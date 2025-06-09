<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_perusahaan',
        'alamat',
        'no_telp',
        'penanggung_jawab',
        'jenis_usaha',
    ];

    public function semesterReports()
    {
        return $this->hasMany(SemesterReport::class);
    }

    public function create()
    {
        $companies = Company::all();
        return view('rekap.semester.create', compact('companies'));
    }

}
