<?php

namespace App\Http\Livewire;

use App\Models\School;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class SchoolEditForm extends Component
{
    public $school = [];

    public function mount(Collection $school)
    {
        $this->school = []; // hapus positions collection
        foreach ($school as $schools) {
            $this->school[] = ['id' => $schools->id, 'nama_sekolah' => $schools->nama_sekolah];
        }
    }

    public function saveSchool()
    {
        // tidak mengimplementasikan validasi, karena jika input kosong berarti data tersebut tidak akan diubah
        // ambil input/request dari position yang berisi
        $school = array_filter($this->school, function ($a) {
            return trim($a['nama_sekolah']) !== "";
        });

        $affected = 0;
        foreach ($school as $schools) {
            $affected += School::find($schools['id'])->update(['nama_sekolah' => $schools['nama_sekolah']]);
        }

        $message = $affected === 0 ?
            "Tidak ada data jabatan yang diubah." :
            "Ada $affected data jabatan yang berhasil diedit.";

        return redirect()->route('school.index')->with('success', $message);
    }

    public function render()
    {
        return view('livewire.school-edit-form');
    }
}
