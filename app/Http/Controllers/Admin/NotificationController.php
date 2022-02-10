<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('product');
    }

    public function readNotification()
    {
        $user = auth()->user();
        foreach ($user->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return 'success';
    }
}
