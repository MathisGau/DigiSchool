<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show(){
        $user = Auth::user();

        $notifications = Notifications::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('dashboard', ['notifications' => $notifications]);
    }

    public function markAsRead(Request $request){
        $notification = Notifications::find($request->notification_id);
        $notification->is_read = 1;
        $notification->save();

        $user = Auth::user();
        $notifications = Notifications::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('dashboard', ['notifications' => $notifications]);
    }    
}
