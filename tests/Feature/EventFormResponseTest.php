<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\EventFormResponse;
use App\Models\User;
use App\Services\EventFormResponseService;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class EventFormResponseTest extends TestCase
{
    private function makeResponse() {
        $faker = Factory::create();

        $response = [];
        for ($i = 0; $i < 10; $i++) {
            $response[] = [
                'judul' => $faker->words(rand(5, 10), true),
                'response' => $faker->words(rand(5, 10), true)
            ];
        }
        return $response;
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_successfully_save_form_response()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $event = Event::latest()->first();
        
        $service = new EventFormResponseService();
        $service->saveResponse($event->id, $this->makeResponse());

        $this->assertDatabaseHas('event_form_responses', [
            'event_id' => $event->id,
            'user_id' => Auth::id(),
        ]);

        //biar gak kesimpen di db aja, jadi didelete
        EventFormResponse::latest()->first()->delete(); 
        $user->delete();
    }

    public function test_user_response_should_be_saved()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $event = Event::latest()->first();
        
        $service = new EventFormResponseService();
        $service->saveResponse($event->id, $this->makeResponse());
        $userResponse = $service->checkUserResponse($event->id);
        
        $this->assertEquals($userResponse->event_id, $event->id);
        $this->assertEquals($userResponse->user_id, Auth::id());

        $user->delete(); //biar gak kesimpen di db aja, jadi didelete
    }
}
