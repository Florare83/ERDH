<?php

namespace App\Http\Controllers;

use App\Models\Evento;

class EventoController extends Controller
{
    // Página HTML con el listado
    public function index()
    {
        $eventos = Evento::orderBy('fecha')->orderBy('hora_inicio')->get();

        return view('eventos.index', ['eventos' => $eventos]);
    }

    // Endpoint JSON (API simple)
    public function api()
    {
        return response()->json(
            Evento::orderBy('fecha')->orderBy('hora_inicio')->get()
        );
    }
}