<?php

namespace App\Http\Controllers;

use App\Models\RestaurantMenu;
use App\Models\RestaurantOrder;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function menuIndex()
    {
        $menus = RestaurantMenu::all();
        return view('admin.restaurant.menu.index', compact('menus'));
    }

    public function menuCreate()
    {
        return view('admin.restaurant.menu.create');
    }

    public function menuStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string',
            'is_available' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_available'] = $request->has('is_available');
        RestaurantMenu::create($data);
        return redirect()->route('admin.restaurant.menu.index')->with('success', 'Menu berhasil ditambahkan');
    }

    public function menuEdit(RestaurantMenu $restaurantMenu)
    {
        return view('admin.restaurant.menu.edit', compact('restaurantMenu'));
    }

    public function menuUpdate(Request $request, RestaurantMenu $restaurantMenu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category' => 'nullable|string',
            'is_available' => 'boolean',
        ]);

        $data = $request->all();
        $data['is_available'] = $request->has('is_available');
        $restaurantMenu->update($data);
        return redirect()->route('admin.restaurant.menu.index')->with('success', 'Menu berhasil diupdate');
    }

    public function menuDestroy(RestaurantMenu $restaurantMenu)
    {
        $restaurantMenu->delete();
        return redirect()->route('admin.restaurant.menu.index')->with('success', 'Menu berhasil dihapus');
    }

    public function orderIndex(Request $request)
    {
        $query = RestaurantOrder::with(['guest', 'details.menu'])->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->paginate(10)->withQueryString();

        // Stats
        $ordersPending = RestaurantOrder::where('status', 'pending')->count();
        $ordersPreparing = RestaurantOrder::where('status', 'preparing')->count();
        $ordersCompleted = RestaurantOrder::where('status', 'completed')->count();
        $ordersTotal = RestaurantOrder::count();

        return view('admin.restaurant.order.index', compact(
            'orders', 'ordersPending', 'ordersPreparing', 'ordersCompleted', 'ordersTotal'
        ));
    }

    public function orderShow(RestaurantOrder $order)
    {
        $order->load(['details.menu', 'guest']);
        return view('admin.restaurant.order.show', compact('order'));
    }

    public function updateStatus(Request $request, RestaurantOrder $order)
    {
        $request->validate([
            'status' => 'required|in:pending,preparing,ready,completed,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }
}
