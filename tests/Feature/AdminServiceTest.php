<?php

namespace Tests\Feature;

use App\Models\Admin;
use Faker\Factory;
use Tests\TestCase;
use App\Models\User;
use App\Services\AdminService;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_assign_admin()
    // {
    //     User::factory()->create();
    //     $user = User::latest()->first();
    //     $this->actingAs($user);

    //     $faker = Factory::create();

    //     // $input = [];
    //     // for ($i = 0; $i < 8; $i++) {
    //     $input = [
    //         'id' => 9,
    //         'userDept' => 8
    //     ];
    //     // }

    //     $admin = new AdminService();
    //     $admin->assignAdmin($input);

    //     $this->assertDatabaseHas('users', [
    //         'admin_id' => 8
    //     ]);
    // }

    public function test_delete_admin()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $adminM = Admin::latest()->first();

        $admin = new AdminService();
        $admin->deleteAdmin($adminM->id);

        $this->assertDatabaseMissing('admins', [
            'id' => $adminM->id
        ]);

        $user->delete();
    }

    public function test_get_admin()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $admin = new AdminService();
        $show = $admin->getAdmin();

        $this->assertJson($show);
    }
}
