<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $query = Guest::with('user');
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
        }
        
        $guests = $query->latest()->paginate(10);
        return view('admin.guests.index', compact('guests'));
    }

    public function create()
    {
        return view('admin.guests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:guests,email',
            'phone' => 'required|string|max:20',
            'id_card' => 'nullable|string|max:50',
            'address' => 'nullable|string',
        ]);

        Guest::create($request->all());
        return redirect()->route('admin.guests.index')->with('success', 'Guest berhasil ditambahkan');
    }

    public function edit(Guest $guest)
    {
        return view('admin.guests.edit', compact('guest'));
    }

    public function update(Request $request, Guest $guest)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:guests,email,' . $guest->id,
            'phone' => 'required|string|max:20',
            'id_card' => 'nullable|string|max:50',
            'address' => 'nullable|string',
        ]);

        $guest->update($request->all());
        return redirect()->route('admin.guests.index')->with('success', 'Guest berhasil diupdate');
    }

    public function destroy(Guest $guest)
    {
        $guest->delete();
        return redirect()->route('admin.guests.index')->with('success', 'Guest berhasil dihapus');
    }
}