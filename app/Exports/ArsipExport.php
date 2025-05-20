<?php

namespace App\Exports;

use App\Models\Arsip;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ArsipExport implements FromCollection, WithHeadings, WithMapping
{
    protected $year;

    public function __construct($year)
    {
        $this->year = $year;
    }

    public function collection()
    {
        return Arsip::whereYear('created_at', $this->year)->get();
    }

    public function headings(): array
    {
        return [
            'Pelaku Usaha',
            'Alamat',
            'Jenis Usaha',
            'Tanggal Pengawasan',
            'Jenis Dokumen Lingkungan',
            'Dokumen Lingkungan',
            'PPA',
            'PPU',
            'PLB3',
            'Rekomendasi',
            'Tindak Lanjut',
            'Nama File',
            'Waktu Upload'
        ];
    }

    public function map($arsip): array
    {
        return [
            $arsip->pelaku_usaha,
            $arsip->alamat,
            $arsip->jenis_usaha,
            $arsip->tanggal_pengawasan,
            $arsip->jenis_dokumen_lingkungan,
            $arsip->dokumen_lingkungan,
            $arsip->ppa,
            $arsip->ppu,
            $arsip->plb3,
            $arsip->rekomendasi,
            $arsip->tindak_lanjut,
            $arsip->file_pdf_name,
            $arsip->created_at->format('d-m-Y H:i')
        ];
    }
}
