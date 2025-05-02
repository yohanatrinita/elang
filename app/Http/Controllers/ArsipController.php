<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ArsipController extends Controller
{
    public function index(Request $request)
    {
        $data = Storage::exists('arsip.json')
            ? collect(json_decode(Storage::get('arsip.json'), true))
            : collect([]);

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
            'tanggal' => 'required|string',
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

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('arsip', 'public');
        }

        $data = Storage::exists('arsip.json')
            ? collect(json_decode(Storage::get('arsip.json'), true))
            : collect([]);

        $data->push($validated);
        Storage::put('arsip.json', $data->toJson(JSON_PRETTY_PRINT));

        return redirect()->route('arsip')->with('success', 'Data berhasil disimpan.');
    }

    public function exportPdf(Request $request)
    {
        $awal = $request->get('tanggal_awal');
        $akhir = $request->get('tanggal_akhir');
        $cari = $request->get('cari');

        $data = Storage::exists('arsip.json')
            ? collect(json_decode(Storage::get('arsip.json'), true))
            : collect([]);

        if ($awal) {
            $data = $data->where('tanggal', '>=', $awal);
        }

        if ($akhir) {
            $data = $data->where('tanggal', '<=', $akhir);
        }

        if ($cari) {
            $data = $data->filter(function ($item) use ($cari) {
                return str_contains(strtolower($item['pelaku']), strtolower($cari));
            });
        }

        $judul = 'Rekap Data Pengawasan dari ' .
            ($awal ? Carbon::parse($awal)->translatedFormat('d F Y') : '-') .
            ' sampai ' .
            ($akhir ? Carbon::parse($akhir)->translatedFormat('d F Y') : '-');

        $filename = 'Rekap Data Pengawasan ' .
            ($awal ? Carbon::parse($awal)->translatedFormat('d F Y') : '-') .
            ' - ' .
            ($akhir ? Carbon::parse($akhir)->translatedFormat('d F Y') : '-') . '.pdf';

        $pdf = Pdf::loadView('arsip-pdf', [
            'arsip' => $data->values()->all(),
            'judul' => $judul
        ])->setPaper('a4', 'landscape');

        return $pdf->download($filename);
    }

    public function edit($id)
    {
        $data = json_decode(Storage::get('arsip.json'), true);
        if (!isset($data[$id])) {
            abort(404);
        }
        return view('edit-arsip', ['arsip' => $data[$id], 'id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'pelaku' => 'required|string',
            'jenis' => 'required|string',
            'tanggal' => 'required|string',
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

        $arsip = json_decode(Storage::get('arsip.json'), true);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('arsip', 'public');
        } else {
            $validated['file'] = $arsip[$id]['file'] ?? null;
        }

        $arsip[$id] = $validated;
        Storage::put('arsip.json', json_encode($arsip, JSON_PRETTY_PRINT));

        return redirect()->route('arsip')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $arsip = json_decode(Storage::get('arsip.json'), true);
        if (isset($arsip[$id])) {
            unset($arsip[$id]);
            $arsip = array_values($arsip); // reset index
            Storage::put('arsip.json', json_encode($arsip, JSON_PRETTY_PRINT));
        }
        return redirect()->route('arsip')->with('success', 'Data berhasil dihapus.');
    }

}
