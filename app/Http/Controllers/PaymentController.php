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

        $booking->load('guest', 'room.roomType');

        $checkIn = \Carbon\Carbon::parse($booking->check_in);
        $checkOut = \Carbon\Carbon::parse($booking->check_out);
        $nights = max($checkIn->diffInDays($checkOut), 1);

        $params = [
            'transaction_details' => [
                'order_id' => 'BOOKING-' . $booking->id,
                'gross_amount' => (int) $booking->total_price,
            ],
            'customer_details' => [
                'first_name' => $booking->guest->full_name,
                'email' => $booking->guest->email,
                'phone' => $booking->guest->phone,
            ],
            'item_details' => [
                [
                    'id' => $booking->room->id,
                    'price' => (int) $booking->room->roomType->price,
                    'quantity' => $nights,
                    'name' => $booking->room->roomType->name . ' - Room ' . $booking->room->room_number,
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

        $bookingId = preg_replace('/[^0-9]/', '', $orderId);
        $booking = Booking::find($bookingId);

        if (!$booking) {
            return response()->json(['status' => 'error', 'message' => 'Booking not found']);
        }

        if (!$booking) {
            return response()->json(['status' => 'error', 'message' => 'Booking not found']);
        }

        $payment = Payment::where('booking_id', $booking->id)->firstOrFail();

        $oldStatus = $payment->payment_status;

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

        // Send notifications if payment status changed to paid
        if ($oldStatus != 'paid' && $payment->payment_status == 'paid') {
            if ($payment->booking) {
                $booking = $payment->booking;
                $booking->update(['status' => 'confirmed']);

                \App\Models\Notification::sendToAdmins(
                    'payment_received',
                    'Pembayaran Diterima',
                    'Pembayaran booking kamar ' . $booking->room->room_number . ' sebesar Rp ' . number_format($payment->amount, 0, ',', '.') . ' telah dikonfirmasi',
                    route('admin.bookings.show', $booking)
                );

                \App\Models\Notification::send(
                    $booking->guest->user_id,
                    'payment_success',
                    'Pembayaran Berhasil',
                    'Pembayaran booking kamar ' . $booking->room->room_number . ' telah dikonfirmasi. Kamar Anda sudah terbooking!',
                    route('customer.bookings')
                );
            }

            if ($payment->restaurantOrder) {
                $order = $payment->restaurantOrder;
                $order->update(['status' => 'preparing']);

                \App\Models\Notification::sendToAdmins(
                    'restaurant_payment_received',
                    'Pembayaran Restaurant Diterima',
                    'Pembayaran pesanan restaurant #' . $order->order_number . ' sebesar Rp ' . number_format($payment->amount, 0, ',', '.') . ' telah dikonfirmasi',
                    route('admin.restaurant.order.show', $order)
                );

                \App\Models\Notification::send(
                    $order->guest->user_id,
                    'restaurant_payment_success',
                    'Pembayaran Restaurant Berhasil',
                    'Pembayaran pesanan restaurant Anda telah dikonfirmasi. Pesanan sedang diproses.',
                    route('customer.restaurant.order.detail', $order)
                );
            }
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

        $isNowPaid = $request->payment_status === 'paid' && $payment->payment_status !== 'paid';

        $payment->update([
            'payment_status' => $request->payment_status,
            'payment_method' => $request->payment_method,
            'paid_at' => $isNowPaid ? now() : $payment->paid_at,
        ]);

        if ($isNowPaid && !$payment->verification_code) {
            $payment->update(['verification_code' => $this->generateVerificationCode()]);
        }

        return redirect()->route('admin.payments.index')->with('success', 'Payment berhasil diupdate');
    }

    public function showVerificationForm()
    {
        return view('admin.verify-booking');
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:8',
        ]);

        $code = strtoupper($request->code);

        $payment = Payment::where('verification_code', $code)
            ->where('payment_status', 'paid')
            ->with('booking.guest', 'booking.room')
            ->first();

        if (!$payment) {
            return back()->with('error', 'Kode verifikasi tidak ditemukan atau pembayaran belum dikonfirmasi.');
        }

        $booking = $payment->booking;

        if ($booking->status === 'checked_in') {
            return back()->with('info', 'Booking ini sudah check-in sebelumnya.');
        }

        $booking->update(['status' => 'checked_in']);
        $booking->room->update(['status' => 'occupied']);

        ActivityLog::log('check_in_verification', 'Auto check-in via kode verifikasi #' . $booking->id, $booking);

        return view('admin.verify-booking-success', compact('booking', 'payment'));
    }

    private function generateVerificationCode()
    {
        do {
            $code = strtoupper(substr(bin2hex(random_bytes(4)), 0, 8));
        } while (Payment::where('verification_code', $code)->exists());

        return $code;
    }
}
