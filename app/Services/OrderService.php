<?php

namespace App\Services;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderService
{
    public function generatePdf($orderId)
    {
        $order = Order::with(['customer', 'user', 'details.product'])
            ->findOrFail($orderId);

        $pdf = Pdf::loadView('orders.pdf.invoice', compact('order'));

        return $pdf->stream("pedido_{$order->id}.pdf");
    }
}