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
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Gráfico de barras (Día)</strong>
                        </div>
                    </div>
                    <div class="card-body h-50">
                        <canvas class="barChart" data-chart-type="bar" id="barChartDia"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenedores para almacenar la configuración de los gráficos -->

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
    const barChartDia = document.getElementById('barChartDia').getContext('2d');

    // Datos de prueba (reemplaza esto con tus datos reales)
    let labels = @json($labels);
    let montosIniciales = @json($montosIniciales);
    let montosFinales = @json($montosFinales);

    // Graficar el Diagrama de Barras (Cajas)
   graficar(barChartDia, 'bar', labels, [montosIniciales, montosFinales], 'Montos Iniciales y Finales de Caja');

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
