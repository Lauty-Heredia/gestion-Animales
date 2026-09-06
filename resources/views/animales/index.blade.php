@extends('layouts.app')

@section('content')
    <div class="form-container">
        <h2>Agregar Nuevo Animal</h2>
        <!-- POST para procesar el almacenamiento de nuevos registros -->
        <form action="/animales" method="POST">
            @csrf <!-- Protección obligatoria para envío de datos -->
            
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="especie">Especie:</label>
                <input type="text" name="especie" required>
            </div>
            <button type="submit">Guardar</button>
        </form>
    </div>

    <h2>Lista de Animales</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Especie</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Iteramos sobre la sesión de animales -->
            @forelse($animales as $id => $animal)
                <tr>
                    <td>{{ $id }}</td>
                    <td>{{ $animal['nombre'] }}</td>
                    <td>{{ $animal['especie'] }}</td>
                    <td>
                        <a href="/animales/{{ $id }}/edit">Editar</a>
                        
                        <!-- DELETE para eliminar registros de la lista -->
                        <form action="/animales/{{ $id }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE') <!-- Directiva explícita de eliminación[cite -->
                            <button type="submit" onclick="return confirm('¿Borrar animal?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay animales registrados en la sesión.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection