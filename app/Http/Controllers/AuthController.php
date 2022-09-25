<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $auth;

    public function __construct(AuthService $auth) {
        $this->auth = $auth;
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'nim' => ['required', 'min:15', 'max:15'],
            'password' => ['required', 'min:8']
        ]);

        $loggedIn = $this->auth->login($credentials['nim'], $credentials['password']);
        if ($loggedIn) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors([
            'nim' => 'NIM atau password salah',
            'password' => 'NIM atau password salah',
        ]);
    }

    public function logout(Request $request) {
        $this->auth->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}
