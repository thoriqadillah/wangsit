<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $user;

    public function __construct(UserService $userService) {
        $this->user = $userService;
    }

    public function daftarEvent() {
        
    }
}
