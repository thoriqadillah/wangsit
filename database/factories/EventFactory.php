<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $nama = fake()->words(rand(3, 5), true);
        $hash = bin2hex(random_bytes(6));

        return [
            "departement_id" => rand(1, 7),
            "nama" => $nama,
            "slug" => Str::slug($nama).'-'.$hash,
            "thumbnail" => fake()->imageUrl(480, 640),
            'adanya_kelulusan' => fake()->boolean(),
            "tgl_buka_pendaftaran" => Carbon::now(),
            "tgl_tutup_pendaftaran" => Carbon::now()->addDays(rand(5, 7)),
            "tgl_buka_pengumuman" => Carbon::now()->addDays(10),
            "tgl_tutup_pengumuman" => Carbon::now()->addDays(10 + rand(5, 7)),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
