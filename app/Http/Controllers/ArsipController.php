<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Models\Arsip;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\DB;
use App\Exports\ArsipExport;
use Maatwebsite\Excel\Facades\Excel;

class ArsipController extends Controller
{
    public function index(Request $request)
    {
        $query = Arsip::with(['uploader', 'desa.kecamatan']);

        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->where(function ($q) use ($cari) {
                $q->where('pelaku_usaha', 'like', "%$cari%")
                    ->orWhere('jenis_usaha', 'like', "%$cari%")
                    ->orWhere('dokumen_lingkungan', 'like', "%$cari%")
                    ->orWhere('ppa', 'like', "%$cari%")
                    ->orWhere('ppu', 'like', "%$cari%")
                    ->orWhere('plb3', 'like', "%$cari%")
                    ->orWhere('rekomendasi', 'like', "%$cari%")
                    ->orWhere('tindak_lanjut', 'like', "%$cari%");
            });
        }

        $arsips = $query->latest()->paginate(15);
        return view('arsip', compact('arsips'));
    }

    public function UploadView()
    {
        return view('upload-arsip');
    }

    public function getDesaByKecamatan($kecamatanId)
    {
        $desa = Desa::where('kecamatan_id', $kecamatanId)->get(['id', 'nama']);
        return response()->json($desa);
    }

    public function create()
    {
        $kecamatans = Kecamatan::orderBy('nama')->get();
        return view('upload-arsip', compact('kecamatans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'desa_id' => 'required|exists:desas,id',
            'pelaku_usaha' => 'required|string',
            'alamat' => 'required|string',
            'jenis_usaha' => 'required|string',
            'tanggal_pengawasan' => 'required|date',
            'jenis_dokumen_lingkungan' => 'required|string',
            'dokumen_lingkungan' => 'required|string',
            'ppa' => 'required|string',
            'ppu' => 'required|string',
            'plb3' => 'required|string',
            'rekomendasi' => 'required|string',
            'tindak_lanjut' => 'required|string',
            'file_pdf' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $validated['uploaded_by'] = auth()->id();

        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');
            $path = $file->store('arsip', 'public');
            $validated['file_pdf_path'] = $path;
            $validated['file_pdf_name'] = $file->getClientOriginalName();
        }

        Arsip::create($validated);
        return redirect()->route('arsip')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $arsip = Arsip::with('desa.kecamatan')->findOrFail($id);
        $kecamatans = Kecamatan::orderBy('nama')->get();
        $desas = $arsip->desa ? Desa::where('kecamatan_id', $arsip->desa->kecamatan_id)->get() : collect();

        return view('edit-arsip', compact('arsip', 'kecamatans', 'desas'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'desa_id' => 'required|exists:desas,id',
            'pelaku_usaha' => 'required|string',
            'alamat' => 'required|string',
            'jenis_usaha' => 'required|string',
            'tanggal_pengawasan' => 'required|date',
            'jenis_dokumen_lingkungan' => 'required|string',
            'dokumen_lingkungan' => 'required|string',
            'ppa' => 'required|string',
            'ppu' => 'required|string',
            'plb3' => 'required|string',
            'rekomendasi' => 'required|string',
            'tindak_lanjut' => 'required|string',
            'file_pdf' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $arsip = Arsip::findOrFail($id);

        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');
            $path = $file->store('arsip', 'public');
            $validated['file_pdf_path'] = $path;
            $validated['file_pdf_name'] = $file->getClientOriginalName();
        }

        $arsip->update($validated);
        return redirect()->route('arsip')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $arsip = Arsip::findOrFail($id);
        if ($arsip->file_pdf_path && Storage::disk('public')->exists($arsip->file_pdf_path)) {
            Storage::disk('public')->delete($arsip->file_pdf_path);
        }
        $arsip->delete();
        return redirect()->route('arsip')->with('success', 'Data berhasil dihapus.');
    }

    public function downloadFile($id)
    {
        $arsip = Arsip::findOrFail($id);
        if (!$arsip->file_pdf_path || !Storage::disk('public')->exists($arsip->file_pdf_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($arsip->file_pdf_path, $arsip->file_pdf_name);
    }

    public function showPdfFilter(Request $request)
    {
        $arsips = Arsip::query();

        if ($request->filled('from') && $request->filled('to')) {
            $arsips->whereBetween('tanggal_pengawasan', [$request->from, $request->to]);
        }

        $arsips = $arsips->get();

        return view('arsip-pdf', [
            'arsips' => $arsips,
            'judul' => null
        ]);
    }

    public function downloadPdf(Request $request)
    {
        $request->validate([
            'from' => 'required|date',
            'to' => 'required|date|after_or_equal:from'
        ]);

        $from = Carbon::parse($request->from);
        $to = Carbon::parse($request->to);

        $arsips = Arsip::whereBetween('tanggal_pengawasan', [$from, $to])->get();

        $judul = 'Rekap Pengawasan Pelaku Usaha ' . $from->translatedFormat('d F Y') . ' - ' . $to->translatedFormat('d F Y');
        $filename = $judul . '.pdf';

        $pdf = Pdf::loadView('arsip-pdf', [
            'arsips' => $arsips,
            'judul' => $judul
        ])->setPaper('a4', 'landscape');

        return $pdf->download($filename);
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
            ($awal ? Carbon::parse($awal)->translatedFormat('d F Y') : '-') . ' sampai ' .
            ($akhir ? Carbon::parse($akhir)->translatedFormat('d F Y') : '-');

        $filename = 'Rekap_Pengawasan_' .
            ($awal ? Carbon::parse($awal)->format('d-m-Y') : '-') . '_sd_' .
            ($akhir ? Carbon::parse($akhir)->format('d-m-Y') : '-') . '.pdf';

        $pdf = Pdf::loadView('arsip-pdf', [
            'arsips' => $data,
            'judul' => $judul
        ])->setPaper('a4', 'landscape');

        return $pdf->download($filename);
    }

    public function showRekapFilter()
    {
        return $this->showPdfFilter(request());
    }

    public function downloadRekap(Request $request)
    {
        $from = $request->query('from');
        $to = $request->query('to');

        if (!$from || !$to) {
            abort(404, 'Tanggal tidak lengkap');
        }

        $fromDate = Carbon::parse($from);
        $toDate = Carbon::parse($to);

        $arsips = Arsip::whereBetween(DB::raw('DATE(tanggal_pengawasan)'), [$fromDate, $toDate])->get();

        $judul = 'Rekap Pengawasan Pelaku Usaha ' . $fromDate->translatedFormat('d F Y') . ' - ' . $toDate->translatedFormat('d F Y');
        $filename = $judul . '.pdf';

        $pdf = Pdf::loadView('rekap-pdf', [
            'arsips' => $arsips,
            'judul' => $judul,
        ])->setPaper('a4', 'landscape');

        return $pdf->download($filename);
    }

    public function downloadExcel(Request $request)
{
    $from = $request->query('from');
    $to = $request->query('to');

    if (!$from || !$to) {
        return redirect()->back()->with('error', 'Tanggal tidak valid.');
    }

    $fromDate = Carbon::parse($from);
    $toDate = Carbon::parse($to);

    // Sama seperti yang digunakan di fungsi downloadRekap PDF
    $judul = 'Rekap Pengawasan Pelaku Usaha ' . $fromDate->translatedFormat('d F Y') . ' - ' . $toDate->translatedFormat('d F Y');
    $filename = $judul . '.xlsx';

    return Excel::download(new ArsipExport($from, $to), $filename);
}

}
