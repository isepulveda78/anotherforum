<?php

namespace Forum\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function notifications()
    {
        //mark all as read 
        auth()->user()->unreadNotifications->markAsRead();

        //display all notifications
        return view('users.notifications', [
            'notifications' => auth()->user()->notifications()->paginate(5)
        ]);
    }
}
