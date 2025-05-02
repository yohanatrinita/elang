@extends('layouts.app')

@section('content')
<section class="py-5 bg-white">
    <div class="container">
        <h3 class="fw-bold mb-4">Edit Arsip</h3>

        <form action="{{ route('arsip.update', $id) }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf
            <input type="hidden" name="id" value="{{ $id }}">

            <div class="col-md-6">
                <label class="form-label">Pelaku Usaha</label>
                <input type="text" name="pelaku" class="form-control" value="{{ old('pelaku', $arsip['pelaku']) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Jenis Usaha/Kegiatan</label>
                <input type="text" name="jenis" class="form-control" value="{{ old('jenis', $arsip['jenis']) }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tanggal Pengawasan</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $arsip['tanggal']) }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Bulan</label>
                <input type="text" name="bulan" class="form-control" value="{{ old('bulan', $arsip['bulan']) }}" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tahun</label>
                <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $arsip['tahun']) }}" required>
            </div>
            <div class="col-md-12">
                <label class="form-label">Dokumen Lingkungan</label>
                <input type="text" name="dokling" class="form-control" value="{{ old('dokling', $arsip['dokling']) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">PPA</label>
                <textarea name="ppa" class="form-control" rows="3" required>{{ old('ppa', $arsip['ppa']) }}</textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label">PPU</label>
                <textarea name="ppu" class="form-control" rows="3" required>{{ old('ppu', $arsip['ppu']) }}</textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label">PLB3</label>
                <textarea name="plb3" class="form-control" rows="3" required>{{ old('plb3', $arsip['plb3']) }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Rekomendasi</label>
                <textarea name="rekomendasi" class="form-control" rows="3" required>{{ old('rekomendasi', $arsip['rekomendasi']) }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tindak Lanjut</label>
                <textarea name="tindak" class="form-control" rows="3" required>{{ old('tindak', $arsip['tindak']) }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Ganti File (PDF, opsional)</label>
                <input type="file" name="file" class="form-control" accept=".pdf">
                @if(!empty($arsip['file']))
                    <small class="text-muted">File saat ini: <a href="{{ asset('storage/' . $arsip['file']) }}" target="_blank">Lihat PDF</a></small>
                @endif
            </div>
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="{{ route('arsip') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</section>
@endsection
