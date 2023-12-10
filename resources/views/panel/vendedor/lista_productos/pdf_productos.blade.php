<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte PDF</title>
    <link rel="stylesheet" href="{{ public_path('vendor/adminlte/dist/css/adminlte.min.css') }}">
</head>
<body>
    <h2 class="text-danger text-center">PIMP</h2>
    <h3 class="text-center">Productos</h3>
    <table class="table table-striéd w-100">
        <thead class="bg-danger text-center text-white">
            <tr>
                <th scope="col" class="text-uppercase">Id</th>
                <th scope="col" class="text-uppercase">Nombre</th>
                <th scope="col" class="text-uppercase">Descripcion</th>
                <th scope="col" class="text-uppercase">Precio</th>
                <th scope="col" class="text-uppercase">Categoria</th>
                <th scope="col" class="text-uppercase">Cantidad</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td class="text-bold">{{ $producto->nombre }}</td>
                <td>{{ Str::limit($producto->descripcion, 30)}}</td>
                <td class="text-bold">{{ $producto->precio }}</td>
                <td>{{ $producto->categoria->nombre }}</td>
                <td class="text-danger">{{ $producto->cantidad }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>