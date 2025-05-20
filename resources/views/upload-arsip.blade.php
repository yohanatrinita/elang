@extends('layouts.app')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="fw-bold mb-4">Upload Arsip</h3>
        <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Tanggal Pengawasan -->
            <div class="mb-3">
                <label for="tanggal_pengawasan" class="form-label">Tanggal Pengawasan</label>
                <input type="date" class="form-control" id="tanggal_pengawasan" name="tanggal_pengawasan" required>
            </div>

            <!-- Pelaku Usaha -->
            <div class="mb-3">
                <label for="pelaku_usaha" class="form-label">Pelaku Usaha</label>
                <input type="text" class="form-control" id="pelaku_usaha" name="pelaku_usaha" required>
            </div>

            <!-- Alamat -->
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>

            <!-- Jenis Usaha/Kegiatan -->
            <div class="mb-3">
                <label for="jenis_usaha" class="form-label">Jenis Usaha/Kegiatan</label>
                <input type="text" class="form-control" id="jenis_usaha" name="jenis_usaha" required>
            </div>

            <!-- Jenis Dokumen Lingkungan -->
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

            <!-- Dokumen Lingkungan (nama file) -->
            <div class="mb-3">
                <label for="dokumen_lingkungan" class="form-label">Dokumen Lingkungan</label>
                <input type="text" class="form-control" id="dokumen_lingkungan" name="dokumen_lingkungan" placeholder="Contoh: UKL-UPL No. 660.1/111/TL-DLH tanggal 1 Januari 2025" required>
            </div>

            <!-- PPA -->
            <div class="mb-3">
                <label for="ppa" class="form-label">PPA</label>
                <textarea class="form-control numbered" id="ppa" name="ppa" rows="3"></textarea>
            </div>

            <!-- PPU -->
            <div class="mb-3">
                <label for="ppu" class="form-label">PPU</label>
                <textarea class="form-control numbered" id="ppu" name="ppu" rows="3"></textarea>
            </div>

            <!-- PLB3 -->
            <div class="mb-3">
                <label for="plb3" class="form-label">PLB3</label>
                <textarea class="form-control numbered" id="plb3" name="plb3" rows="3"></textarea>
            </div>

            <!-- Tindak Lanjut -->
            <div class="mb-3">
                <label for="tindak_lanjut" class="form-label">Tindak Lanjut</label>
                <textarea class="form-control numbered" id="tindak_lanjut" name="tindak_lanjut" rows="3"></textarea>
            </div>

            <!-- Rekomendasi -->
            <div class="mb-3">
                <label for="rekomendasi" class="form-label">Rekomendasi</label>
                <textarea class="form-control numbered" id="rekomendasi" name="rekomendasi" rows="3"></textarea>
            </div>

            <!-- Upload Berita Acara Pengawasan -->
            <div class="mb-3">
                <label for="file" class="form-label">Upload Berita Acara Pengawasan</label>
                <input type="file" class="form-control" id="file" name="file" required>
            </div>

            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>

<script>
    // Menambahkan baris baru dengan nomor manual saat tekan Enter, tanpa memaksa format
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
@endsection
