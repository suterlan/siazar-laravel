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
use Illuminate\Support\Str;
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
        $this->call(RoleSeeder::class);
        $this->call(PositionSeeder::class);

        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password'  => bcrypt('password'),
            'role_id' => 1,
            'position_id' => 1,
        ]);

        // user seeder
        for($i=0;$i<10;$i++){
            // $role = ['kurikulum', 'kaprog', 'walas', 'guru', 'siswa'];
            // $rand_keys = array_rand($role);
            $data[$i] = [
                'name' => fake()->name(),
                'username'  => fake()->unique()->userName(mt_rand(5, 8)),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role_id' => mt_rand(3, 4),
                'position_id' => mt_rand(6, 7),
                'remember_token' => Str::random(10),
                // 'role' => $role[$rand_keys],
                'created_at'    => now(),
                'updated_at'    => now(),
            ];
        }
        DB::table('users')->insert($data);

        // User::factory(10)->create();

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
        // SuratMasuk::factory(5)->create();

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
            'jurusan_id' => 1,
            'guru_id' => 1,
            'nama'  => 'X'
        ]);
        Kelas::create([
            'jurusan_id' => 1,
            'guru_id' => 1,
            'nama'  => 'XI'
        ]);
        Kelas::create([
            'jurusan_id' => 1,
            'guru_id' => 1,
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

        // Category::create([
        //     'name'      => 'Penerimaan Peserta Didik Baru',
        //     'slug'      => 'penerimaan-peserta-didik-baru'
        // ]);
        // Category::create([
        //     'name'      => 'Ujian akhir',
        //     'slug'      => 'ujian-akhir'
        // ]);

        // Post::factory(20)->create();

    }
}
