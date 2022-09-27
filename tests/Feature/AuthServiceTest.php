<?php

namespace Tests\Feature;

use App\Services\AuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    public function test_login_attempt_should_return_false()
    {
        $auth = new AuthService();
        $loggedIn = $auth->login(env('NIM_SIAM'), 'secret');
        
        $this->assertFalse($loggedIn);
    }

    public function test_login_attempt_should_return_true()
    {
        $auth = new AuthService();
        $loggedIn = $auth->login(env('NIM_SIAM'), env('PASSWORD_SIAM'));

        $this->assertTrue($loggedIn);
        $this->assertDatabaseHas('users', [
            'nim' => env('NIM_SIAM')
        ]);
        
    }
}