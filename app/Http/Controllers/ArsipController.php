<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ArsipController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun');

        // Ambil dan filter data arsip
        $data = Storage::exists('arsip.json')
            ? collect(json_decode(Storage::get('arsip.json'), true))
            : collect([]);

        if ($bulan) $data = $data->where('bulan', $bulan);
        if ($tahun) $data = $data->where('tahun', $tahun);

        return view('arsip', [
            'arsip' => $data->values()->all()
        ]);
    }

    public function create()
    {
        return view('upload-arsip');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelaku' => 'required|string',
            'jenis' => 'required|string',
            'tanggal' => 'required',
            'bulan' => 'required|string',
            'tahun' => 'required|numeric',
            'dokling' => 'required|string',
            'ppa' => 'required|string',
            'ppu' => 'required|string',
            'plb3' => 'required|string',
            'rekomendasi' => 'required|string',
            'tindak' => 'required|string',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Upload file jika ada
        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('arsip', 'public');
        }

        // Simpan ke arsip.json
        $data = Storage::exists('arsip.json')
            ? collect(json_decode(Storage::get('arsip.json'), true))
            : collect([]);

        $data->push($validated);
        Storage::put('arsip.json', $data->toJson(JSON_PRETTY_PRINT));

        return redirect()->route('arsip')->with('success', 'Data berhasil disimpan.');
    }


    public function exportPdf(Request $request)
    {
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun');
    
        $data = Storage::exists('arsip.json') 
            ? collect(json_decode(Storage::get('arsip.json'), true)) 
            : collect([]);
    
        if ($bulan) $data = $data->where('bulan', $bulan);
        if ($tahun) $data = $data->where('tahun', $tahun);
    
        $filename = 'Rekap Data Pengawasan (' . ($bulan ?? 'Semua') . ' ' . ($tahun ?? 'Semua') . ').pdf';
    
        $pdf = Pdf::loadView('arsip-pdf', [
            'arsip' => $data->values()->all(),
            'bulan' => $bulan,
            'tahun' => $tahun
        ])->setPaper('a4', 'landscape');
    
        return $pdf->download($filename);
    }
    
}
