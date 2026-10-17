<?php

namespace Database\Factories;

use App\Models\Informasi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Informasi>
 */
class InformasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'judul' => fake()->sentence(4),
            'isi' => fake()->paragraphs(2, true),
            'kategori' => fake()->randomElement(['Akademik', 'Kegiatan', 'Pengumuman']),
            'user_id' => User::factory()->admin(),
        ];
    }
}
