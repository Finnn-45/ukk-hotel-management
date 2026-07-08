<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Guest;
use App\Models\Payment;
use App\Models\RestaurantOrder;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'total_rooms' => Room::count(),
            'available_rooms' => Room::where('status', 'available')->count(),
            'total_guests' => Guest::count(),
            'total_revenue' => Payment::where('payment_status', 'paid')->sum('amount'),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'restaurant_orders' => RestaurantOrder::where('status', 'pending')->count(),
        ];

        $recent_bookings = Booking::latest()->take(5)->get();
        $recent_payments = Payment::latest()->take(5)->get();

        // Top Level Management Reports
        $reports = [
            'monthly_revenue' => Payment::where('payment_status', 'paid')
                ->whereMonth('paid_at', now()->month)
                ->whereYear('paid_at', now()->year)
                ->sum('amount'),
            
            'yearly_revenue' => Payment::where('payment_status', 'paid')
                ->whereYear('paid_at', now()->year)
                ->sum('amount'),
            
            'occupancy_rate' => $stats['total_rooms'] > 0 ? round(($stats['total_rooms'] - $stats['available_rooms']) / $stats['total_rooms'] * 100, 2) : 0,
            
            'booking_trends' => Booking::selectRaw('MONTH(created_at) as month, COUNT(*) as count, SUM(total_price) as revenue')
                ->whereYear('created_at', now()->year)
                ->groupBy('month')
                ->orderBy('month')
                ->get(),
            
            'room_type_distribution' => \App\Models\RoomType::withCount('rooms')
                ->get(['name', 'room_type']),
            
            'payment_methods' => Payment::where('payment_status', 'paid')
                ->selectRaw('payment_method, COUNT(*) as count, SUM(amount) as total')
                ->groupBy('payment_method')
                ->get(),
            
            'guest_demographics' => [
                'total' => Guest::count(),
                'verified' => Guest::whereNotNull('email')->count(),
            ],
            
            'restaurant_performance' => \App\Models\RestaurantOrder::selectRaw('MONTH(created_at) as month, COUNT(*) as orders, SUM(total_amount) as revenue')
                ->whereYear('created_at', now()->year)
                ->groupBy('month')
                ->orderBy('month')
                ->get(),
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
            'reports',
            'timeline_dates',
            'room_types_timeline'
        ));
    }
}