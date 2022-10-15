<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use App\Models\User;
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

        $nama = $faker->words(10, true);
        $kategori = $faker->words(3, true);
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
        // $eventS = new EventService();
        // $event = new EventController($eventS);
        // $event->addEvent($input);
        $response->assertOk();
        // $this->assertDatabaseHas('academies', [
        //     'nama' => $nama
        // ]);
    }
}
