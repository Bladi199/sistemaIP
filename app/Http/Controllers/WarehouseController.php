<?php
namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::orderBy('name')->get();
        return view('warehouses.index', compact('warehouses'));
    }

    public function create()
    {
        return view('warehouses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:warehouses,name',
            'description' => 'nullable|string',
            'ubicacion' => 'required|string'
        ]);

        Warehouse::create($request->only('name','description','ubicacion'));

        return redirect()->route('warehouses.index')
            ->with('success', 'Ubicación creada correctamente');
    }

    public function edit(Warehouse $warehouse)
    {
        return view('warehouses.edit', compact('warehouse'));
    }

    public function update(Request $request, Warehouse $warehouse)
    {
        $request->validate([
            'name' => 'required|unique:warehouses,name,' . $warehouse->id,
            'description' => 'nullable|string',
            'ubicacion' => 'required|string'
        ]);

        $warehouse->update($request->only('name','description','ubicacion'));

        return redirect()->route('warehouses.index')
            ->with('success', 'Ubicación actualizada correctamente');
    }

    public function destroy(Warehouse $warehouse)
    {
        if ($warehouse->products()->count() > 0) {
            return back()->with('error', 'No se puede eliminar una ubicación con productos asignados');
        }

        $warehouse->delete();

        return redirect()->route('warehouses.index')
            ->with('success', 'Ubicación eliminada correctamente');
    }
}