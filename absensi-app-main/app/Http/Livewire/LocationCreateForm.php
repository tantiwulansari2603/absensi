<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Livewire\Component;

class LocationCreateForm extends Component
{
    public $locations;
    private $initialValue = [
        'nama' => '', 
        'alamat' => '', 
        'latitude' => '', 
        'longitude' => ''];
    
    public function mount()
    {
        $this->locations = [$this->initialValue];
    }

    public function addLocationInput(): void
    {
        $this->locations[] = $this->initialValue;
    }

    public function removeLocationInput(int $index): void
    {
        unset($this->locations[$index]);
        $this->locations = array_values($this->locations);
    }

    public function saveLocations()
    {
        $this->validate([
            'locations.*.nama' => 'required',
            'locations.*.alamat' => 'required',
            'locations.*.latitude' => 'required',
            'locations.*.longitude' => 'required',
        ]);

        // alasan menggunakan create alih2 mengunakan ::insert adalah karena tidak looping untuk menambahkan created_at dan updated_at
        foreach ($this->locations as $location) {
            Location::create($location);
        }

        redirect()->route('location.index')->with('success', 'Data Lokasi berhasil ditambahkan.');
    }

    public function render()
    {
        return view('livewire.location-create-form');
    }
}
