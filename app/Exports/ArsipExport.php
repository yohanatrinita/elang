<?php

namespace App\Exports;

use App\Models\Arsip;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use Maatwebsite\Excel\Events\AfterSheet;

class ArsipExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithEvents
{
    protected $from;
    protected $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function collection()
    {
        return Arsip::whereBetween('created_at', [$this->from, $this->to])->get();
    }

    public function headings(): array
    {
        return [
            ['REKAPITULASI PENGAWASAN ' . date('d F Y', strtotime($this->from)) . ' - ' . date('d F Y', strtotime($this->to))],
            ['SUBKO PENEGAKAN HUKUM LINGKUNGAN'],
            ['BIDANG PENEGAKAN HUKUM LINGKUNGAN DAN PENGELOLAAN LIMBAH B3'],
            ['DINAS LINGKUNGAN HIDUP KABUPATEN BOGOR'],
            [], // Spacer row
            [
                'No.', 'Pelaku Usaha', 'Jenis Usaha/Kegiatan', 'Alamat Lengkap' ,'Tanggal Pengawasan',
                'Dokumen Lingkungan', 'PPA', 'PPU', 'PLB3', 'Rekomendasi', 'Tindak Lanjut'
            ],
            // Sub-header baris ke-7, sama seperti baris 6 agar mudah distyling
        ];
    }

    public function map($arsip): array
    {
        static $no = 1;

        return [
            $no++,
            $arsip->pelaku_usaha,
            $arsip->jenis_usaha,
            $arsip->alamat,
            $arsip->tanggal_pengawasan,
            $arsip->dokumen_lingkungan,
            $arsip->ppa,
            $arsip->ppu,
            $arsip->plb3,
            $arsip->rekomendasi,
            $arsip->tindak_lanjut
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Merge header judul
        $sheet->mergeCells('A1:K1');
        $sheet->mergeCells('A2:K2');
        $sheet->mergeCells('A3:K3');
        $sheet->mergeCells('A4:K4');


        // Style judul
        for ($i = 1; $i <= 4; $i++) {
            $sheet->getStyle("A{$i}")->applyFromArray([
                'font' => ['bold' => true, 'size' => 15],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
            ]);
        }

        // Header tabel bold & tengah
        $sheet->getStyle('A6:K6')->getFont()->setBold(true);
        $sheet->getStyle('A6:K6')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A6:K6')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        return [];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 25,
            'C' => 25,
            'D' => 18,
            'E' => 20,
            'F' => 20,
            'G' => 20,
            'H' => 20,
            'I' => 25,
            'J' => 25,
            'K' => 25,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $count = $this->collection()->count();
                $startRow = 6;
                $endRow = $startRow + $count;

                // Border untuk seluruh tabel data
                $event->sheet->getStyle("A{$startRow}:K{$endRow}")
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                // Wrap text dan vertical alignment
                $event->sheet->getStyle("A{$startRow}:K{$endRow}")
                    ->getAlignment()
                    ->setWrapText(true)
                    ->setVertical(Alignment::VERTICAL_TOP);
            }
        ];
    }
}
