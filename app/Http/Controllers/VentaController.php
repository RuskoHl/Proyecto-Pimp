<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;

class VentaController extends Controller
{
    public function index()
    {   
        $ventas = Venta::latest()->get();
       
        return view('panel.ventas.index', compact('ventas'));
    }

    public function create()
    {
        // You can add any logic you need for the create view here
        return view('panel.ventas.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            // Add validation rules based on your requirements
        ]);

        // Create a new venta instance
        $venta = Venta::create([
            'fecha_emision' => $request->input('fecha_emision'),
            'iva' => $request->input('iva'),
            'valor_total' => $request->input('valor_total'),
            // Add any other fields you need to fill in the database
        ]);

        // Attach products to the venta
        $venta->products()->attach($request->input('product_ids'));

        return redirect()->route('ventas.index')->with('success', 'Venta created successfully.');
    }

    public function show(Venta $venta)
    {
        return view('panel.ventas.show', compact('venta'));
    }

    public function edit(Venta $venta)
    {
        // You can add any logic you need for the edit view here
        return view('panel.ventas.edit', compact('venta'));
    }

    public function update(Request $request, Venta $venta)
    {
        // Validate the request data
        $request->validate([
            // Add validation rules based on your requirements
        ]);

        // Update the venta instance
        $venta->update([
            'fecha_emision' => $request->input('fecha_emision'),
            'iva' => $request->input('iva'),
            'valor_total' => $request->input('valor_total'),
            // Add any other fields you need to update in the database
        ]);

        // Sync products to the venta
        $venta->products()->sync($request->input('product_ids'));

        return redirect()->route('panel.ventas.index')->with('success', 'Venta updated successfully.');
    }

    public function destroy(Venta $venta)
    {
        $venta->delete();

        return redirect()->route('panel.ventas.index')->with('success', 'Venta deleted successfully.');
    }
}
