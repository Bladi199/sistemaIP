<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MovementsExport implements FromCollection, WithHeadings
{
    protected $movements;

    public function __construct(Collection $movements)
    {
        $this->movements = $movements;
    }

    public function collection()
    {
        return $this->movements->map(function ($m) {
            return [
                $m->created_at->format('d/m/Y H:i'),
                $m->product->name ?? '-',
                $m->user->name ?? '-',
                $m->movementType->name ?? '-',
                $m->movementReason->name ?? '-',
                $m->quantity,
                $m->notes ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Fecha',
            'Producto',
            'Usuario',
            'Tipo',
            'Motivo',
            'Cantidad',
            'Notas',
        ];
    }
}
