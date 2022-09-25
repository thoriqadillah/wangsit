<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class AuthService {
  public function login(string $nim, string $password): bool {
    if (!$this->validNim($nim)) return false;
    
    return !Auth::attempt(['nim' => $nim, 'password' => $password]) 
      ? $this->register($nim, $password)
      : true;
  }

  private function register(string $nim, string $password): bool {
    $newUser = ScrapperService::scrapUser($nim, $password);
    if (count($newUser) !== 0) {
      User::create($newUser);
      return Auth::attempt(['nim' => $nim, 'password' => $password]);
    }

    return false;
  }

  private function validNim(string $nim): bool {
    $NIM_SI = '515040';
    return substr($nim, 2, 6) === $NIM_SI;
  }

}