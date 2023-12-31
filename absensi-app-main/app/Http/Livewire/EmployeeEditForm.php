<?php

namespace App\Http\Livewire;

use App\Http\Traits\useUniqueValidation;
use App\Models\Location;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use App\Models\School;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EmployeeEditForm extends Component
{
    use useUniqueValidation;

    public $employees;
    public Collection $roles;
    public Collection $positions;
    public Collection $schools;
    public Collection $locations;

    public function mount(Collection $employees)
    {
        $this->employees = [];
        foreach ($employees as $employee) {
            $this->employees[] = [
                'id' => $employee->id,
                'name' => $employee->name,
                'email' => $employee->email,
                'original_email' => $employee->email,
                'phone' => $employee->phone,
                'original_phone' => $employee->phone,
                'role_id' => $employee->role_id,
                'position_id' => $employee->position_id,
                'schools_id' => $employee->schools_id,
                'locations_id' => $employee->locations_id
            ];
        }
        $this->roles = Role::all();
        $this->positions = Position::all();
        $this->schools = School::all();
        $this->locations = Location::all();
    }
    public function saveEmployees()
    {
        $roleIdRuleIn = join(',', $this->roles->pluck('id')->toArray());
        $positionIdRuleIn = join(',', $this->positions->pluck('id')->toArray());
        $schoolsIdRuleIn = join(',', $this->schools->pluck('id')->toArray());
        $locationsIdRuleIn = join(',', $this->locations->pluck('id')->toArray());

        $this->validate([
            'employees.*.name' => 'required',
            'employees.*.email' => 'required|email',
            'employees.*.phone' => 'required',
            'employees.*.password' => '',
            'employees.*.role_id' => 'required|in:' . $roleIdRuleIn,
            'employees.*.position_id' => 'required|in:' . $positionIdRuleIn,
            'employees.*.schools_id' => 'required|in:' . $schoolsIdRuleIn,
            'employees.*.locations_id' => 'required|in:' . $locationsIdRuleIn,
        ]);

        if (!$this->isUniqueOnLocal('phone', $this->employees)) {
            $this->dispatchBrowserEvent('livewire-scroll', ['top' => 0]);
            return session()->flash('failed', 'Pastikan input No. Telp tidak mangandung nilai yang sama dengan input lainnya.');
        }

        if (!$this->isUniqueOnLocal('email', $this->employees)) {
            $this->dispatchBrowserEvent('livewire-scroll', ['top' => 0]);
            return session()->flash('failed', 'Pastikan input Email tidak mangandung nilai yang sama dengan input lainnya.');
        }

        $affected = 0;
        foreach ($this->employees as $employee) {
            // cek unique validasi
            $employeeBeforeUpdated = User::find($employee['id']);

            if (!$this->isUniqueOnDatabase($employeeBeforeUpdated, $employee, 'phone', User::class)) {
                $this->dispatchBrowserEvent('livewire-scroll', ['top' => 0]);
                return session()->flash('failed', "No. Telp dari data user {$employee['id']} sudah terdaftar. Silahkan masukan email yang berbeda!");
            }

            if (!$this->isUniqueOnDatabase($employeeBeforeUpdated, $employee, 'email', User::class)) {
                $this->dispatchBrowserEvent('livewire-scroll', ['top' => 0]);
                return session()->flash('failed', "Email dari data user {$employee['id']} sudah terdaftar. Silahkan masukan email yang berbeda!");
            }

            $affected += $employeeBeforeUpdated->update([
                'name' => $employee['name'],
                'email' => $employee['email'],
                'phone' => $employee['phone'],
                'role_id' => $employee['role_id'],
                'position_id' => $employee['position_id'],
                'schools_id' => $employee['schools_id'],
                'locations_id' => $employee['locations_id'],
            ]);
        }

        $message = $affected === 0 ?
            "Tidak ada data user yang diubah." :
            "Ada $affected data karyawaan yang berhasil diedit.";

        return redirect()->route('employees.index')->with('success', $message);
    }

    public function render()
    {
        return view('livewire.employee-edit-form');
    }
}
