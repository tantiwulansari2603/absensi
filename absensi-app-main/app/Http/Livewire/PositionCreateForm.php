<?php

namespace App\Http\Livewire;

use App\Models\Position;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Boolean;

class PositionCreateForm extends Component
{
    public $positions;

    public function mount()
    {
        $this->positions = [
            ['name' => '']
        ];
    }

    public function addPositionInput(): void
    {
        $this->positions[] = ['name' => ''];
    }

    public function removePositionInput(int $index): void
    {
        unset($this->positions[$index]);
        $this->positions = array_values($this->positions);
    }

    public function savePositions()
    {
        $this->validate([
            'positions.0.name' => 'required'
        ], ['positions.0.name.required' => 'Setidaknya input posisi pertama wajib diisi.']);

        $positions = array_filter($this->positions, function ($a) {
            return trim($a['name']) !== "";
        });

        foreach ($positions as $position) {
            Position::create($position);
        }

        redirect()->route('positions.index')->with('success', 'Data posisi berhasil ditambahkan.');
    }

    public function render()
    {
        return view('livewire.position-create-form');
    }
}
