<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
use Illuminate\Support\Str;

class AttendanceEditForm extends AttendanceAbstract
{
    public $initialCode;

    public function mount()
    {
        parent::mount();
        $this->attendance['start_time'] = substr($this->attendance['start_time'], 0, -3);
        $this->attendance['batas_start_time'] = substr($this->attendance['batas_start_time'], 0, -3);
        $this->attendance['end_time'] = substr($this->attendance['end_time'], 0, -3);
        $this->attendance['batas_end_time'] = substr($this->attendance['batas_end_time'], 0, -3);

        $this->initialCode = $this->attendance['code'];
        $this->attendance['code'] = $this->initialCode ? true : false;

        $this->position_ids = $this->attendance->positions()->pluck('positions.id', 'positions.id')->toArray();
    }

    public function save()
    {
        $this->position_ids = array_filter($this->position_ids, function ($id) {
            return is_numeric($id);
        });
        $position_ids = array_values($this->position_ids);

        $this->validate();

        $attendance = [];
        if (!$this->attendance->code) {
            $this->attendance->code = null;
            $attendance = $this->attendance->toArray();
        } else {
            $attendance = $this->attendance->toArray();
            if (!$this->initialCode) {
                $attendance['code'] = Str::random();
            } else {
                $attendance['code'] = $this->initialCode;
            }
        }

        $this->attendance->update($attendance);
        $this->attendance->location()->associate($this->attendance['lokasi_id']);
        $this->attendance->positions()->sync($position_ids);

        redirect()->route('attendances.index')->with('success', "Data absensi berhasil diubah.");
    }

    public function render()
    {
        return view('livewire.attendance-edit-form');
    }
}
