<?php

namespace Tests\Feature;

use App\Http\Livewire\Root;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RootTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_admin()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $admin = Admin::create(['user_id' => $user->id, 'departement_id' => null]);
        
        $this->actingAs($user);
        
        Livewire::test(Root::class)
            ->call('deleteAdmin', $admin->user_id)
            ->assertHasNoErrors(['success']);

        $user->delete();
    }

    public function test_add_new_admin()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $admin = Admin::create(['user_id' => $user->id, 'departement_id' => null]);
        $this->actingAs($user);

        $this->actingAs($user);

        User::factory()->create();
        $newuser = User::latest()->first();

        Livewire::test(Root::class)
            ->set('searchedUser', $newuser)
            ->set('selectedDept', rand(1, 7))
            ->call('setAdmin')
            ->assertRedirect('/admin/root');
        
        $user->delete();
    }
}
