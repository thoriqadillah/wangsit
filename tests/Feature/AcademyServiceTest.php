<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Faker\Factory;
use Tests\TestCase;
use App\Models\User;
use App\Models\Academy;
use App\Models\AcademyCategory;
use App\Services\AcademyService;
use Illuminate\Support\Facades\Auth;
use Database\Seeders\AcademyCategorySeeder;
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
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $faker = Factory::create();

        $kategoriM = AcademyCategory::latest()->first();

        $nama = $faker->words(10, true);
        $kategori = $kategoriM->id;
        $link = $faker->words(7, true);
        $thumbnail = $faker->words(5, true);

        $input = [
            'academy_category_id' => $kategori,
            'nama' => $nama,
            'link' => $link,
        ];

        $academy = new AcademyService();
        $academy->addAcademy($input);

        $this->assertDatabaseHas('academies', [
            'nama' => $nama
        ]);

        $user->delete();
    }

    public function test_update_academy()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $faker = Factory::create();

        $kategoriM = AcademyCategory::latest()->first();

        $nama = $faker->words(10, true) . 'update';
        $kategori = $kategoriM->id;
        $link = $faker->words(7, true);
        $thumbnail = $faker->words(5, true);

        $input = [
            'academy_category_id' => $kategori,
            'nama' => $nama,
            'link' => $link,
        ];

        $academyM = Academy::latest()->first();

        $academy = new AcademyService();
        $academy->updateAcademy($input, $academyM->id);

        $this->assertDatabaseHas('academies', [
            'nama' => $nama
        ]);

        $user->delete();
    }

    public function test_delete_event()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $academyM = Academy::latest()->first();

        $academy = new AcademyService();
        $academy->deleteAcademy($academyM->id);

        $this->assertDatabaseMissing('academies', [
            'id' => $academyM->id
        ]);

        $user->delete();
    }

    public function test_show_all()
    {
        $academy = new AcademyService();
        $show = $academy->showAcademy();

        $this->assertJson($show);
    }

    public function test_detail_academy()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $academyM = Academy::latest()->first();

        $academy = new AcademyService();
        $show = $academy->detailAcademy($academyM->id);

        $this->assertJson($show);
    }
}
