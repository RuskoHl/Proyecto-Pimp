<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Http\Requests\crearProveedorRequest;

use Illuminate\Http\Request;


class ProveedorController extends Controller
{

    public function __construct()
    {
        $this->middleware("can:lista_proveedores");
    }
    
    public function index()
    {
        $proveedors= Proveedor::all();
        return view('panel.compras.lista_proveedores.index', compact('proveedors'));
    }

    public function create()
    {
        $proveedor = new Proveedor();
        return view('panel.compras.lista_proveedores.create', compact('proveedor'));

    }

    public function store(crearProveedorRequest $request)
    {
        $proveedor = new Proveedor();

        $proveedor->nombre= $request->get('nombre');
        $proveedor->email= $request->get('email');       
        $proveedor->telefono= $request->get('telefono');
        $proveedor->direccion= $request->get('direccion');
        $proveedor->cuit= $request->get('cuit');
        $proveedor->comentario= $request->get('comentario');
   

        
        $proveedor->save();

        return redirect()
                ->route('proveedor.index')
                ->with('alert', 'proveedor "' . $proveedor->nombre . '" agregado exitosamente.');
    }
    public function show(Proveedor $proveedor)
    {
        return view('panel.compras.lista_proveedores.show', compact('proveedor'));

    }
    public function edit(Proveedor $proveedor)
    {
        return view('panel.compras.lista_proveedores.edit', compact('proveedor'));

    }
    public function update(crearProveedorRequest $request, Proveedor $proveedor)
    {
        $proveedor->nombre= $request->get('nombre');
        $proveedor->email= $request->get('email');       
        $proveedor->telefono= $request->get('telefono');
        $proveedor->direccion= $request->get('direccion');
        $proveedor->cuit= $request->get('cuit');
        $proveedor->comentario= $request->get('comentario');



        $proveedor->update();

        return redirect()
            ->route('proveedor.index')
            ->with('alert', 'Proveedor "' .$proveedor->nombre. '" actualizado existosamente.');
    }
    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();

        return redirect()
            ->route('proveedor.index')
            ->with('alert', 'Proveedor eliminado existosamente.');
    }

    //public function mostrarProducto()
//{
   // $productos = Producto::all(); // Recupera todos los productos de la base de datos
   // return view('ropa', ['productos' => $productos]);
//}

}
