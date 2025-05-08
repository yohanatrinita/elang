<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dashboard;

class DashboardController extends Controller
{
    public function index()
    {
        $monthlyUploads = Dashboard::selectRaw('MONTH(uploaded_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->get();

        $recentUploads = Dashboard::latest()->limit(5)->get();

        $categoryCounts = Dashboard::selectRaw('category, COUNT(*) as count')
            ->groupBy('category')
            ->get();

        return view('dashboard', compact('monthlyUploads', 'recentUploads', 'categoryCounts'));
    }
}
