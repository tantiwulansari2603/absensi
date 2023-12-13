<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        return view('school.index', [
            "title" => "Sekolah"
        ]);
    }

    public function create()
    {
        return view('school.create', [
            "title" => "Tambah Data Sekolah"
        ]);
    }

    public function edit()
    {
        $ids = request('ids');
        if (!$ids)
            return redirect()->back();
        $ids = explode('-', $ids);

        // ambil data user yang hanya memiliki User::USER_ROLE_ID / role untuk karyawaan
        $school = School::query()
            ->whereIn('id', $ids)
            ->get();

        return view('school.edit', [
            "title" => "Edit Data Sekolah",
            "school" => $school
        ]);
    }
}
