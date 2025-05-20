<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Categoria;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tareas = Tarea::with('categoria')->orderBy('fecha', 'desc')->paginate(4);
        // dd($tareas->toArray());
        return view('tareas.index', compact('tareas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('tareas.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datos = $request->validate([
            'titulo' => 'required|string|min:1|max:191',
            'cat_id' => 'required|exists:tblcategoria,id',
            'fecha' => 'required|date',
            'hora' => 'required',
            'prioridad' => 'required|in:1,2',
            'lugar' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|max:2048',
        ], [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.string' => 'El título debe ser una cadena de texto.',
            'titulo.min' => 'El título debe tener al menos 1 carácter.',
            'titulo.max' => 'El título no puede tener más de 191 caracteres.',

            'cat_id.required' => 'La categoría es obligatoria.',
            'cat_id.exists' => 'La categoría seleccionada no existe.',

            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha no tiene un formato válido.',

            'hora.required' => 'La hora es obligatoria.',

            'prioridad.required' => 'La prioridad es obligatoria.',
    
            'lugar.string' => 'El lugar debe ser una cadena de texto.',
            'lugar.max' => 'El lugar no puede tener más de 255 caracteres.',

            'descripcion.string' => 'La descripción debe ser una cadena de texto.',

            'imagen.image' => 'El archivo debe ser una imagen válida.',
            'imagen.max' => 'La imagen no puede superar los 2MB.',
        ]);

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('tareas', 'public');
        }

        $tarea = Tarea::create($datos);

        // Mensaje de éxito sweetalert
        session()->flash('swa1', [
            'icon' => 'success',
            'tittle' => '¡Bien hecho!',
            'text' => 'Entrada "' . $tarea->titulo . '" creada correctamente.'
        ]);
        return redirect()->route('tareas.index', $tarea);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarea $tarea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tarea $tarea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarea $tarea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea)
    {
        //
    }
}
