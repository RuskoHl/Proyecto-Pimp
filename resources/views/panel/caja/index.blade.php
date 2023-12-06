{{-- Extiende de la plantilla de Admin LTE, nos permite tener el panel en la vista --}}
@extends('adminlte::page')

{{-- Activamos el Plugin de Datatables instalado en AdminLTE --}}
@section('plugins.Datatables', true)

{{-- Activamos el plugin de Chartjs --}}
@section('plugins.Chartjs', true)

{{-- Titulo en las tabulaciones del Navegador --}}
@section('title', 'Cajas')

{{-- Titulo en el contenido de la Pagina --}}
@section('content_header')
    <h1>Apertura y Cierre de Cajas</h1>
@stop

{{-- Contenido de la Pagina --}}
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('caja2.create') }}" class="btn btn-success text-uppercase">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-plus" viewBox="0 0 16 16">
  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
  <path d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4"/>
</svg> Nueva caja
            </a>
            <a href="{{ route('graficos-cajas')}}" class="btn btn-danger" title="ChartJs">
                <i class="fas fa-chart-pie"></i> Gráficos Dias
            </a>
            <a href="{{ route('grafico-egresos')}}" class="btn btn-warning" title="ChartJs">
                <i class="fas fa-chart-pie"></i> Gráficos Ingresos
            </a>
            <a href="{{ route('extraccion.create') }}" class="btn btn-info" title="ChartJs">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
                    <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                    <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
                    <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                  </svg> Realizar Extracción
            </a>
            <a href="{{ route('extraccion.index') }}" class="btn btn-primary" title="ChartJs">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-minus" viewBox="0 0 16 16">
                    <path d="M5.5 9.5A.5.5 0 0 1 6 9h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5"/>
                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                  </svg> Listado de Extracciones
            </a>
        </div>
        
        @if (session('alert'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('alert') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif



      
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="tabla-cajas" class="table table-striped nowrap responsive hover display compact" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" class="text-uppercase">fecha_apertura</th>
                            <th scope="col" class="text-uppercase">monto_inicial</th>
                            <th scope="col" class="text-uppercase">fecha_cierre</th>
                            <th scope="col" class="text-uppercase">sumatoria ventas</th>
                            <th scope="col" class="text-uppercase">Status</th>
                            <th scope="col" class="text-uppercase">monto_final</th>
                            <th scope="col" class="text-uppercase">Cantidad_ventas</th>
                            <th scope="col" class="text-uppercase">Egresos</th>
                            <th scope="col" class="text-uppercase">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cajas as $caja)
    <tr>
        <td>{{ $caja->id }}</td>
        <td>{{ $caja->fecha_apertura }}</td>
        <td>{{ $caja->monto_inicial }}</td>
        <td>{{ $caja->fecha_cierre }}</td>
        <td>
            @if (isset($caja->sumatoriaVentas))
                {{ $caja->sumatoriaVentas }}
            @else
                Calculando... <!-- Puedes personalizar el mensaje mientras se calcula -->
            @endif
        </td>
        <td>
            @if ($caja->status === 1)
                <span class="badge bg-info">Abierto</span>
            @else
                <span class="badge bg-danger">Cerrado</span>
            @endif
        </td>
        <td>
            <h6 class="text-success">{{ $caja->monto_final }}</h6>
        </td>
        <td>{{ $caja->cantidadVentas() }}</td>
        <td>
            <span class="text-danger">${{ $caja->extraccion }}</span>
        </td>
        <td>
            <div class="d-flex flex-column">
                <a href="{{ route('caja.show', $caja) }}" class="btn btn-sm btn-info text-white text-uppercase me-1">
                    Ver
                </a>
            </div>
        </td>
    </tr>
@endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Gráfico de Línea -->
    
</div>
@stop

{{-- Importacion de Archivos CSS --}}
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@stop

{{-- Importacion de Archivos JS --}}
@section('js')
<script>
document.addEventListener("DOMContentLoaded", function() {
    new DataTable('#tabla-cajas', {
        responsive: true,
        order: [[0, 'desc']]
    });
});
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener datos para el gráfico
        var labels = [];
        var montosFinales = [];

        @foreach ($cajas as $caja)
            labels.push("{{ $caja->fecha_apertura }}");
            montosFinales.push({{ $caja->monto_final }});
        @endforeach

        // Dibujar el gráfico
        var ctx = document.getElementById('cajasChart').getContext('2d');
        var cajasChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Montos Finales',
                    data: montosFinales,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false,
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day',
                            displayFormats: {
                                day: 'MMM D'
                            }
                        },
                        title: {
                            display: true,
                            text: 'Fecha de Apertura'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Monto Final'
                        }
                    }
                }
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

{{-- La funcion asset() es una funcion de Laravel PHP que nos dirige a la carpeta "public" --}}
<script src="{{ asset('js/cajas.js') }}"></script>
@stop
