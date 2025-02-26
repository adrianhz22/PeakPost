<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mi perfil</title>

</head>

<body>

<x-navigation/>

<h1>Perfil de Usuario</h1>

<strong>Nombre:</strong> {{ $user->name }}
<strong>Email:</strong> {{ $user->email }}
<strong>Fecha de creacion:</strong> {{ $user->created_at->format('d/m/Y') }}


</body>
</html>
