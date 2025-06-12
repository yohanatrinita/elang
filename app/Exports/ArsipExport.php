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
        [], // Spacer row (baris 5)
        [ // Baris 6 (header utama)
            'No.', 'Pelaku Usaha', 'Jenis Usaha/Kegiatan', 'Alamat Lengkap', 'Tanggal Pengawasan',
            'Hasil Pemeriksaan Lapangan', '', '', '', 'Rekomendasi', 'Tindak Lanjut'
        ],
        [ // Baris 7 (sub-header)
            '', '', '', '', '',
            'Dokumen Lingkungan', 'PPA', 'PPU', 'PLB3', '', ''
        ],
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
        // Header tabel bold & tengah
$sheet->getStyle('A6:K7')->getFont()->setBold(true);
$sheet->getStyle('A6:K7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A6:K7')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);



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
            $sheet = $event->sheet;

            // Baris awal data setelah header dua baris (baris 6 dan 7)
            $dataStartRow = 6;

            // Hitung total baris data
            $dataCount = $this->collection()->count();

            // Baris akhir data
            $dataEndRow = $dataStartRow + $dataCount - (-1);

            // Terapkan border ke semua kolom dan baris data
            $sheet->getStyle("A{$dataStartRow}:K{$dataEndRow}")
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(Border::BORDER_THIN);

            // Wrap text dan vertical alignment
            $sheet->getStyle("A{$dataStartRow}:K{$dataEndRow}")
                ->getAlignment()
                ->setWrapText(true)
                ->setVertical(Alignment::VERTICAL_TOP);

            // Merge header bertingkat (baris 6 dan 7)
            $sheet->mergeCells('A6:A7'); // No.
            $sheet->mergeCells('B6:B7'); // Pelaku Usaha
            $sheet->mergeCells('C6:C7'); // Jenis Usaha
            $sheet->mergeCells('D6:D7'); // Alamat
            $sheet->mergeCells('E6:E7'); // Tanggal Pengawasan
            $sheet->mergeCells('F6:I6'); // Hasil Pemeriksaan Lapangan
            $sheet->mergeCells('J6:J7'); // Rekomendasi
            $sheet->mergeCells('K6:K7'); // Tindak Lanjut
        }
    ];
}

}
