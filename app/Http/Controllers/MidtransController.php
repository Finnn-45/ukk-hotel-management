<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransController extends Controller
{
    public function getSnapToken(Request $request, Booking $booking)
    {
        try {
            $user = Auth::user();

            // Load booking with guest relation
            $booking->load(['guest', 'room.roomType']);

            if (!$booking->guest) {
                return response()->json([
                    'error'   => true,
                    'message' => 'Data tamu booking tidak ditemukan.',
                ], 404);
            }

            $guest = $booking->guest;

            // Ensure this booking belongs to the authenticated user
            // Check via guest's user_id OR via direct user match
            if ($guest->user_id !== null && $guest->user_id !== $user->id) {
                Log::warning("Midtrans: User {$user->id} tried to access booking {$booking->id} owned by guest user {$guest->user_id}");
                return response()->json([
                    'error'   => true,
                    'message' => 'Booking tidak ditemukan atau Anda tidak memiliki akses.',
                ], 403);
            }

            // If guest has no user_id yet, claim it (for walk-in converted bookings)
            if (!$guest->user_id) {
                $guest->update(['user_id' => $user->id]);
                $guest->refresh();
            }

            // Validate required fields
            if (empty($guest->email) || empty($guest->phone)) {
                return response()->json([
                    'error'   => true,
                    'message' => 'Data pelanggan tidak lengkap. Email dan nomor telepon wajib diisi.',
                ], 400);
            }

            Config::$serverKey = config('services.midtrans.server_key');
            Config::$isProduction = config('services.midtrans.is_production');
            Config::$isSanitized = config('services.midtrans.is_sanitized');
            Config::$is3ds = config('services.midtrans.is_3ds');

            $orderId = 'BOOKING-' . $booking->id;

            // Create or update payment record
            $payment = Payment::updateOrCreate(
                ['booking_id' => $booking->id],
                [
                    'payment_method' => 'midtrans',
                    'payment_status' => 'pending',
                    'amount' => $booking->total_price,
                    'midtrans_order_id' => $orderId,
                ]
            );

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $booking->total_price,
                ],
                'customer_details' => [
                    'first_name' => $guest->full_name,
                    'email' => $guest->email,
                    'phone' => $guest->phone,
                ],
                'item_details' => [
                    [
                        'id' => $booking->room->id,
                        'price' => (int) $booking->room->roomType->price,
                        'quantity' => \Carbon\Carbon::parse($booking->check_in)->diffInDays(\Carbon\Carbon::parse($booking->check_out)) ?: 1,
                        'name' => $booking->room->roomType->name . ' - Room ' . $booking->room->room_number,
                    ]
                ],
            ];

            $snapToken = Snap::getSnapToken($params);
            
            return response()->json([
                'token' => $snapToken,
                'payment_id' => $payment->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage() . ' | Booking: ' . $booking->id);
            return response()->json([
                'error'   => true,
                'message' => 'Gagal memuat pembayaran: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function paymentSuccess(Request $request)
    {
        $orderId = $request->query('order_id');
        $statusCode = $request->query('status_code');
        
        if ($statusCode == 200 && $orderId) {
            $payment = Payment::where('midtrans_order_id', $orderId)->first();
            
            if ($payment && $payment->booking) {
                $payment->update([
                    'payment_status' => 'paid',
                    'paid_at' => now(),
                ]);

                $booking = $payment->booking;
                $booking->update(['status' => 'confirmed']);

                return redirect()->route('customer.booking.success', $booking)
                    ->with('success', 'Pembayaran berhasil! Booking Anda telah dikonfirmasi.');
            }
        }

        return redirect()->route('rooms.index')
            ->with('error', 'Pembayaran gagal atau dibatalkan.');
    }

    public function paymentPending(Request $request)
    {
        $orderId = $request->query('order_id');
        $payment = Payment::where('midtrans_order_id', $orderId)->first();
        
        if ($payment) {
            $payment->update(['payment_status' => 'pending']);
        }

        return redirect()->route('customer.booking.success', $payment->booking)
            ->with('info', 'Menunggu pembayaran. Silakan selesaikan pembayaran sebelum batas waktu.');
    }

    public function paymentError(Request $request)
    {
        return redirect()->route('rooms.index')
            ->with('error', 'Pembayaran gagal. Silakan coba lagi.');
    }

    public function getRestaurantSnapToken(Request $request, \App\Models\RestaurantOrder $order)
    {
        try {
            $user = Auth::user();
            $order->load(['guest']);

            if (!$order->guest) {
                return response()->json([
                    'error' => true,
                    'message' => 'Data tamu tidak ditemukan.',
                ], 404);
            }

            $guest = $order->guest;

            if ($guest->user_id !== $user->id) {
                return response()->json([
                    'error' => true,
                    'message' => 'Pesanan tidak ditemukan atau Anda tidak memiliki akses.',
                ], 403);
            }

            if (empty($guest->email) || empty($guest->phone)) {
                return response()->json([
                    'error' => true,
                    'message' => 'Data pelanggan tidak lengkap. Email dan nomor telepon wajib diisi.',
                ], 400);
            }

            Config::$serverKey = config('services.midtrans.server_key');
            Config::$isProduction = config('services.midtrans.is_production');
            Config::$isSanitized = config('services.midtrans.is_sanitized');
            Config::$is3ds = config('services.midtrans.is_3ds');

            $orderId = 'RESTAURANT-' . $order->id;

            $payment = Payment::updateOrCreate(
                ['restaurant_order_id' => $order->id],
                [
                    'payment_method' => 'midtrans',
                    'payment_status' => 'pending',
                    'amount' => $order->total_amount,
                    'midtrans_order_id' => $orderId,
                ]
            );

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
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

            $snapToken = Snap::getSnapToken($params);

            return response()->json([
                'token' => $snapToken,
                'payment_id' => $payment->id,
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Midtrans Restaurant Error: ' . $e->getMessage() . ' | Order: ' . $order->id);
            return response()->json([
                'error' => true,
                'message' => 'Gagal memuat pembayaran: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function restaurantPaymentSuccess(Request $request)
    {
        $orderId = $request->query('order_id');
        $statusCode = $request->query('status_code');

        if ($statusCode == 200 && $orderId) {
            $payment = Payment::where('midtrans_order_id', $orderId)->first();

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

    public function restaurantPaymentPending(Request $request)
    {
        $orderId = $request->query('order_id');
        $payment = Payment::where('midtrans_order_id', $orderId)->first();

        if ($payment) {
            $payment->update(['payment_status' => 'pending']);
        }

        return redirect()->route('customer.restaurant.order.detail', $payment->restaurantOrder)
            ->with('info', 'Menunggu pembayaran. Silakan selesaikan pembayaran sebelum batas waktu.');
    }

    public function restaurantPaymentError(Request $request)
    {
        return redirect()->route('customer.restaurant.orders')
            ->with('error', 'Pembayaran gagal. Silakan coba lagi.');
    }
}
