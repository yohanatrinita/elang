<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Arsip;

class ArsipController extends Controller
{
    public function index(Request $request)
    {
        $arsip = Arsip::all();
        return view('arsip', ['arsip' => $arsip]);
    }

    public function create()
    {
        return view('upload-arsip');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pelaku_usaha' => 'required|string',
            'jenis_usaha' => 'required|string',
            'tanggal_pengawasan' => 'required|string',
            'bulan' => 'required|string',
            'tahun' => 'required|numeric',
            'dokumen_lingkungan' => 'required|string',
            'ppa' => 'required|string',
            'ppu' => 'required|string',
            'plb3' => 'required|string',
            'rekomendasi' => 'required|string',
            'tindak_lanjut' => 'required|string',
            'file_pdf' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Konversi tanggal jadi YYYY-MM-DD
        $tanggal = str_pad($validated['tanggal_pengawasan'], 2, '0', STR_PAD_LEFT);
        $bulan = $this->convertBulan($validated['bulan']);
        $validated['tanggal_pengawasan'] = "{$validated['tahun']}-{$bulan}-{$tanggal}";

        // Upload file
        if ($request->hasFile('file_pdf')) {
            $validated['file_pdf'] = $request->file('file_pdf')->store('arsip', 'public');
        }        

        Arsip::create($validated);

        return redirect()->route('arsip')->with('success', 'Data berhasil disimpan.');
    }

    public function exportPdf(Request $request)
    {
        $awal = $request->get('tanggal_awal');
        $akhir = $request->get('tanggal_akhir');
        $cari = $request->get('cari');

        $data = Arsip::query();

        if ($awal) {
            $data->where('tanggal_pengawasan', '>=', $awal);
        }

        if ($akhir) {
            $data->where('tanggal_pengawasan', '<=', $akhir);
        }

        if ($cari) {
            $data->where('pelaku_usaha', 'like', "%$cari%");
        }

        $data = $data->get();

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
        $arsip = Arsip::findOrFail($id);
        return view('edit-arsip', compact('arsip'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'pelaku_usaha' => 'required|string',
            'jenis_usaha' => 'required|string',
            'tanggal_pengawasan' => 'required|string',
            'bulan' => 'required|string',
            'tahun' => 'required|numeric',
            'dokumen_lingkungan' => 'required|string',
            'ppa' => 'required|string',
            'ppu' => 'required|string',
            'plb3' => 'required|string',
            'rekomendasi' => 'required|string',
            'tindak_lanjut' => 'required|string',
            'file_pdf' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        // Konversi tanggal jadi YYYY-MM-DD
        $tanggal = str_pad($validated['tanggal_pengawasan'], 2, '0', STR_PAD_LEFT);
        $bulan = $this->convertBulan($validated['bulan']);
        $validated['tanggal_pengawasan'] = "{$validated['tahun']}-{$bulan}-{$tanggal}";

        $arsip = Arsip::findOrFail($id);

        if ($request->hasFile('file_pdf')) {
            $validated['file_pdf'] = $request->file('file_pdf')->store('arsip', 'public');
        }

        $arsip->update($validated);

        return redirect()->route('arsip')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $arsip = Arsip::findOrFail($id);
        $arsip->delete();

        return redirect()->route('arsip')->with('success', 'Data berhasil dihapus.');
    }

    private function convertBulan($bulan)
    {
        $bulanList = [
            'Januari' => '01',
            'Februari' => '02',
            'Maret' => '03',
            'April' => '04',
            'Mei' => '05',
            'Juni' => '06',
            'Juli' => '07',
            'Agustus' => '08',
            'September' => '09',
            'Oktober' => '10',
            'November' => '11',
            'Desember' => '12',
        ];

        return $bulanList[$bulan] ?? '01';
    }
}
