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
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $faker = Factory::create();

        $nama = $faker->words(6, true);
        $slug = $faker->words(9, true);
        $thumbnail = $faker->words(9, true);
        $adanyaKelulusan = 1;
        $deptId = 16;

        $input = [
            'departement_id' => Auth::user()->admin->departement_id,
            'nama' => $nama,
            'slug' => $slug,
            'thumbnail' => $thumbnail,
            'adanya_kelulusan' => $adanyaKelulusan,
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
        $user->delete(); //biar gak kesimpen di db aja, jadi didelete

    }

    public function test_update_event()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $faker = Factory::create();

        $nama = $faker->words(6, true) . 'updated';
        $slug = $faker->words(9, true);
        $thumbnail = $faker->words(9, true);
        $adanyaKelulusan = 1;
        $deptId = 16;

        $input = [
            'departement_id' => Auth::user()->admin->departement_id,
            'nama' => $nama,
            'slug' => $slug,
            'thumbnail' => $thumbnail,
            'adanya_kelulusan' => $adanyaKelulusan,
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
        $user->delete(); //biar gak kesimpen di db aja, jadi didelete

    }

    public function test_delete_event()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $eventM = Event::latest()->first();

        $event = new EventService();
        $event->deleteEvent($eventM->id);

        $this->assertDatabaseMissing('events', [
            'id' => $eventM->id
        ]);

        $user->delete(); //biar gak kesimpen di db aja, jadi didelete

    }

    public function test_show_by()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $event = new EventService();
        $show = $event->showBy('departement_id', 1);

        $this->assertJson($show);
    }

    public function test_show()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $event = new EventService();
        $show = $event->showEvent();

        $this->assertJson($show);
    }

    public function test_show_by_date()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $event = new EventService();
        $show = $event->showByDate('aktif');

        $this->assertJson($show);
    }

    public function test_detail_event()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $event = new EventService();

        $eventM = Event::latest()->first();
        $show = $event->detailEvent($eventM->slug);

        $this->assertJson($show);
    }
}
