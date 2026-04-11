<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderDetail;
use App\Models\Movement;
use App\Models\MovementReason;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\OrderService;
use App\Enums\MovementTypeEnum;

class OrderController extends Controller
{
    // ==========================
    // LISTA DE PEDIDOS
    // ==========================
    public function index()
    {
        $orders = Order::with(['customer', 'user'])
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    // ==========================
    // FORMULARIO (CARRITO)
    // ==========================
    public function create()
    {
        $products = Product::where('status', 'activo')->get();
        $customers = Customer::all();

        return view('orders.create', compact('products', 'customers'));
    }

    // ==========================
    // GUARDAR PEDIDO
    // ==========================
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'fecha' => 'nullable|date',
            'estado' => 'required|string',
            'products' => 'required|array|min:1',

            'products.*.product_id' => 'required|exists:products,id',
            'products.*.cantidad' => 'required|numeric|min:1',
            'products.*.precio_unitario' => 'required|numeric|min:0',
            'products.*.subtotal' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {

            // ======================
            // CREAR PEDIDO
            // ======================
            $order = Order::create([
                'customer_id'   => $request->customer_id,
                'user_id'       => Auth::id(),
                'fecha_pedido'  => now(),
                'fecha_entrega' => $request->fecha 
                    ? \Carbon\Carbon::parse($request->fecha) 
                    : null,
                'estado'        => $request->estado,
                'descuento'     => $request->descuento ?? 0,
                'total'         => $request->total ?? 0,
                'observaciones' => $request->observaciones,
            ]);

            // 🔥 Buscar motivo venta una sola vez (optimizado)
            $reasonVenta = MovementReason::where('name', 'Venta')->first();

            // ======================
            // DETALLES + STOCK + MOVIMIENTOS
            // ======================
            foreach ($request->products as $item) {

                $product = Product::findOrFail($item['product_id']);

                // 🔥 VALIDACIÓN DE STOCK
                if ($product->stock_actual < $item['cantidad']) {
                    throw new \Exception("Stock insuficiente para {$product->name}");
                }

                // ======================
                // DETALLE
                // ======================
                OrderDetail::create([
                    'order_id'        => $order->id,
                    'product_id'      => $item['product_id'],
                    'cantidad'        => $item['cantidad'],
                    'precio_unitario' => $item['precio_unitario'],
                    'subtotal'        => $item['subtotal'],
                ]);

                // ======================
                // DESCONTAR STOCK
                // ======================
                $product->decrement('stock_actual', $item['cantidad']);

                // ======================
                // 🔥 MOVIMIENTO AUTOMÁTICO
                // ======================
                Movement::create([
                    'product_id' => $product->id,
                    'order_id' => $order->id, // 🔥 relación con pedido
                    'user_id' => Auth::id(),
                    'movement_type_id' => MovementTypeEnum::SALIDA->value,
                    'movement_reason_id' => $reasonVenta?->id,
                    'quantity' => $item['cantidad'],
                    'notes' => 'Salida automática por pedido #' . $order->id,
                ]);
            }

            DB::commit();

            return redirect()
                ->route('orders.index')
                ->with('success', 'Pedido registrado correctamente');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    // ==========================
    // VER PEDIDO
    // ==========================
    public function show(Order $order)
    {
        $order->load(['customer', 'user', 'details.product']);

        return view('orders.show', compact('order'));
    }

    // ==========================
    // ELIMINAR PEDIDO
    // ==========================
    public function destroy(Order $order)
    {
        DB::beginTransaction();

        try {

            foreach ($order->details as $detail) {

                $product = $detail->product;

                // 🔥 DEVOLVER STOCK
                $product->increment('stock_actual', $detail->cantidad);

                // 🔥 OPCIONAL: eliminar movimientos relacionados
                Movement::where('order_id', $order->id)->delete();
            }

            $order->details()->delete();
            $order->delete();

            DB::commit();

            return redirect()
                ->route('orders.index')
                ->with('success', 'Pedido eliminado');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Error al eliminar');
        }
    }

    // ==========================
    // MARCAR COMO PAGADO
    // ==========================
    public function markAsPaid(Order $order)
    {
        $order->update([
            'estado' => 'cancelado'
        ]);

        return back()->with('success', 'Pedido cobrado correctamente');
    }

    // ==========================
    // PDF
    // ==========================
    public function pdf($orderId, OrderService $service)
    {
        return $service->generatePdf($orderId);
    }
}