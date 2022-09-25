<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService {
  public function login(string $nim, string $password): bool {
    if (!$this->validNim($nim)) return false;
    
    return !Auth::attempt(['nim' => $nim, 'password' => $password]) 
      ? $this->register($nim, $password)
      : true;
  }

  private function register(string $nim, string $password): bool {
    $scraper = new ScrapperService($nim, $password);
    $newUser = $scraper->scrapUser();

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

  public function logout(): void {
    Auth::logout();
  }

}