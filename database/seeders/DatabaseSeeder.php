<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Guru;
use App\Models\Category;
use App\Models\Iklan;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Klasifikasi;
use App\Models\Post;
use App\Models\PPDB;
use App\Models\Sekolah;
use App\Models\SuratMasuk;
use App\Models\Tentang;
use App\Models\User;
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
        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'role'  => 1,
            'password'  => bcrypt('password')
        ]);

        User::factory(10)->create();

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
            'guru_id' => 1,
            'nama'  => 'X'
        ]);
        Kelas::create([
            'guru_id' => 2,
            'nama'  => 'XI'
        ]);
        Kelas::create([
            'guru_id' => 3,
            'nama'  => 'XII'
        ]);

        PPDB::factory(15)->create();

        Sekolah::create([
            'id'    => 1,
        ]);
        Tentang::create([
            'id'    => 1,
        ]);
        Iklan::create([
            'id'    => 1,
        ]);

        Guru::factory(10)->create();

        Category::create([
            'name'      => 'Penerimaan Peserta Didik Baru',
            'slug'      => 'penerimaan-peserta-didik-baru'
        ]);
        Category::create([
            'name'      => 'Ujian akhir',
            'slug'      => 'ujian-akhir'
        ]);

        Post::factory(20)->create();
    }
}
