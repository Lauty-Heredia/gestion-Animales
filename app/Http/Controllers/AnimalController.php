<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {
        $animales = session('animales', []);
        
        return view('animales.index', compact('animales'));
    }

    public function store(Request $request)
    {
        // Recuperaramos la lista actual
        $animales = session('animales', []);
        
        // Generamos un ID
        $nuevoId = count($animales) > 0 ? max(array_keys($animales)) + 1 : 1;
        
        // Agregamos el unevo animal
        $animales[$nuevoId] = [
            'nombre' => $request->input('nombre'),
            'especie' => $request->input('especie')
        ];
        
        // Sobrescribimos la sesión con la lista actualizada
        session(['animales' => $animales]);
        
        return redirect('/animales');
    }
}

