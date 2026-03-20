<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AlertsExport implements FromCollection, WithHeadings
{
    protected $alerts;

    public function __construct(Collection $alerts)
    {
        $this->alerts = $alerts;
    }

    public function collection()
    {
        return $this->alerts->map(function ($a) {

            // Convertimos las acciones en un solo string
            $acciones = $a->actions->map(function ($ac) {
                return $ac->action . ' por ' . ($ac->user->name ?? '');
            })->implode(' | ');

            return [
                $a->created_at->format('d/m/Y'),
                $a->product->name ?? '-',
                $a->type,
                $a->severity,
                $a->message,
                $a->status,
                $acciones ?: '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Fecha',
            'Producto',
            'Tipo',
            'Severidad',
            'Mensaje',
            'Estado',
            'Acciones',
        ];
    }
}