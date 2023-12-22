<?php

namespace App\Http\Livewire;

use App\Models\School;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Boolean;

class SchoolCreateForm extends Component
{
    public $school;

    public function mount()
    {
        $this->school = [
            ['nama_sekolah' => '']
        ];
    }

    public function addSchoolInput(): void
    {
        $this->school[] = ['nama_sekolah' => ''];
    }

    public function removeSchoolInput(int $index): void
    {
        unset($this->school[$index]);
        $this->school = array_values($this->school);
    }

    public function saveSchool()
    {
        $this->validate([
            'school.0.nama_sekolah' => 'required'
        ], ['school.0.nama_sekolah.required' => 'Setidaknya input sekolah pertama wajib diisi.']);

        $school = array_filter($this->school, function ($a) {
            return trim($a['nama_sekolah']) !== "";
        });

        foreach ($school as $school) {
            School::create($school);
        }

        redirect()->route('school.index')->with('success', 'Data sekolah berhasil ditambahkan.');
    }

    public function render()
    {
        return view('livewire.school-create-form');
    }
}
