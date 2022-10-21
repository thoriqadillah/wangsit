<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use App\Models\User;
use App\Models\Academy;
use App\Models\AcademyCategory;
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
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $faker = Factory::create();

        $kategoriM = AcademyCategory::latest()->first();

        $nama = $faker->words(10, true);
        $kategori = $kategoriM->id;
        $link = $faker->words(7, true);

        $input = [
            'academy_category_id' => $kategori,
            'nama' => $nama,
            'link' => $link,
        ];

        $response = $this->post('/admin/academy/tambah', $input);
        $response->assertRedirect('/admin/academy');

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
            'thumbnail' => $thumbnail,
        ];

        $academyM = Academy::latest()->first();

        $response = $this->put('/admin/academy/' . $academyM->id, $input);
        $response->assertRedirect(session()->previousUrl());

        $user->delete();
    }

    public function test_delete_academy()
    {
        User::factory()->create();
        $user = User::latest()->first();
        $this->actingAs($user);
        $academyM = Academy::latest()->first();

        $response = $this->delete('/admin/academy/' . $academyM->id . '/delete');
        $response->assertRedirect(session()->previousUrl());

        $user->delete();
    }
}
