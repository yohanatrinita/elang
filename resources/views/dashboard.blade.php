@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container mt-4">
    <h2 class="text-center mb-4">Dashboard - Year {{ $selectedYear }}</h2>

    <form method="GET" class="mb-4 d-flex align-items-center gap-2">
        <label for="year">Select Year:</label>
        <select name="year" id="year" class="form-select w-auto" onchange="this.form.submit()">
            @foreach ($availableYears as $year)
                <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>{{ $year }}</option>
            @endforeach
        </select>
    </form>

    <!-- Summary -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-bg-primary">
                <div class="card-body text-center">
                    <h5>Total Documents</h5>
                    <h3>{{ $totalYearly }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success">
                <div class="card-body text-center">
                    <h5>Top Category: {{ $topCategory }}</h5>
                    <h3>{{ $topCategoryCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-warning">
                <div class="card-body text-center">
                    <h5>Missing Documents</h5>
                    <h3>{{ $missingDocCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-info">
                <div class="card-body text-center">
                    <h5>Uploaded Today</h5>
                    <h3>{{ $todayCount }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="row">
        <!-- Supervisions by Month -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">Supervisions by Month</div>
                <div class="card-body">
                    <canvas id="monthlyChart" height="220"></canvas>
                </div>
            </div>
        </div>

        <!-- Document Categories -->
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">Document Categories</div>
                <div class="card-body">
                    <canvas id="categoryChart" height="220"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Uploads -->
    <div class="card">
        <div class="card-header">Recent Uploads</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Document Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Uploaded</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recentUploads as $doc)
                        <tr>
                            <td>{{ $doc->dokumen_lingkungan }}</td>
                            <td>{{ $doc->created_at->format('d-m-Y') }}</td>
                            <td>{{ $doc->created_at->format('h:i A') }}</td>
                            <td><span class="badge bg-secondary">{{ $doc->created_at->diffForHumans() }}</span></td>
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

    // Bar Chart - Supervisions by Month
    new Chart(document.getElementById('monthlyChart'), {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: 'Supervisions',
                data: monthlyUploads,
                backgroundColor: 'rgba(54, 162, 235, 0.7)'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // Pie Chart - Document Categories
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
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endsection
