<?php

namespace App\Http\Controllers;

use App\Models\RestaurantMenu;
use App\Models\RestaurantOrder;
use App\Models\RestaurantOrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerRestaurantController extends Controller
{
    public function menu()
    {
        $categories = RestaurantMenu::select('category')->distinct()->pluck('category');
        $menus = RestaurantMenu::where('is_available', true)->get();

        // Hanya tamu dengan reservasi aktif yang boleh memesan restoran.
        $hasBookedRoom = false;
        if (auth()->check()) {
            $guest = \App\Models\Guest::where('user_id', auth()->id())->first();
            if ($guest && $guest->bookings()->whereIn('status', ['confirmed', 'checked_in'])->exists()) {
                $hasBookedRoom = true;
            }
        }

        return view('customer.restaurant.menu', compact('menus', 'categories', 'hasBookedRoom'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:restaurant_menus,id',
            'items.*.quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500',
            'order_type' => 'required|in:dine_in,takeaway,delivery',
            'table_number' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();

        // Cegah bypass dari request manual: wajib memiliki reservasi aktif.
        $guest = \App\Models\Guest::where('user_id', $user->id)->first();
        $hasBookedRoom = $guest && $guest->bookings()->whereIn('status', ['confirmed', 'checked_in'])->exists();

        if (!$hasBookedRoom) {
            return redirect()->back()->with('error', 'Anda harus melakukan booking kamar terlebih dahulu sebelum dapat memesan makanan restoran.');
        }

        $guest = \App\Models\Guest::firstOrCreate(
            ['user_id' => $user->id],
            [
                'full_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? '',
            ]
        );

        // Calculate total
        $total = 0;
        foreach ($request->items as $item) {
            $menu = RestaurantMenu::findOrFail($item['menu_id']);
            $total += $menu->price * $item['quantity'];
        }

        // Create order
        $order = RestaurantOrder::create([
            'guest_id' => $guest->id,
            'order_number' => 'ORD-' . time() . '-' . rand(1000, 9999),
            'order_date' => now(),
            'total_amount' => $total,
            'status' => 'pending_payment',
            'notes' => $request->notes,
            'order_type' => $request->order_type,
            'table_number' => $request->order_type === 'dine_in' ? $request->table_number : null,
        ]);

        // Create order details
        foreach ($request->items as $item) {
            $menu = RestaurantMenu::findOrFail($item['menu_id']);
            RestaurantOrderDetail::create([
                'restaurant_order_id' => $order->id,
                'menu_id' => $menu->id,
                'quantity' => $item['quantity'],
                'price' => $menu->price,
                'subtotal' => $menu->price * $item['quantity'],
            ]);
        }

        // Create payment record with truly unique order_id
        $payment = \App\Models\Payment::create([
            'restaurant_order_id' => $order->id,
            'payment_method' => 'midtrans',
            'payment_status' => 'pending',
            'amount' => $total,
            'midtrans_order_id' => 'RESTAURANT-' . $order->id . '-' . microtime(true),
        ]);

        // Send notification to admin
        \App\Models\Notification::sendToAdmins(
            'new_restaurant_order',
            'Pesanan Restaurant Baru',
            $guest->full_name . ' memesan ' . $order->details->count() . ' item (Total: Rp ' . number_format($total, 0, ',', '.') . ')',
            route('admin.restaurant.order.show', $order)
        );

        // Send notification to customer
        \App\Models\Notification::send(
            $guest->user_id,
            'restaurant_order_created',
            'Pesanan Restaurant Diterima',
            'Pesanan Anda telah diterima. Silakan lakukan pembayaran.',
            route('customer.restaurant.order.detail', $order)
        );

        // Redirect to payment page
        return redirect()->route('customer.restaurant.payment', $order)
            ->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }

    public function payment(RestaurantOrder $order)
    {
        $user = Auth::user();
        $guest = \App\Models\Guest::where('user_id', $user->id)->first();

        if (!$guest || $order->guest_id !== $guest->id) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini');
        }

        $order->load(['details.menu']);
        $payment = $order->payment;

        if (!$payment) {
            abort(404, 'Pembayaran tidak ditemukan');
        }

        // Get Midtrans Snap Token
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = config('services.midtrans.is_sanitized');
        \Midtrans\Config::$is3ds = config('services.midtrans.is_3ds');

        // Always generate new unique order_id to avoid Midtrans duplicate error
        $newOrderId = 'RESTAURANT-' . $order->id . '-' . time() . '-' . rand(1000, 9999);

        $params = [
            'transaction_details' => [
                'order_id' => $newOrderId,
                'gross_amount' => (int) $order->total_amount,
            ],
            'customer_details' => [
                'first_name' => $guest->full_name,
                'email' => $guest->email,
                'phone' => $guest->phone,
            ],
            'item_details' => $order->details->map(function ($detail) {
                return [
                    'id' => $detail->menu_id,
                    'price' => (int) $detail->price,
                    'quantity' => $detail->quantity,
                    'name' => $detail->menu->name,
                ];
            })->toArray(),
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Update payment with new order_id and snap token
        $payment->update([
            'midtrans_order_id' => $newOrderId,
            'midtrans_snap_token' => $snapToken,
        ]);

        return view('customer.restaurant.payment', compact('order', 'payment', 'snapToken'));
    }

    public function paymentSuccess(Request $request)
    {
        $orderId = $request->query('order_id');
        $statusCode = $request->query('status_code');

        if ($statusCode == 200 && $orderId) {
            $payment = \App\Models\Payment::where('midtrans_order_id', $orderId)->first();

            if ($payment && $payment->restaurantOrder) {
                $payment->update([
                    'payment_status' => 'paid',
                    'paid_at' => now(),
                ]);

                $order = $payment->restaurantOrder;
                $order->update(['status' => 'preparing']);

                return redirect()->route('customer.restaurant.order.detail', $order)
                    ->with('success', 'Pembayaran berhasil! Pesanan Anda sedang diproses.');
            }
        }

        return redirect()->route('customer.restaurant.orders')
            ->with('error', 'Pembayaran gagal atau dibatalkan.');
    }

    public function paymentPending(Request $request)
    {
        $orderId = $request->query('order_id');
        $payment = \App\Models\Payment::where('midtrans_order_id', $orderId)->first();

        if ($payment) {
            $payment->update(['payment_status' => 'pending']);
        }

        return redirect()->route('customer.restaurant.order.detail', $payment->restaurantOrder)
            ->with('info', 'Menunggu pembayaran. Silakan selesaikan pembayaran sebelum batas waktu.');
    }

    public function paymentError(Request $request)
    {
        return redirect()->route('customer.restaurant.orders')
            ->with('error', 'Pembayaran gagal. Silakan coba lagi.');
    }

    public function orderConfirmation(RestaurantOrder $order)
    {
        $order->load(['details.menu', 'guest']);
        return view('customer.restaurant.confirmation', compact('order'));
    }

    public function myOrders()
    {
        $user = Auth::user();
        $guest = \App\Models\Guest::where('user_id', $user->id)->first();

        if (!$guest) {
            $orders = RestaurantOrder::where('id', 0)->paginate(10);
        } else {
            $orders = RestaurantOrder::where('guest_id', $guest->id)
                ->with('details.menu')
                ->latest()
                ->paginate(10);
        }

        return view('customer.restaurant.orders', compact('orders'));
    }

    public function orderDetail(RestaurantOrder $order)
    {
        $user = Auth::user();
        $guest = \App\Models\Guest::where('user_id', $user->id)->first();

        if (!$guest || $order->guest_id !== $guest->id) {
            abort(403, 'Anda tidak memiliki akses ke pesanan ini');
        }

        $order->load(['details.menu']);
        return view('customer.restaurant.order-detail', compact('order'));
    }
}
