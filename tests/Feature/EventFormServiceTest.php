<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\EventForm;
use App\Services\EventFormService;
use Faker\Factory;
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
        Event::factory()->create();
        $event = Event::latest()->first();
        $service = new EventFormService();
        $service->createForm($format, $event->id);

        $this->assertDatabaseHas('event_forms', [
            'event_id' => $event->id,
            'format' => json_encode($format)
        ]);

        //biar gak kesimpen di db aja, jadi didelete
        EventForm::latest()->first()->delete(); 
        $event->delete();
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
        $event = Event::first(); //pastikan di db gak ada, biar unik
        
        $service = new EventFormService();
        $service->updateForm($format, $event->id);

        $this->assertDatabaseHas('event_forms', [
            'event_id' => $event->id,
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
