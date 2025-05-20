<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    /** @use HasFactory<\Database\Factories\CategoriaFactory> */
    use HasFactory;

    protected $table = 'tblcategoria'; // Nombre de la tabla
    // Permitimos la inserciion masiva
    protected $fillable = [
        'nombre',
        'imagen'
    ];

    // Definir la relación inversa
    public function tarea()
    {
        return $this->hasMany(Tarea::class, 'cat_id');//relaciones
    }

}

