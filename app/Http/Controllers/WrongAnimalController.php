<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnimalDataRequest;

class WrongAnimalController extends Controller
{
    public function index()
    {
        $animales = session('animales', []);
        
        return view('animales.index', compact('animales'));
    }

    public function store(AnimalDataRequest $request)
    {
        $validatedData = $request->validated();
        // Recuperaramos la lista actual
        $animales = session('animales', []);
        // Generamos un ID
        $nuevoId = count($animales) > 0 ? max(array_keys($animales)) + 1 : 1;
        // Agregamos el unevo animal
        $animales[$nuevoId] = $validatedData;
        // Sobrescribimos la sesión con la lista actualizada
        session(['animales' => $animales]);
        
        return redirect('/');
    }

    public function edit($id)
    {
        $animales = session('animales', []);
        
        // Si el ID no existe en la sesión, volvemos a la lista
        if (!isset($animales[$id])) {
            return redirect('/');
        }
        
        $animal = $animales[$id];
        return view('animales.edit', compact('animal', 'id'));
    }

    public function update(AnimalDataRequest $request, $id)
    {
        $animales = session('animales', []);
        if (isset($animales[$id])) {
            $animales[$id]['nombre'] = $request->input('nombre');
            $animales[$id]['especie'] = $request->input('especie');
            // Guardamos el arreglo actualizado en la sesión
            session(['animales' => $animales]);
        }
        $animales[$id] = $request->validated();
        return redirect('/');
    }

    public function destroy($id)
    {
        $animales = session('animales', []);
        
        if (isset($animales[$id])) {
            // Eliminamos el registro del arreglo
            unset($animales[$id]); 
            session(['animales' => $animales]);
        }
        
        return redirect('/');
    }
    
    public function reset()
    {
        // Limpiamos la sesión
        session()->forget('animales');
        
        return redirect('/');
    }
}

