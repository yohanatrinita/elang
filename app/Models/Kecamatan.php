<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $fillable = ['nama'];

    public function desas()
    {
        return $this->hasMany(Desa::class);
    }

    protected $attributes = [
    'kabupaten' => 'Kabupaten Bogor',
    'provinsi' => 'Provinsi Jawa Barat',
];

}

