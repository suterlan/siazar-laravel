<?php

namespace App\Exports;

use App\Models\Siswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class SiswaExport implements FromView, ShouldAutoSize, WithColumnFormatting, WithDrawings, WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('export.siswa-export', [
            'title'     => 'Export SISWA'. config('app.name'),
            'siswas'    => Siswa::orderBy('nis', 'ASC')
                            ->where('lulus', false)
                            ->get(),
        ]);
    }

    public function columnFormats(): array
    {
        return [
            // 'D' => NumberFormat::FORMAT_TEXT,
            // 'T' => NumberFormat::FORMAT_NUMBER,
            // 'Y' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('logo_smk.jpg'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('A1');

        return $drawing;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 11,
            'L' => 30,
        ];
    }
}
