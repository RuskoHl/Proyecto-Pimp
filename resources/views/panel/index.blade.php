@extends('adminlte::page')

@section('title','PimpAdmin')

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
<!-- COMIENZO VISTAS ADMINS -->
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
<h3 style="font-family: 'Old English Text MT', sans-serif;">Alerta productos escasos:</h3>
<a href="{{ route('alerta') }}"> <!-- Agregar la URL a la que deseas redirigir -->
    <div class="card bg-white">
       
        <div class="card-body">
            <h5 class="card-title"><strong class="text-danger">Cantidad Productos escasos</strong></h5>
            <p class="card-text"> Hay <strong>{{ App\Models\Producto::where('cantidad', '<', 20)->count() }}</strong> productos con un stock menor o igual a 20.</p>
        </div>
    </div>
</a>
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
</div>
</div>
@endcan
<div class="container-fluid">
    <div class="row">



        <!-- Repite el mismo patrón para otras tarjetas -->
    </div>
</div>










@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(function() {
            const barChart = document.getElementById('barChart').getContext('2d');
            const pieChart = document.getElementById('pieChart').getContext('2d');

            const configDataBarChart = $('#config_barchart');
            const configDataPieChart = $('#config_piechart')

            // Peticion AJAX para extraer datos de la BD y graficar
            $.get(location.href, function(response) {
                response = JSON.parse(response);

                // Si hay exito en la petición
                if(response.success) {

                    let labels = response.data[0];
                    let count = response.data[1];

                    // Para Graficar el Diagrama de Barras (BarChart)
                    graficar(barChart, 'bar', labels, count, 'Cantidad de Productos por Categoria', configDataBarChart);

                    // Para Graficar el Diagrama de Torta (PieChart)
                    graficar(pieChart, 'pie', labels, count, 'Cantidad de Productos por Categoria', configDataPieChart);
                } else {
                    console.log(response.message);
                }
            })
            .fail(function(error) {
                console.log(error.statusText, error.status);
            });

            // Grafica cualquier gráfico estadistico de ChartJs
            function graficar(context, typeGraphic, label, count, title, inputData) {

                // Inicio de la configuracion de ChartJs
                let configChart = `{
                    "type": "${typeGraphic}",
                    "data": {
                        "labels": ${ JSON.stringify(label) },
                        "datasets": [{
                            "label": "${title}",
                            "data": ${ JSON.stringify(count) },
                            "backgroundColor": [
                                "rgba(255, 99, 132, 0.2)",
                                "rgba(54, 162, 235, 0.2)"
                            ],
                            "borderColor": [
                                "rgba(255, 99, 132, 1)",
                                "rgba(54, 162, 235, 1)"
                            ],
                            "borderWidth": 2
                        }]
                    }`;

                // Si es alguno de estos graficos, iniciarán en el punto 0
                if(typeGraphic === 'bar' || typeGraphic === 'horizontalBar') {
                    configChart += `
                    ,"options": {
                        "scales": {
                            "xAxes": [{
                                "ticks": {
                                    "beginAtZero": true
                                }
                            }],
                            "yAxes": [{
                                "ticks": {
                                    "beginAtZero": true
                                }
                            }]
                        }
                    }
                    `;
                }

                configChart += '}'; // Cierre del JSON

                // Guardamos el string en el input data del formulario correspondiente
                inputData.val(configChart);

                // JSON.parse(string) -> convierte el string a JSON
                let myChart = new Chart(context, JSON.parse(configChart));
            }
        });
    </script>
@stop
