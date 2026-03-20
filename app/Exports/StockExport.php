<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StockExport implements FromCollection, WithHeadings
{
    protected $products;

    public function __construct(Collection $products)
    {
        $this->products = $products;
    }

    public function collection()
    {
        return $this->products->map(function ($p) {

            $total = $p->stock_actual * $p->precio_unitario;

            return [
                $p->code,
                $p->name,
                $p->category->name ?? '-',
                $p->stock_actual,
                number_format($p->precio_unitario, 2),
                number_format($total, 2),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Código',
            'Producto',
            'Categoría',
            'Stock',
            'Precio',
            'Total',
        ];
    }
}