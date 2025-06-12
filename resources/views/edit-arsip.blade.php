@extends('layouts.app')

@section('content')
<section class="py-5 bg-white">
    <div class="container">
        <h3 class="fw-bold mb-4">Edit Arsip</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('arsip.update', $arsip->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Tanggal Pengawasan -->
            <div class="mb-3">
                <label for="tanggal_pengawasan" class="form-label">Tanggal Pengawasan</label>
                <input type="date" class="form-control" id="tanggal_pengawasan" name="tanggal_pengawasan" value="{{ old('tanggal_pengawasan', $arsip->tanggal_pengawasan) }}" required>
            </div>

            <!-- Pelaku Usaha -->
            <div class="mb-3">
                <label for="pelaku_usaha" class="form-label">Pelaku Usaha</label>
                <input type="text" class="form-control" id="pelaku_usaha" name="pelaku_usaha" value="{{ old('pelaku_usaha', $arsip->pelaku_usaha) }}" required>
            </div>

            <!-- Provinsi -->
            <div class="mb-3">
                <label class="form-label">Provinsi</label>
                <input type="text" class="form-control" value="Jawa Barat" readonly>
            </div>

            <!-- Kabupaten -->
            <div class="mb-3">
                <label class="form-label">Kabupaten</label>
                <input type="text" class="form-control" value="Bogor" readonly>
            </div>

            <!-- Kecamatan -->
            <div class="mb-3">
                <label class="form-label">Kecamatan</label>
                <select name="kecamatan_id" id="kecamatan_id" class="form-select" required>
                    <option value="">-- Pilih Kecamatan --</option>
                    @foreach ($kecamatans as $kecamatan)
                        <option value="{{ $kecamatan->id }}" {{ old('kecamatan_id', optional($arsip->desa)->kecamatan_id) == $kecamatan->id ? 'selected' : '' }}>
                            {{ $kecamatan->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Desa -->
            <div class="mb-3">
                <label class="form-label">Desa/Kelurahan</label>
                <select name="desa_id" id="desa_id" class="form-select" required>
                    <option value="">-- Pilih Desa/Kelurahan --</option>
                    {{-- Desa akan di-load via JS --}}
                </select>
            </div>

            <!-- Alamat -->
            <div class="mb-3">
                <label class="form-label">Alamat Lengkap</label>
                <input type="text" class="form-control" name="alamat" value="{{ old('alamat', $arsip->alamat) }}" required>
            </div>

            <!-- Jenis Usaha -->
            <div class="mb-3">
                <label class="form-label">Jenis Usaha/Kegiatan</label>
                <select name="jenis_usaha" class="form-select" required>
                    <option value="">-- Pilih Jenis Usaha/Kegiatan --</option>
                    @foreach(['Agroindustri', 'Fasilitas Pelayanan Kesehatan', 'Jasa Pengelolaan Limbah B3', 'Manufaktur', 'Pertambangan Energi dan Migas', 'Prasarana'] as $jenis)
                        <option value="{{ $jenis }}" {{ old('jenis_usaha', $arsip->jenis_usaha) == $jenis ? 'selected' : '' }}>{{ $jenis }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Jenis Dokumen -->
            <div class="mb-3">
                <label class="form-label">Jenis Dokumen Lingkungan</label>
                <select name="jenis_dokumen_lingkungan" class="form-select" required>
                    <option value="">-- Pilih Jenis Dokumen --</option>
                    @foreach(['Amdal', 'UKL-UPL', 'DELH', 'DPLH', 'Tidak Ada'] as $dok)
                        <option value="{{ $dok }}" {{ old('jenis_dokumen_lingkungan', $arsip->jenis_dokumen_lingkungan) == $dok ? 'selected' : '' }}>{{ $dok }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dokumen Lingkungan -->
            <div class="mb-3">
                <label class="form-label">Dokumen Lingkungan</label>
                <input type="text" class="form-control" name="dokumen_lingkungan" value="{{ old('dokumen_lingkungan', $arsip->dokumen_lingkungan) }}" required>
            </div>

            <!-- PPA - PPU - PLB3 - Rekomendasi - Tindak Lanjut -->
            @foreach (['ppa', 'ppu', 'plb3', 'tindak_lanjut', 'rekomendasi'] as $field)
                <div class="mb-3">
                    <label class="form-label text-uppercase">{{ strtoupper(str_replace('_', ' ', $field)) }}</label>
                    <textarea class="form-control numbered" name="{{ $field }}" rows="3">{{ old($field, $arsip->$field) }}</textarea>
                </div>
            @endforeach

            <!-- Preview file lama -->
            @if ($arsip->file_pdf_path)
                <div class="mb-3">
                    <label class="form-label">Preview File Lama</label>
                    <iframe src="{{ asset('storage/' . $arsip->file_pdf_path) }}" style="width:100%; height:400px; border:1px solid #ccc;"></iframe>
                </div>
            @endif

            <!-- Upload file baru -->
            <div class="mb-3">
                <label class="form-label">Upload Berita Acara (Opsional)</label>
                <input type="file" class="form-control" name="file_pdf" accept="application/pdf" onchange="previewPdf(this)">
                <iframe id="pdf_preview" class="mt-3" style="width: 100%; height: 400px; display: none;"></iframe>
            </div>

            <!-- Aksi -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('arsip') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</section>

{{-- SCRIPT --}}
<script>
    function previewPdf(input) {
        const file = input.files[0];
        const preview = document.getElementById('pdf_preview');
        if (file && file.type === 'application/pdf') {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
            preview.src = '';
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        const kecamatanSelect = document.getElementById('kecamatan_id');
        const desaSelect = document.getElementById('desa_id');
        const selectedKecamatan = "{{ optional($arsip->desa)->kecamatan_id }}";
        const selectedDesa = "{{ $arsip->desa_id }}";

        function loadDesa(kecamatanId, selected = null) {
            fetch(`/get-desa-by-kecamatan/${kecamatanId}`)
                .then(response => response.json())
                .then(data => {
                    desaSelect.innerHTML = '<option value="">-- Pilih Desa/Kelurahan --</option>';
                    data.forEach(desa => {
                        desaSelect.innerHTML += `<option value="${desa.id}" ${desa.id == selected ? 'selected' : ''}>${desa.nama}</option>`;
                    });
                });
        }

        if (selectedKecamatan) {
            loadDesa(selectedKecamatan, selectedDesa);
        }

        kecamatanSelect.addEventListener('change', function () {
            loadDesa(this.value);
        });
    });

    // Penomoran otomatis
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
