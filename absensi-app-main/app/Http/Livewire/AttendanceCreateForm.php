<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
use App\Models\Location;
use \Illuminate\Support\Str;

class AttendanceCreateForm extends AttendanceAbstract
{
    public function save()
    {
        // Filter value sebelum divalidasi
        $this->position_ids = array_filter($this->position_ids, 'is_numeric');
        // $this->lokasi_id = array_filter($this->lokasi_id, 'is_numeric');
        $this->attendance['lokasi_id'] = is_array($this->attendance['lokasi_id'])
            ? array_filter($this->attendance['lokasi_id'], 'is_numeric')
            : [];

        // Validasi
        $this->validate();

        // Inisialisasi variabel dengan nilai yang benar
        $position_ids = $this->position_ids;
        // $lokasi_id = $this->lokasi_id;
        $lokasi_id = $this->attendance['lokasi_id'];

        if (empty($lokasi_id)) {
            $lokasi_id = 1; // Gantilah dengan nilai default yang sesuai
        }

        if (array_key_exists('code', $this->attendance[0]) && $this->attendance[0]['code']) {
            // Jika menggunakan qrcode
            $this->attendance[0]['code'] = Str::random();
        }

        $attendance = Attendance::create($this->attendance[0]);
        $attendance->positions()->attach($position_ids);
        $attendance->locations()->attach($lokasi_id);

        return redirect()->route('attendances.index')->with('success', 'Data absensi berhasil ditambahkan.');
    }


    public function render()
    {
        $locations = Location::all();

        return view('livewire.attendance-create-form', ['locations' => $locations]);
    }
}
