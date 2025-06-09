@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-bold">Rekapitulasi Data Pengawasan</h3>

    <!-- Filter Form -->
    <form method="GET" action="{{ route('arsip.pdf') }}" class="d-flex align-items-end gap-2 mb-4">
        <div>
            <label for="from" class="form-label">Tanggal Awal</label>
            <input type="date" name="from" id="from" class="form-control" value="{{ request('from') }}">
        </div>
        <div>
            <label for="to" class="form-label">Tanggal Akhir</label>
            <input type="date" name="to" id="to" class="form-control" value="{{ request('to') }}">
        </div>
        <div>
            <label class="form-label d-block invisible">Cari</label>
            <button type="submit" class="btn btn-success" title="Cari">
                <i class="fas fa-search"></i>
            </button>
        </div>

        @if(request('from') && request('to') && $arsips->count())
        <div class="ms-auto d-flex gap-2">
            <div>
                <label class="form-label d-block invisible">Download PDF</label>
                <a href="{{ route('arsip.rekap.download', ['from' => request('from'), 'to' => request('to')]) }}" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> PDF
                </a>
            </div>
            <div>
                <label class="form-label d-block invisible">Download Excel</label>
                <a href="{{ route('arsip.rekap.excel', ['from' => request('from'), 'to' => request('to')]) }}" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Excel
                </a>
            </div>
        </div>
        @endif

    </form>

    <!-- Judul Rentang -->
    @if(isset($judul))
        <p class="fw-semibold">{{ $judul }}</p>
    @endif

    <!-- Tabel Rekap -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle text-sm">
            <thead class="table-light text-center align-middle">
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Pelaku Usaha</th>
                    <th rowspan="2">Jenis Usaha/Kegiatan</th>
                    <th rowspan="2">Tanggal Pengawasan</th>
                    <th colspan="4">Hasil Pemeriksaan Lapangan</th>
                    <th rowspan="2">Rekomendasi</th>
                    <th rowspan="2">Tindak Lanjut</th>
                </tr>
                <tr>
                    <th>Dokumen Lingkungan</th>
                    <th>PPA</th>
                    <th>PPU</th>
                    <th>PLB3</th>
                </tr>
            </thead>
            <tbody>
                @forelse($arsips as $index => $arsip)
                    <tr>
                        <td class="text-center align-top">{{ $index + 1 }}</td>
                        <td class="align-top">{{ $arsip->pelaku_usaha }}</td>
                        <td class="align-top">{{ $arsip->jenis_usaha }}</td>
                        <td class="align-top">{{ \Carbon\Carbon::parse($arsip->tanggal_pengawasan)->format('d-m-Y') }}</td>
                        <td class="align-top">{{ $arsip->dokumen_lingkungan }}</td>
                        <td class="align-top">{!! nl2br(e($arsip->ppa)) !!}</td>
                        <td class="align-top">{!! nl2br(e($arsip->ppu)) !!}</td>
                        <td class="align-top">{!! nl2br(e($arsip->plb3)) !!}</td>
                        <td class="align-top">{!! nl2br(e($arsip->rekomendasi)) !!}</td>
                        <td class="align-top">{!! nl2br(e($arsip->tindak_lanjut)) !!}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Tidak ada data untuk rentang tanggal yang dipilih.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
