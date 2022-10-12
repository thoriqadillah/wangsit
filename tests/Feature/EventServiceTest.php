<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Faker\Factory;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\EventDispatcher\DependencyInjection\ExtractingEventDispatcher;

class EventServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_add_event()
    {
        $this->actingAs(User::find(8)); //sesuaikan departement_id user dengan event
        $faker = Factory::create();

        $nama = $faker->words(6, true);
        $slug = $faker->words(9, true);
        $deptId = 16;

        $input = [
            'departement_id' => Auth::user()->admin->departement_id,
            'nama' => $nama,
            'slug' => $slug,
            'tgl_buka_pendaftaran' => Carbon::now(),
            'tgl_tutup_pendaftaran' => Carbon::now()->addDays(7),
            'tgl_buka_pengumuman' => Carbon::now()->addDays(10),
            'tgl_tutup_pengumuman' => Carbon::now()->addDays(12),
        ];

        $event = new EventService();
        $event->addEvent($input);

        $this->assertDatabaseHas('events', [
            'nama' => $nama
        ]);
    }

    public function test_update_event()
    {
        $this->actingAs(User::find(8)); //sesuaikan departement_id user dengan event
        $faker = Factory::create();

        $nama = $faker->words(6, true) . ' Updated ';
        $slug = $faker->words(9, true);
        $deptId = 16;

        $input = [
            'departement_id' => Auth::user()->admin->departement_id,
            'nama' => $nama,
            'slug' => $slug,
            'tgl_buka_pendaftaran' => Carbon::now(),
            'tgl_tutup_pendaftaran' => Carbon::now()->addDays(7),
            'tgl_buka_pengumuman' => Carbon::now()->addDays(10),
            'tgl_tutup_pengumuman' => Carbon::now()->addDays(12),
        ];

        $eventM = Event::latest()->first();

        $event = new EventService();
        $event->updateEvent($input, $eventM->id);

        $this->assertDatabaseHas('events', [
            'nama' => $nama
        ]);
    }

    public function test_delete_event()
    {
        $this->actingAs(User::find(20)); //sesuaikan departement_id user dengan event
        $eventM = Event::latest()->first();

        $event = new EventService();
        $event->deleteEvent($eventM->id);

        $this->assertDatabaseMissing('events', [
            'id' => $eventM->id
        ]);
    }

    public function test_show_by()
    {
        $this->actingAs(User::find(20)); //sesuaikan departement_id user dengan event

        $event = new EventService();
        $show = $event->showBy('departement_id', 1);

        $this->assertJson($show);
    }

    public function test_show()
    {
        $this->actingAs(User::find(20)); //sesuaikan departement_id user dengan event

        $event = new EventService();
        $show = $event->showEvent();

        $this->assertJson($show);
    }
}
