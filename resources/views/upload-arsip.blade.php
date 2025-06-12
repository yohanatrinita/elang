@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@section('body-class', 'dashboard-body')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

<section class="py-5 bg-light">
    <div class="container">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                <h3 class="fw-bold mb-4">Upload Arsip</h3>

                <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_pengawasan" class="form-label">Tanggal Pengawasan</label>
                            <input type="date" class="form-control" id="tanggal_pengawasan" name="tanggal_pengawasan" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="pelaku_usaha" class="form-label">Pelaku Usaha</label>
                            <input type="text" class="form-control" id="pelaku_usaha" name="pelaku_usaha" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <input type="text" class="form-control" id="provinsi" name="provinsi" value="Jawa Barat" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="kabupaten" class="form-label">Kabupaten</label>
                            <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="Kabupaten Bogor" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <select class="form-select" id="kecamatan" name="kecamatan" required>
                                <option value="">-- Pilih Kecamatan --</option>
                                @foreach ($kecamatans as $kecamatan)
                                    <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="desa" class="form-label">Desa/Kelurahan</label>
                            <select class="form-select" id="desa" name="desa_id" required>
                                <option value="">-- Pilih Desa/Kelurahan --</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" required>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_usaha" class="form-label">Jenis Usaha/Kegiatan</label>
                        <select name="jenis_usaha" class="form-select" required>
                            <option value="">-- Pilih Jenis Usaha/Kegiatan --</option>
                            <option value="Agroindustri">Agroindustri</option>
                            <option value="Fasilitas Pelayanan Kesehatan">Fasilitas Pelayanan Kesehatan</option>
                            <option value="Jasa Pengelolaan Limbah B3">Jasa Pengelolaan Limbah B3</option>
                            <option value="Manufaktur">Manufaktur</option>
                            <option value="Pertambangan Energi dan Migas">Pertambangan Energi dan Migas</option>
                            <option value="Prasarana">Prasarana</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_dokumen_lingkungan" class="form-label">Jenis Dokumen Lingkungan</label>
                        <select class="form-select" id="jenis_dokumen_lingkungan" name="jenis_dokumen_lingkungan" required>
                            <option value="">-- Pilih Jenis Dokumen --</option>
                            <option value="Amdal">Amdal</option>
                            <option value="UKL-UPL">UKL-UPL</option>
                            <option value="DELH">DELH</option>
                            <option value="DPLH">DPLH</option>
                            <option value="Tidak Ada">Tidak Ada</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="dokumen_lingkungan" class="form-label">Dokumen Lingkungan</label>
                        <input type="text" class="form-control" id="dokumen_lingkungan" name="dokumen_lingkungan" placeholder="Contoh: UKL-UPL No. 660.1/111/TL-DLH tanggal 1 Januari 2025" required>
                    </div>

                    <div class="mb-3">
                        <label for="ppa" class="form-label">PPA</label>
                        <textarea class="form-control numbered" id="ppa" name="ppa" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="ppu" class="form-label">PPU</label>
                        <textarea class="form-control numbered" id="ppu" name="ppu" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="plb3" class="form-label">PLB3</label>
                        <textarea class="form-control numbered" id="plb3" name="plb3" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="tindak_lanjut" class="form-label">Tindak Lanjut</label>
                        <textarea class="form-control numbered" id="tindak_lanjut" name="tindak_lanjut" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="rekomendasi" class="form-label">Rekomendasi</label>
                        <textarea class="form-control numbered" id="rekomendasi" name="rekomendasi" rows="3"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="file_pdf" class="form-label">Upload Berita Acara Pengawasan</label>
                        <input type="file" class="form-control" id="file_pdf" name="file_pdf" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
// Auto-numbered textarea on Enter
document.querySelectorAll('.numbered').forEach(function(textarea) {
    textarea.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            const start = this.selectionStart;
            const end = this.selectionEnd;
            const value = this.value;
            const lines = value.substr(0, start).split('\n');
            const lastLine = lines[lines.length - 1];
            const match = lastLine.match(/^(\d+)\.\s/);
            let nextNumber = '1. ';
            if (match) {
                nextNumber = (parseInt(match[1]) + 1) + '. ';
            }
            const insertText = '\n' + nextNumber;
            this.value = value.substring(0, start) + insertText + value.substring(end);
            this.selectionStart = this.selectionEnd = start + insertText.length;
        }
    });
});
</script>

<script>
document.getElementById('kecamatan').addEventListener('change', function () {
    const kecamatanId = this.value;
    const desaSelect = document.getElementById('desa');
    desaSelect.innerHTML = '<option value="">Memuat...</option>';

    fetch(`/get-desa/${kecamatanId}`)
        .then(response => response.json())
        .then(data => {
            desaSelect.innerHTML = '<option value="">-- Pilih Desa/Kelurahan --</option>';
            data.forEach(desa => {
                desaSelect.innerHTML += `<option value="${desa.id}">${desa.nama}</option>`;
            });
        });
});
</script>

@endsection
