<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Faker\Factory;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EventController;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventControllerTest extends TestCase
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

        // $this->post('/admin/event', $input);
        $response = $this->post('/admin/event', $input);
        $this->assertDatabaseHas('events', [
            'nama' => $nama
        ]);
    }

    public function test_update_event()
    {
        $this->actingAs(User::find(8)); //sesuaikan departement_id user dengan event
        $faker = Factory::create();

        $nama = $faker->words(6, true) . 'Updated';
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


        // $this->post('/admin/event', $input);
        $response = $this->put('/admin/event/' . $eventM->id, $input);


        $this->assertDatabaseHas('events', [
            'nama' => $nama
        ]);
    }

    public function test_delete_event()
    {
        $this->actingAs(User::find(20)); //sesuaikan departement_id user dengan event
        $eventM = Event::latest()->first();


        $response = $this->delete('/admin/event/' . $eventM->id);


        // $this->get('/event')->assertStatus(200);
        $this->assertDatabaseMissing('events', [
            'id' => $eventM->id
        ]);
    }
}
