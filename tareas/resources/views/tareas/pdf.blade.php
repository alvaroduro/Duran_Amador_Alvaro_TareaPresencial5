<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Listado de Tareas</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
        img { max-width: 50px; max-height: 50px; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Listado completo de Tareas</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Categoría</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Prioridad</th>
                <th>Lugar</th>
                <th>Descripción</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tareas as $tarea)
            <tr>
                <td>{{ $tarea->id }}</td>
                <td>{{ $tarea->titulo }}</td>
                <td>{{ $tarea->categoria->nombre ?? 'Sin categoría' }}</td>
                <td>{{ \Carbon\Carbon::parse($tarea->fecha)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($tarea->hora)->format('H:i') }}</td>
                <td>{{ ucfirst($tarea->prioridad) }}</td>
                <td>{{ $tarea->lugar }}</td>
                <td>{!! $tarea->descripcion !!}</td>
                <td>
                    @if($tarea->imagen && file_exists(public_path('storage/' . $tarea->imagen)))
                        <img src="{{ public_path('storage/' . $tarea->imagen) }}" alt="Imagen tarea" />
                    @else
                        No imagen
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
