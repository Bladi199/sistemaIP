<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    ) {}

    public function index(Request $request)
    {
        $period = $request->get('period', 'week');

        $data = $this->dashboardService->getData($period);

        return view('dashboard.index', [
            'data' => $data,
            'period' => $period
        ]);
    }
}
