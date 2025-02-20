<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear post</title>
    @vite(['resources/css/app.css'])
</head>

<body>

<h1>Crear post</h1></br>

<form action="{{ route('store') }}" method="POST">

    @csrf

    <h2>Titulo: </h2><input type="text" name="title">
    <h2>Contenido: <textarea name="body"></textarea></h2>
    <h2>URL imagen:<input type="text" name="image"></h2>
    <button type="submit">Enviar</button>
</form>

<a href="{{ route('home') }}">Volver</a>

</body>
</html>
