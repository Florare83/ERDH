<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    // Tu tabla y tu clave primaria no siguen la convención de Laravel
    protected $table = 'eventos';
    protected $primaryKey = 'id_evento';

    // Campos que se pueden cargar en masa
    protected $fillable = [
        'titulo', 'descripcion', 'fecha', 'hora_inicio',
        'hora_fin', 'lugar', 'imagen',
    ];

    // Hace que la fecha salga como 2026-09-27 en el JSON
    protected $casts = [
        'fecha' => 'date:Y-m-d',
    ];

    // created_at y updated_at ya existen en tu tabla: Eloquent los maneja solo
}