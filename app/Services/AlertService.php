<?php

namespace App\Services;
use App\Models\Product;
use App\Models\Alert;

class AlertService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function evaluateProductStock(Product $product): void
    {
        // 🔴 STOCK AGOTADO
        if ($product->stock_actual == 0) {
            $this->createOrUpdateAlert(
                $product,
                'agotado',
                'alta',
                'El producto se ha agotado completamente. Se requiere reabastecimiento urgente.'
            );
            return;
        }

        // 🔴 STOCK CRÍTICO
        if ($product->stock_actual <= ($product->stock_minimo * 0.5)) {
            $this->createOrUpdateAlert(
                $product,
                'critico',
                'alta',
                'El producto está por debajo del 50% del stock mínimo requerido.'
            );
            return;
        }

        // 🟠 STOCK BAJO
        if ($product->stock_actual <= $product->stock_minimo) {
            $this->createOrUpdateAlert(
                $product,
                'bajo',
                'media',
                'El producto ha alcanzado el nivel mínimo de stock.'
            );
            return;
        }

        // 🟢 STOCK NORMAL → cerrar alertas
        $this->resolveActiveAlerts($product);
    }

    private function createOrUpdateAlert(
        Product $product,
        string $type,
        string $severity,
        string $message
    ): void {
        Alert::updateOrCreate(
            [
                'product_id' => $product->id,
                'status' => 'activa'
            ],
            [
                'type' => $type,
                'severity' => $severity,
                'message' => $message
            ]
        );
    }

    private function resolveActiveAlerts(Product $product): void
    {
        Alert::where('product_id', $product->id)
            ->where('status', 'activa')
            ->update([
                'status' => 'resuelta',
                'resolved_at' => now()
            ]);
    }
}
