<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use App\Models\User;
use App\Models\Academy;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademyControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_add_academy()
    {
        $this->actingAs(User::find(8)); //sesuaikan departement_id user dengan event
        $faker = Factory::create();

        $nama = $faker->words(3, true);
        $kategori = $faker->words(1, true);
        $link = $faker->words(7, true);
        $thumbnail = $faker->words(5, true);

        $input = [
            'nama' => $nama,
            'kategori' => $kategori,
            'link' => $link,
            'thumbnail' => $thumbnail,
        ];

        // $this->post('/admin/academy', $input);
        $response = $this->post('/admin/academy', $input);
        $this->assertDatabaseHas('academies', [
            'kategori' => $kategori
        ]);
    }
    public function test_update_academy()
    {
        $this->actingAs(User::find(8)); //sesuaikan departement_id user dengan event
        $faker = Factory::create();

        $nama = $faker->words(3, true) . 'updated';
        $kategori = $faker->words(1, true);
        $link = $faker->words(7, true);
        $thumbnail = $faker->words(5, true);

        $input = [
            'nama' => $nama,
            'kategori' => $kategori,
            'link' => $link,
            'thumbnail' => $thumbnail,
        ];

        $academyM = Academy::latest()->first();

        // $this->post('/admin/academy', $input);
        $response = $this->put('/admin/academy/' . $academyM->id, $input);
        $this->assertDatabaseHas('academies', [
            'kategori' => $kategori
        ]);
    }

    public function test_delete_academy()
    {
        $this->actingAs(User::find(20)); //sesuaikan departement_id user dengan event
        $academyM = Academy::latest()->first();


        $response = $this->delete('/admin/academy/' . $academyM->id);


        // $this->get('/event')->assertStatus(200);
        $this->assertDatabaseMissing('academies', [
            'id' => $academyM->id
        ]);
    }
}
