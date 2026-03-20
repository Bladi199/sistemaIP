<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class KardexExport implements FromCollection
{
    protected $products;

    public function __construct(Collection $products)
    {
        $this->products = $products;
    }

    public function collection()
    {
        $rows = collect();

        $rows->push(['KARDEX POR PRODUCTO']);
        $rows->push(['Fecha:', now()->format('d/m/Y')]);
        $rows->push([]);

        foreach ($this->products as $p) {

            // Título del producto
            $rows->push([$p->name . ' (' . $p->code . ')']);
            $rows->push(['Fecha', 'Tipo', 'Razón', 'Cantidad', 'Usuario']);

            foreach ($p->movements as $m) {
                $rows->push([
                    $m->created_at->format('d/m/Y'),
                    $m->movementType->name ?? '',
                    $m->movementReason->name ?? '',
                    $m->quantity,
                    $m->user->name ?? '',
                ]);
            }

            // Línea vacía entre productos
            $rows->push([]);
        }

        return $rows;
    }
}
