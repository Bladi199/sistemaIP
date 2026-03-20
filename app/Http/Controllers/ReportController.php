<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportService;

class ReportController extends Controller
{
    protected ReportService $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    // Vista principal (imagen 1)
    public function index(Request $request)
    {
        $period = $request->get('period', 'month');

        $data = $this->reportService->getDashboardData($period);

        return view('reports.index', compact('data', 'period'));
    }

    // Generación de reportes (imagen 2)
    public function generate(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'period' => 'required',
            'format' => 'required',
        ]);

        return $this->reportService->generateReport(
            $request->type,
            $request->period,
            $request->format
        );
    }
}
