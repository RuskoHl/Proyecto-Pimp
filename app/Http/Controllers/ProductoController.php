<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;


class ProductoController extends Controller
{

    public function __construct()
    {
        $this->middleware("can:lista_productos");
    }
    
    public function index()
    {
        $productos = Producto::where('vendedor_id', auth()->user()->id)
                            ->latest()
                            ->get();
        return view('panel.vendedor.lista_productos.index', compact('productos'));
    }

    public function create()
    {
        $producto = new Producto();
        $categorias = Categoria::all();
        return view('panel.vendedor.lista_productos.create', compact('producto', 'categorias'));

    }

    public function store(Request $request)
    {
        $producto = new Producto();

        $producto->nombre= $request->get('nombre');
        $producto->descripcion= $request->get('descripcion');
        $producto->precio= $request->get('precio');
        $producto->categoria_id= $request->get('categoria_id');
        $producto->vendedor_id= auth()->user()->id;

        if($request->hasFile('imagen')){
            $image_url = $request->file('imagen')->store('public/producto');
            $producto->imagen = asset(str-replace('public', 'storage', $image_url));
        } else {
            $producto->imagen ='';
        }
        $producto->save();

        return redirect()
                ->route('producto.index')
                ->with('alert', 'Producto "' . $producto->nombre . '" agregado exitosamente.');
    }
    public function show(Producto $producto)
    {
        return view('panel.vendedor.lista_productos.show', compact('producto'));

    }
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('panel.vendedor.lista_productos.edit', compact('producto', 'categorias'));

    }
    public function update(Request $request, Producto $producto)
    {
        $producto->nombre = $request->get('nombre');
        $producto->descripcion = $request->get('descripcion');
        $producto->precio = $request->get('precio');
        $producto->categoria_id = $request->get('categoria_id');

        if ($request->hasFile('imagen')){
            $image_url = $request->file('imagen')->store('public/producto');
            $producto->imagen= asset(str_replace('public', 'storage', $image_url));
        }
        $producto->update();

        return redirect()
            ->route('producto.index')
            ->with('alert', 'Producto "' .$producto->nombre. '" actualizado existosamente.');
    }
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()
            ->route('producto.index')
            ->with('alert', 'Producto eliminado existosamente.');
    }
}
