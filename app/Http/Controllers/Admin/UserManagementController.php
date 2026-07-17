<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Search by name or email
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        // Filter by role
        if ($request->has('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        // Filter by email verification status
        if ($request->has('verified')) {
            if ($request->verified == 'yes') {
                $query->whereNotNull('email_verified_at');
            } else {
                $query->whereNull('email_verified_at');
            }
        }

        $users = $query->with('roles')->latest()->paginate(20);
        $roles = Role::all();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function show(User $user)
    {
        $user->load('roles');
        $guest = $user->guest()->first();
        $bookings = $guest ? $guest->bookings()->with('room.roomType', 'payment')->latest()->take(10)->get() : collect();
        $reviews = $guest ? \App\Models\Review::whereHas('booking', function($q) use ($guest) {
            $q->where('guest_id', $guest->id);
        })->with('booking.room')->latest()->take(10)->get() : collect();

        return view('admin.users.show', compact('user', 'guest', 'bookings', 'reviews'));
    }

    public function edit(User $user)
    {
        $user->load('roles');
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|exists:roles,name',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update password if provided
        if ($request->filled('password')) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }

        // Sync roles
        $user->syncRoles([$request->role]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        // Prevent deleting self
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri');
        }

        // Delete related guest data if exists
        $guest = $user->guest()->first();
        if ($guest) {
            // Cancel any active bookings
            $guest->bookings()->whereIn('status', ['pending', 'confirmed', 'checked_in'])
                ->update(['status' => 'cancelled']);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus');
    }

    public function toggleVerification(User $user)
    {
        if ($user->email_verified_at) {
            $user->update(['email_verified_at' => null]);
            return back()->with('info', 'Verifikasi email dibatalkan');
        } else {
            $user->update(['email_verified_at' => now()]);
            return back()->with('success', 'Email berhasil diverifikasi');
        }
    }

    public function toggleActive(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menonaktifkan akun sendiri');
        }

        if ($user->is_active) {
            $user->update(['is_active' => false]);
            return back()->with('info', 'User dinonaktifkan');
        } else {
            $user->update(['is_active' => true]);
            return back()->with('success', 'User diaktifkan');
        }
    }
}
