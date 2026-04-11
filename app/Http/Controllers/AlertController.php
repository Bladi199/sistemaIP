<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Alert;
use Carbon\Carbon;
use App\Models\Order;

class AlertController extends Controller
{
    public function index()
    {
        $criticalCount = Alert::where('type', 'critico')
            ->where('status', 'activa')
            ->count();

        $warningCount = Alert::where('type', 'bajo')
            ->where('status', 'activa')
            ->count();

        $resolvedLast7Days = Alert::where('status', 'resuelta')
            ->where('resolved_at', '>=', Carbon::now()->subDays(7))
            ->count();

        $activeAlerts = Alert::with('product')
            ->where('status', 'activa')
            ->orderBy('severity', 'desc')
            ->get();

        $resolvedAlerts = Alert::with('product')
            ->where('status', 'resuelta')
            ->latest('resolved_at')
            ->limit(5)
            ->get();
            // ==========================
        // PEDIDOS PENDIENTES (NUEVO)
        // ==========================
        $pendingOrders = Order::with('customer')
            ->where('estado', 'pendiente')
            ->latest()
            ->get();

        

        return view('alerts.index', compact(
            'criticalCount',
            'warningCount',
            'resolvedLast7Days',
            'activeAlerts',
            'resolvedAlerts',
            'pendingOrders' // 🔥 NUEVO
        ));

    }
}

