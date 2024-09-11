<?php

namespace App\Charts;

use App\Models\Kelas;
use App\Models\Siswa;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class JumlahSiswaChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $query = Kelas::select('nama')->distinct()->get();
        $kelas = $query->map(function ($item, $key) {
            return $item->nama;
        });
        $kelasArr = $kelas->toArray();

        return $this->chart->donutChart()
            ->setTitle('Jumlah siswa per kelas')
            // ->setSubtitle('Season 2021.')
            ->addData([
                Siswa::select('id', 'kelas_id')->where('lulus', false)->whereRelation('kelas', 'nama', '=', $kelasArr[0])->count(),
                Siswa::select('id', 'kelas_id')->where('lulus', false)->whereRelation('kelas', 'nama', '=', $kelasArr[1])->count(),
                Siswa::select('id', 'kelas_id')->where('lulus', false)->whereRelation('kelas', 'nama', '=', $kelasArr[2])->count(),
            ])
            ->setLabels($kelasArr);
    }
}
