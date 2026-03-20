<?php

namespace App\Observers;

use App\Models\Movement;
use App\Services\AlertService;

class MovementObserver
{
    /**
     * Handle the Movement "created" event.
     * 
     */
    protected AlertService $alertService;
    public function __construct(AlertService $alertService)
    {
        $this->alertService = $alertService;
    }
    public function created(Movement $movement): void
    {
        // Re-evaluar stock del producto
        $product = $movement->product;

        $this->alertService->evaluateProductStock($product);
    }

    /**
     * Handle the Movement "updated" event.
     */
    public function updated(Movement $movement): void
    {
        //
    }

    /**
     * Handle the Movement "deleted" event.
     */
    public function deleted(Movement $movement): void
    {
        //
    }

    /**
     * Handle the Movement "restored" event.
     */
    public function restored(Movement $movement): void
    {
        //
    }

    /**
     * Handle the Movement "force deleted" event.
     */
    public function forceDeleted(Movement $movement): void
    {
        //
    }
}
