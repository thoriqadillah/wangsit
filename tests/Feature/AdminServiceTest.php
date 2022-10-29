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
    public function test_unassign_admin()
    {
        $deptId = rand(1, 7);
        User::factory()->create();
        $user = User::latest()->first();
        Admin::create(['user_id' => $user->id, 'departement_id' => $deptId]);
        $adminM = Admin::latest()->first();
        $this->actingAs($user);

        $admin = new AdminService();
        $admin->unassignAdmin($adminM->user_id);

        $this->assertDatabaseMissing('admins', [
            'user_id' => $adminM->user_id,
            'departement_id' => $deptId
        ]);
        $user->delete();
        $adminM->delete();
    }

    public function test_assign_admin()
    {
        User::factory()->create();
        $user = User::latest()->first();

        $admin = new AdminService();
        $deptId = rand(1, 7);
        $admin->assignAdmin($user->id, $deptId);

        $this->assertDatabaseHas('admins', [
            'user_id' => $user->id,
            'departement_id' => $deptId
        ]);
        $user->delete();
        Admin::latest()->first()->delete();
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
