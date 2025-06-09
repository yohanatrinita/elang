<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class RekapController extends Controller
{
    public function semester() {
        return view('rekap.semester');
    }

    public function pengawasan() {
        return view('rekap.pengawasan');
    }

    public function emisi() {
        return view('rekap.emisi');
    }

    public function airLimbah() {
        return view('rekap.airlimbah');
    }

    public function plb3() {
        return view('rekap.plb3');
    }

    public function pernyataan() {
        return view('rekap.pernyataan');
    }
}
