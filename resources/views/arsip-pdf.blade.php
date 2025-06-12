@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@section('body-class', 'dashboard-body')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

<div class="container py-4">

    <!-- Card Judul -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <h4 class="fw-bold mb-0">Rekapitulasi Data Pengawasan</h4>
        </div>
    </div>

    <!-- Card Filter -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('arsip.pdf') }}" class="d-flex flex-wrap align-items-end gap-3">
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
                <div class="ms-auto d-flex gap-2 flex-wrap">
                    <div>
                        <label class="form-label d-block invisible">PDF</label>
                        <a href="{{ route('arsip.rekap.download', ['from' => request('from'), 'to' => request('to')]) }}" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                    </div>
                    <div>
                        <label class="form-label d-block invisible">Excel</label>
                        <a href="{{ route('arsip.rekap.excel', ['from' => request('from'), 'to' => request('to')]) }}" class="btn btn-success">
                            <i class="fas fa-file-excel"></i> Excel
                        </a>
                    </div>
                </div>
                @endif
            </form>
        </div>
    </div>

    @if(isset($judul))
        <div class="mb-2">
            <p class="fw-semibold">{{ $judul }}</p>
        </div>
    @endif

    <!-- Tabel -->
    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle text-sm w-100" style="min-width: 1100px;">
                <thead class="table-light text-center align-middle">
                    <tr>
                        <th rowspan="2" style="width: 40px;">No.</th>
                        <th rowspan="2">Pelaku Usaha</th>
                        <th rowspan="2">Jenis Usaha/Kegiatan</th>
                        <th rowspan="2">Alamat Lengkap</th>
                        <th rowspan="2">Tanggal Pengawasan</th>
                        <th colspan="4">Hasil Pemeriksaan Lapangan</th>
                        <th style="min-width: 300px;" rowspan="2">Rekomendasi</th>
                        <th style="min-width: 300px;" rowspan="2">Tindak Lanjut</th>
                    </tr>
                    <tr>
                        <th>Dokumen Lingkungan</th>
                        <th style="min-width: 300px;">PPA</th>
                        <th style="min-width: 300px;">PPU</th>
                        <th style="min-width: 300px;">PLB3</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($arsips as $index => $arsip)
                        <tr>
                            <td class="text-center align-top">{{ $index + 1 }}</td>
                            <td class="align-top">{{ $arsip->pelaku_usaha }}</td>
                            <td class="align-top">{{ $arsip->jenis_usaha }}</td>
                            <td class="align-top">{{ $arsip->alamat }}</td>
                            <td class="align-top">{{ \Carbon\Carbon::parse($arsip->tanggal_pengawasan)->format('d-m-Y') }}</td>
                            <td class="align-top">{{ $arsip->dokumen_lingkungan }}</td>
                            <td style="white-space: pre-line; text-align: justify" class="align-top">{!! nl2br(e($arsip->ppa)) !!}</td>
                            <td style="white-space: pre-line;text-align: justify" class="align-top">{!! nl2br(e($arsip->ppu)) !!}</td>
                            <td style="white-space: pre-line;text-align: justify" class="align-top">{!! nl2br(e($arsip->plb3)) !!}</td>
                            <td style="white-space: pre-line;text-align: justify" class="align-top">{!! nl2br(e($arsip->rekomendasi)) !!}</td>
                            <td style="white-space: pre-line;text-align: justify" class="align-top">{!! nl2br(e($arsip->tindak_lanjut)) !!}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center">Tidak ada data untuk rentang tanggal yang dipilih.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
