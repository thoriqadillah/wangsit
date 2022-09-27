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
            "departement_id" => 5,
            "slug" => "Genius-Accelerate",
            "name" => "Genius : Accelerate",
            "deskripsi" => "Pengantar Data Saintis",
            "start_date" => Carbon::create('2022', '12', '01'),
            "end_date" => Carbon::create('2022', '12', '10'),
            "spreadsheet_url" => "genius.com",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);

        Event::insert([
            "id" => 2,
            "departement_id" => 4,
            "slug" => "Atraksi",
            "name" => "Atraksi",
            "deskripsi" => "Belajar Figma",
            "start_date" => Carbon::create('2022', '11', '01'),
            "end_date" => Carbon::create('2022', '12', '5'),
            "spreadsheet_url" => "atrkasi.com",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
    }
}
