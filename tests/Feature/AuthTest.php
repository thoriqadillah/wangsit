<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\AuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class AuthTest extends TestCase
{
    
    public function test_sucessfully_login()
    {
        $response = $this->post('/login', [
            'nim' => '195150400111034',
            'password' => env('PASSWORD_SIAM')
        ]);
        $response->assertRedirect('/');
        $response->assertStatus(302);
    }

    public function test_user_not_found()
    {
        $response = $this->post('/login', [
            'nim' => '195150400111034',
            'password' => 'secret12345678'
        ]);
        $response->assertRedirect('/login');
        $response->assertStatus(302);
    }

    public function test_invalid_password_entry()
    {
        $response = $this->post('/login', [
            'nim' => '195150400111034',
            'password' => 'secret'
        ]);

        $response->assertSessionHasErrors();
    }

    public function test_nim_too_short()
    {
        $response = $this->post('/login', [
            'nim' => '19515040011103',
            'password' => env('PASSWORD_SIAM')
        ]);
        
        $response->assertSessionHasErrors();
    }

    public function test_nim_too_long()
    {
        $response = $this->post('/login', [
            'nim' => '1951504001110345',
            'password' => env('PASSWORD_SIAM')
        ]);

        $response->assertSessionHasErrors();
    }

    public function test_sucessfully_logged_out() 
    {
        $response = $this->post('/logout');
        $response->assertRedirect('/login');
    }

    public function test_login_attempt_should_return_false()
    {
        $auth = new AuthService();
        $loggedIn = $auth->login('195150400111034', 'secret');
        
        $this->assertFalse($loggedIn);
    }

    public function test_login_attempt_should_return_true()
    {
        $auth = new AuthService();
        $loggedIn = $auth->login('195150400111034', env('PASSWORD_SIAM'));
        
        $this->assertTrue($loggedIn);
    }
}
