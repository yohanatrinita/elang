@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container mt-4">
    <div class="card p-4 mb-4 shadow-sm">
        <h2 class="fw-bold mb-3 dashboard-title text-center"> Dashboard - Tahun {{ $selectedYear }}</h2>

        <form method="GET" class="year-form mb-3">
            <label for="year" class="form-label"><i class="fa-solid fa-calendar-days"></i> Pilih Tahun:</label>
            <select name="year" id="year" class="form-select w-auto d-inline-block" onchange="this.form.submit()">
                @foreach ($availableYears as $year)
                    <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Summary Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center bg-gradient-primary text-black">
                <h6><i class="fa-solid fa-box-archive me-2"></i>Total Arsip</h6>
                <h2>{{ $totalYearly }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-1 text-center bg-gradient-success text-black">
                <h6><i class="fa-solid fa-star me-2"></i>Top Kategori</h6>
                <small>{{ $topCategory }}</small>
                <h2>{{ $topCategoryCount }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center bg-gradient-warning text-black">
                <h6><i class="fa-solid fa-triangle-exclamation me-2"></i>Dokumen Hilang</h6>
                <h2>{{ $missingDocCount }}</h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm p-3 text-center bg-gradient-info text-black">
                <h6><i class="fa-solid fa-cloud-arrow-down me-2"></i>Hari Ini</h6>
                <h2>{{ $todayCount }}</h2>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card p-3 shadow-sm">
                <h5 class="chart-title mb-3"><i class="fa-solid fa-chart-line me-2"></i> Pengawasan Bulanan</h5>
                <canvas id="monthlyChart" style="height: 300px;"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3 shadow-sm" style="height: 400px;">
                <h5 class="chart-title mb-3"><i class="fa-solid fa-folder-open me-2"></i> Kategori Dokumen</h5>
                <canvas id="categoryChart" width="250" height="250"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Uploads -->
    <div class="card p-4 shadow-sm mb-4">
        <h5 class="table-title mb-3"><i class="fa-solid fa-clock me-2"></i>Terakhir Diupload</h5>
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Nama Dokumen</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Diupload Oleh</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentUploads->sortByDesc('created_at') as $doc)
                        <tr>
                            <td>{{ $doc->dokumen_lingkungan }}</td>
                            <td>{{ $doc->created_at->format('d-m-Y') }}</td>
                            <td>{{ $doc->created_at->timezone('Asia/Jakarta')->format('H:i') }}</td>
                            <td>{{ $doc->uploader->name ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const monthlyUploads = {!! json_encode(array_values($monthlyUploads->toArray())) !!};
    const categoryCounts = {!! json_encode($categoryCounts->toArray()) !!};

    const categoryLabels = Object.keys(categoryCounts);
    const categoryValues = Object.values(categoryCounts);
    const categoryColors = ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6c757d'];

    new Chart(document.getElementById('monthlyChart'), {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: 'banyak dokumen',
                data: monthlyUploads,
                backgroundColor: 'rgba(242, 16, 242, 0.7)'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        stepSize: 1
                    }
                }
            }
        }
    });

    new Chart(document.getElementById('categoryChart'), {
        type: 'pie',
        data: {
            labels: categoryLabels,
            datasets: [{
                data: categoryValues,
                backgroundColor: categoryColors
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });
</script>
@endsection
