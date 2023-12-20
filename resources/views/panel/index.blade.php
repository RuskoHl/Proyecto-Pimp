@extends('adminlte::page')

@section('title','PimpAdmin')

@section('plugins.Chartjs', true)
@section('content_header')
<h1 style="font-family: 'Old English Text MT', sans-serif; font-size: 60px;">Pimp</h1>

@stop

@section('content')
@inject('productos', 'App\Models\Producto')

<div>
    <div>
        <div>
            <a class="text-danger">Wheels & Clothes</a><a>.</a> <br><br>
        </div>
    </div>
</div>

<div class="container-fluid bg-danger" style="height: 2px;"> <!-- Ajusta la altura como desees -->
    <div class="row justify-content-center align-items-center" style="height: 100%;">
      </div>
    </div>


    <div class="container-fluid bg-dark" style="height: 2px;"> <!-- Ajusta la altura como desees -->
        <div class="row justify-content-center align-items-center" style="height: 100%;">
          </div>
        </div>

<br>

<div class="col-12">
    @if (\App\Models\Caja::where('status', 1)->count() == 0)
    <a href="{{ route('caja2.create') }}">
        <div class="card bg-danger">
            <div class="card-body">
                <h5 class="card-title"><strong class="text-black">No hay cajas activas</strong></h5>
                <p class="card-text">¡Si no hay cajas activas los clientes no podran realizar compras!</p>
            </div>
        </div>
        </a>
    @endif
</div>


<!-- COMIENZO VISTAS ADMINS -->
<h3 style="font-family: 'Old English Text MT', sans-serif;">Atajos Administrativos:</h3>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('graficos-productos') }}">
                <div class="card bg-black">
                    <div class="card-body">
                        <h5 class="card-title"><strong class="text-danger">Cantidad Productos</strong></h5>
                        <p class="card-text"> Hay <strong class="text-danger">{{ App\Models\Producto::count() }}</strong> productos en stock.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('ofertas.index') }}">
                <div class="card bg-black">
                    <div class="card-body">
                        <h5 class="card-title"><strong class="text-warning">Cantidad Ofertas Activas</strong></h5>
                        <p class="card-text"> Hay <strong class="text-warning">{{ \App\Models\Oferta::where('status', 1)->count() }}</strong> ofertas activas.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('ventas.index') }}">
        <div class="card bg-black">
        
        <div class="card-body">
        <h5 class="card-title"><strong class="text-success">Ventas Realizadas</strong></h5>
            <p class="card-text">Realizamos <strong class="text-success">{{ App\Models\Venta::count() }}</strong> ventas en total.</p>
        </div>
        
        </div>
    </a>
        </div>

        <div class="col-md-3">
        <div class="card bg-black">
            <div class="card-body">
                <h5 class="card-title"><strong class="text-primary">Clientes Registrados</strong></h5>
                <p class="card-text">Hay <strong class="text-primary" >{{ \Spatie\Permission\Models\Role::where('name', 'cliente')->first()->users()->count() }}</strong> clientes registrados.</p>
            </div>
        </div>
        </div>

        <div class="col-md-6">
            <a href="{{ route('ventas.index') }}">
            <div class="card bg-white">
                <div class="card-body">
                    <h5 class="card-title"><strong class="text-orange">Sumatoria de Ventas</strong></h5>
                    <p class="card-text">La sumatoria de los ingresos de caja es: <strong class="text-orange">${{ \App\Models\Venta::whereHas('caja', function($query) {
                        $query->where('status', 1);
                    })->sum('valor_total') }}</strong>.</p>
                </div>
            </div>
        </a>
        </div>
        
        

        <div class="col-md-6">
            <a href="{{ route('caja.index') }}">
            <div class="card bg-white">
                <div class="card-body">
                    <h5 class="card-title"><strong class="text-purple">Monto de Extracción de caja</strong></h5>
                    
                    @php
                        $extraccion = \App\Models\Caja::where('status', 1)->value('extraccion');
                    @endphp
                    
                    @if ($extraccion)
                        <p class="card-text">El monto de extracción es: <strong class="text-purple">${{ $extraccion }}</strong>.</p>
                    @else
                        <p class="card-text">Realizar extracción.</p>
                    @endif
                </div>
            </div>
        </a>
        </div>

        
        
        {{-- <!-- COMIENZO VISTAS ADMINS -->
<h3 style="font-family: 'Old English Text MT', sans-serif;">Atajos Administrativos:</h3>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <a href="{{ route('graficos-productos') }}"> <!-- Agregar la URL a la que deseas redirigir -->
                <div class="card bg-black">
                   
                    <div class="card-body">
                        <h5 class="card-title"><strong class="text-danger">Cantidad Productos</strong></h5>
                        <p class="card-text"> Hay <strong>{{ App\Models\Producto::count() }}</strong> productos en la base de datos.</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('caja2.create') }}"> <!-- Agregar la URL a la que deseas redirigir -->
                <div class="card bg-black">
                   
                    <div class="card-body">
                        <h5 class="card-title"><strong class="text-danger">Cantidad Cajas Activas</strong></h5>
                        <p class="card-text"> Hay <strong>{{ App\Models\Caja::where('status', 1)->count() }}</strong> cajas acivas.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-6 d-none d-md-block">
            <a href="{{ route('casa') }}"><img src="logo2.png" class="img-fluid" alt="Logo"></a>
        </div>
    </div>
