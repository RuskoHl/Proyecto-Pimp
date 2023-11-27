@extends('adminlte::page')

@section('title', 'Graficos')

{{-- Activamos el plugin de Chartjs --}}
@section('plugins.Chartjs', true)

@section('content_header')
    <h1>Datos Estadísticos de Monto recaudado por Día</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">

            <!-- line CHART -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Gráfico de línea</strong>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- bar CHART -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Gomoso</strong>
                        </div>
                    </div>
                    <div class="card-body h-50">
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        $(function() {
            const lineChart = document.getElementById('lineChart').getContext('2d');
            const barChart = document.getElementById('barChart').getContext('2d');

            const configDatalineChart = $('#config_linechart');
            const configDatabarChart = $('#config_barchart')

            // Peticion AJAX para extraer datos de la BD y graficar
            $.get(location.href, function(response) {
                response = JSON.parse(response);

                // Si hay exito en la petición
                if(response.success) {

                    let labels = response.data[0];
                    let count = response.data[1];

                    // Para Graficar el Diagrama de lineras (lineChart)
                    graficar(lineChart, 'line', labels, count, 'Monto recaudado por día', configDatalineChart);

                    // Para Graficar el Diagrama de Torta (barChart)
                    graficar(barChart, 'bar', labels, count, 'Monto recaudado por día', configDatabarChart);
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
                if(typeGraphic === 'line' || typeGraphic === 'horizontalline') {
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
