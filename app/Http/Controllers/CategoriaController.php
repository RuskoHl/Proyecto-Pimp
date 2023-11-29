<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoriaRequest;
use App\Http\Requests\editarCatRequest;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['can:lista_productos']);

    }

    public function index()
    {
        $categorias = Categoria::all();
        return view('panel.categoria.lista_categorias.index', compact('categorias'));
    }

    public function create()
    {
        $categoria = new Categoria();
        $categorias = Categoria::all();
        return view('panel.categoria.lista_categorias.create', compact('categoria', 'categorias'));

    }


    public function store(CategoriaRequest $request)
    {
        $categoria = new Categoria();

        $categoria->nombre= $request->get('nombre');

        $categoria->save();

        return redirect()
                ->route('categoria.index')
                ->with('alert', 'Categoria "' . $categoria->nombre . '" agregado exitosamente.');
    }
    public function show(Categoria $categoria)
    {
        return view('panel.categoria.lista_categorias.show', compact('categoria'));

    }
    public function edit(Categoria $categoria)
    {
        $categorias = Categoria::all();
        return view('panel.categoria.lista_categorias.edit', compact('categoria', 'categorias'));

    }
    public function update(editarCatRequest $request, Categoria $categoria)
    {
        $categoria->nombre = $request->get('nombre');

        $categoria->update();

        return redirect()
            ->route('categoria.index')
            ->with('alert', 'Categoria "' .$categoria->nombre. '" actualizado existosamente.');
    }
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()
            ->route('categoria.index')
            ->with('alert', 'Categoria eliminado existosamente.');
    }
}