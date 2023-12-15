<?php

namespace App\Http\Livewire;

use App\Models\Location;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class LocationEditForm extends Component
{
    public $locations = [];

    public function mount(Collection $locations)
    {
        $this->locations = []; // hapus location collection
        foreach ($locations as $location) {
            $this->locations[] = [
                'id' => $location->id,
                'nama' => $location->nama,
                'alamat' => $location->alamat,
                'latitude' => $location->latitude,
                'longitude' => $location->longitude,
            ];
        }
    }

    public function saveLocations()
    {
        // tidak mengimplementasikan validasi, karena jika input kosong berarti data tersebut tidak akan diubah
        // ambil input/request dari location yang berisi
        $locations = array_filter($this->locations, function ($a) {
            return trim($a['nama']) !== "";
        });

        $affected = 0;
        foreach ($locations as $location) {
            $affected += Location::find($location['id'])->update([
                'nama' => $location['nama'], 
                'alamat' => $location['alamat'], 
                'latitude' => $location['latitude'], 
                'longitude' => $location['longitude'],
            ]);
        }

        $message = $affected === 0 ?
            "Tidak ada data lokasi yang diubah." :
            "Ada $affected data lokasi yang berhasil diedit.";

        return redirect()->route('location.index')->with('success', $message);
    }

    public function render()
    {
        return view('livewire.location-edit-form');
    }
}
