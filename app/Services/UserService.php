<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserService {
    
    public function getBirthdayUsers() {
        $date = Carbon::now();
        return User::whereMonth('tgl_lahir', $date->month)
            ->whereDay('tgl_lahir', $date->day)
            ->get();
    }

    public function getUser() {
        return Auth::user();
    }
}
