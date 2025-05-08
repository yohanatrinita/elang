<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    protected $fillable = [
        'pelaku_usaha',
        'jenis_usaha',
        'tanggal_pengawasan',
        'bulan',
        'tahun',
        'dokumen_lingkungan',
        'ppa',
        'ppu',
        'plb3',
        'rekomendasi',
        'tindak_lanjut',
        'file_pdf',
    ];
}
