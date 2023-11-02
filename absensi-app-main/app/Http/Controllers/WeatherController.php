<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getTemperature()
    {
        $apiKey = 'f71a0d13b049885f8f40b750a8c7cba2';
        $city = 'Jakarta'; // Ganti dengan nama kota yang sesuai
        $units = 'metric'; // Menggunakan Celsius, Anda dapat mengganti dengan 'imperial' atau 'standard' sesuai dengan preferensi Anda

        $response = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => $units,
        ]);

        $data = $response->json();
        $temperature = $data['main']['temp'];

        return view('dashboard.index', [
            'city' => $city,
            'temperature' => $temperature,
        ]);

        // if (isset($data['main']['temp'])) {
        //     $temperature = $data['main']['temp'];
        //     return view('dashboard.index', [
        //         'city' => $city,
        //         'temperature' => $temperature,
        //     ]);
        //     // return "Suhu di $city hari ini adalah $temperature °C";
        // } else {
        //     return "Data suhu tidak ditemukan.";
        // }
    }
}
