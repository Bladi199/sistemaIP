<?php

namespace App\Observers;

use App\Models\Product;
use App\Services\AlertService;

class ProductObserver
{
    protected AlertService $alertService;

    public function __construct(AlertService $alertService)
    {
        $this->alertService = $alertService;
    }

    /**
     * Se ejecuta DESPUÉS de actualizar un producto
     */
    public function updated(Product $product): void
    {
        // Solo evaluar si cambió el stock
        if ($product->wasChanged('stock_actual')) {
            $this->alertService->evaluateProductStock($product);
        }
    }
}
