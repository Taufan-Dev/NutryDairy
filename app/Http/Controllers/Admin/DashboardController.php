<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Children;
use App\Models\Measurement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalChildren = Children::count();
        $totalMeasurements = Measurement::count();

        $recentMeasurements = Measurement::latest('created_at')->take(5)->get();

        return view('admin.dashboard.index', compact(
            'totalUsers',
            'totalChildren',
            'totalMeasurements',
            'recentMeasurements'
        ));
    }

    public function data(Request $request)
    {
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $months->push(Carbon::now()->subMonths($i)->format('Y-m'));
        }

        $labels = $months->map(fn($m) => Carbon::createFromFormat('Y-m', $m)->format('M Y'))->toArray();

        $measurementsQuery = Measurement::query();

        if ($request->filled('child_id') && $measurementsQuery) {
            $measurementsQuery->where('child_id', $request->child_id);
        }

        $data = [];
        if ($measurementsQuery) {
            $grouped = $measurementsQuery
                ->whereBetween('created_at', [Carbon::now()->subMonths(5)->startOfMonth(), Carbon::now()->endOfMonth()])
                ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as ym, AVG(weight_kg) as avg_weight")
                ->groupBy('ym')
                ->pluck('avg_weight','ym')
                ->toArray();
        } else {
            $grouped = [];
        }

        foreach ($months as $m) {
            $data[] = isset($grouped[$m]) ? round($grouped[$m], 2) : null;
        }

        return response()->json([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Rata-rata Berat (kg)',
                    'data' => $data,
                ]
            ],
        ]);
    }
}