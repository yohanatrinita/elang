@if (!Auth::check())
    <script>window.location.href = "{{ route('login') }}";</script>
    @php exit; @endphp
@endif


@extends('layouts.app')

@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="fw-bold mb-4">Arsip</h3>

        <form method="GET" class="row g-3 mb-4 align-items-end">
            <div class="col-md-3">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Cari Pelaku Usaha</label>
                <input type="text" name="cari" class="form-control" placeholder="Masukkan nama pelaku" value="{{ request('cari') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label d-block invisible">Aksi</label>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success btn-sm w-100">
                        <i class="fas fa-search"></i> Cari
                    </button>
                    <a href="{{ route('arsip.create') }}" class="btn btn-primary btn-sm w-100">
                        <i class="fas fa-plus"></i> Tambah
                    </a>
                </div>
            </div>
        </form>

        @if(count($arsip))
            <div class="mb-3">
                <a href="{{ route('arsip.export', [
                    'tanggal_awal' => request('tanggal_awal'),
                    'tanggal_akhir' => request('tanggal_akhir'),
                    'cari' => request('cari')
                ]) }}" class="btn btn-danger btn-sm" target="_blank">
                    <i class="fas fa-file-pdf"></i> Download PDF
                </a>
            </div>
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
                        <th rowspan="2">Aksi</th>
                    </tr>
                    <tr>
                        <th>Dokumen Lingkungan</th>
                        <th>PPA</th>
                        <th>PPU</th>
                        <th>PLB3</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $filtered = collect($arsip);
                        if (request('tanggal_awal')) {
                            $filtered = $filtered->filter(fn($item) => $item['tanggal'] >= request('tanggal_awal'));
                        }
                        if (request('tanggal_akhir')) {
                            $filtered = $filtered->filter(fn($item) => $item['tanggal'] <= request('tanggal_akhir'));
                        }
                        if (request('cari')) {
                            $filtered = $filtered->filter(fn($item) => str_contains(strtolower($item['pelaku']), strtolower(request('cari'))));
                        }
                    @endphp

                    @forelse ($filtered as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $item['pelaku_usaha'] }}</td>
                            <td>{{ $item['jenis_usaha'] }}</td>
                            <td>{{ $item['tanggal_pengawasan'] }}</td>
                            <td>{{ $item['dokumen_lingkungan'] }}</td>
                            <td>{{ $item['ppa'] }}</td>
                            <td>{{ $item['ppu'] }}</td>
                            <td>{{ $item['plb3'] }}</td>
                            <td>{{ $item['rekomendasi'] }}</td>
                            <td>{{ $item['tindak_lanjut'] }}</td>
                            <td class="text-center">
                                @if (!empty($item['file_pdf']))
                                    <a href="{{ asset('storage/' . $item['file_pdf']) }}" target="_blank" class="btn btn-sm btn-primary">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('arsip.edit', $index) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('arsip.destroy', $index) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center">Tidak ada data arsip ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
