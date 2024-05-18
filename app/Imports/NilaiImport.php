<?php

namespace App\Imports;

use App\Models\Nilai;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class NilaiImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Nilai([
            'siswa_id'  => $row['Siswa_ID'],
            'mapel_id'  => $row['Mapel_ID'],
            'nilai'     => $row['Nilai'],
            'tahun_ajaran'  => $row['Tahun_Ajaran'],
            'semester'  => $row['Semester'],
        ]);
    }
}
