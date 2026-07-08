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
        $user = Auth::user();
        
        // Ensure booking belongs to the authenticated user
        $guest = \App\Models\Guest::where('user_id', $user->id)
            ->where('id', $booking->guest_id)
            ->firstOrFail();

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

        try {
            $snapToken = Snap::getSnapToken($params);
            
            return response()->json([
                'token' => $snapToken,
                'payment_id' => $payment->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function paymentSuccess(Request $request)
    {
        $orderId = $request->query('order_id');
        $statusCode = $request->query('status_code');
        
        if ($statusCode == 200) {
            $payment = Payment::where('midtrans_order_id', $orderId)->first();
            
            if ($payment) {
                $payment->update([
                    'payment_status' => 'paid',
                    'paid_at' => now(),
                ]);

                $booking = $payment->booking;
                $booking->update(['status' => 'confirmed']);
            }

            return redirect()->route('customer.booking.success', $payment->booking)
                ->with('success', 'Pembayaran berhasil! Booking Anda telah dikonfirmasi.');
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
}