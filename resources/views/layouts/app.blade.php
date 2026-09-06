<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Animales</title>
    <style>
        /* Estilos básicos para la aplicación */
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-container { margin-bottom: 30px; padding: 15px; border: 1px solid #ccc; }
        .form-group { margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #aaa; padding: 10px; text-align: left; }
    </style>
</head>
<body>
    <header>
        <h1>Sistema de Gestión de Animales</h1>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>