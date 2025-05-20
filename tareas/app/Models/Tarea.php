<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $table = 'tbltareas'; // Nombre de la tabla

    protected $fillable = [
        'fecha',
        'hora',
        'titulo',
        'imagen',
        'descripcion',
        'prioridad',
        'lugar',
        'cat_id',
    ];

    public $timestamps = false;

    public function getPrioridadNombreAttribute()
{
    return $this->prioridad == 1 ? 'Alta' : 'Baja';
}

    protected $casts = [
    'fecha' => 'date',            // convierte a instancia Carbon solo con la parte fecha
    'hora'  => 'datetime:H:i',  // convierte a Carbon y formatea hora:minuto:segundo
];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'cat_id');
    }
}
