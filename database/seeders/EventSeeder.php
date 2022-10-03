<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 20; $i++) {
            $nama = $faker->words(rand(3, 5), true);
            $hash = str_replace("=", "", base64_encode(Carbon::now()));

            DB::table('events')->insert([
                "id" => $i + 1,
                "departement_id" => rand(1, 7),
                "nama" => $nama,
                "slug" => Str::slug($nama).'-'.$hash,
                "deskripsi" => $faker->words(rand(8, 10), true),
                "thumbnail" => $faker->imageUrl(480, 640, 'technics'),
                "tgl_acara" => Carbon::now()->addDays(rand(8, 10)),
                "start_date" => Carbon::now(),
                "end_date" => Carbon::now()->addDays(rand(5, 7)),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]);
        }
        
    }
}
