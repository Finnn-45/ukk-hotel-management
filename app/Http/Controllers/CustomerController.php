<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Guest;
use App\Models\LandingPageSection;
use App\Models\LandingPageService;
use App\Models\LandingPageGallery;
use App\Models\LandingPageTestimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function home()
    {
        $roomTypes = RoomType::withCount('rooms')->get();
        $rooms = Room::with('roomType')->where('status', 'available')->take(8)->get();
        
        // Dynamic Landing Page Data
        $sections = LandingPageSection::where('is_active', true)->orderBy('order')->get();
        $services = LandingPageService::where('is_active', true)->orderBy('order')->get();
        $galleries = LandingPageGallery::where('is_active', true)->orderBy('order')->take(6)->get();
        $testimonials = LandingPageTestimonial::where('is_active', true)->orderBy('created_at', 'desc')->take(3)->get();

        return view('customer.home', compact('roomTypes', 'rooms', 'sections', 'services', 'galleries', 'testimonials'));
    }

    public function gallery()
    {
        $galleries = LandingPageGallery::orderBy('order')->get();
        return view('customer.gallery', compact('galleries'));
    }

    public function contact()
    {
        $hotelName = \App\Models\Setting::where('key', 'hotel_name')->value('value') ?? 'Hotel Kami';
        $hotelAddress = \App\Models\Setting::where('key', 'hotel_address')->value('value') ?? '';
        $hotelPhone = \App\Models\Setting::where('key', 'hotel_phone')->value('value') ?? '';
        $hotelEmail = \App\Models\Setting::where('key', 'hotel_email')->value('value') ?? '';
        $hotelWhatsapp = \App\Models\Setting::where('key', 'hotel_whatsapp')->value('value') ?? '';
        $latitude = \App\Models\Setting::where('key', 'hotel_latitude')->value('value') ?? '-6.2088';
        $longitude = \App\Models\Setting::where('key', 'hotel_longitude')->value('value') ?? '106.8456';
        $mapsApiKey = \App\Models\Setting::where('key', 'google_maps_api_key')->value('value') ?? '';

        return view('customer.contact', compact('hotelName', 'hotelAddress', 'hotelPhone', 'hotelEmail', 'hotelWhatsapp', 'latitude', 'longitude', 'mapsApiKey'));
    }

    public function rooms(Request $request)
    {
        $query = Room::with('roomType')->where('status', 'available');

        if ($request->filled('room_type')) {
            $query->where('room_type_id', $request->room_type);
        }
        if ($request->filled('min_price')) {
            $query->whereHas('roomType', fn($q) => $q->where('price', '>=', $request->min_price));
        }
        if ($request->filled('max_price')) {
            $query->whereHas('roomType', fn($q) => $q->where('price', '<=', $request->max_price));
        }
        if ($request->filled('floor')) {
            $query->where('floor', $request->floor);
        }

        $rooms = $query->paginate(12);
        $roomTypes = RoomType::all();

        return view('customer.rooms', compact('rooms', 'roomTypes'));
    }

    public function roomDetail(Room $room)
    {
        $room->load('roomType');
        $otherRooms = Room::with('roomType')
            ->where('room_type_id', $room->room_type_id)
            ->where('id', '!=', $room->id)
            ->where('status', 'available')
            ->take(4)
            ->get();

        return view('customer.room-detail', compact('room', 'otherRooms'));
    }

    public function booking(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        $room = Room::with('roomType')->findOrFail($request->room_id);
        $days = \Carbon\Carbon::parse($request->check_in)->diffInDays(\Carbon\Carbon::parse($request->check_out));
        $totalPrice = $room->roomType->price * $days;

        session([
            'booking_data' => [
                'room_id' => $room->id,
                'room_number' => $room->room_number,
                'room_type' => $room->roomType->name,
                'price_per_night' => $room->roomType->price,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'days' => $days,
                'total_price' => $totalPrice,
            ]
        ]);

        return redirect()->route('customer.checkout');
    }

    public function checkout()
    {
        $data = session('booking_data');
        if (!$data) {
            return redirect()->route('rooms.index')->with('error', 'Silakan pilih kamar terlebih dahulu');
        }
        return view('customer.checkout', compact('data'));
    }

    public function processBooking(Request $request)
    {
        $data = session('booking_data');
        if (!$data) {
            return redirect()->route('rooms.index')->with('error', 'Session booking tidak ditemukan');
        }

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
        ]);

        $user = Auth::user();

        // Create or get guest
        $guest = Guest::firstOrCreate(
            ['email' => $request->email],
            [
                'user_id' => $user->id,
                'full_name' => $request->full_name,
                'phone' => $request->phone,
            ]
        );

        // Create booking with pending status
        $booking = Booking::create([
            'guest_id' => $guest->id,
            'room_id' => $data['room_id'],
            'check_in' => $data['check_in'],
            'check_out' => $data['check_out'],
            'number_of_guests' => 1,
            'total_price' => $data['total_price'],
            'status' => 'pending',
        ]);

        // Update room status
        Room::find($data['room_id'])->update(['status' => 'booked']);

        // Create payment record with pending status
        Payment::create([
            'booking_id' => $booking->id,
            'payment_method' => 'midtrans',
            'payment_status' => 'pending',
            'amount' => $data['total_price'],
        ]);

        // Clear session
        session()->forget('booking_data');

        return redirect()->route('customer.booking.success', $booking)->with('info', 'Silakan selesaikan pembayaran untuk mengkonfirmasi booking.');
    }

    public function bookingSuccess(Booking $booking)
    {
        $booking->load(['room.roomType', 'guest', 'payment']);
        return view('customer.booking-success', compact('booking'));
    }

    public function myBookings()
    {
        $user = Auth::user();
        $guest = Guest::where('user_id', $user->id)->first();

        if (!$guest) {
            $bookings = Booking::where('id', 0)->paginate(10);
        } else {
            $bookings = Booking::with(['room.roomType', 'payment', 'review'])
                ->where('guest_id', $guest->id)
                ->latest()
                ->paginate(10);
        }

        return view('customer.my-bookings', compact('bookings'));
    }

    public function cancelBooking(Booking $booking)
    {
        $user = Auth::user();
        $guest = Guest::where('user_id', $user->id)->firstOrFail();

        if ($booking->guest_id !== $guest->id) {
            abort(403);
        }

        if ($booking->status == 'cancelled') {
            return back()->with('error', 'Booking sudah dibatalkan');
        }

        if ($booking->status == 'completed') {
            return back()->with('error', 'Booking sudah selesai, tidak dapat dibatalkan');
        }

        $booking->update(['status' => 'cancelled']);
        $booking->room->update(['status' => 'available']);

        if ($booking->payment) {
            $booking->payment->update(['payment_status' => 'cancelled']);
        }

        return back()->with('success', 'Booking berhasil dibatalkan');
    }

    public function customerCheckOut(Booking $booking)
    {
        $user = Auth::user();
        $guest = Guest::where('user_id', $user->id)->firstOrFail();

        if ($booking->guest_id !== $guest->id) {
            abort(403);
        }

        if ($booking->status !== 'checked_in') {
            return back()->with('error', 'Booking harus berstatus checked_in untuk check-out');
        }

        $booking->update(['status' => 'checked_out']);
        $booking->room->update(['status' => 'available']);

        return back()->with('success', 'Check-out berhasil! Terima kasih telah menginap di hotel kami.');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('customer.profile', compact('user'));
    }

    public function wishlist()
    {
        return view('customer.wishlist');
    }

    public function notifications()
    {
        $user = Auth::user();
        $notifications = \App\Models\Notification::where('user_id', $user->id)
            ->orWhere('type', 'global')
            ->latest()
            ->take(20)
            ->get();
        return view('customer.notifications', compact('notifications'));
    }

    public function reviews()
    {
        $user = Auth::user();
        $reviews = \App\Models\Review::with('booking.room.roomType')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);
        return view('customer.reviews', compact('reviews'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'current_password' => 'nullable|required_with:new_password|current_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update guest phone if exists
        $guest = Guest::where('user_id', $user->id)->first();
        if ($guest) {
            $guest->update(['phone' => $request->phone]);
        }

        // Update password if provided
        if ($request->filled('new_password')) {
            $user->update([
                'password' => bcrypt($request->new_password),
            ]);
        }

        return back()->with('success', 'Profile berhasil diupdate!');
    }
}
