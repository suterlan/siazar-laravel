<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Iklan;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Klasifikasi;
use App\Models\PPDB;
use App\Models\Sekolah;
use App\Models\SuratMasuk;
use App\Models\Tentang;
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
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'role'  => 1,
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
        SuratMasuk::factory(5)->create();

        Jurusan::create([
            'kode'  => 'TML',
            'nama'  => 'Teknik Multimedia',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum, quidem.'
        ]);
        Jurusan::create([
            'kode'  => 'MP',
            'nama'  => 'Manajemen Perkantoran',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum, quidem.'
        ]);
        Jurusan::create([
            'kode'  => 'TSM',
            'nama'  => 'Teknik Sepeda Motor',
            'deskripsi' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum, quidem.'
        ]);

        Kelas::create([
            'wali_kelas_id' => 1,
            'nama'  => 'X'
        ]);
        Kelas::create([
            'wali_kelas_id' => 2,
            'nama'  => 'XI'
        ]);
        Kelas::create([
            'wali_kelas_id' => 3,
            'nama'  => 'XII'
        ]);

        PPDB::factory(15)->create();

        Sekolah::create([
            'id'    => 1,
            'nama_sekolah'  => 'SMK Az-Zarkasyih'
        ]);
        Tentang::create([
            'id'    => 1,
        ]);

        Iklan::create([
            'id'    => 1
        ]);
    }
}
