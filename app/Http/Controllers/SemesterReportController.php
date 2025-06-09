<?php

namespace App\Http\Controllers;

use App\Models\SemesterReport;
use Illuminate\Http\Request;
use App\Models\Company; 

class SemesterReportController extends Controller
{
    public function index()
    {
        $companies = Company::with('semesterReports')->get();
        return view('rekap.semester.index', compact('companies'));
    }

    public function create()
    {
        return view('rekap.semester.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id',
            'semester' => 'required|in:I,II',
            'tahun' => 'required|integer',
            'tanggal_diterima' => 'nullable|date',
            'status_dokumen' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        SemesterReport::create($request->all());
        return redirect()->route('rekap.semester')->with('success', 'Data berhasil disimpan.');
    }

    public function edit(SemesterReport $semester)
    {
        return view('rekap.semester.edit', compact('semester'));
    }

    public function update(Request $request, SemesterReport $semester)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'semester' => 'required|string',
            'tahun' => 'required|integer',
            'status_dokumen' => 'required|string',
            'tanggal_diterima' => 'required|date',
            'catatan' => 'nullable|string',
        ]);

        $semester->update($validated);

        return redirect()->route('rekap.semester.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(SemesterReport $semester)
    {
        $semester->delete();
        return redirect()->route('rekap.semester.index')->with('success', 'Data berhasil dihapus');
    }
}
