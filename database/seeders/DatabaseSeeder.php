<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //TODO: cek data dari db wangsit yang lama
        $this->call(DepartementSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FormTypeSeeder::class);
        $this->call(EventSeeder::class);
        $this->call(EventFormResponseSeeder::class);
        $this->call(AcademySeeder::class);
        $this->call(EventFormSeeder::class);
    }
}
