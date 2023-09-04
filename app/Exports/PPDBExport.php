<?php

namespace App\Exports;

use App\Models\PPDB;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class PPDBExport implements FromView, ShouldAutoSize, WithColumnFormatting, WithDrawings, WithColumnWidths
{
    public function view(): View
    {
        $thisYear = Carbon::now();
        return view('export.ppdb', [
            'ppdbs' => PPDB::with(['jurusan', 'kelas', 'user'])
                ->latest()
                ->where('confirmed', 0)
                ->whereYear('created_at', $thisYear)
                ->get()
        ]);
    }

     public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_NUMBER,
            'T' => NumberFormat::FORMAT_NUMBER,
            'Y' => NumberFormat::FORMAT_NUMBER,
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
