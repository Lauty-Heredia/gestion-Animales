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

    public function edit($id)
    {
        $animales = session('animales', []);
        
        // Si el ID no existe en la sesión, volvemos a la lista
        if (!isset($animales[$id])) {
            return redirect('/animales');
        }
        
        $animal = $animales[$id];
        return view('animales.edit', compact('animal', 'id'));
    }

    public function update(Request $request, $id)
    {
        $animales = session('animales', []);
        
        if (isset($animales[$id])) {
            $animales[$id]['nombre'] = $request->input('nombre');
            $animales[$id]['especie'] = $request->input('especie');
            
            // Guardamos el arreglo actualizado en la sesión
            session(['animales' => $animales]);
        }
        
        return redirect('/animales');
    }

    public function destroy($id)
    {
        $animales = session('animales', []);
        
        if (isset($animales[$id])) {
            // Eliminamos el registro del arreglo
            unset($animales[$id]); 
            session(['animales' => $animales]);
        }
        
        return redirect('/animales');
    }
}

