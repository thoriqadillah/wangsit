<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nim' => '0051504000kbmsi',
            'nama' => 'KEMSI',
            'email' => 'kemsi@gmail.com',
            'hp' => '000000000000',
            'password' => Hash::make('semangatpagi'),
            'tgl_lahir' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // $faker = Factory::create('id_ID');
        // for ($i = 0; $i < 20; $i++) {
        //     $role = [null, rand(2, 7)];

        //     DB::table('users')->insert([
        //         'nim' => Str::random(15),
        //         'nama' => $faker->name,
        //         'email' => $faker->email,
        //         'hp' => $faker->phoneNumber(),
        //         'password' => Hash::make('12345678'),
        //         'profile_pic' => $faker->imageUrl(480, 640, 'technics'),
        //         'tgl_lahir' => $faker->dateTimeBetween('-22 years', '-20 years'),
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ]);
        // }
    }
}
