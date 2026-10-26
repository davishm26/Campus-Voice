<?php

namespace App\Http\Controllers;

use App\ReportStatus;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the authenticated user's dashboard.
     */
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        $statusCounts = $user->reports()
            ->selectRaw('status, count(*) as aggregate')
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        return view('dashboard', [
            'totalReports' => $statusCounts->sum(),
            'inProgressReports' => (int) $statusCounts->get(ReportStatus::InProgress->value, 0),
            'completedReports' => (int) $statusCounts->get(ReportStatus::Completed->value, 0),
            'latestReports' => $user->reports()->latest()->latest('id')->limit(3)->get(),
        ]);
    }
}
