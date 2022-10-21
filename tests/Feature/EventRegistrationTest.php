<?php

namespace Tests\Feature;

use App\Http\Livewire\EventRegistration;
use App\Models\Event;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Tests\TestCase;

class EventRegistrationTest extends TestCase
{
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_should_redirect_to_404()
    {
        Event::factory()->create();
        $event = Event::latest()->first(); 
        $component = Livewire::test(EventRegistration::class, ['slug' => $event->slug]);
        $component->assertStatus(404);

        $event->delete(); //biar gak kesimpen di db aja, jadi didelete
    }

    //FIXME
    public function test_should_redirected_if_already_registered()
    {
        $this->actingAs(User::first());
        $event = Event::first(); 
        $component = Livewire::test(EventRegistration::class, ['slug' => $event->slug]);
        $component->assertRedirect("/event/$event->slug/daftar/berhasil");
    }

    public function test_should_redirected_after_sucessfully_registered()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $event = Event::first();

        $faker = Factory::create();

        $response = [];
        for ($i = 0; $i < 10; $i++) {
            $response[] = [
                'judul' => $faker->words(rand(5, 10), true),
                'required' => $faker->boolean(),
                'response' => $faker->words(rand(5, 10), true)
            ];
        }

        $slug = $event->slug;
        Livewire::test(EventRegistration::class, ['slug' => $slug])
            ->set('formResponse', $response)
            ->set('aggrement', true)
            ->call('saveResponse')
            ->assertRedirect("/event/$slug/daftar/berhasil");

        $user->delete(); //biar gak kesimpen di db aja, jadi didelete
    }
}
