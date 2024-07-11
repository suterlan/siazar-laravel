<?php

namespace App\Charts;

use App\Models\Kelas;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class GenderChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $queryKelas = Kelas::select('id', 'jurusan_id', 'nama')->orderBy('nama')->get();

        foreach ($queryKelas as $row) {
            $arrKelas[] = $row->nama . '-' . $row->jurusan->kode;
        }

        // hitung jumlah siswa berdasarkan jenis kelamin
        // menggunakan fungsi eager loading eloquent relationship
        $lakiCounts = Kelas::withCount(['siswas' => function ($query) {
            $query->where('siswas.jk', 'Laki-laki');
        }])->orderBy('nama')->get();

        $perempuanCounts = Kelas::withCount(['siswas' => function ($query) {
            $query->where('siswas.jk', 'Perempuan');
        }])->orderBy('nama')->get();

        // mapping hasil count 
        // dengan mengembalikan hanya value siswa_count dan jadikan array
        $arrLaki = $lakiCounts->map(function ($item, $key) {
            return $item->siswas_count;
        })->toArray();

        $arrPerempuan = $perempuanCounts->map(function ($item, $key) {
            return $item->siswas_count;
        })->toArray();

        return $this->chart->barChart()
            ->setTitle('Jumlah siswa berdasarkan jenis kelamin.')
            ->setSubtitle('Chart jenis kelamin siswa per kelas')
            ->addData('Laki-laki', $arrLaki)
            ->addData('Perempuan', $arrPerempuan)
            ->setXAxis($arrKelas);
    }
}
