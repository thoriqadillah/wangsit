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
        $this->call(DepartementSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(EventSeeder::class);
        // $this->call(EventFormResponseSeeder::class);
        // $this->call(AcademySeeder::class);
        $this->call(AcademyCategorySeeder::class);
        // $this->call(EventFormSeeder::class);
    }
}
