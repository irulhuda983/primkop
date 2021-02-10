<?php

namespace App\Exports;

use App\Models\Transaksi;
use App\Models\Instansi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class TransaksiExport implements FromView, WithColumnWidths, WithColumnFormatting, WithDrawings
{
    protected $bulan;
    protected $tahun;

    public function __construct(int $bulan, int $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('This is my logo');
        $drawing->setPath(public_path('assets/img/logo.png'));
        $drawing->setHeight(90);
        $drawing->setCoordinates('B1');

        return $drawing;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 4,
            'B' => 27,
            'C' => 15,            
            'D' => 15,            
            'E' => 15,            
            'F' => 15,            
            'G' => 15,            
            'H' => 15,            
            'I' => 15,            
            'J' => 15,            
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => '#,##0_-',
            'D' => '#,##0_-',
            'E' => '#,##0_-',
            'F' => '#,##0_-',
            'G' => '#,##0_-',
            'H' => '#,##0_-',
            'I' => '#,##0_-',
            'J' => '#,##0_-',
        ];
    }

    public function view(): View
    {
        $instansi = Instansi::all();
        $bulan = $this->bulan;
        $tahun = $this->tahun;
        $bulan_lengkap = ['', 'January', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'November', 'Desember'];
        return view('dashboard.exports.transaksi', compact('instansi', 'bulan', 'tahun', 'bulan_lengkap'));
    }

    // end

}
