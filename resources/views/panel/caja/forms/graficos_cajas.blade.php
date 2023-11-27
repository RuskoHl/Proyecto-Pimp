@extends('adminlte::page')

@section('title', 'Graficos')

{{-- Activamos el plugin de Chartjs --}}
@section('plugins.Chartjs', true)

@section('content_header')
    
@stop

@section('content')
    <div class="container-fluid">
        <h2>Datos Estadísticos de <span class="text-danger"> Monto recaudado</span></h2>
        <div class="row">

            <!-- line CHART -->
            <div class="col-md-6">
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

            <!-- bar CHART -->
            <div class="col-md-6">
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
        <br>
        <h2>Datos Estadísticos de <span class="text-info">Ventas al mes</span></h2>
        <div class="row">

            <!-- line CHART -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Gráfico de línea (Mes)</strong>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas class="lineChart" data-chart-type="line" id="lineChartMeses"></canvas>
                    </div>
                </div>
            </div>

            <!-- bar CHART -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Gráfico de barras (Mes)</strong>
                        </div>
                    </div>
                    <div class="card-body h-50">
                        <canvas class="barChart" data-chart-type="bar" id="barChartMeses"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        
        $(function() {
            const lineChartDias = document.getElementById('lineChartDias').getContext('2d');
            const barChartDias = document.getElementById('barChartDias').getContext('2d');
            const lineChartMeses = document.getElementById('lineChartMeses').getContext('2d');
            const barChartMeses = document.getElementById('barChartMeses').getContext('2d');

            const configDatalineChart = $('#config_linechart');
            const configDatabarChart = $('#config_barchart');

            // Peticion AJAX para extraer datos de la BD y graficar
            $.get(location.href, function(response) {
                response = JSON.parse(response);

                // Si hay éxito en la petición
                if(response.success) {

                    let labels = response.data[0];
                    let count = response.data[1];

                    // Graficar el Diagrama de línea (Días)
                    graficar(lineChartDias, 'line', labels, count, 'Monto recaudado por día', configDatalineChart);

                    // Graficar el Diagrama de Barras (Días)
                    graficar(barChartDias, 'bar', labels, count, 'Monto recaudado por día', configDatabarChart);

                    // Agrupa los datos por mes
                    labels = labels.map(date => new Date(date)); // Ajusta según el formato de tus fechas

                    // Graficar el Diagrama de línea (Meses) con cantidad de ventas
                    graficar(lineChartMeses, 'line', labels, response.data[2], 'Cantidad de Ventas por mes', configDatalineChart);

                    // Graficar el Diagrama de Barras (Meses) con cantidad de ventas
                    graficar(barChartMeses, 'bar', labels, response.data[2], 'Cantidad de Ventas por mes', configDatabarChart);
                } else {
                    console.log(response.message);
                }
            })
            .fail(function(error) {
                console.log(error.statusText, error.status);
            });

            function graficar(context, typeGraphic, label, count, title, inputData) {
    let configChart = {
        type: typeGraphic,
        data: {
            labels: label.map(date => date.toLocaleString('default', { month: 'long', year: 'numeric' })), // Formatea las fechas
            datasets: [{
                label: title,
                data: count,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    type: 'time',
                    time: {
                        unit: 'month'
                    },
                    ticks: {
                        autoSkip: true,
                        maxTicksLimit: 20 // Ajusta este valor según sea necesario
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        // Puedes ajustar otras opciones aquí, por ejemplo:
                        // max: 100, // Valor máximo en el eje Y
                        // min: 0,   // Valor mínimo en el eje Y
                        // stepSize: 10 // Intervalo entre las marcas en el eje Y
                    }
                }]
            }
        }
    };

    inputData.val(JSON.stringify(configChart));
    new Chart(context, configChart);
}

        });
    </script>
@stop

