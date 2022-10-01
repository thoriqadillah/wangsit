<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
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
        $this->actingAs(User::find(20)); //sesuaikan departement_id user dengan event
        $response = $this->get('/event');

        $response->assertStatus(200);
    }

    public function test_add_event()
    {
        $this->actingAs(User::find(20)); //sesuaikan departement_id user dengan event
        $faker = Factory::create();

        $nama = $faker->words(6, true);
        $deskripsi = $faker->words(9, true);

        $input = [
            'nama' => $nama,
            'deskripsi' => $deskripsi,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(7),
        ];

        $this->post('/admin/event', $input);
        $this->assertDatabaseHas('events', [
            'nama' => $nama
        ]);
    }

    public function test_update_event()
    {
        $this->actingAs(User::find(20)); //sesuaikan departement_id user dengan event
        $event = Event::latest()->first();
        $faker = Factory::create();

        $nama = $faker->words(rand(3, 5), true) . ' updated';
        $input = [
            'nama' => $nama,
            'deskripsi' => $faker->words(rand(8, 10), true) . ' updated',
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(7),
        ];

        $this->put('/admin/event/' . $event->id, $input);
        $this->assertEquals($nama, Event::latest()->first()->nama);
    }

    public function test_delete_event()
    {
        $this->actingAs(User::find(20)); //sesuaikan departement_id user dengan event
        $event = Event::latest()->first();

        $this->delete('/admin/event/' . $event->id);
        $this->assertDatabaseMissing('events', [
            'id' => $event->id
        ]);
    }
}
