<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'nim' => ['required', 'size:15'],
            'password' => ['required', 'min:8',]
        ], [
            'required' => ':attribute wajib diisi',
            'size' => ':attribute harus 15 karakter',
            'min' => ':attribute minimal berisi 8 karakter'
        ]);

        $loggedIn = $this->auth->login($credentials['nim'], $credentials['password']);
        if ($loggedIn) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return redirect()->refresh()->withErrors([
            'status' => 'NIM atau password salah',
        ]);
    }

    public function logout(Request $request)
    {
        $this->auth->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
