@extends('layouts.app')

@section('content')
<section class="py-5 bg-white">
    <div class="container">
        <h3 class="fw-bold mb-4">Upload Arsip</h3>

        <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf
            <div class="col-md-6">
                <label class="form-label">Pelaku Usaha</label>
                <input type="text" name="pelaku_usaha" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Jenis Usaha/Kegiatan</label>
                <input type="text" name="jenis_usaha" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tanggal Pengawasan</label>
                <select name="tanggal_pengawasan" class="form-select" required>
                    <option value="">Pilih Tanggal</option>
                    @for ($d = 1; $d <= 31; $d++)
                        <option value="{{ $d < 10 ? '0' . $d : $d }}">{{ $d }}</option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Bulan</label>
                <select name="bulan" class="form-select" required>
                    @foreach (['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $b)
                        <option value="{{ $b }}">{{ $b }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tahun</label>
                <input type="number" name="tahun" class="form-control" min="1900" max="2099" placeholder="Contoh: 2024" required>
            </div>
            <div class="col-md-12">
                <label class="form-label">Dokumen Lingkungan</label>
                <input type="text" name="dokumen_lingkungan" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">PPA</label>
                <textarea name="ppa" class="form-control" rows="3" placeholder="- Kulitas Air&#10;- " required></textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label">PPU</label>
                <textarea name="ppu" class="form-control" rows="3" placeholder="- Kualitas Udara&#10;- " required></textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label">PLB3</label>
                <textarea name="plb3" class="form-control" rows="3" placeholder="- Pengelolaan limbahB3&#10;- " required></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Rekomendasi</label>
                <textarea name="rekomendasi" class="form-control" rows="3" required></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tindak Lanjut</label>
                <textarea name="tindak_lanjut" class="form-control" rows="3" required></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Upload File (PDF)</label>
                <input type="file" name="file_pdf" class="form-control" accept=".pdf">
            </div>
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary">Simpan Arsip</button>
            </div>
        </form>
    </div>
</section>
@endsection
