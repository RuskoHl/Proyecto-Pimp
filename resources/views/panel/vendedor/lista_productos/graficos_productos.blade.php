@extends('adminlte::page')

@section('title', 'Graficos')

{{-- Activamos el plugin de Chartjs --}}
@section('plugins.Chartjs', true)

@section('content_header')
    <h1>Datos Estadisticos de Productos por Categoria</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">

            <!-- BAR CHART -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <strong>Grafico de barras</strong>
                        </div>
                    </div>
                    <div class="card-body">
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
    </div>
    <a href="{{ route('producto.index') }}"> <!-- Agregar la URL a la que deseas redirigir -->
        <div class="card bg-danger d-flex align-items-center">
           
            <div class="card-body d-flex align-items-center">
                <h4 class="card-text text-white"> Hay <strong>{{ App\Models\Producto::count() }}</strong> productos en la base de datos.</h4>
            </div>
        </div>
    </a>
@stop

@section('css')

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
                                "rgba(255, 0, 0, 0.2)",
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
