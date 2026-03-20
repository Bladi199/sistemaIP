<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    protected $users;

    public function __construct(Collection $users)
    {
        $this->users = $users;
    }

    public function collection()
    {
        $rows = collect();

        $rows->push(['REPORTE DE USUARIOS']);
        $rows->push(['Generado:', now()->format('d/m/Y H:i')]);
        $rows->push([]);

        $rows->push([
            'Usuario',
            'Email',
            'Movimientos',
            'Acciones Alertas'
        ]);

        foreach ($this->users as $u) {
            $rows->push([
                $u->name,
                $u->email,
                $u->movements_count,
                $u->alert_actions_count,
            ]);
        }

        return $rows;
    }
}