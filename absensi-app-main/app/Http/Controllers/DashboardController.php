<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Position;
use App\Models\User;
use App\Models\Presence;
use App\Models\Attendance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $apiKey = 'f71a0d13b049885f8f40b750a8c7cba2';
        $city = 'Jakarta';
        $units = 'metric';

        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => $units,
        ]);

        $data = $response->json();

        if (isset($data['main']['temp'])) {
            $temperature = $data['main']['temp'];
            return view('dashboard.index', [
                'city' => $city,
                'temperature' => $temperature,
                "title" => "Dashboard",
                "positionCount" => Position::count(),
                "userCount" => User::count(),
                "presenceCount" => Presence::count(),
                "attendanceCount" => Attendance::count(),
            ]);
        } else {
            return "Data suhu tidak ditemukan.";
        }
    }
}
