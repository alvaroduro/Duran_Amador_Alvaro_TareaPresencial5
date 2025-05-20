<x-layouts.app>
    <div class="mb-8 flex justify-between items-center">
        <flux:breadcrumbs class="mb-4">
            <flux:breadcrumbs.item href="{{ route('home') }}">Dashboard</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="{{ route('tareas.index') }}">Tareas</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Nueva Tarea</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>

    <div class="card">
        <form action="{{ route('tareas.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf

            <!-- Imagen -->
            <div class="relative mb-2 w-full max-w-md mx-auto">
                <!-- Imagen de referencia por defecto -->
                <img id="imgPreview"
                    class="w-full h-48 object-cover object-center rounded-md shadow-md"
                    src="https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg"
                    alt="img">

                <!-- Cambiar Imagen -->
                <div class="absolute top-2 right-2">
                    <label class="bg-white px-3 py-1 rounded shadow cursor-pointer text-xs hover:bg-gray-100">
                        Cambiar Imagen
                        <input class="hidden" type="file" name="imagen" accept="image/*"
                            onchange="previewImage(event, '#imgPreview')">
                    </label>
                </div>
            </div>

            <!-- Título -->
            <flux:input label="Título" name="titulo" value="{{ old('titulo') }}" placeholder="Escribe el título de la tarea">
            </flux:input>

            <!-- Fecha -->
            <flux:input label="Fecha" name="fecha" type="date" value="{{ old('fecha') }}">
            </flux:input>

            <!-- Hora -->
            <flux:input label="Hora" name="hora" type="time" value="{{ old('hora') }}">
            </flux:input>

            <!-- Descripción (Quill) -->
            <div>
                <p class="font-medium text-sm mb-1">Descripción</p>
                <div id="editor">{!! old('descripcion') !!}</div>
                <textarea class="hidden" name="descripcion" id="descripcion"></textarea>
            </div>

            <!-- Lugar -->
            <flux:input label="Lugar" name="lugar" value="{{ old('lugar') }}" placeholder="Ubicación o lugar de la tarea">
            </flux:input>

            <!-- Categoría -->
            <flux:select label="Categoría" name="cat_id">
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </flux:select>

            <!-- Prioridad -->
           <flux:select label="Prioridad" name="prioridad">
    <option value="1" {{ old('prioridad') == '1' ? 'selected' : '' }}>Alta</option>
    <option value="2" {{ old('prioridad') == '2' ? 'selected' : '' }}>Media</option>
    <option value="3" {{ old('prioridad') == '3' ? 'selected' : '' }}>Baja</option>
</flux:select>


            <!-- Botón -->
            <flux:button class="flex justify-end mt-3" type="submit" variant="primary">Crear Tarea</flux:button>
        </form>
    </div>

    @push('js')
        <script>
            function previewImage(event, selector) {
                const input = event.target;
                const file = input.files[0];
                const preview = document.querySelector(selector);

                if (file && preview) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
        <script>
            const quill = new Quill('#editor', {
                theme: 'snow'
            });

            quill.on('text-change', function() {
                document.querySelector('#descripcion').value = quill.root.innerHTML;
            });
        </script>
    @endpush
</x-layouts.app>
