<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Alert;
use App\Models\AlertAction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AlertActionController extends Controller
{
    public function resolve(Alert $alert)
    {
        $alert->update([
            'status' => 'resuelta',
            'resolved_at' => Carbon::now()
        ]);

        AlertAction::create([
            'alert_id' => $alert->id,
            'user_id' => Auth::id(),
            'action' => 'resolver'
        ]);

        return back()->with('success', 'Alerta resuelta correctamente');
    }

    public function ignore(Alert $alert)
    {
        $alert->update([
            'status' => 'ignorada'
        ]);

        AlertAction::create([
            'alert_id' => $alert->id,
            'user_id' => Auth::id(),
            'action' => 'ignorar'
        ]);

        return back()->with('info', 'Alerta ignorada');
    }
}

