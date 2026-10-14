@extends('layouts.app')

@section('content')
    <div class="form-container">
        <h2>Editar Animal</h2>
        <!-- La acción apunta a la ruta de actualización pasándole el ID -->
        <form action="/{{ $id }}" method="POST">
            @csrf
            <!-- Directiva especial obligatoria para actualizar registros -->
            @method('PUT') 
            
             <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="{{ $animal['nombre'] }}" required>
                @error('nombre')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="especie">Especie:</label>
                <input type="text" name="especie" value="{{ $animal['especie'] }}" required>
                @error('especie')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
             <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="text" name="edad" value="{{ $animal['edad'] }}" required>
                @error('edad')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit">Actualizar</button>
            <a href="/">Cancelar</a>
        </form>
    </div>
@endsection