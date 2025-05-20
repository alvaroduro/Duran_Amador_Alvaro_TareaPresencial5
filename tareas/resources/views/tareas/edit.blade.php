<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('home') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('tareas.index') }}">Tareas</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Editar Tarea</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <form id="form-editar" action="{{ route('tareas.update', $tarea) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card space-y-4">

            <flux:input label="Título" name="titulo" value="{{ old('titulo', $tarea->titulo) }}" placeholder="Escribe el título de la tarea" />

            <!-- Categoría -->
            <flux:select label="Categoría" name="cat_id" placeholder="Selecciona una categoría">
                @foreach ($categorias as $categoria)
                    <flux:select.option value="{{ $categoria->id }}" :selected="$categoria->id == old('cat_id', $tarea->cat_id)">
                        {{ $categoria->nombre }}
                    </flux:select.option>
                @endforeach
            </flux:select>

            <!-- Fecha -->
            <flux:input type="date" name="fecha" label="Fecha" value="{{ old('fecha', $tarea->fecha->format('Y-m-d')) }}" />

            <!-- Hora -->
            <flux:input type="time" name="hora" label="Hora" value="{{ old('hora', $tarea->hora->format('H:i')) }}" />

            <<!-- Prioridad -->
            <flux:select label="Prioridad" name="prioridad">
                <flux:select.option value="1" :selected="old('prioridad', $tarea->prioridad) == 1">Alta</flux:select.option>
                <flux:select.option value="2" :selected="old('prioridad', $tarea->prioridad) == 2">Media</flux:select.option>
                <flux:select.option value="3" :selected="old('prioridad', $tarea->prioridad) == 3">Baja</flux:select.option>
            </flux:select>


            <!-- Lugar -->
            <flux:input label="Lugar" name="lugar" value="{{ old('lugar', $tarea->lugar) }}" placeholder="Escribe el lugar de la tarea" />

            <!-- Descripción (con Quill) -->
            <div>
                <p class="font-medium text-sm mb-1">Descripcion</p>
                <div id="editor">{!! old('descripcion', $tarea->descripcion) !!}</div>
                <textarea class="hidden" name="descripcion" id="descripcion"></textarea>
            </div>

            <!-- Imagen (sin uso aún) -->
            <flux:input type="file" label="Imagen" name="imagen" />

            <!-- Botones -->
            <div class="flex justify-end gap-3 mt-4">
                <a href="{{ route('tareas.index') }}" class="px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg shadow">
                    Cancelar
                </a>
                <flux:button type="submit" variant="primary">Guardar Cambios</flux:button>
            </div>
        </div>
    </form>

    @push('js')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script>
        const quill = new Quill('#editor', { theme: 'snow' });
        quill.on('text-change', function () {
            document.querySelector('#descripcion').value = quill.root.innerHTML;
        });
    </script>
    <script>
    document.getElementById('form-editar').addEventListener('submit', function (e) {
        e.preventDefault(); // Detiene el envío
        Swal.fire({
            title: '¿Guardar cambios?',
            text: "La tarea se actualizará en nuestra base de datos.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                e.target.submit(); // Envío real del formulario
            }
        });
    });
</script>

    @endpush
</x-layouts.app>

