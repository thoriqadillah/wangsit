<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Services\EventFormService;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventFormServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_successfuly_create_form()
    {
        $faker = Factory::create();
        $format = [];
        for ($i=0; $i < 10; $i++) { 
            $format[] = [
                'form_type_id' => "1",
                'judul' => $faker->sentence(),
                'placeholder' => $faker->sentence(),
                'required' => $faker->boolean(),
                'value_options' => [
                    ['text' => '','value' => '']
                ]
            ];
        }
        $eventId = 15; //pastikan di db gak ada, biar unik
        $service = new EventFormService();
        $service->createForm($format, $eventId);

        $this->assertDatabaseHas('event_forms', [
            'event_id' => $eventId,
            'format' => json_encode($format)
        ]);
    }

    public function test_successfuly_update_form()
    {
        $faker = Factory::create();
        $format = [];
        for ($i=0; $i < 5; $i++) { 
            $format[] = [
                'form_type_id' => "1",
                'judul' => $faker->sentence(),
                'placeholder' => $faker->sentence(),
                'required' => $faker->boolean(),
                'value_options' => [
                    ['text' => '','value' => '']
                ]
            ];
        }
        $eventId = 15; //pastikan di db gak ada, biar unik
        $service = new EventFormService();
        $service->updateForm($format, $eventId);

        $this->assertDatabaseHas('event_forms', [
            'event_id' => $eventId,
            'format' => json_encode($format)
        ]);
    }

    public function test_get_event_form()
    {
        $event = Event::first();
        $service = new EventFormService();
        $result = $service->getEventForm($event->slug);

        $this->assertNotNull($result);
    }
}
