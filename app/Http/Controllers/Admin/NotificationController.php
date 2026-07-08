<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::with('user')->latest()->paginate(20);
        return view('admin.notifications.index', compact('notifications'));
    }

    public function markRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->update(['is_read' => true]);
        return response()->json(['success' => true]);
    }

    public function markAllRead()
    {
        Notification::where('user_id', auth()->id())->where('is_read', false)
            ->update(['is_read' => true]);
        return back()->with('success', 'Semua notifikasi telah dibaca');
    }

    public function unreadCount()
    {
        $count = Notification::where('user_id', auth()->id())
            ->where('is_read', false)->count();
        return response()->json(['count' => $count]);
    }
}