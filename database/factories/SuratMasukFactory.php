<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuratMasuk>
 */
class SuratMasukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'klasifikasi_id' => 1,
            'no_surat' => $this->faker->numerify('##.#/###/SMK'),
            'asal_surat' => fake()->name(),
            'deskripsi' => $this->faker->sentence(),
            'tanggal_surat' => now(),
            'tanggal_diterima' => now(),
            'keterangan' => 'segera'
        ];
    }
}
