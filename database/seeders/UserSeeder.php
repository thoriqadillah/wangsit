<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($i = 0; $i < 20; $i++) {
            $role = [null, rand(1, 8)];

            DB::table('users')->insert([
                'nim' => Str::random(15),
                'nama' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('12345678'),
                'admin_id' => $role[rand(0, 1)],
                'tgl_lahir' => $faker->dateTimeBetween('-22 years', '-20 years'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
