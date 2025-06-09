@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Rekap Laporan Semester</h2>
    <a href="{{ route('rekap.semester.create') }}" class="btn btn-primary mb-3">+ Tambah Laporan</a>

    @foreach ($companies as $company)
        <div class="card mb-4">
            <div class="card-header">
                <strong>{{ $company->nama_perusahaan }}</strong>
            </div>
            <div class="card-body table-responsive">
                <p><strong>Alamat:</strong> {{ $company->alamat }}</p>
                <p><strong>Penanggung Jawab:</strong> {{ $company->penanggung_jawab }}</p>
                <p><strong>Jenis Usaha:</strong> {{ $company->jenis_usaha }}</p>

                @php
                    $years = $company->semesterReports->pluck('tahun')->unique()->sort()->values();
                @endphp

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Semester</th>
                            @foreach ($years as $year)
                                <th>{{ $year }} - I</th>
                                <th>{{ $year }} - II</th>
                            @endforeach
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Laporan</td>
                            @foreach ($years as $year)
                                @php
                                    $smt1 = $company->semesterReports->where('tahun', $year)->where('semester', 'I')->first();
                                    $smt2 = $company->semesterReports->where('tahun', $year)->where('semester', 'II')->first();
                                @endphp
                                <td>
                                    @if($smt1)
                                        <span class="badge bg-success">Ada</span>
                                    @else
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if($smt2)
                                        <span class="badge bg-success">Ada</span>
                                    @else
                                        <span class="badge bg-secondary">-</span>
                                    @endif
                                </td>
                            @endforeach
                            <td>
                                {{ $company->semesterReports->last()->catatan ?? '-' }}
                            </td>
                            <td>
                                <a href="{{ route('rekap.semester.edit', $company->semesterReports->last()->id ?? 0) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('rekap.semester.destroy', $company->semesterReports->last()->id ?? 0) }}" method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
</div>
@endsection
