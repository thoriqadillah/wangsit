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
    public function test_delete_admin()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $adminM = Admin::latest()->first();

        $admin = new AdminService();
        $admin->unassignAdmin($adminM->id);

        $this->assertDatabaseHas('users', [
            'id' => $adminM->id,
            'admin_id' => null
        ]);

        $user->delete();
    }

    public function test_get_admin()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $admin = new AdminService();
        $show = $admin->getAdmin(10);

        $this->assertNotNull($show);
    }
}
