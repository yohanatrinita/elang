<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arsip;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $selectedYear = $request->get('year', now()->year);

        // Get available years based on tanggal_pengawasan
        $availableYears = Arsip::selectRaw('YEAR(tanggal_pengawasan) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // Monthly Supervision by tanggal_pengawasan
        $monthlyCounts = Arsip::selectRaw('MONTH(tanggal_pengawasan) as month, COUNT(*) as count')
            ->whereYear('tanggal_pengawasan', $selectedYear)
            ->groupBy('month')
            ->pluck('count', 'month');

        $monthlyUploads = collect(range(1, 12))->mapWithKeys(function ($month) use ($monthlyCounts) {
            return [$month => $monthlyCounts[$month] ?? 0];
        });

        // Recent uploads including uploader info
        $recentUploads = Arsip::with('uploader')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Document categories pie chart
        $defaultCategories = ['Amdal', 'UKL-UPL', 'DELH', 'DPLH', 'Tidak Ada'];
        $categoryRaw = Arsip::select('jenis_dokumen_lingkungan', DB::raw('COUNT(*) as count'))
            ->whereYear('tanggal_pengawasan', $selectedYear)
            ->groupBy('jenis_dokumen_lingkungan')
            ->pluck('count', 'jenis_dokumen_lingkungan');

        $categoryCounts = collect();
        foreach ($defaultCategories as $kategori) {
            $categoryCounts[$kategori] = $categoryRaw[$kategori] ?? 0;
        }

        // Total arsip tahun ini berdasarkan tanggal_pengawasan
        $totalYearly = Arsip::whereYear('tanggal_pengawasan', $selectedYear)->count();

        // Kategori terbanyak
        $topCategory = $categoryCounts->sortDesc()->keys()->first();
        $topCategoryCount = $categoryCounts[$topCategory];

        // Trend tahunan
        $yearlyTrend = Arsip::selectRaw('YEAR(tanggal_pengawasan) as year, COUNT(*) as count')
            ->groupBy('year')
            ->orderBy('year')
            ->pluck('count', 'year');

        // Dokumen yang tidak memiliki kategori lengkap
        $missingDocCount = Arsip::where('jenis_dokumen_lingkungan', 'Tidak Ada')->count();

        // Dokumen yang diunggah hari ini (berdasarkan tanggal_pengawasan == hari ini)
        $todayDate = Carbon::now('Asia/Jakarta')->toDateString();

        $todayCount = Arsip::whereDate('created_at', $todayDate)->count();


        return view('dashboard', compact(
            'monthlyUploads',
            'categoryCounts',
            'yearlyTrend',
            'recentUploads',
            'selectedYear',
            'availableYears',
            'totalYearly',
            'topCategory',
            'topCategoryCount',
            'missingDocCount',
            'todayCount'
        ));
    }
}
