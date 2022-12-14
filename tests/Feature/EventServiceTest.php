<?php

namespace Tests\Feature;

use App\Models\Admin;
use Carbon\Carbon;
use Faker\Factory;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_add_event()
    {
        Storage::fake('avatars');

        User::factory()->create();
        $user = User::latest()->first();
        Admin::create(['user_id' => $user->id, 'departement_id' => rand(1, 7)]);
        $admin = Admin::latest()->first();
        $this->actingAs($user);

        $faker = Factory::create();

        $nama = $faker->words(6, true);
        $slug = $faker->words(9, true);
        $adanyaKelulusan = 1;
        $year = Carbon::now()->format('Y');
        $thumbnail = UploadedFile::fake()->image('avatar.png');
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

        $admin->delete(); //biar gak kesimpen di db aja, jadi didelete
        $user->delete(); //biar gak kesimpen di db aja, jadi didelete
    }

    public function test_update_event()
    {
        Storage::fake('avatars');

        User::factory()->create();
        $user = User::latest()->first();
        Admin::create(['user_id' => $user->id, 'departement_id' => rand(1, 7)]);
        $admin = Admin::latest()->first();
        $this->actingAs($user);
        
        $faker = Factory::create();

        $nama = $faker->words(6, true) . 'updated';
        $slug = $faker->words(9, true);
        $thumbnail = UploadedFile::fake()->image('avatar.png');
        $adanyaKelulusan = 1;
        $thumbnailLama = $faker->words(9, true);

        $input = [
            'departement_id' => Auth::user()->admin->departement_id,
            'nama' => $nama,
            'slug' => $slug,
            'thumbnail' => $thumbnail,
            'thumbnailLama' => $thumbnailLama,
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
        $admin->delete(); //biar gak kesimpen di db aja, jadi didelete
        $user->delete(); //biar gak kesimpen di db aja, jadi didelete
    }

    public function test_delete_event()
    {
        Event::factory()->create();
        $eventM = Event::latest()->first();

        $event = new EventService();
        $event->deleteEvent($eventM->id);

        $this->assertDatabaseMissing('events', [
            'id' => $eventM->id
        ]);
    }

    public function test_show_by()
    {
        $event = new EventService();
        $show = $event->showBy('departement_id', 1);

        $this->assertNotNull($show);
    }

    public function test_show_by_filter_aktif()
    {
        User::factory()->create();
        $user = User::latest()->first();
        Admin::create(['user_id' => $user->id, 'departement_id' => rand(1, 7)]);
        $admin = Admin::latest()->first();
        $this->actingAs($user);

        $event = new EventService();
        $show = $event->showByFilter('pendaftaran', $user->admin->departement_id);

        $this->assertNotNull($show);
        $admin->delete(); //biar gak kesimpen di db aja, jadi didelete
        $user->delete(); //biar gak kesimpen di db aja, jadi didelete
    }

    public function test_detail_event()
    {
        $event = new EventService();

        $eventM = Event::latest()->first();
        $show = $event->detailEvent($eventM->slug);

        $this->assertJson($show);
    }
}
