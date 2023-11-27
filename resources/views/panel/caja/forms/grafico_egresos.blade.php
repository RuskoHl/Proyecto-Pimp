@extends('adminlte::page')

@section('title', 'Gráfico Ingresos/Egresos Caja')

{{-- Activamos el plugin de Chartjs --}}
@section('plugins.Chartjs', true)

@section('content_header')
    <h1 class="text-bold">Gráfico Ingresos/Egresos Caja</h1>
@stop

@section('content')
    <div class="container-fluid">
        <h3>Datos Estadísticos de <span class="text-danger">Ingresos y Egresos a Caja</span></h3>

        <div class="row">
            <!-- Montos Iniciales CHART -->
    

            <!-- Agrega este elemento para el gráfico -->
            <div class="col-md-12">
                <canvas class="lineChart" data-chart-type="line" id="lineChart"></canvas>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        $(function() {
            // Asegúrate de tener el contexto correcto para el gráfico
            const lineChart = document.getElementById('lineChart').getContext('2d');
            const configDataLineChart = $('#config_linechart_ingresos_egresos');

            // Peticion AJAX para extraer datos de la BD y graficar
            $.get(location.href, function(response) {
                response = JSON.parse(response);

                // Si hay éxito en la petición
                if(response.success) {
                    let labels = response.data.labels;
                    let montosIniciales = response.data.iniciales;
                    let montosFinales = response.data.finales;

                    // Graficar el Diagrama de línea (Montos Iniciales y Finales)
                    graficar(lineChart, 'line', labels, montosIniciales, montosFinales, 'Montos Iniciales y Finales de Caja', configDataLineChart);
                } else {
                    console.log(response.message);
                }
            })
            .fail(function(error) {
                console.log(error.statusText, error.status);
            });
        });

        function graficar(context, typeGraphic, labels, data1, data2, title, inputData) {
            let configChart = {
                type: typeGraphic,
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Montos Iniciales',
                        data: data1,
                        fill: false,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        pointRadius: 5,
                        pointHoverRadius: 8,
                        pointStyle: 'rectRounded'
                    }, {
                        label: 'Montos Finales',
                        data: data2,
                        fill: false,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        pointRadius: 5,
                        pointHoverRadius: 8,
                        pointStyle: 'rectRounded'
                    }]
                },
                options: {
                    scales: {
                        xAxes: [{
                            type: 'category',
                            labels: labels,
                        }],
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: 'Monto'
                            },
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            };

            inputData.val(JSON.stringify(configChart));
            new Chart(context, configChart);
        }
    </script>
@stop
