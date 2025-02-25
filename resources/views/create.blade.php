<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Crear post</title>

    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script>

</head>

<body class="bg-gray-100">

<x-navigation/>

<div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Crear Post</h1>

    <form action="{{ route('store') }}" method="POST" class="space-y-4">
        @csrf

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

        <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition">
            Publicar
        </button>
    </form>

    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="text-blue-500 hover:underline">Volver al inicio</a>
    </div>
</div>

</body>
</html>

