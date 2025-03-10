<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Editar Post</title>

    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-kml/1.1.0/leaflet-kml.js"></script>
</head>

<body class="bg-gray-100">
<x-navigation/>

<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-10">
    <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Editar Post</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label class="block font-semibold text-gray-700">Imagen Actual:</label>
            <img src="{{ $post->image }}" class="w-full h-64 object-cover rounded-lg mt-2">
        </div>

        <div class="dropzone border-2 border-dashed p-6 text-center mb-6" id="imagenDropzone">
        </div>
        <input type="hidden" name="image">
        @error('image')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <div class="mb-4">
            <label for="title" class="block font-semibold text-gray-700">Título:</label>
            <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mt-2"
                   required>
            @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="body" class="block font-semibold text-gray-700">Contenido:</label>
            <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
            <trix-editor input="body" class="w-full mt-2 border border-gray-300 rounded-lg"></trix-editor>
            @error('body')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">

            <div>
                <label for="province" class="block font-semibold text-gray-700">Provincia:</label>
                <select name="province" id="province"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mt-2">
                    <option value="">Selecciona una provincia</option>
                    @foreach($provinces as $province)
                        <option
                            value="{{ $province }}" {{ old('province', $post->province) == $province ? 'selected' : '' }}>
                            {{ $province }}
                        </option>
                    @endforeach
                </select>
                @error('province')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="difficulty" class="block font-semibold text-gray-700">Dificultad:</label>
                <select name="difficulty" id="difficulty"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mt-2">
                    <option value="">Selecciona una dificultad</option>
                    @foreach($difficulties as $difficulty)
                        <option
                            value="{{ $difficulty }}" {{ old('difficulty', $post->difficulty) == $difficulty ? 'selected' : '' }}>
                            {{ $difficulty }}
                        </option>
                    @endforeach
                </select>
                @error('difficulty')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="longitude" class="block font-semibold text-gray-700">Longitud (km):</label>
                <input type="number" name="longitude" id="longitude" step="0.01"
                       value="{{ old('longitude', $post->longitude) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mt-2">
                @error('longitude')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="altitude" class="block font-semibold text-gray-700">Altitud (m):</label>
                <input type="number" name="altitude" id="altitude" value="{{ old('altitude', $post->altitude) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mt-2">
                @error('altitude')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="time" class="block font-semibold text-gray-700">Duración:</label>
                <input type="time" name="time" id="time" step="1" value="{{ old('time', $post->time) }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 mt-2">
                @error('time')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="track" class="block font-semibold text-gray-700">Subir track (KML):</label>
            <input type="file" name="track" id="track" accept=".kml"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg mt-2">
            @error('track')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block font-semibold text-gray-700">Vista del Mapa:</label>
            <div id="map" style="height: 400px;" class="rounded-lg"></div>
        </div>

        <button type="submit"
                class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg mt-6 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Guardar Cambios
        </button>
    </form>

    <a href="{{ route('home') }}"
       class="block text-center mt-6 text-gray-500 hover:underline focus:outline-none focus:ring-2 focus:ring-blue-500">
        Volver
    </a>
</div>

<script>

    var map = L.map('map').setView([40.4168, -3.7034], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    document.getElementById('track').addEventListener('change', function (event) {
        var file = event.target.files[0];
        if (file && file.name.endsWith('.kml')) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var kmlLayer = new L.KML(e.target.result);
                map.addLayer(kmlLayer);
                map.fitBounds(kmlLayer.getBounds());
            };
            reader.readAsText(file);
        }
    });
</script>
</body>

</html>
