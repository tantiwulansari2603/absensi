<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use App\Models\Presence;
use App\Models\Permission;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;

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

    // public function rekapAbsensiMahasiswa($userId)
    // {
    //     $user = User::findOrFail($userId);
    //     $presences = Presence::with('permissions', 'attendance')
    //         ->where('user_id', $user->id)
    //         ->get();

    //     return view('dosen.rekap_absensi', [
    //         "title" => "Data Kehadiran Siswa",
    //         'user' => $user,
    //         'presences' => $presences,
    //     ]);
    // }

    // private function getNotPresentEmployees($presences, $attendance)
    // {
    //     $notPresentData = [];

    //     foreach ($presences as $presence) {
    //         // Memeriksa karyawan yang tidak hadir pada tanggal tersebut
    //         $user = User::query()
    //             ->with('position')
    //             ->onlyEmployees()
    //             ->where('id', $presence->user_id)
    //             ->first();

    //         if ($user) {
    //             $notPresentData[] = [
    //                 "not_presence_date" => $presence->presence_date,
    //                 "users" => $user->toArray()
    //             ];
    //         }
    //     }

    //     return $notPresentData;
    // }

    // public function notPresent(Attendance $attendance)
    // {
    //     $byDate = now()->toDateString();
    //     if (request('display-by-date'))
    //         $byDate = request('display-by-date');

    //     $presences = Presence::query()
    //         ->where('attendance_id', $attendance->id)
    //         ->where('presence_date', $byDate)
    //         ->get(['presence_date', 'user_id']);

    //     $notPresentData = [];

    //     // jika semua karyawan tidak hadir
    //     if ($presences->isEmpty()) {
    //         $notPresentData[] =
    //             [
    //                 "not_presence_date" => $byDate,
    //                 "users" => User::query()
    //                     ->with('position')
    //                     ->onlyEmployees()
    //                     ->get()
    //                     ->toArray()
    //             ];
    //     } else {
    //         $notPresentData = $this->getNotPresentEmployees($presences, $attendance);
    //     }


    //     return view('dosen.rekap_data', [
    //         "title" => "Data Karyawan Tidak Hadir",
    //         "attendance" => $attendance,
    //         "notPresentData" => $notPresentData
    //     ]);
    // }

    public function rekapAbsensiMahasiswa($userId, Attendance $attendance)
    {
        // dd($userId, $attendance);
        $user = User::findOrFail($userId);

        $presences = Presence::with('permissions', 'attendance')
            ->where('user_id', $user->id)
            ->get();

        // $isHasEnterToday = $presences
        //     ->where('presence_date', now()->toDateString())
        //     ->isNotEmpty();

        // $isTherePermission = Permission::query()
        //     ->where('permission_date', now()->toDateString())
        //     ->where('attendance_id', $attendance->id)
        //     ->where('user_id', auth()->user()->id)
        //     ->first();

        // $data = [
        //     'is_has_enter_today' => $isHasEnterToday, // sudah absen masuk
        //     'is_not_out_yet' => $presences->where('presence_out_time', null)->isNotEmpty(), // belum absen pulang
        //     'is_there_permission' => (bool) $isTherePermission,
        //     'is_permission_accepted' => $isTherePermission?->is_accepted ?? false
        // ];

        // $holiday = $attendance->data->is_holiday_today ? Holiday::query()
        //     ->where('holiday_date', now()->toDateString())
        //     ->first() : false;

        // $history = Presence::query()
        //     ->where('user_id', auth()->user()->id)
        //     ->where('attendance_id', $attendance->id)
        //     ->get();

        // // untuku melihat karyawan yang tidak hadir
        // $priodDate = CarbonPeriod::create($attendance->created_at->toDateString(), now()->toDateString())
        //     ->toArray();

        // foreach ($priodDate as $i => $date) { // get only stringdate
        //     $priodDate[$i] = $date->toDateString();
        // }

        // $priodDate = array_slice(array_reverse($priodDate), 0, 30);

        return view('dosen.rekap_absensi', [
            "title" => "Data Kehadiran Siswa",
            'user' => $user,
            'presences' => $presences,
            // 'attendance' => $attendance,
            // "data" => $data,
            // "holiday" => $holiday,
            // 'history' => $history,
            // 'priodDate' => $priodDate
        ]);
    }

    // private function getNotPresentEmployees($presences, $attendance, $userId)
    // {
    //     $notPresentData = [];

    //     foreach ($presences as $presence) {
    //         // Memeriksa karyawan yang tidak hadir pada tanggal tersebut
    //         $user = User::query()
    //             ->with('position')
    //             ->onlyEmployees()
    //             ->where('id', $userId)
    //             ->first();

    //         // Jika karyawan tidak memiliki presensi pada tanggal tersebut, tambahkan ke $notPresentData
    //         if (!$presence->where('user_id', $userId)->where('presence_date', $presence->presence_date)->exists() && $user) {
    //             $notPresentData[] = [
    //                 "not_presence_date" => $presence->presence_date,
    //                 "users" => $user->toArray()
    //             ];
    //         }
    //     }

    //     return $notPresentData;
    // }
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
