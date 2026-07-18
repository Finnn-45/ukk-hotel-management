<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminServiceRequestController extends Controller
{
    public function index()
    {
        return view('admin.services.index');
    }

    public function updateStatus(Request $request, $id)
    {
        return back()->with('success', 'Status layanan berhasil diperbarui.');
    }
}
