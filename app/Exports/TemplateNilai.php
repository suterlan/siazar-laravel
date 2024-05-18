<?php

namespace App\Exports;

use App\Models\Nilai;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TemplateNilai implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithColumnWidths
{
    use Exportable;

    protected $semester;
    protected $tahun_ajaran;
    protected $mapel_id;

    public function __construct($semester, $tahun_ajaran, $mapel_id)
    {
        $this->semester = $semester;
        $this->tahun_ajaran = $tahun_ajaran;
        $this->mapel_id = $mapel_id;
    }

    public function headings(): array
    {
        return [
            [
                'No',
                'ID',
                'Nilai ID',
                'Siswa ID',
                'Nama Siswa',
                'Mapel ID',
                'Mata Pelajaran',
                'Tahun Ajaran',
                'Semester',
                'Nilai'
            ]
        ];
    }

    public function map($nilai): array
    {
        // set number
        static $number = 1;
        return [
            $number++,
            md5($nilai->id),
            $nilai->id,
            $nilai->siswa_id,
            $nilai->siswa->nama_siswa,
            $nilai->mapel_id,
            $nilai->mapel->nama,
            $nilai->tahun_ajaran,
            $nilai->semester,
            $nilai->nilai,
        ];
    }

    public function query()
    {
        return Nilai::query()
            ->with(['siswa', 'mapel'])
            ->where('semester', '=', $this->semester)
            ->where('tahun_ajaran', '=', $this->tahun_ajaran)
            ->where('mapel_id', '=', $this->mapel_id);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 4,
        ];
    }
}
