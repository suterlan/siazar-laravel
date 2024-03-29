<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PPDB>
 */
class PPDBFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_siswa'    => fake()->name(),
            'jk'            => 'Laki-laki',
            'nik'           => $this->faker->nik(),
            'nisn'          => $this->faker->numerify('##########'),
            'tempat_lahir'  => fake()->city(),
            'tgl_lahir'     => now(),
            'asal_sekolah'  => 'SMPN 1',
            'kelas_id'      => 1,
            'jurusan_id'    => 1,
            'nama_ibu'     => fake()->name(),
            'user_id'       => 1
        ];
    }
}
