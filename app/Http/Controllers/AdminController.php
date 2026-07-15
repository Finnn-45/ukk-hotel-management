<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Guest;
use App\Models\Payment;
use App\Models\RestaurantOrder;
use App\Models\RestaurantOrderDetail;
use App\Models\Review;
use App\Models\ActivityLog;

class AdminController extends Controller
{
    public function dashboard()
    {
        $today = now()->startOfDay();
        $totalRooms = Room::count();
        $occupiedRooms = Room::where('status', 'occupied')->count();
        $availableRooms = Room::where('status', 'available')->count();
        $cleaningRooms = Room::where('status', 'cleaning')->count();
        $maintenanceRooms = Room::where('status', 'maintenance')->count();

        $stats = [
            'total_rooms' => $totalRooms,
            'occupied_rooms' => $occupiedRooms,
            'available_rooms' => $availableRooms,
            'cleaning_rooms' => $cleaningRooms,
            'maintenance_rooms' => $maintenanceRooms,
            'total_bookings' => Booking::count(),
            'total_guests' => Guest::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'restaurant_orders' => RestaurantOrder::where('status', 'pending')->count(),
            'today_bookings' => Booking::whereDate('created_at', $today)->count(),
            'today_restaurant_orders' => RestaurantOrder::whereDate('created_at', $today)->count(),
            'today_revenue' => Payment::where('payment_status', 'paid')
                ->whereDate('paid_at', $today)
                ->sum('amount'),
        ];

        $recent_bookings = Booking::with('guest', 'room.roomType')
            ->latest()
            ->take(5)
            ->get();

        $recent_payments = Payment::with('booking.guest')
            ->latest()
            ->take(5)
            ->get();

        $recent_restaurant_orders = RestaurantOrder::with('details.menu', 'guest')
            ->latest()
            ->take(5)
            ->get();

        $recent_reviews = Review::with('user')
            ->latest()
            ->take(4)
            ->get();

        $recent_activities = ActivityLog::latest()->take(6)->get() ?? collect();

        $rooms = Room::with('roomType')->orderBy('room_number')->get();

        // Pre-calculate weekly revenue data (to avoid Payment model usage in Blade)
        $weeklyRevenue = [];
        $weeklyDays = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $weeklyDays[] = $date->translatedFormat('D');
            $weeklyRevenue[] = (int) Payment::where('payment_status', 'paid')
                ->whereDate('paid_at', $date)
                ->sum('amount');
        }

        $reports = [
            'monthly_revenue' => Payment::where('payment_status', 'paid')
                ->whereMonth('paid_at', now()->month)
                ->whereYear('paid_at', now()->year)
                ->sum('amount'),
            'yearly_revenue' => Payment::where('payment_status', 'paid')
                ->whereYear('paid_at', now()->year)
                ->sum('amount'),
            'occupancy_rate' => $totalRooms > 0 ? round(($totalRooms - $availableRooms) / $totalRooms * 100, 2) : 0,
            'booking_trends' => Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as count, SUM(total_price) as revenue')
                ->whereYear('created_at', now()->year)
                ->groupBy('month')
                ->orderBy('month')
                ->get(),
            'restaurant_performance' => RestaurantOrder::selectRaw('MONTH(created_at) as month, COUNT(*) as orders, SUM(total_amount) as revenue')
                ->whereYear('created_at', now()->year)
                ->groupBy('month')
                ->orderBy('month')
                ->get(),
            'payment_methods' => Payment::where('payment_status', 'paid')
                ->selectRaw('payment_method, COUNT(*) as count, SUM(amount) as total')
                ->groupBy('payment_method')
                ->get(),
            'weekly_revenue' => $weeklyRevenue,
            'weekly_days' => $weeklyDays,
        ];

        // 14-day Booking Timeline Data
        $startDate = now()->startOfDay();
        $endDate = now()->startOfDay()->addDays(14);
        
        $timeline_dates = [];
        for ($i = 0; $i < 14; $i++) {
            $timeline_dates[] = now()->startOfDay()->addDays($i);
        }

        $room_types_timeline = \App\Models\RoomType::with(['rooms' => function($q) {
            $q->orderBy('room_number');
        }, 'rooms.bookings' => function($q) use ($startDate, $endDate) {
            $q->where('status', '!=', 'cancelled')
              ->where('check_out', '>', $startDate)
              ->where('check_in', '<', $endDate)
              ->with('guest');
        }])->get();

        return view('admin.dashboard', compact(
            'stats', 
            'recent_bookings', 
            'recent_payments',
            'recent_restaurant_orders',
            'recent_reviews',
            'recent_activities',
            'rooms',
            'reports',
            'timeline_dates',
            'room_types_timeline'
        ));
    }

    public function reviewsIndex()
    {
        $reviews = Review::with('user')->latest()->paginate(20);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function approveReview(Review $review)
    {
        $review->update(['is_approved' => true, 'status' => 'approved']);
        return redirect()->back()->with('success', 'Review berhasil disetujui.');
    }

    public function destroyReview(Review $review)
    {
        $review->delete();
        return redirect()->back()->with('success', 'Review berhasil dihapus.');
    }

    public function approvePayment(Payment $payment)
    {
        $payment->update(['payment_status' => 'paid', 'paid_at' => now()]);
        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }

    public function rejectPayment(Payment $payment)
    {
        $payment->update(['payment_status' => 'failed']);
        return redirect()->back()->with('success', 'Pembayaran ditolak.');
    }
}
