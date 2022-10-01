<?php

namespace Tests\Feature;

use App\Models\User;
use App\Services\AuthService;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $response->assertStatus(302);
    }

    public function test_user_not_found()
    {
        $response = $this->post('/login', [
            'nim' => env('NIM_SIAM'),
            'password' => 'secret12345678'
        ]);
        $errors = session('errors');

        $response->assertRedirect('/login');
        $response->assertStatus(302);
        
        $response->assertSessionHasErrors();
        $this->assertEquals($errors->get('nim')[0], 'NIM atau password salah');
        $this->assertEquals($errors->get('password')[0], 'NIM atau password salah');
    }

    public function test_invalid_password_entry()
    {
        $response = $this->post('/login', [
            'nim' => env('NIM_SIAM'),
            'password' => 'secret'
        ]);

        $errors = session('errors');
        $response->assertSessionHasErrors();
        $this->assertEquals($errors->get('password')[0], 'password minimal berisi 8 karakter');
    }

    public function test_empty_password_should_return_validation_error()
    {
        $response = $this->post('/login', [
            'nim' => env('NIM_SIAM'),
            'password' => ''
        ]);

        $errors = session('errors');
        $response->assertSessionHasErrors();
        $this->assertEquals($errors->get('password')[0], 'password wajib diisi');
    }
    
    public function test_empty_nim_should_return_validation_error()
    {
        $response = $this->post('/login', [
            'nim' => '',
            'password' => 'secret'
        ]);

        $errors = session('errors');
        $response->assertSessionHasErrors();
        $this->assertEquals($errors->get('nim')[0], 'nim wajib diisi');
    }

    public function test_nim_too_short()
    {
        $response = $this->post('/login', [
            'nim' => '19515040011103',
            'password' => env('PASSWORD_SIAM')
        ]);
        
        $errors = session('errors');
        $response->assertSessionHasErrors();
        $this->assertEquals($errors->get('nim')[0], 'nim harus 15 karakter');
    }

    public function test_nim_too_long()
    {
        $response = $this->post('/login', [
            'nim' => '1951504001110345',
            'password' => env('PASSWORD_SIAM')
        ]);

        $errors = session('errors');
        $response->assertSessionHasErrors();
        $this->assertEquals($errors->get('nim')[0], 'nim harus 15 karakter');
    }

    public function test_sucessfully_logged_out() 
    {
        $response = $this->post('/logout');
        $response->assertRedirect('/login');
    }
}
