<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategoria;
use App\Models\Categoria;

class SubcategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['can:lista_productos']);
        
    }
   
    public function index()
    {
        $subcategorias = Subcategoria::latest()->get();
        return view('panel.subcategoria.lista_subcategorias.index', compact('subcategorias'));
    }
    
    public function create()
    {
        $subcategoria = new Subcategoria();
        $categorias = Categoria::all();
        return view('panel.subcategoria.lista_subcategorias.create', compact('subcategoria', 'categorias'));

    }


    public function store(Request $request)
    {
        $subcategoria = new Subcategoria();

        $subcategoria->nombre= $request->get('nombre');
        $subcategoria->categoria_id= $request->get('categoria_id');
        $subcategoria->save();

        return redirect()
                ->route('subcategoria.index')
                ->with('alert', 'Subcategoria "' . $subcategoria->nombre . '" agregado exitosamente.');
    }
    public function show(Subcategoria $subcategoria)
    {
        return view('panel.subcategoria.lista_subcategorias.show', compact('subcategoria'));

    }
    public function edit(Subcategoria $Subcategoria)
    {
        $subcategoria = Subcategoria::all();
        $categorias = Categoria::all();
        return view('panel.subcategoria.lista_subcategorias.edit', compact('subcategoria', 'categorias'));

    }
    public function update(Request $request, Subcategoria $subcategoria)
    {
        $subcategoria->nombre = $request->get('nombre');
        $subcategoria->categoria_id= $request->get('categoria_id');
        $subcategoria->update();

        return redirect()
            ->route('subcategoria.index')
            ->with('alert', 'Subcategoria "' .$subcategoria->nombre. '" actualizado existosamente.');
    }
    public function destroy(Subcategoria $subcategoria)
    {
        $subcategoria->delete();

        return redirect()
            ->route('subcategoria.index')
            ->with('alert', 'Subcategoria eliminado existosamente.');
    }
}