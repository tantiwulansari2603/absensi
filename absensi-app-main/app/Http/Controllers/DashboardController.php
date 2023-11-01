<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use App\Models\Presence;
use App\Models\Attendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            "title" => "Dashboard",
            "positionCount" => Position::count(),
            "userCount" => User::count(),
            "presenceCount" => Presence::count(),
            "attendanceCount" => Attendance::count(),
        ]);
    }
}
