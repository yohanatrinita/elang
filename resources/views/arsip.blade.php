@extends('layouts.app')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="fw-bold mb-4">Arsip</h3>

        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-3">
                <label for="bulan" class="form-label">Bulan</label>
                <select id="bulan" name="bulan" class="form-select">
                    <option value="">Semua Bulan</option>
                    @foreach (['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $b)
                        <option value="{{ $b }}" {{ request('bulan') == $b ? 'selected' : '' }}>{{ $b }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="tahun" class="form-label">Tahun</label>
                <input type="number" id="tahun" name="tahun" class="form-control" value="{{ request('tahun') }}" placeholder="Contoh: 2024">
            </div>

            <div class="col-md-3 align-self-end">
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>

        @if(count($arsip))
            <a href="{{ route('arsip.export', ['bulan' => request('bulan'), 'tahun' => request('tahun')]) }}"
               class="btn btn-danger mb-3" target="_blank"><i class="fa-solid fa-file-pdf"></i> Export PDF
            </a>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th rowspan="2">No.</th>
                        <th rowspan="2">Pelaku Usaha</th>
                        <th rowspan="2">Jenis Usaha/Kegiatan</th>
                        <th rowspan="2">Tanggal Pengawasan</th>
                        <th colspan="4">Hasil Pemeriksaan Lapangan</th>
                        <th rowspan="2">Rekomendasi</th>
                        <th rowspan="2">Tindak Lanjut</th>
                        <th rowspan="2">Download</th>
                    </tr>
                    <tr>
                        <th>Dokumen Lingkungan</th>
                        <th>PPA</th>
                        <th>PPU</th>
                        <th>PLB3</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($arsip as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $item['pelaku'] }}</td>
                            <td>{{ $item['jenis'] }}</td>
                            <td>{{ $item['tanggal'] }}</td>
                            <td>{!! nl2br(e($item['dokling'])) !!}</td>
                            <td>{!! nl2br(e($item['ppa'])) !!}</td>
                            <td>{!! nl2br(e($item['ppu'])) !!}</td>
                            <td>{!! nl2br(e($item['plb3'])) !!}</td>
                            <td>{!! nl2br(e($item['rekomendasi'])) !!}</td>
                            <td>{!! nl2br(e($item['tindak'])) !!}</td>
                            <td class="text-center">
                                @if(!empty($item['file']))
                                    <a href="{{ asset('storage/' . $item['file']) }}" class="btn btn-sm btn-primary" target="_blank">PDF</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center">Tidak ada data arsip untuk bulan dan tahun ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
