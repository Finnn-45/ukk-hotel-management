<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function roomTypeIndex()
    {
        $roomTypes = RoomType::withCount('rooms')->get();
        return view('admin.room-types.index', compact('roomTypes'));
    }

    public function roomTypeStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'max_guests' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        RoomType::create($request->all());
        return redirect()->route('admin.room-types.index')->with('success', 'Tipe kamar berhasil ditambahkan');
    }

    public function roomTypeEdit(RoomType $roomType)
    {
        return view('admin.room-types.edit', compact('roomType'));
    }

    public function roomTypeUpdate(Request $request, RoomType $roomType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'max_guests' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        $roomType->update($request->all());
        return redirect()->route('admin.room-types.index')->with('success', 'Tipe kamar berhasil diupdate');
    }

    public function roomTypeDestroy(RoomType $roomType)
    {
        if ($roomType->rooms()->count() > 0) {
            return back()->with('error', 'Tipe kamar masih memiliki kamar');
        }
        $roomType->delete();
        return redirect()->route('admin.room-types.index')->with('success', 'Tipe kamar berhasil dihapus');
    }

    public function index(Request $request)
    {
        $query = Room::with('roomType');
        
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        $rooms = $query->latest()->paginate(10);
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $roomTypes = RoomType::all();
        return view('admin.rooms.create', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'room_number' => 'required|string|unique:rooms,room_number',
            'floor' => 'nullable|string',
            'status' => 'required|in:available,occupied,maintenance,booked',
        ]);

        Room::create($request->all());
        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil ditambahkan');
    }

    public function edit(Room $room)
    {
        $roomTypes = RoomType::all();
        return view('admin.rooms.edit', compact('room', 'roomTypes'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'room_number' => 'required|string|unique:rooms,room_number,' . $room->id,
            'floor' => 'nullable|string',
            'status' => 'required|in:available,occupied,maintenance,booked',
        ]);

        $room->update($request->all());
        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil diupdate');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil dihapus');
    }
}