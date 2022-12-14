<?php

namespace Tests\Feature;

use App\Models\Admin;
use Carbon\Carbon;
use Faker\Factory;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        User::factory()->create();
        $user = User::latest()->first();
        Admin::create(['user_id' => $user->id, 'departement_id' => rand(1, 7)]);
        $admin = Admin::latest()->first();
        $this->actingAs($user);

        $faker = Factory::create();

        $nama = $faker->words(6, true);
        $slug = $faker->words(9, true);
        $thumbnail = $faker->words(9, true);
        $adanyaKelulusan = 1;

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

        $response = $this->post('/admin/event/tambah', $input);
        $response->assertRedirect(session()->previousUrl());

        $admin->delete(); //biar gak kesimpen di db aja, jadi didelete
        $user->delete(); //biar gak kesimpen di db aja, jadi didelete
    }

    public function test_update_event()
    {
        User::factory()->create();
        $user = User::latest()->first();
        Admin::create(['user_id' => $user->id, 'departement_id' => rand(1, 7)]);
        $admin = Admin::latest()->first();
        $this->actingAs($user);

        $faker = Factory::create();

        $nama = $faker->words(6, true) . 'Updated';
        $slug = $faker->words(9, true);
        $thumbnail = $faker->words(9, true);
        $adanyaKelulusan = 1;

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
        $response = $this->put('/admin/event/' . $eventM->id, $input);
        $response->assertRedirect(session()->previousUrl());

        $admin->delete(); //biar gak kesimpen di db aja, jadi didelete
        $user->delete();
    }
}
