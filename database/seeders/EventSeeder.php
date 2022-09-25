<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Event::insert([
            "id" => 1,
            "departement_id" => "5",
            "name" => "Genius : Accelerate",
            "deskripsi" => "Pengantar Data Saintis",
            "start_date" => Carbon::create('2022', '12', '01'),
            "end_date" => Carbon::create('2022', '12', '10'),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
    }
}
