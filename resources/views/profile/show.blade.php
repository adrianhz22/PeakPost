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

<div>
    <img src="{{ asset('storage/' . $user->profile_photo) }}" width="150" height="150">
</div>

<strong>Nombre:</strong> {{ $user->name }}
<strong>Email:</strong> {{ $user->email }}
<strong>Fecha de creacion:</strong> {{ $user->created_at->format('d/m/Y') }}

<form action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data">
    @csrf
    Actualizar foto: <input type="file" name="profile_photo">
    <button type="submit">Subir foto</button>
</form>

</body>
</html>
