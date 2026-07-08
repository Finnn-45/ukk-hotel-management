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
        return view('customer.restaurant.menu', compact('menus', 'categories'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:restaurant_menus,id',
            'items.*.quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500',
            'table_number' => 'required|string|max:20',
        ]);

        $user = Auth::user();
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

        // Create order
        $order = RestaurantOrder::create([
            'guest_id' => $guest->id,
            'order_number' => 'ORD-' . time() . '-' . rand(1000, 9999),
            'order_date' => now(),
            'total_amount' => $total,
            'status' => 'pending',
            'notes' => $request->notes,
            'order_type' => 'dine_in',
            'table_number' => $request->table_number,
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
        $guest = \App\Models\Guest::where('user_id', $user->id)->firstOrFail();

        if ($order->guest_id !== $guest->id) {
            abort(403);
        }

        $order->load(['details.menu']);
        return view('customer.restaurant.order-detail', compact('order'));
    }
}