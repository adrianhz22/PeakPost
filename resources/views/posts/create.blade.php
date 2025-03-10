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

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Crear Post</h1>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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
                   class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-300 focus:outline-none">
        </div>
        @error('title')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <div>
            <label for="body" class="block text-gray-700 font-medium">Contenido</label>
            <input id="body" type="hidden" name="body">
            <trix-editor input="body" class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-300"></trix-editor>
        </div>
        @error('body')
        <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="province" class="block text-gray-700 font-medium">Provincia</label>
                <select id="province" name="province" class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-300">
                    <option value="">Selecciona una provincia</option>
                    @foreach($provinces as $province)
                        <option value="{{ $province }}">{{ $province }}</option>
                    @endforeach
                </select>
                @error('province')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="difficulty" class="block text-gray-700 font-medium">Dificultad</label>
                <select id="difficulty" name="difficulty" class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-300">
                    <option value="">Selecciona una dificultad</option>
                    <option value="Facil">Facil</option>
                    <option value="Moderado">Moderado</option>
                    <option value="Dificil">Dificil</option>
                </select>
                @error('difficulty')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="longitude" class="block text-gray-700 font-medium">Longitud (km)</label>
                <input type="number" id="longitude" name="longitude" step="0.01"
                       class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-300">
                @error('longitude')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="altitude" class="block text-gray-700 font-medium">Altitud (m)</label>
                <input type="number" id="altitude" name="altitude"
                       class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-300">
                @error('altitude')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="time" class="block text-gray-700 font-medium">Duración</label>
                <input type="time" id="time" name="time" step="1"
                       class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-300">
                @error('time')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="track" class="block text-gray-700 font-medium">Subir track (KML)</label>
                <input type="file" id="track" name="track" accept=".kml"
                       class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-300">
                @error('track')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg mt-6 hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-500">
            Publicar
        </button>
    </form>

    <div class="text-center mt-6">
        <a href="{{ route('home') }}" class="text-blue-500 hover:underline">Volver al inicio</a>
    </div>
</div>

</body>
</html>

