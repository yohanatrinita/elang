@extends('layouts.app')

@section('content')
<section class="py-5 bg-white">
    <div class="container">
        <h3 class="fw-bold mb-4">Edit Arsip</h3>

        <form action="{{ route('arsip.update', $arsip->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

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

            <!-- Alamat -->
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $arsip->alamat) }}" required>
            </div>

            <!-- Jenis Usaha -->
            <div class="mb-3">
                <label for="jenis_usaha" class="form-label">Jenis Usaha/Kegiatan</label>
                <input type="text" class="form-control" id="jenis_usaha" name="jenis_usaha" value="{{ old('jenis_usaha', $arsip->jenis_usaha) }}" required>
            </div>

            <!-- Jenis Dokumen -->
            <div class="mb-3">
                <label for="jenis_dokumen_lingkungan" class="form-label">Jenis Dokumen Lingkungan</label>
                <select class="form-select" id="jenis_dokumen_lingkungan" name="jenis_dokumen_lingkungan" required>
                    <option value="">-- Pilih Jenis Dokumen --</option>
                    @foreach(['Amdal', 'UKL-UPL', 'DELH', 'DPLH', 'Tidak Ada'] as $jenis)
                        <option value="{{ $jenis }}" {{ old('jenis_dokumen_lingkungan', $arsip->jenis_dokumen_lingkungan) == $jenis ? 'selected' : '' }}>
                            {{ $jenis }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Dokumen Lingkungan -->
            <div class="mb-3">
                <label for="dokumen_lingkungan" class="form-label">Dokumen Lingkungan</label>
                <input type="text" class="form-control" id="dokumen_lingkungan" name="dokumen_lingkungan" value="{{ old('dokumen_lingkungan', $arsip->dokumen_lingkungan) }}" required>
            </div>

            <!-- PPA -->
            <div class="mb-3">
                <label for="ppa" class="form-label">PPA</label>
                <textarea class="form-control numbered" id="ppa" name="ppa" rows="3">{{ old('ppa', $arsip->ppa) }}</textarea>
            </div>

            <!-- PPU -->
            <div class="mb-3">
                <label for="ppu" class="form-label">PPU</label>
                <textarea class="form-control numbered" id="ppu" name="ppu" rows="3">{{ old('ppu', $arsip->ppu) }}</textarea>
            </div>

            <!-- PLB3 -->
            <div class="mb-3">
                <label for="plb3" class="form-label">PLB3</label>
                <textarea class="form-control numbered" id="plb3" name="plb3" rows="3">{{ old('plb3', $arsip->plb3) }}</textarea>
            </div>

            <!-- Tindak Lanjut -->
            <div class="mb-3">
                <label for="tindak_lanjut" class="form-label">Tindak Lanjut</label>
                <textarea class="form-control numbered" id="tindak_lanjut" name="tindak_lanjut" rows="3">{{ old('tindak_lanjut', $arsip->tindak_lanjut) }}</textarea>
            </div>

            <!-- Rekomendasi -->
            <div class="mb-3">
                <label for="rekomendasi" class="form-label">Rekomendasi</label>
                <textarea class="form-control numbered" id="rekomendasi" name="rekomendasi" rows="3">{{ old('rekomendasi', $arsip->rekomendasi) }}</textarea>
            </div>

            <!-- Preview File Lama -->
            @if ($arsip->file_pdf_path)
                <div class="mb-3">
                    <label class="form-label">Preview File Lama</label>
                    <iframe src="{{ asset('storage/' . $arsip->file_pdf_path) }}" style="width:100%; height:400px; border:1px solid #ccc;"></iframe>
                </div>
            @endif

            <!-- Upload File Baru -->
            <div class="mb-3">
                <label for="file_pdf" class="form-label">Upload Berita Acara Pengawasan (Opsional)</label>
                <input type="file" class="form-control" id="file_pdf" name="file_pdf" accept="application/pdf" onchange="previewPdf(this)">
                <iframe id="pdf_preview" class="mt-3" style="width: 100%; height: 400px; display: none;"></iframe>
            </div>

            <!-- Tombol Simpan dan Batal -->
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('arsip') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</section>

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
