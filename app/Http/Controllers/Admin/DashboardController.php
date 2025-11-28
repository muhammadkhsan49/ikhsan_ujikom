<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\SelectionSchedule;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        $totalRegistrations = Registration::count();
        $pendingVerification = Registration::where('status', 'submitted')->count();
        $verifiedRegistrations = Registration::where('status', 'verified')->count();
        $rejectedRegistrations = Registration::where('status', 'rejected')->count();
        
        $recentRegistrations = Registration::latest()->limit(10)->get();
        $recentNotifications = Notification::latest()->limit(5)->get();
        
        $chartData = $this->getChartData();
        
        return view('admin.dashboard', compact(
            'totalRegistrations',
            'pendingVerification',
            'verifiedRegistrations',
            'rejectedRegistrations',
            'recentRegistrations',
            'recentNotifications',
            'chartData'
        ));
    }

    /**
     * Get chart data for dashboard
     */
    private function getChartData()
    {
        $statusData = Registration::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $monthlyData = Registration::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('total', 'month');

        return [
            'status' => $statusData,
            'monthly' => $monthlyData,
        ];
    }
}
