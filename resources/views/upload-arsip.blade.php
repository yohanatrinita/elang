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

            <div class="form-group">
                <label for="
                ">Provinsi</label>
                <input type="text" class="form-control" id="provinsi" name="provinsi" value="Jawa Barat" readonly>
            </div>

            <div class="form-group">
                <label for="kabupaten">Kabupaten</label>
                <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="Kabupaten Bogor" readonly>
            </div>

            <!-- Kecamatan -->
            <div class="mb-3">
                <label for="kecamatan" class="form-label">Kecamatan</label>
                <select class="form-select" id="kecamatan" name="kecamatan" required>
                    <option value="">-- Pilih Kecamatan --</option>
                    @foreach ($kecamatans as $kecamatan)
                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Desa -->
            <div class="mb-3">
                <label for="desa" class="form-label">Desa/Kelurahan</label>
                <select class="form-select" id="desa" name="desa_id" required>
                    <option value="">-- Pilih Desa/Kelurahan --</option>
                </select>
            </div>


            <!-- Alamat -->
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat Lengkap</label>
                <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>


            <!-- Jenis Usaha/Kegiatan -->
            <div class="mb-3">
                <label for="jenis_usaha" class="form-label">Jenis Usaha/Kegiatan</label>
                <select name="jenis_usaha" class="form-control" required>
                    <option value="">-- Pilih Jenis Usaha/Kegiatan --</option>
                    <option value="Agroindustri" {{ old('jenis_usaha') == 'Agroindustri' ? 'selected' : '' }}>Agroindustri</option>
                    <option value="Fasilitas Pelayanan Kesehatan" {{ old('jenis_usaha') == 'Fasilitas Pelayanan Kesehatan' ? 'selected' : '' }}>Fasilitas Pelayanan Kesehatan</option>
                    <option value="Jasa Pengelolaan Limbah B3" {{ old('jenis_usaha') == 'Jasa Pengelolaan Limbah B3' ? 'selected' : '' }}>Jasa Pengelolaan Limbah B3</option>
                    <option value="Manufaktur" {{ old('jenis_usaha') == 'Manufaktur' ? 'selected' : '' }}>Manufaktur</option>
                    <option value="Pertambangan Energi dan Migas" {{ old('jenis_usaha') == 'Pertambangan Energi dan Migas' ? 'selected' : '' }}>Pertambangan Energi dan Migas</option>
                    <option value="Prasarana" {{ old('jenis_usaha') == 'Prasarana' ? 'selected' : '' }}>Prasarana</option>
                </select>
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
                <label for="file_pdf" class="form-label">Upload Berita Acara Pengawasan</label>
                <input type="file" class="form-control" id="file_pdf" name="file_pdf" required>
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
