<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('academy_categories')->insert([
            'nama' => 'Basis Data'
        ]);
        DB::table('academy_categories')->insert([
            'nama' => 'Pemrograman'
        ]);
        DB::table('academy_categories')->insert([
            'nama' => 'Pengembangan Sistem Informasi'
        ]);
        DB::table('academy_categories')->insert([
            'nama' => 'Manajemen'
        ]);
        DB::table('academy_categories')->insert([
            'nama' => 'Antarmuka'
        ]);
        DB::table('academy_categories')->insert([
            'nama' => 'Lain-lain'
        ]);
    }
}
