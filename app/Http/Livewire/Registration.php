<?php

namespace App\Http\Livewire;

use App\Models\PPDB;
use Livewire\Component;
use Laravolt\Indonesia\Models\Province;

class Registration extends Component
{
    public $currentStep = 1;
    public $nama_siswa, $jk, $nik, $tempat_lahir, $tgl_lahir, $alamat, $provinsi, $kabupaten, $kecamatan, $kelurahan,
    $asal_sekolah, $nisn, $no_ijazah, $no_skhun, $no_kip, $nama_kip,
    $nama_ayah, $nik_ayah, $tgl_lahir_ayah, $pekerjaan_ayah, $pendidikan_ayah, $penghasilan_ayah, $nama_ibu, $nik_ibu, $tgl_lahir_ibu, $pendidikan_ibu, $pekerjaan_ibu, $penghasilan_ibu, $jml_saudara_kandung;
    public $successMessage = '';
    public $provinces;

    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'nama_siswa'    => 'required',
            'jk'            => 'required',
            'nik'           => 'min:16|required|numeric',
            'tempat_lahir'  => 'required',
            'tgl_lahir'     => 'required',
            'alamat'        => 'max:255',
            'provinsi'      => 'max:64',
            'kabupaten'     => 'max:64',
            'kecamatan'     => 'max:64',
            'kelurahan'     => 'max:64',
            'jml_saudara_kandung'   => 'max:1'
        ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $validatedData = $this->validate([
            'asal_sekolah'  => 'required',
            'nisn'          => 'min:10|numeric',
            'no_ijazah'     => 'min:16',
            'no_skhun'      => 'min:7',
            'no_kip'        => 'min:7',
            'nama_kip'      => 'max:255'
        ]);

        $this->currentStep = 3;
    }

    public function thirdStepSubmit(){
        $validatedData = $this->validate([
            'nama_ayah'         => 'required',
            'nik_ayah'          => 'min:16|numeric',
            'tgl_lahir_ayah'    => 'date',
            'pendidikan_ayah'   => 'max:32',
            'pekerjaan_ayah'    => 'max:64',
            'penghasilan_ayah'  => 'numeric',
            'nama_ibu'          => 'required',
            'nik_ibu'           => 'min:16|numeric',
            'tgl_lahir_ibu'     => 'date',
            'pendidikan_ibu'    => 'max:32',
            'pekerjaan_ibu'     => 'max:64',
            'penghasilan_ibu'   => 'numeric',
        ]);

        $this->currentStep = 4;
    }

    public function submitForm()
    {
        PPDB::create([
            'nama_siswa'        => $this->nama_siswa,
            'jk'                => $this->jk,
            'nik'               => $this->nik,
            'tempat_lahir'      => $this->tempat_lahir,
            'tgl_lahir'         => $this->tgl_lahir,
            'alamat'            => $this->alamat,
            'provinsi'          => $this->provinsi,
            'kabupaten'         => $this->kabupaten,
            'kecamatan'         => $this->kecamatan,
            'kelurahan'         => $this->kelurahan,
            'asal_sekolah'      => $this->asal_sekolah,
            'nisn'              => $this->nisn,
            'no_ijazah'         => $this->no_ijazah,
            'no_skhun'          => $this->no_skhun,
            'no_kip'            => $this->no_kip,
            'nama_kip'          => $this->nama_kip,
            'nama_ayah'         => $this->nama_ayah,
            'nik_ayah'          => $this->nik_ayah,
            'tgl_lahir_ayah'    => $this->tgl_lahir_ayah,
            'pendidikan_ayah'   => $this->pendidikan_ayah,
            'pekerjaan_ayah'    => $this->pekerjaan_ayah,
            'penghasilan_ayah'  => $this->penghasilan_ayah,
            'nama_ibu'          => $this->nama_ibu,
            'nik_ibu'           => $this->nik_ibu,
            'tgl_lahir_ibu'     => $this->tgl_lahir_ibu,
            'pendidikan_ibu'    => $this->pendidikan_ibu,
            'pekerjaan_ibu'     => $this->pekerjaan_ibu,
            'penghasilan_ibu'   => $this->penghasilan_ibu,
            'jml_saudara_kandung'   => $this->jml_saudara_kandung
        ]);

        $this->successMessage = 'You\'ve successfully registered';

        $this->clearForm();

        $this->currentStep = 1;
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function clearForm()
    {
        // $this->name = '';
        // $this->username = '';
        // $this->birth_place = '';
        // $this->birth_date = '';
        // $this->status = '';
        // $this->email = '';
        // $this->phone = '';
    }

    public function render()
    {
        $this->provinces= Province::pluck('name', 'code');
        return view('livewire.registration');
    }

}
