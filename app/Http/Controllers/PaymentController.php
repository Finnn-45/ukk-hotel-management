<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['booking.guest', 'booking.room.roomType']);
        
        if ($request->has('search')) {
            $paymentStatus = strtolower($request->search);
            $query->where('payment_status', 'like', "%{$paymentStatus}%")
                  ->orWhere('payment_method', 'like', "%{$paymentStatus}%");
        }
        
        $payments = $query->latest()->paginate(10);
        return view('admin.payments.index', compact('payments'));
    }

    public function getMidtransSnapToken(Request $request, Booking $booking)
    {
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');

        $payment = Payment::where('booking_id', $booking->id)->firstOrFail();

        $params = [
            'transaction_details' => [
                'order_id' => $booking->booking_code,
                'gross_amount' => (int) $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $booking->guest->name,
                'email' => $booking->guest->email,
                'phone' => $booking->guest->phone,
            ],
            'item_details' => [
                [
                    'id' => $booking->room->id,
                    'price' => (int) $booking->room->price,
                    'quantity' => $booking->duration_nights,
                    'name' => $booking->room->roomType->name . ' - ' . $booking->room->room_number,
                ]
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        $snapRedirectUrl = Snap::getSnapRedirectUrl($params);

        return response()->json([
            'token' => $snapToken,
            'redirect_url' => $snapRedirectUrl,
            'payment' => $payment,
        ]);
    }

    public function midtransNotification(Request $request)
    {
        $notif = new \Midtrans\Notification();
        
        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $orderId = $notif->order_id;
        $fraud = $notif->fraud_status;

        $booking = Booking::where('booking_code', $orderId)->first();
        
        if (!$booking) {
            return response()->json(['status' => 'error', 'message' => 'Booking not found']);
        }

        $payment = Payment::where('booking_id', $booking->id)->firstOrFail();

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $payment->update(['payment_status' => 'challenge']);
                } else {
                    $payment->update(['payment_status' => 'paid', 'paid_at' => now()]);
                }
            }
        } elseif ($transaction == 'settlement') {
            $payment->update(['payment_status' => 'paid', 'paid_at' => now()]);
        } elseif ($transaction == 'pending') {
            $payment->update(['payment_status' => 'pending']);
        } elseif ($transaction == 'deny') {
            $payment->update(['payment_status' => 'failed']);
        } elseif ($transaction == 'expire') {
            $payment->update(['payment_status' => 'expired']);
        } elseif ($transaction == 'cancel') {
            $payment->update(['payment_status' => 'cancelled']);
        }

        return response()->json(['status' => 'success']);
    }

    public function show(Payment $payment)
    {
        $payment->load(['booking.guest', 'booking.room.roomType']);
        return view('admin.payments.show', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'payment_status' => 'required|string',
            'payment_method' => 'required|in:cash,transfer,credit_card,e_wallet',
        ]);

        $payment->update([
            'payment_status' => $request->payment_status,
            'payment_method' => $request->payment_method,
            'paid_at' => $request->payment_status === 'paid' ? now() : $payment->paid_at,
        ]);

        return redirect()->route('admin.payments.index')->with('success', 'Payment berhasil diupdate');
    }
}