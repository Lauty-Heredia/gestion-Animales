@extends('layouts.app')

@section('content')
    <div class="form-container">
        <h2>Editar Animal</h2>
        <!-- La acción apunta a la ruta de actualización pasándole el ID -->
        <form action="/animales/{{ $id }}" method="POST">
            @csrf
            <!-- Directiva especial obligatoria para actualizar registros -->
            @method('PUT') 
            
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" value="{{ $animal['nombre'] }}" required>
            </div>
            
            <div class="form-group">
                <label for="especie">Especie:</label>
                <input type="text" name="especie" value="{{ $animal['especie'] }}" required>
            </div>
            
            <button type="submit">Actualizar</button>
            <a href="/animales">Cancelar</a>
        </form>
    </div>
@endsection