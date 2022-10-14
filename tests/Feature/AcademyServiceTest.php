<?php

namespace Tests\Feature;

use App\Models\Academy;
use Carbon\Carbon;
use Faker\Factory;
use Tests\TestCase;
use App\Models\User;
use App\Services\AcademyService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AcademyServiceTest extends TestCase
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

        $academy = new AcademyService();
        $academy->addAcademy($input);

        $this->assertDatabaseHas('academies', [
            'nama' => $nama
        ]);
    }

    public function test_update_academy()
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

        $academyM = Academy::latest()->first();

        $academy = new AcademyService();
        $academy->updateAcademy($input, $academyM->id);

        $this->assertDatabaseHas('academies', [
            'nama' => $nama
        ]);
    }

    public function test_delete_event()
    {
        $this->actingAs(User::find(20)); //sesuaikan departement_id user dengan event
        $academyM = Academy::latest()->first();

        $academy = new AcademyService();
        $academy->deleteAcademy($academyM->id);

        $this->assertDatabaseMissing('academies', [
            'id' => $academyM->id
        ]);
    }

    public function test_show_all()
    {
        $academy = new AcademyService();
        $show = $academy->showAcademy();

        $this->assertJson($show);
    }
}
