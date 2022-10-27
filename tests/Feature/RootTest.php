<?php

namespace Tests\Feature;

use App\Http\Livewire\Root;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class RootTest extends TestCase
{
    //TODO: buat test root
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_admin()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs(User::first());
        Livewire::test(Root::class)
            ->call('deleteAdmin', $user->id)
            ->assertHasNoErrors('success');
        
        $user->delete();
    }

    public function test_add_new_admin()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs(User::first());
        Livewire::test(Root::class)
            ->set('searchedUser', $user)
            ->set('selectedDept', 2)
            ->call('setAdmin')
            ->assertRedirect('/admin/root');
        
        $user->delete();
    }
}
