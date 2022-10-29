<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //untuk root => kemsi
        DB::table('admins')->insert([
            'id' => 1,
            'user_id' => 1,
            'departement_id' => null, 
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        for ($i = 0; $i < 7; $i++) {
            DB::table('admins')->insert([
                'id' => ($i + 2),
                'user_id' => ($i + 2),
                'departement_id' => rand(1, 7),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
