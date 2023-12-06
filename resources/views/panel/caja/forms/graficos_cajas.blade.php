@extends('adminlte::page')

@section('title', 'Graficos')

{{-- Activamos el plugin de Chartjs --}}
@section('plugins.Chartjs', true)

@section('content_header')
    <h1 class="text-bold">Gráficos Caja</h1>
    
@stop

@section('content')
    <div class="container-fluid">
        <h3>Datos Estadísticos de <span class="text-danger">Montos recaudados por día</span></h3>
        <a href="{{ route('caja.index') }}" class="btn btn-sm btn-danger text-uppercase mb-2">
            Volver al Listado de cajas
        </a>
        <div class="row">
            <!-- Gráfico de Línea -->
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Gráfico de línea (Día)</strong>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas class="lineChart" data-chart-type="line" id="lineChartDias"></canvas>
                    </div>
                </div>
            </div>

            <!-- Gráfico de Barras -->
            <div class="col-md-6 mx-auto">
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
    </div>

    <!-- Contenedores para almacenar la configuración de los gráficos -->
    <div id="config_linechart" style="display: none;"></div>
    <div id="config_barchart" style="display: none;"></div>
@stop

@section('css')
    <!-- Agrega estilos CSS personalizados si es necesario -->
@stop

@section('js')
    <!-- Agrega jQuery y Chart.js desde un CDN -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            const lineChartDias = document.getElementById('lineChartDias').getContext('2d');
            const barChartDias = document.getElementById('barChartDias').getContext('2d');

            // Hacer la llamada AJAX para obtener los datos
            $.get(location.href, function(response) {
                response = JSON.parse(response);

                // Si hay éxito en la petición
                if (response.success) {
                    let labels = response.data.labels;
                    let montosIniciales = response.data.montosIniciales;
                    let montosFinales = response.data.montosFinales;

                    // Graficar el Diagrama de línea (Cajas)
                    graficar(lineChartDias, 'line', labels, [montosIniciales, montosFinales], 'Montos Iniciales y Finales de Caja');

                    // Graficar el Diagrama de Barras (Cajas)
                    graficar(barChartDias, 'bar', labels, [montosIniciales, montosFinales], 'Montos Iniciales y Finales de Caja');
                } else {
                    console.log(response.message);
                }
            }).fail(function(error) {
                console.log(error.statusText, error.status);
            });

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
                                    // Ajusta el mínimo y máximo según tus datos reales
                                    min: Math.min.apply(null, [].concat.apply([], datasets)),
                                    max: Math.max.apply(null, [].concat.apply([], datasets)),
                                    callback: function(value, index, values) {
                                        return '$' + value; // Ajusta el formato según tus necesidades
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
