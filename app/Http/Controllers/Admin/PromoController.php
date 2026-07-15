<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PromoController extends Controller
{
    public function index(Request $request)
    {
        $query = Promo::query();
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }
        
        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true)->where('valid_until', '>', now());
            } elseif ($request->status === 'expired') {
                $query->where('valid_until', '<', now());
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }
        
        $promos = $query->orderBy('created_at', 'desc')->paginate(20);
        
        return view('admin.promos.index', compact('promos'));
    }
    
    public function create()
    {
        return view('admin.promos.create');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:promos,code',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after:valid_from',
            'is_active' => 'required|boolean',
            'description' => 'nullable|string',
        ]);
        
        // Custom validation for percentage
        if ($request->discount_type === 'percentage' && $request->discount_value > 100) {
            $validator->errors()->add('discount_value', 'Persentase diskon tidak boleh lebih dari 100%');
        }
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        Promo::create($request->all());
        
        return redirect()->route('admin.promos.index')
            ->with('success', 'Promo berhasil dibuat');
    }
    
    public function edit(Promo $promo)
    {
        return view('admin.promos.edit', compact('promo'));
    }
    
    public function update(Request $request, Promo $promo)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:promos,code,' . $promo->id,
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after:valid_from',
            'is_active' => 'required|boolean',
            'description' => 'nullable|string',
        ]);
        
        // Custom validation for percentage
        if ($request->discount_type === 'percentage' && $request->discount_value > 100) {
            $validator->errors()->add('discount_value', 'Persentase diskon tidak boleh lebih dari 100%');
        }
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $promo->update($request->all());
        
        return redirect()->route('admin.promos.index')
            ->with('success', 'Promo berhasil diperbarui');
    }
    
    public function destroy(Promo $promo)
    {
        // Check if promo is currently being used
        $hasBookings = \App\Models\Booking::whereHas('payment', function ($query) use ($promo) {
                $query->where('promo_id', $promo->id);
            })->exists();
            
        $hasRestaurantOrders = \App\Models\RestaurantOrder::whereHas('payment', function ($query) use ($promo) {
                $query->where('promo_id', $promo->id);
            })->exists();
        
        if ($hasBookings || $hasRestaurantOrders) {
            return redirect()->route('admin.promos.index')
                ->with('error', 'Tidak dapat menghapus promo yang sedang digunakan dalam transaksi. Nonaktifkan promo sebagai gantinya.');
        }
        
        $promo->delete();
        
        return redirect()->route('admin.promos.index')
            ->with('success', 'Promo berhasil dihapus');
    }
}