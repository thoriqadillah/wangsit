<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $format = [];
        for ($i=0; $i < 10; $i++) { 
            $format[] = [
                'form_type_id' => "1",
                'judul' => $faker->sentence(),
                'placeholder' => $faker->sentence(),
                'required' => $faker->boolean(),
                'value_options' => [
                    ['text' => '','value' => '']
                ]
            ];
        }

        for ($i = 0; $i < 10; $i++) {
            DB::table('event_forms')->insert([
                'event_id' => $i,
                'format' => json_encode($format),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
