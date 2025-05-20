<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('home') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Tareas</flux:breadcrumbs.item>
        </flux:breadcrumbs>

        <!-- Botón ver registros de logs -->
        {{-- <a href="{{ route('admin.logs.index') }}" class="btn btn-slate text-xs">Ver Logs</a> --}}

        <!--Boton nueva categoria-->
        <a href="{{ route('tareas.create') }}" class="btn btn-blue text-xs">Nueva Tarea</a>

    </div>

    <!--Formulario de busqueda entradas por titulo-->
    {{-- <form action="" class="flex justify-center mt-10 mb-4">
        <div class="flex w-full max-w-md bg-slate-800 rounded-xl overflow-hidden shadow-lg">
            <input type="text"
            class="flex-1 px-4 py-2 bg-slate-900 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500"
            placeholder="Buscar Entradas" name="search" id="search" aria-label="Search"
            value="{{ request('search') }}" />

            <button type="button" id="btn-buscar"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 text-sm font-semibold transition-all">
                Buscar
            </button>
        </div>
    </form> --}}

    <h1 class="text-center text-3xl mb-2">Listado de Tareas</h1>

    <!--Busqueda por fecha-->
    {{-- <form action="{{ route('tareas.filtrarPorFecha') }}" method="GET" class="flex items-center gap-2 mb-4">
        <label for="fecha" class="font-medium">Buscar por fecha:</label>
        <input type="date" name="fecha" id="fecha" value="{{ request('fecha') }}" class="border p-1 rounded text-sm" required>
        <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-sm">Buscar</button>
    </form> --}}

    <!--Si existe fecha-->
    {{-- @if (isset($fecha))
        <p class="text-sm text-gray-600 mb-2">Resultados para el día <strong>{{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}</strong></p>
    @endif
    @if ($tareas->isEmpty())
        <p class="text-gray-500">No hay tareas para esta fecha.</p>
    @endif

    <!--Filtramos por estados tareas-->
    @if (isset($filtro))
        <h2 class="mb-4 text-xl font-semibold">
            @if ($filtro === 'completadas')
                Tareas Completadas
            @elseif ($filtro === 'pendientes')
                Tareas Pendientes
            @endif
        </h2>
    @endif --}}
    <!-- Botones de navegación para filtrar por estado-->
    {{-- <div class="mb-4 space-x-2">
        <a href="{{ route('tareas.completadas') }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Tareas Completadas</a>
        <a href="{{ route('tareas.pendientes') }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Tareas Pendientes</a>
        <a href="{{ route('tareas.index') }}" class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600">Todas las tareas</a>
    </div>

    <!--Exportar pdfs de todas las tareas-->
    <a target="_blanc" href="{{ route('tareas.exportarPdf') }}" 
   class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 text-sm mb-4 inline-block">
    Descargar PDF completo
</a> --}}


    <!--TABLA DE ENTRADAS-->
    <div class="relative overflow-x-auto mb-3">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        FECHA
                    </th>
                    <th scope="col" class="px-6 py-3">
                        HORA
                    </th>
                    <th scope="col" class="px-6 py-3">
                        TITULO
                    </th>
                    <th scope="col" class="px-6 py-3">
                        IMAGEN
                    </th>
                    <th scope="col" class="px-6 py-3">
                        OBSERVACIONES
                    </th>
                    <th scope="col" class="px-6 py-3">
                        DESCRIPCION
                    </th>
                    <th scope="col" class="px-6 py-3">
                        LUGAR
                    </th>
                    <th scope="col" class="px-6 py-3">
                        CATEGORIA
                    </th>
                    {{-- <th>
                        <a href="{{ route('admin.entradas.index', ['orden' => $ordenTipo === 'asc' ? 'desc' : 'asc']) }}">
                            Fecha Publicación
                            {!! $ordenTipo === 'asc' ? '🔼' : '🔽' !!}
                        </a>
                    </th> --}}
                    <th scope="col" class="px-6 py-3" width="10px">
                        OPERACIONES
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tareas as $tarea)
                
                    <!-- FILA CATEGORIA -->
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $tarea->id }}
                        </th>
                        <!-- COLUMNAS CATEGORIAS DATOS -->
                        <td class="px-6 py-4 max-w-xs break-words whitespace-normal">
                            {{ $tarea->fecha->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 max-w-xs break-words whitespace-normal">
                            {{ $tarea->hora->format('H:i') }}
                        </td>
                        <td class="px-6 py-4  max-w-xs break-words whitespace-normal">
                            {{-- {!! $tarea->descripcion !!} --}}
                            {{ $tarea->titulo }}
                        </td>
                        <td class="px-6 py-4  max-w-xs break-words whitespace-normal">
                                {{-- @if($entrada->imagen && file_exists(public_path('storage/' . $entrada->imagen)))
                                    <img src="{{ asset('storage/' . $entrada->imagen) }}" alt="" width="50" height="50" />
                                @else
                                    <img src="{{ asset('img/noimage.jpeg') }}" alt="Sin imagen" width="50" height="50" />
                                @endif --}}
                                {{ $tarea->imagen }}
                        </td> 
                        <td class="px-6 py-4 max-w-xs break-words whitespace-normal">
                            {{-- {!! $tarea->descripcion !!} --}}
                            {!! $tarea->descripcion !!}
                        </td>
                        <td class="px-6 py-4  max-w-xs break-words whitespace-normal">
                            {{ $tarea->prioridad_nombre }}
                        </td>
                        <td class="px-6 py-4  max-w-xs break-words whitespace-normal">
                            {{ $tarea->lugar }}
                        </td>
                        <td class="px-6 py-4 max-w-xs break-words whitespace-normal">
                            {{ $tarea->categoria->nombre }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">

                                <!-- Boton EDITAR TAREA -->
                                <a class="btn btn-blue rounded-1 text-xs"
                                    href="{{ route('tareas.edit', $tarea) }}"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11.5A1.5 1.5 0 005.5 20H17a2 2 0 002-2v-5M16 3a2.828 2.828 0 114 4L12 15l-4 1 1-4L16 3z" />
                                </svg></a>

                                <!-- Boton ELIMINAR TAREA -->
                                <form class="delete-form" action="{{ route('tareas.destroy', $tarea) }}"
                                    method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-red rounded-1 text-xs"
                                        href="{{ route('tareas.destroy', $tarea) }}"><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg></button>
                                    <!-- Boton DETALLE categoria -->                              
                                </form>

                                <!-- Boton DETALLE TAREA -->
                                <a class="btn btn-purple rounded-1 text-xs"
                                    href="{{ route('tareas.show', $tarea) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                                </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- PAGINACION -->
    <div class="mt-4">
        {{ $tareas->links() }}
    </div>

    @push('js')
        <script>
            //Seleccionamos todos los formularios de eliminar
            forms = document.querySelectorAll('.delete-form');
            //Recorremos todos los formularios  
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    //Evitar el comportamiento por defecto del formulario
                    e.preventDefault();

                    //Mostramos la alerta de confirmacion
                    Swal.fire({
                        title: '¿Estás seguro que deseas eliminar?',
                        text: "No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminar!',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            //Si el usuario confirma, enviamos el formulario
                            form.submit();
                        }
                    });
                });
            });
        </script>
        {{-- <script src="{{ asset('vendor/jquery-ui/jquery-ui-1.14.1/jquery-ui.min.js') }}"></script>
        <!--Busqueda entradas autocompletado-->
        <script>
            // Cuando se carga la página, se activa el autocompletado en el input con id "search"
            $('#search').autocomplete({
                // source define cómo se van a obtener los resultados del autocompletado
                source: function(request, response) {
                    // Se hace una petición AJAX al servidor para buscar coincidencias
                    $.ajax({
                        url: "{{ route('admin.entradas.buscar') }}", // Ruta que devuelve los datos (en formato JSON)
                        data: {
                            term: request.term // Se envía lo que el usuario está escribiendo en el input
                        },
                        dataType: "json", // Se espera una respuesta en formato JSON
                        success: function(data) {
                            // Si la petición es exitosa, se ejecuta esta función
                            // 'data' debe ser un array de objetos con propiedades 'label' y 'value'
                            response(data); // Se muestran los resultados en la lista de autocompletado
                        }
                    });
                },
                // select se ejecuta cuando el usuario selecciona una opción de la lista
                select: function(event, ui) {
                    // Redirige a la página de resultados, agregando el valor seleccionado en la URL como parámetro de búsqueda
                    window.location.href = "{{ route('admin.entradas.index') }}" + "?search=" + ui.item.value;
                }
            });
        
            // Si el usuario hace clic en el botón con id "btn-buscar"
            $('#btn-buscar').on('click', function() {
                // Se obtiene el valor escrito en el input de búsqueda
                const valor = $('#search').val();
                // Se redirige a la página de resultados con el parámetro search en la URL
                window.location.href = "{{ route('admin.entradas.index') }}" + "?search=" + valor;
            });
        </script> --}}
    @endpush

</x-layouts.app>
