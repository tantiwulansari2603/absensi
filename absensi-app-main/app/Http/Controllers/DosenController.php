<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use App\Models\Presence;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $attendances = Attendance::all()->sortByDesc('data.is_end')->sortByDesc('data.is_start');
        $users = User::all()->sortByDesc('data.is_end')->sortByDesc('data.is_start');

        $currentUser = auth()->user();

        // Mengambil pengguna lain dengan sekolah yang sama
        $usersWithSameSchool = User::where('schools_id', $currentUser->schools_id)
            ->where('role_id', User::USER_ROLE_ID)
            ->where('locations_id', auth()->user()->locations_id)
            ->where('id', '!=', $currentUser->id)

            ->get();

        // return view('users.show_users', compact('usersWithSameSchool'));

        return view('dosen.index', [
            "title" => "Data Kehadiran Siswa",
            "usersWithSameSchool" => $usersWithSameSchool
        ]);
    }

    public function rekapAbsensiMahasiswa($userId)
    {
        $user = User::findOrFail($userId);
        $presences = Presence::where('user_id', $user->id)->get();

        return view('dosen.rekap_absensi', [
            "title" => "Data Kehadiran Siswa",
            'user' => $user,
            'presences' => $presences,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show()
    {
        // $attendance->load(['positions', 'presences']);

        // dd($qrcode);
        return view('dosen.show', [
            "title" => "Data Detail Kehadiran",
            // "attendance" => $attendance,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
