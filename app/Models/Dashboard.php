<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'file_path', 'category', 'uploaded_at'
    ];

    protected $dates = ['uploaded_at'];
}
