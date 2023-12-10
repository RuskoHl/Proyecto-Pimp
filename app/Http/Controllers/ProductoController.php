<?php

namespace App\Http\Controllers;

use App\Http\Requests\crearRequest;
use App\Http\Requests\editarRequest;
use App\Models\Producto;
use App\Models\Categoria;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class ProductoController extends Controller
{

    public function __construct()
    {
        $this->middleware(['can:lista_productos']);
        
    }
    
    public function index()
    {
        $productos = Producto::latest()->get();
        return view('panel.vendedor.lista_productos.index', compact('productos'));
    }

    public function create()
    {
        $producto = new Producto();
        $categorias = Categoria::all();
        return view('panel.vendedor.lista_productos.create', compact('producto', 'categorias'));

    }

    public function store(crearRequest $request)
    {
        $producto = new Producto();

        $producto->nombre= $request->get('nombre');
        $producto->descripcion= $request->get('descripcion');
        $producto->precio= $request->get('precio');
        $producto->categoria_id= $request->get('categoria_id');
        $producto->cantidad_minima= $request->get('cantidad_minima');
        $producto->cantidad= $request->get('cantidad');

        if($request->hasFile('imagen')){
            $image_url = $request->file('imagen')->store('public/producto');
            $producto->imagen = asset(str_replace('public', 'storage', $image_url));
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
    
    public function alerta()
    {
        // Suponiendo que 'cantidad_minima' es el nombre de la columna en tu tabla de productos
        $productosEscasos = Producto::whereColumn('cantidad', '<', 'cantidad_minima')->get();

    
        return view('panel.alertas', compact('productosEscasos'));
    }
    
    

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('panel.vendedor.lista_productos.edit', compact('producto', 'categorias'));

    }
    public function update(editarRequest $request, Producto $producto)
    {
        $producto->nombre = $request->get('nombre');
        $producto->descripcion = $request->get('descripcion');
        $producto->precio = $request->get('precio');
        $producto->categoria_id = $request->get('categoria_id');
        $producto->cantidad_minima= $request->get('cantidad_minima');
        $producto->cantidad = $request->get('cantidad');

        if ($request->hasFile('imagen')){
            $image_url = $request->file('imagen')->store('public/producto');
            $producto->imagen= asset(str_replace('public', 'storage', $image_url));
        }

        $validated = $request->validated();

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
    public function graficosProductosxCategoria() {
        // Si se hace una peticion AJAX
        if(request()->ajax()) {
        $labels = [];
        $counts = [];
        $categorias = Categoria::get();
        foreach($categorias as $categoria) {
        $labels[] = $categoria->nombre;
        $counts[] = Producto::where('categoria_id', $categoria->id)->count();
        }
        $response = [
        'success' => true,
        'data' => [$labels, $counts]
        ];
        return json_encode($response);
        }
        return view('panel.vendedor.lista_productos.graficos_productos');
        }

        public function exportarProductosPDF() {
            $productos= Producto::all();
            $pdf= Pdf::loadView('panel.vendedor.lista_productos.pdf_productos', compact('productos'));
            $pdf->render();
            return $pdf->stream('productos-pdf');
        }

        public function ultimosAgregados()
        {
            $ultimosAgregados = Producto::latest()->take(6)->get();

            return view('panel.ultimos_agregados', compact('ultimosAgregados'));
        }
        
        public function mostrarFormularioRestarCantidad($id)
        {
            $producto = Producto::findOrFail($id);
            return view('panel.vendedor.lista_productos.formulario_restar_cantidad', compact('producto'));
        }
        
        public function restarCantidad(Request $request, $id)
        {
            $producto = Producto::findOrFail($id);
        
            // Obtener la cantidad ingresada por el usuario desde el formulario
            $cantidadARestar = $request->input('cantidadARestar');
        
            // Validar que la cantidad a restar sea válida
            if ($cantidadARestar > 0 && $producto->cantidad >= $cantidadARestar) {
                // Restar la cantidad
                $producto->cantidad -= $cantidadARestar;
                $producto->save();
        
                // Redirigir a donde desees después de restar la cantidad
                return redirect()->route('producto.index')->with('success', 'Cantidad restada exitosamente.');
            } else {
                // Si la cantidad ingresada no es válida, mostrar un mensaje de error
                return redirect()->route('producto.index')->with('error', 'La cantidad ingresada no es válida.');
            }
        }
        
                
}
