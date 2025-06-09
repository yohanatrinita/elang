<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemesterReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'tahun',
        'semester',
        'status_dokumen',
        'tanggal_diterima',
        'catatan',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
