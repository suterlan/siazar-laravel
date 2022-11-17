<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Klasifikasi;
use App\Models\SuratMasuk;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(5)->create();

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password'  => bcrypt('password')
        ]);

        // seed Klasifikasi
        Klasifikasi::create([
            'kode' => '25',
            'nama'  => 'Pemberitahuan',
            'deskripsi' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore, facilis.'
        ]);
        Klasifikasi::create([
            'kode' => '20',
            'nama'  => 'Undangan',
            'deskripsi' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempore, facilis.'
        ]);

        // seed Surat Masuk
        SuratMasuk::factory(7)->create();
    }
}
