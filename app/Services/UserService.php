<?php

namespace App\Services;

use App\Models\Departement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserService
{

    public function getBirthdayUsers()
    {
        $date = Carbon::now();
        return User::whereMonth('tgl_lahir', $date->month)
            ->whereDay('tgl_lahir', $date->day)
            ->where('id', '!=', 1)
            ->get();
    }

    public function getCurrentUser()
    {
        return Auth::user();
    }

    public function getUserById(int $id)
    {
        return User::find($id);
    }

    public function getUserDept()
    {
        $deptId = Auth::user()->admin->departement_id;
        return Departement::find($deptId);
    }
}
