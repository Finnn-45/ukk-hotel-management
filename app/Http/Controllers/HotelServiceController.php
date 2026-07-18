<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelServiceController extends Controller
{
    public function index()
    {
        return view('customer.services.index');
    }

    public function store(Request $request)
    {
        return back()->with('success', 'Permintaan layanan berhasil dikirim.');
    }

    public function history()
    {
        return view('customer.services.history');
    }
}
