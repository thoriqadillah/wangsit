<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $response = [];
        for ($i = 0; $i < 10; $i++) {
            $response[] = [
                'judul' => $faker->words(rand(5, 10), true),
                'response' => $faker->words(rand(5, 10), true)
            ];
        }

        for ($i = 0; $i <= 60; $i++) {
            DB::table('event_response_jsons')->insert([
                'event_id' => 1,
                'user_id' => rand(1, 20),
                'response' => json_encode($response),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