</div>
<!-- FIN VISTAS ADMINS -->
<h3 style="font-family: 'Old English Text MT', sans-serif;">Ventas Realizadas:</h3>

    <div class="card bg-white">
        <div class="card-body">
            <h5 class="card-title"><strong class="text-danger">Ventas Realizadas</strong></h5>
            <p class="card-text">Se han realizado un total de <strong>{{ App\Models\Venta::count() }}</strong> ventas.</p>
        </div>
    </div>
 --}}

<h3 style="font-family: 'Old English Text MT', sans-serif;">Vistas usuario administrativo:</h3>
<div class="container-fluid">
    <div class="row">

        <div class="col">
            <a href="{{ route('caja.index') }}"> <!-- Agregar la URL a la que deseas redirigir -->
                <div class="card bg-secondary ">
                   
                    <div class="card-body">
                        <h5 class="card-title">Listado de Cajas</h5>
                        <p class="card-text">Acceso rapido a Pantalla de Cajas.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-3 d-none d-md-block">
            <a href="{{ route('caja2.create')}}"> <!-- Agregar la URL a la que deseas redirigir -->
                <div class="card bg-secondary">
                   
                    <div class="card-body">
                        <h5 class="card-title">Abrir una nueva caja</h5>
                        <p class="card-text">Nueva caja .</p>
                    </div>
                </div>
            </a>
        </div>
        <!-- Repite el mismo patrón para otras tarjetas -->
    </div>
    <div class="row">

        <div class="col">
            <a href="{{ route('producto.index') }}"> <!-- Agregar la URL a la que deseas redirigir -->
                <div class="card bg-dark">
                   
                    <div class="card-body">
                        <h5 class="card-title">Listado de Productos</h5>
                        <p class="card-text">Acceso rapido a Pantalla de Productos.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-3 d-none d-md-block">
            <a href="{{ route('producto.create')}}"> <!-- Agregar la URL a la que deseas redirigir -->
                <div class="card bg-dark">
                   
                    <div class="card-body">
                        <h5 class="card-title">Añadir un nuevo producto</h5>
                        <p class="card-text">Nuevo Producto .</p>
                    </div>
                </div>
            </a>
        </div>
        <!-- Repite el mismo patrón para otras tarjetas -->
    </div>

    <div class="row">

        <div class="col">
            <a href="{{ route('proveedor.index') }}"> <!-- Agregar la URL a la que deseas redirigir -->
                <div class="card bg-black ">
                   
                    <div class="card-body">
                        <h5 class="card-title">Listado de Proveedor</h5>
                        <p class="card-text">Acceso rapido Proveedores.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-3 d-none d-md-block">
            <a href="{{ route('proveedor.create')}}"> <!-- Agregar la URL a la que deseas redirigir -->
                <div class="card bg-black">
                   
                    <div class="card-body">
                        <h5 class="card-title">Añadir un nuevo proveedor</h5>
                        <p class="card-text">Nuevo Proveedor .</p>
                    </div>
                </div>
            </a>
        </div>
        <!-- Repite el mismo patrón para otras tarjetas -->
    </div>
    <div class="row d-none">
        <!-- BAR CHART -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>Gráfico de Barras</strong>
                    </div>
                </div>
                <div class="card-body h-50">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    
        <!-- PIE CHART -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>Grafico de Torta</strong>
                    </div>
                </div>
                <div class="card-body h-50">
                    <canvas id="pieChart"></canvas>
                </div>
            </div>
        </div>
    </div>

