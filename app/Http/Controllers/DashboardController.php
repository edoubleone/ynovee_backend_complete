<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\RoomType;
use App\Models\User;

class DashboardController extends Controller
{
    public function stats()
    {
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $totalRooms = RoomType::sum('total_rooms');
        // Calculate revenue only from confirmed/checked_out/checked_in bookings
        $revenue = Booking::whereIn('status', ['confirmed', 'checked_in', 'checked_out'])->sum('total_price');
        $totalUsers = User::count();

        return response()->json([
            'total_bookings' => $totalBookings,
            'pending_bookings' => $pendingBookings,
            'total_rooms' => $totalRooms,
            'total_revenue' => $revenue,
            'total_users' => $totalUsers,
        ]);
    }
}
