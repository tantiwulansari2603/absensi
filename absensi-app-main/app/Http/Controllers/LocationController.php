<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        return view('location.index', [
            "title" => "Lokasi"
        ]);
    }

    public function create()
    {
        return view('location.create', [
            "title" => "Tambah Lokasi"
        ]);
    }

    public function edit()
    {
        $ids = request('ids');
        if (!$ids)
            return redirect()->back();
        $ids = explode('-', $ids);

        $locations = Location::query()
            ->whereIn('id', $ids)
            ->get();

        return view('location.edit', [
            "title" => "Edit Lokasi",
            "location" => $locations
        ]);
    }
}
