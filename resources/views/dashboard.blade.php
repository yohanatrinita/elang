@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container mt-4">
    <h2 class="title">Document Dashboard</h2>

    <!-- Grafik Upload Per Bulan -->
    <div class="card">
        <h3>Monthly Uploads</h3>
        <canvas id="monthlyChart"></canvas>
    </div>

    <!-- History Upload -->
    <div class="card">
        <h3>Recent Uploads</h3>
        <table class="history-table">
            <thead>
                <tr>
                    <th>Document Name</th>
                    <th>Uploaded Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentUploads as $doc)
                    <tr>
                        <td>{{ $doc->name }}</td>
                        <td>{{ $doc->created_at->format('d-m-Y') }}</td>
                        <td>{{ $doc->created_at->format('H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Grafik Kategori Dokumen -->
    <div class="card">
        <h3>Document Categories</h3>
        <canvas id="categoryChart"></canvas>
    </div>
</div>

<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection

<script>
    const monthlyUploads = @json($monthlyUploads);
    const categoryCounts = @json($categoryCounts);
</script>

