<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    protected $fillable = [
        'desa_id',
        'pelaku_usaha',
        'alamat',
        'jenis_usaha',
        'tanggal_pengawasan',
        'jenis_dokumen_lingkungan',
        'dokumen_lingkungan',
        'ppa',
        'ppu',
        'plb3',
        'rekomendasi',
        'tindak_lanjut',
        'file_pdf_path',
        'file_pdf_name',
        'uploaded_by',
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    public function kecamatan()
    {
        return $this->desa?->kecamatan(); // relasi melalui desa
    }

}
