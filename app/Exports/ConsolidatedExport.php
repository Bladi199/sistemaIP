<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ConsolidatedExport implements FromCollection
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        $rows = collect();

        // ===== KPIs =====
        $rows->push(['REPORTE CONSOLIDADO']);
        $rows->push(['Generado:', now()->format('d/m/Y H:i')]);
        $rows->push([]);

        $rows->push(['Total Valorizado', number_format($this->data['total_value'], 2)]);
        $rows->push(['Movimientos en periodo', $this->data['movements']]);
        $rows->push(['Alertas del periodo', $this->data['alerts']]);
        $rows->push([]);

        // ===== Bajo Stock =====
        $rows->push(['PRODUCTOS BAJO STOCK']);
        $rows->push(['Producto', 'Actual', 'Mínimo']);

        foreach ($this->data['low_stock'] as $p) {
            $rows->push([
                $p->name,
                $p->stock_actual,
                $p->stock_minimo,
            ]);
        }

        return $rows;
    }
}