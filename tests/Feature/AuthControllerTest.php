<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\AuthService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use function PHPUnit\Framework\assertEquals;

class AuthControllerTest extends TestCase
{
    public function test_sucessfully_login()
    {
        $response = $this->post('/login', [
            'nim' => env('NIM_SIAM'),
            'password' => env('PASSWORD_SIAM')
        ]);
        $response->assertRedirect('/');
    }

    public function test_user_not_found()
    {
        $response = $this->post('/login', [
            'nim' => '123456789012345',
            'password' => 'secret12345678'
        ]);

        $response->assertRedirect('/login');
    }

    public function test_invalid_password_entry()
    {
        $response = $this->post('/login', [
            'nim' => '123456789012345',
            'password' => 'secret'
        ]);

        $response->assertSessionHasErrors();
    }

    public function test_empty_password_should_return_validation_error()
    {
        $response = $this->post('/login', [
            'nim' => env('NIM_SIAM'),
            'password' => ''
        ]);

        $response->assertSessionHasErrors();
    }
    
    public function test_empty_nim_should_return_validation_error()
    {
        $response = $this->post('/login', [
            'nim' => '',
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
}
