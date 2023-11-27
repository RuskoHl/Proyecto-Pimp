@extends('adminlte::page')

@section('title', 'Graficos')

{{-- Activamos el plugin de Chartjs --}}
@section('plugins.Chartjs', true)

@section('content_header')
    <h1 class="text-bold">Graficos Caja</h1>
@stop

@section('content')
    <div class="container-fluid">
        <h3>Datos Estadísticos de <span class="text-danger">Montos recaudados por día</span></h3>
        <div class="row">
            <!-- line CHART -->
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

            <!-- bar CHART -->
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
@stop

@section('css')

@stop

@section('js')
    <script>
        $(function() {
            const lineChartDias = document.getElementById('lineChartDias').getContext('2d');
            const barChartDias = document.getElementById('barChartDias').getContext('2d');

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
                } else {
                    console.log(response.message);
                }
            })
            .fail(function(error) {
                console.log(error.statusText, error.status);
            });

            $.get(location.href, function(response) {
    response = JSON.parse(response);

    // Si hay éxito en la petición
    if(response.success) {
        let labels = response.data[0];
        let montosIniciales = response.data[1];
        let montosFinales = response.data[2];

        // Graficar el Diagrama de línea (Días)
        graficar(lineChartDias, 'line', labels, montosIniciales, montosFinales, 'Montos Iniciales y Finales de Caja', configDatalineChart);
    } else {
        console.log(response.message);
    }
})
.fail(function(error) {
    console.log(error.statusText, error.status);
});

function graficar(context, typeGraphic, label, montosIniciales, montosFinales, title, inputData) {
    let configChart = {
        type: typeGraphic,
        data: {
            labels: label,
            datasets: [{
                label: 'Monto Inicial',
                data: montosIniciales,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2
            },
            {
                label: 'Monto Final',
                data: montosFinales,
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
                        beginAtZero: true
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
