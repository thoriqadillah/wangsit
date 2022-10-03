<?php

namespace Tests\Feature;

use App\Models\Academy;
use Carbon\Carbon;
use Faker\Factory;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_go_to_academy_page()
    {
        $this->actingAs(User::find(20)); //sesuaikan departement_id user dengan event
        $response = $this->get('/event');

        $response->assertStatus(200);
    }

    public function test_add_academy()
    {
        $this->actingAs(User::find(20)); //sesuaikan departement_id user dengan event
        $faker = Factory::create();

        $nama = $faker->words(10, true);
        $kategori = $faker->words(11, true);
        $link = $faker->words(7, true);
        $thumbnail = $faker->words(5, true);

        $input = [
            'nama' => "dudu",
            'kategori' => $kategori,
            'link' => $link,
            'thumbnail' => $thumbnail,
        ];

        $response = $this->post('/admin/academy', $input);
        $this->assertDatabaseHas('academies', [
            'nama' => "dudu"
        ]);
    }

    public function test_update_academy()
    {
        $this->actingAs(User::find(20)); //sesuaikan departement_id user dengan event
        $academy = Academy::latest()->first();
        $faker = Factory::create();

        $nama = $faker->words(rand(3, 5), true) . ' updated';
        $input = [
            'nama' => $nama,
            'kategori' => $faker->words(rand(8, 10), true) . ' updated',
            'link' => $faker->words(rand(8, 10), true),
            'thumbnail' => $faker->words(rand(8, 10), true),
        ];

        $this->put('/admin/academy/' . $academy->id, $input);
        $this->assertEquals($nama, Academy::latest()->first()->nama);
    }

    public function test_delete_academy()
    {
        $this->actingAs(User::find(20)); //sesuaikan departement_id user dengan event
        $academy = Academy::latest()->first();

        $this->delete('/admin/academy/' . $academy->id);
        $this->assertDatabaseMissing('academies', [
            'id' => $academy->id
        ]);
    }
}
