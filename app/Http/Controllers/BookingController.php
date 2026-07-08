<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Guest;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmationMail;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['guest', 'room.roomType']);
        
        if ($request->has('search')) {
            $query->whereHas('guest', function ($q) use ($request) {
                $q->where('full_name', 'like', "%{$request->search}%");
            });
        }
        
        $bookings = $query->latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $rooms = Room::where('status', 'available')->get();
        $guests = Guest::all();
        return view('admin.bookings.create', compact('rooms', 'guests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'number_of_guests' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
        ]);

        $booking = Booking::create($request->all());
        
        // Update room status
        $room = Room::find($request->room_id);
        $room->update(['status' => 'booked']);

        // Send booking confirmation email
        try {
            Mail::to($booking->guest->email ?? $booking->user->email ?? 'customer@example.com')
                ->send(new BookingConfirmationMail($booking));
        } catch (\Exception $e) {
            \Log::error('Failed to send booking confirmation email: ' . $e->getMessage());
        }

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil dibuat');
    }

    public function show(Booking $booking)
    {
        $booking->load(['guest', 'room.roomType', 'payment']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $rooms = Room::all();
        $guests = Guest::all();
        return view('admin.bookings.edit', compact('booking', 'rooms', 'guests'));
    }

    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'guest_id' => 'required|exists:guests,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'number_of_guests' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,checked_in,checked_out,cancelled',
        ]);

        $booking->update($request->all());

        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil diupdate');
    }

    public function checkIn(Booking $booking)
    {
        if ($booking->status !== 'confirmed') {
            return back()->with('error', 'Booking harus berstatus confirmed untuk check-in');
        }
        
        $booking->update(['status' => 'checked_in']);
        $booking->room->update(['status' => 'occupied']);
        
        ActivityLog::log('check_in', 'Check-in booking #' . $booking->id, $booking);
        
        return back()->with('success', 'Check-in berhasil');
    }

    public function checkOut(Booking $booking)
    {
        if ($booking->status !== 'checked_in') {
            return back()->with('error', 'Booking harus berstatus checked_in untuk check-out');
        }
        
        $booking->update(['status' => 'checked_out']);
        $booking->room->update(['status' => 'available']);
        
        ActivityLog::log('check_out', 'Check-out booking #' . $booking->id, $booking);
        
        return back()->with('success', 'Check-out berhasil');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking berhasil dihapus');
    }
}