@can('lista_usuarios')
    

<div class="row">

    <div class="col">
        <a href="{{ route('empleado.index') }}"> <!-- Agregar la URL a la que deseas redirigir -->
            <div class="card bg-danger ">
               
                <div class="card-body">
                    <h5 class="card-title">Listado de Empleados</h5>
                    <p class="card-text">Acceso rapido Empleados.</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-3 d-none d-md-block">
        <a href="{{ route('empleado.create')}}"> <!-- Agregar la URL a la que deseas redirigir -->
            <div class="card bg-danger">
               
                <div class="card-body">
                    <h5 class="card-title">Añadir un nuevo Empleado</h5>
                    <p class="card-text">Nuevo Empleado .</p>
                </div>
            </div>
        </a>
    </div>
    <!-- Repite el mismo patrón para otras tarjetas -->
    @endcan
</div>
</div>
</div>
<div class="row">

    <div class="col">
        <a href="{{ route('ofertas.index') }}"> <!-- Agregar la URL a la que deseas redirigir -->
            <div class="card bg-info ">
               
                <div class="card-body">
                    <h5 class="card-title">Listado de Oferta</h5>
                    <p class="card-text">Acceso rapido Ofertas.</p>
                </div>
            </div>
        </a>
    </div>

    <div class="col-3 d-none d-md-block">
        <a href="{{ route('ofertas.create')}}"> <!-- Agregar la URL a la que deseas redirigir -->
            <div class="card bg-info">
               
                <div class="card-body">
                    <h5 class="card-title">Añadir una nueva Oferta</h5>
                    <p class="card-text">Nueva Oferta .</p>
                </div>
            </div>
        </a>
    </div>
    <!-- Repite el mismo patrón para otras tarjetas -->

<div class="container-fluid">
    <div class="row">



        <!-- Repite el mismo patrón para otras tarjetas -->
    </div>
</div>
        {{-- <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Gráfico de barras (Día)</strong>
                        </div>
                    </div>
                    <div class="card-body h-50">
                        <canvas class="barChart" data-chart-type="bar" id="barChartDias"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="config_linechart" style="display: none;"></div>
        <div id="config_barchart" style="display: none;"></div> --}}
    
</div>

</div>


<div id="config_linechart" style="display: none;"></div>
    <div id="config_barchart" style="display: none;"></div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
    @parent <!-- Mantiene las secciones de scripts existentes -->

    <!-- Agrega el script para el gráfico de barras -->
    <script>
        $(document).ready(function() {
            const barChartDias = document.getElementById('barChartDias').getContext('2d');
            let labels = ['Enero', 'Febrero', 'Marzo'];
            let montosIniciales = [100, 150, 120];
            let montosFinales = [120, 180, 150];
            // Graficar el Diagrama de Barras (Cajas)
            graficar(barChartDias, 'bar', labels, [montosIniciales, montosFinales], 'Montos Iniciales y Finales de Caja');

            function graficar(context, typeGraphic, label, datasets, title) {
                let configChart = {
                    type: typeGraphic,
                    data: {
                        labels: label,
                        datasets: [{
                            label: 'Monto Inicial',
                            data: datasets[0],
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2
                        },
                        {
                            label: 'Monto Final',
                            data: datasets[1],
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            xAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    callback: function(value, index, values) {
                                        return '$' + value;
                                    }
                                }
                            }]
                        }
                    }
                };
                new Chart(context, configChart);
            }
        });
    </script>
@stop