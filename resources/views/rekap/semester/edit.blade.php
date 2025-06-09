@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Laporan Semester</h2>

    <form action="{{ route('rekap.semester.update', $semester->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="company_id" class="form-label">Perusahaan</label>
            <select name="company_id" class="form-select" required>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ $company->id == $semester->company_id ? 'selected' : '' }}>
                        {{ $company->nama_perusahaan }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <select name="semester" class="form-select" required>
                <option value="I" {{ $semester->semester == 'I' ? 'selected' : '' }}>Semester I</option>
                <option value="II" {{ $semester->semester == 'II' ? 'selected' : '' }}>Semester II</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="tahun" class="form-label">Tahun</label>
            <input type="number" name="tahun" class="form-control" value="{{ $semester->tahun }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_diterima" class="form-label">Tanggal Diterima</label>
            <input type="date" name="tanggal_diterima" class="form-control" value="{{ $semester->tanggal_diterima }}">
        </div>

        <div class="mb-3">
            <label for="status_dokumen" class="form-label">Status Dokumen</label>
            <input type="text" name="status_dokumen" class="form-control" value="{{ $semester->status_dokumen }}">
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan</label>
            <textarea name="catatan" class="form-control" rows="3">{{ $semester->catatan }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Perbarui</button>
        <a href="{{ route('rekap.semester') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
