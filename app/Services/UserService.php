<?php

namespace App\Services;

use App\Models\Departement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserService {
    
    public function getBirthdayUsers() {
        $date = Carbon::now();
        return User::whereMonth('tgl_lahir', $date->month)
            ->whereDay('tgl_lahir', $date->day)
            ->where('admin_id', '!=', 1)
            ->get();
    }

    public function getUser() {
        return Auth::user();
    }

    public function getUserDept() {
        $deptId = Auth::user()->admin->departement_id;
        return Departement::find($deptId);
    }
}
