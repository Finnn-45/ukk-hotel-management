<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Booking;
use App\Models\Guest;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $booking = Booking::findOrFail($request->booking_id);
        $guest = Guest::where('user_id', auth()->id())->first();
        
        // Pastikan booking milik user yang login
        if (!$guest || $booking->guest_id !== $guest->id) {
            return back()->with('error', 'Anda tidak memiliki akses ke booking ini.');
        }

        // Pastikan booking sudah selesai (checkout)
        if ($booking->status !== 'completed' && $booking->status !== 'checked_out') {
            return back()->with('error', 'Anda hanya bisa mereview setelah check out');
        }

        // Cek apakah sudah pernah review
        if (Review::where('booking_id', $booking->id)->exists()) {
            return back()->with('error', 'Anda sudah memberikan review untuk booking ini');
        }

        Review::create([
            'booking_id' => $booking->id,
            'user_id' => auth()->id(),
            'room_id' => $booking->room_id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return back()->with('success', 'Review berhasil dikirim! Terima kasih atas feedback Anda.');
    }
}
