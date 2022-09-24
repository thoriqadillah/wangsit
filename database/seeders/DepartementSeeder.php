<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departements')->insert([
            "id" => 1,
            "departement" => "NONDEPT",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
        DB::table('departements')->insert([
            "id" => 2,
            "departement" => "MEDKOMINFO",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
        DB::table('departements')->insert([
            "id" => 3,
            "departement" => "ADVOKESMA",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
        DB::table('departements')->insert([
            "id" => 4,
            "departement" => "PSDM",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
        DB::table('departements')->insert([
            "id" => 5,
            "departement" => "P2S",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
        DB::table('departements')->insert([
            "id" => 6,
            "departement" => "KWU",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
        DB::table('departements')->insert([
            "id" => 7,
            "departement" => "SOSMA",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
    }
}
