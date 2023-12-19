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
<!-- COMIENZO VISTAS ADMINS -->
<h3 style="font-family: 'Old English Text MT', sans-serif;">Atajos Administrativos:</h3>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <a href="{{ route('graficos-productos') }}">
                <div class="card bg-black">
                    <div class="card-body">
                        <h5 class="card-title"><strong class="text-danger">Cantidad Productos</strong></h5>
                        <p class="card-text"> Hay <strong class="text-danger">{{ App\Models\Producto::count() }}</strong> productos en la base de datos.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('caja2.create') }}">
                <div class="card bg-dark">
                    <div class="card-body">
                        <h5 class="card-title"><strong class="text-warning">Cantidad Cajas Activas</strong></h5>
                        <p class="card-text"> Hay <strong class="text-warning">{{ App\Models\Caja::where('status', 1)->count() }}</strong> cajas activas.</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
        <div class="card bg-secondary">
            <div class="card-body">
                <h5 class="card-title"><strong class="text-success">Ventas Realizadas</strong></h5>
                <p class="card-text">Se han realizado un total de <strong class="text-success">{{ App\Models\Venta::count() }}</strong> ventas.</p>
            </div>
        </div>
        </div>
        <div class="col-md-3">
        <div class="card bg-white">
            <div class="card-body">
                <h5 class="card-title"><strong class="text-primary">Clientes Registrados</strong></h5>
                <p class="card-text">Hay un total de <strong class="text-primary" >{{ \Spatie\Permission\Models\Role::where('name', 'cliente')->first()->users()->count() }}</strong> clientes registrados.</p>
            </div>
        </div>
        </div>
        <div class="row">
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
        <div id="config_barchart" style="display: none;"></div>
    
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