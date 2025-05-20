<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tarea;

class SearchController extends Controller
{

    // Método para autocompletar entradas (posts) según su título
    public function buscartareas(Request $request)
    {
        // Se obtiene el término que el usuario ha escrito en el input de búsqueda
        $term = $request->input('term');

        // Se buscan las entradas cuyo título contenga el término (LIKE %term%)
        $tareas = Tarea::where('titulo', 'LIKE', '%' . $term . '%')->get();

        $data = [];

        // Se recorren los resultados y se preparan para el autocompletado
        foreach ($tareas as $tarea) {
            $data[] = [
                'label' => $tarea->titulo, // lo que se muestra como sugerencia
                'value' => $tarea->titulo, // lo que se coloca en el input al seleccionar
                'id' => $tarea->id,        // ID por si se quiere usar
            ];
        }

        // Se devuelven los resultados como JSON
        return response()->json($data);
    }
}
