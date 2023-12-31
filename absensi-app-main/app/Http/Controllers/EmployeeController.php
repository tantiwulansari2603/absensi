<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees.index', [
            "title" => "User"
        ]);
    }

    public function create()
    {
        return view('employees.create', [
            "title" => "Tambah Data User"
        ]);
    }

    public function edit()
    {
        $ids = request('ids');
        if (!$ids)
            return redirect()->back();
        $ids = explode('-', $ids);

        $employees = User::query()
            ->whereIn('id', $ids)
            ->get();

        return view('employees.edit', [
            "title" => "Edit Data User",
            "employees" => $employees
        ]);
    }

    public function viewPermissions($userId)
    {
        $user = User::findOrFail($userId);
        $permissions = $user->permissions()->where('is_accepted', 1)->get();

        return view('user.permissions', compact('user', 'permissions'));
    }
}
