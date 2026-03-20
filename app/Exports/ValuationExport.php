<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ValuationExport implements FromCollection
{
    protected $products;
    protected $totalGeneral;

    public function __construct(Collection $products, $totalGeneral)
    {
        $this->products = $products;
        $this->totalGeneral = $totalGeneral;
    }

    public function collection()
    {
        $rows = collect();

        $rows->push(['REPORTE DE VALORIZACIÓN']);
        $rows->push([]);

        $rows->push([
            'Producto',
            'Stock',
            'Precio',
            'Total'
        ]);

        foreach ($this->products as $p) {
            $rows->push([
                $p->name,
                $p->stock_actual,
                number_format($p->precio_unitario, 2),
                number_format($p->total, 2),
            ]);
        }

        $rows->push([]);
        $rows->push([
            'TOTAL GENERAL',
            '',
            '',
            number_format($this->totalGeneral, 2),
        ]);

        return $rows;
    }
}