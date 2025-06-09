<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Desa;

class WilayahController extends Controller
{

public function getDesa($kecamatan_id)
{
    $desa = Desa::where('kecamatan_id', $kecamatan_id)->get();
    return response()->json($desa);
}

}
