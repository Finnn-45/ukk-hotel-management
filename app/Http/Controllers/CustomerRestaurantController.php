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
            'delivery_address' => 'nullable|required_if:order_type,delivery|string|max:500',
            'delivery_city_id' => 'nullable|required_if:order_type,delivery|string|max:20',
            'delivery_province_id' => 'nullable|required_if:order_type,delivery|string|max:20',
            'delivery_postal_code' => 'nullable|required_if:order_type,delivery|string|max:10',
            'shipping_courier' => 'nullable|required_if:order_type,delivery|string|max:20',
            'shipping_service' => 'nullable|required_if:order_type,delivery|string|max:50',
            'shipping_cost' => 'nullable|required_if:order_type,delivery|numeric|min:0',
            'estimated_delivery' => 'nullable|required_if:order_type,delivery|string|max:50',
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

        // Add shipping cost for delivery orders
        $shippingCost = $request->shipping_cost ?? 0;
        $total += $shippingCost;

        // Create order
        $order = RestaurantOrder::create([
            'guest_id' => $guest->id,
            'order_number' => 'ORD-' . time() . '-' . rand(1000, 9999),
            'order_date' => now(),
            'total_amount' => $total,
            'status' => 'pending',
            'notes' => $request->notes,
            'order_type' => $request->order_type,
            'table_number' => $request->order_type === 'dine_in' ? $request->table_number : null,
            'delivery_address' => $request->order_type === 'delivery' ? $request->delivery_address : null,
            'delivery_city_id' => $request->delivery_city_id,
            'delivery_province_id' => $request->delivery_province_id,
            'delivery_postal_code' => $request->delivery_postal_code,
            'shipping_courier' => $request->shipping_courier,
            'shipping_service' => $request->shipping_service,
            'shipping_cost' => $shippingCost,
            'estimated_delivery' => $request->estimated_delivery,
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

        return redirect()->route('customer.restaurant.order.confirmation', $order)
            ->with('success', 'Pesanan berhasil dibuat!');
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