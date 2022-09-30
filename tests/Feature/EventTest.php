<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EventTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_go_to_event_page()
    {
        $response = $this->get('/event');

        $response->assertStatus(200);
    }

    public function test_add_event()
    {
        $input = [
            'departement_id' => 6,
            'slug' => 'eventkwu',
            'name' => 'eventkwu',
            'deskripsi' => 'eventkwu adalah blabla',
            'start_date' => '2022-11-12',
            'end_date' => '2022-12-10',
            'spreadsheet_url' => 'eventkwu.com'
        ];

        $this->json('POST', '/add-event', $input);

        $this->assertDatabaseHas('events', $input);
    }




    public function test_update_event()
    {

        $event = Event::first();

        $input = [
            'departement_id' => 6,
            'slug' => 'eventkwu update',
            'name' => 'eventkwu upd',
            'deskripsi' => 'eventkwuupd adalah blabla',
            'start_date' => '2022-11-12',
            'end_date' => '2022-12-10',
            'spreadsheet_url' => 'eventkwuupd.com'
        ];

        $response = $this->json('PUT', 'update-event/' . $event->id, $input);

        $this->assertEquals('eventkwu update', Event::first()->slug);
    }

    public function test_delete_event()
    {
        $event = Event::first();


        $response = $this->delete('delete-event/' . $event->id);

        $this->assertDatabaseMissing('events', [
            'id' => $event->id
        ]);
    }
}
