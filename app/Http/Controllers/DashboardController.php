<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\RoomType;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * @OA\Get(path="/api/admin/dashboard-stats", tags={"Dashboard"}, summary="Get dashboard statistics (Admin)", security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="Dashboard stats",
     *         @OA\JsonContent(
     *             @OA\Property(property="total_bookings", type="integer"),
     *             @OA\Property(property="pending_bookings", type="integer"),
     *             @OA\Property(property="total_rooms", type="integer"),
     *             @OA\Property(property="total_revenue", type="number"),
     *             @OA\Property(property="total_users", type="integer")
     *         )
     *     )
     * )
     */
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
