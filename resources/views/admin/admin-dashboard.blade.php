<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion</title>
    @vite(['resources/css/app.css'])
</head>

<body>
<x-navigation/>

@foreach($users as $user)

    <h2>{{ $user->name }}</h2>
    <p>{{ $user->email }}</p>

    <form action="{{ route('admin.destroy', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar</button>
    </form></br>

@endforeach

</body>
</html>
