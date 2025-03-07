<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Crear post</title>

    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])

    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-gpx/dist/leaflet-gpx.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>

</head>

<body class="bg-gray-100">

<x-navigation/>

<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Crear Post</h1>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-700 font-medium">Imagen de portada</label>
            <div class="dropzone border-dashed border-2 border-gray-300 rounded-lg p-4 text-center bg-gray-50"
                 id="imagenDropzone">
            </div>
            <input type="hidden" name="image">
        </div>
        @error('image')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <div>
            <label for="title" class="block text-gray-700 font-medium">Título</label>
            <input type="text" id="title" name="title" required
                   class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-300">
        </div>
        @error('title')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <div>
            <label for="body" class="block text-gray-700 font-medium">Contenido</label>
            <input id="body" type="hidden" name="body">
            <trix-editor input="body" class="w-full border border-gray-300 rounded-lg p-2 mt-1"></trix-editor>
        </div>
        @error('body')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <label for="province">Provincia:</label>
        <select id="province" name="province">
            <option value="">Selecciona una provincia</option>
            <option value="Murcia">Murcia</option>
            <option value="Alicante">Alicante</option>
            <option value="Albacete">Albacete</option>
        </select>
        @error('province')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <label for="difficulty">Dificultad:</label>
        <select id="difficulty" name="difficulty">
            <option value="">Selecciona una dificultad</option>
            <option value="Facil">Facil</option>
            <option value="Moderado">Moderado</option>
            <option value="Dificil">Dificil</option>
        </select>
        @error('difficulty')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <label for="longitude">Longitud (km):</label>
        <input type="number" id="longitude" name="longitude" step="0.01">
        @error('longitude')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <label for="altitude">Altitud (m):</label>
        <input type="number" id="altitude" name="altitude">
        @error('altitude')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <label for="time">Duracion:</label>
        <input type="time" id="time" name="time" step="1">
        @error('time')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <label for="track">Subir track:</label>
        <input type="file" id="track" name="track" accept=".kml">
        @error('track')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <button type="submit">
            Publicar
        </button>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="text-blue-500 hover:underline">Volver al inicio</a>
    </div>
</div>

</body>
</html>
