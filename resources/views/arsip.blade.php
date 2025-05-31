@extends('layouts.app')

@section('content')
<section class="py-5 bg-light">
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h3 class="fw-bold mb-4">Arsip</h3>

        <form method="GET" class="row g-3 mb-4 align-items-end">
            <div class="col-md-6">
                <label class="form-label">Cari Data</label>
                <input type="text" name="cari" class="form-control" placeholder="Cari Data..." value="{{ request('cari') }}">
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

        <div class="table-responsive">
            <table class="table table-bordered align-middle text-sm">
                <thead class="text-center align-middle">
                    <tr>
                        <th rowspan="2">No.</th>
                        <th rowspan="2">Pelaku Usaha</th>
                        <th rowspan="2">Jenis Usaha/Kegiatan</th>
                        <th rowspan="2">Tanggal Pengawasan</th>
                        <th colspan="4">Hasil Pemeriksaan Lapangan</th>
                        <th rowspan="2">Rekomendasi</th>
                        <th rowspan="2">Tindak Lanjut</th>
                        <th rowspan="2">Download BA</th>
                        @if(auth()->user()->isAdmin())
                            <th rowspan="2">Diunggah oleh</th>
                        @endif
                        <th colspan="2">Aksi</th>
                    </tr>
                    <tr>
                        <th>Dokumen Lingkungan</th>
                        <th>PPA</th>
                        <th>PPU</th>
                        <th>PLB3</th>
                        <th>Edit</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($arsip as $item)
                        <tr>
                            <td class="align-top text-center">{{ $loop->iteration }}</td>
                            <td class="align-top">{{ $item->pelaku_usaha }}</td>
                            <td class="align-top">{{ $item->jenis_usaha }}</td>
                            <td class="align-top">{{ $item->tanggal_pengawasan }}</td>
                            <td class="align-top">{{ $item->dokumen_lingkungan }}</td>
                            <td class="align-top">{!! nl2br(e($item->ppa)) !!}</td>
                            <td class="align-top">{!! nl2br(e($item->ppu)) !!}</td>
                            <td class="align-top">{!! nl2br(e($item->plb3)) !!}</td>
                            <td class="align-top">{!! nl2br(e($item->rekomendasi)) !!}</td>
                            <td class="align-top">{!! nl2br(e($item->tindak_lanjut)) !!}</td>
                            <td class="text-center align-top">
                                @if ($item->file_pdf_path)
                                    <a href="{{ asset('storage/' . $item->file_pdf_path) }}" class="btn btn-outline-secondary btn-sm" target="_blank" title="Lihat dan Unduh BA">
                                        <i class="fas fa-download"></i>
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            @if(auth()->user()->isAdmin())
                                <td class="align-top">
                                    {{ $item->uploader->name ?? 'Tidak diketahui' }}
                                </td>
                            @endif
                            <td class="text-center align-top">
                                <a href="{{ route('arsip.edit', $item->id) }}" class="btn btn-outline-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            <td class="text-center align-top">
                                <form action="{{ route('arsip.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="d-inline-block m-0 p-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="14" class="text-center">Tidak ada data arsip ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $arsip->withQueryString()->links() }}
        </div>
    </div>
</section>
@endsection
