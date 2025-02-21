<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear post</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
</head>

<body>

<x-navigation/>

<h1>Crear post</h1></br>

<form action="{{ route('store') }}" method="POST">

    @csrf

    <h2>Titulo: </h2><input type="text" name="title">
    <input id="body" type="hidden" name="body">
    <trix-editor input="body"></trix-editor>
    <h2>URL imagen:<input type="text" name="image"></h2>
    <button type="submit">Enviar</button>
</form>

<a href="{{ route('home') }}">Volver</a>

</body>
</html>
