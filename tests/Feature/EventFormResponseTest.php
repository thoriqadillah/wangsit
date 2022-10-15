<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use App\Services\EventFormResponseService;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $this->actingAs(User::find(20)); //pastikan di db gak ada, karena user hanya bisa ngisi sekali
        $event = Event::find(2);
        
        
        $service = new EventFormResponseService();
        $service->saveResponse($event->id, $this->makeResponse());

        $this->assertDatabaseHas('event_form_responses', [
            'event_id' => $event->id,
            'user_id' => 20,
        ]);
    }

    public function test_user_response_should_be_saved()
    {
        $this->actingAs(User::find(20)); //pastikan di db gak ada, karena user hanya bisa ngisi sekali
        $event = Event::find(2);
        
        $service = new EventFormResponseService();
        $userResponse = $service->checkUserResponse($event->id);
        
        $this->assertEquals($userResponse->event_id, $event->id);
        $this->assertEquals($userResponse->user_id, 20);
    }
}
