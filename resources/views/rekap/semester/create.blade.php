@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Laporan Semester</h2>

    <form action="{{ route('rekap.semester.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="company_id" class="form-label">Perusahaan</label>
            <select name="company_id" class="form-select" required>
                <option value="">-- Pilih Perusahaan --</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->nama_perusahaan }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <select name="semester" class="form-select" required>
                <option value="I">Semester I</option>
                <option value="II">Semester II</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <input type="number" name="tahun" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_diterima" class="form-label">Tanggal Diterima</label>
            <input type="date" name="tanggal_diterima" class="form-control">
        </div>

        <div class="mb-3">
            <label for="status_dokumen" class="form-label">Status Dokumen</label>
            <input type="text" name="status_dokumen" class="form-control">
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan</label>
            <textarea name="catatan" class="form-control" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('rekap.semester') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
