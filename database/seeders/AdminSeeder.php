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
        DB::table('admins')->insert([
            'id' => 1,
            'departement_id' => null, //null untuk root => kemsi
            'role' => 'ROOT',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $counter = 0;
        for ($i = 0; $i < 16; $i++) {
            if (($i + 2) % 2 === 0) ++$counter;

            DB::table('admins')->insert([
                'id' => ($i + 2),
                'departement_id' => $counter,
                'role' => ($i + 2) % 2 === 0 ? 'Kadept' : 'Staff',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
