@extends('adminlte::page')

@section('title', 'Graficos')

{{-- Activamos el plugin de Chartjs --}}
@section('plugins.Chartjs', true)

@section('content_header')
    <h1 class="text-bold">Gráficos Caja</h1>
@stop

@section('content')
    <div class="container-fluid">
        <h3>Datos Estadísticos de <span class="text-danger">Cantidad de Ventas por Caja</span></h3>
        <!-- Resto del contenido... -->

        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Gráfico de barras (Cajas)</strong>
                        </div>
                    </div>
                    <div class="card-body h-50">
                        <canvas class="barChart" data-chart-type="bar" id="barChartCajas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenedores para almacenar la configuración de los gráficos -->

@stop

@section('js')
    <!-- Agrega jQuery y Chart.js desde un CDN -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            const barChartCajas = document.getElementById('barChartCajas').getContext('2d');

            // Datos de prueba (reemplaza esto con tus datos reales)
            let labels = @json($labels);
            let cantidadVentas = @json($cantidadVentas);

            // Graficar el Diagrama de Barras (Cajas)
            graficar(barChartCajas, 'bar', labels, [cantidadVentas], 'Cantidad de Ventas por Caja');

            function graficar(context, typeGraphic, label, datasets, title) {
                let configChart = {
                    type: typeGraphic,
                    data: {
                        labels: label,
                        datasets: [{
                            label: 'Cantidad de Ventas',
                            data: datasets[0],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
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
                                    beginAtZero: true
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