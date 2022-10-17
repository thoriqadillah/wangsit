<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AcademySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $nama = $faker->words(rand(3, 5), true);
            $hash = bin2hex(random_bytes(6));

            DB::table('academies')->insert([
                'academy_category_id' => rand(1, 6),
                'nama' => $faker->words(rand(3, 5), true),
                "slug" => Str::slug($nama) . '-' . $hash,
                'link' => $faker->url(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
