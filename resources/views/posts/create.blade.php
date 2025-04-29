<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Create post') }}</title>

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
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">{{ __('Create post') }}</h1>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <x-dropzone name="image" label="{{ __('Cover image') }}"/>
        <x-input-error :messages="$errors->get('image')" class="mt-2"/>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium">{{ __('Title') }}</label>
            <x-input name="title" type="text" required/>
            <x-input-error :messages="$errors->get('title')" class="mt-2"/>
        </div>

        <div class="mb-4">
            <x-trix-editor name="body" label="{{ __('Content') }}"/>
            <x-input-error :messages="$errors->get('body')" class="mt-2"/>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-select name="province" label="{{ __('Province') }}" :options="$provinces"
                          placeholder="{{ __('Select a province') }}"/>
                <x-input-error :messages="$errors->get('province')" class="mt-2"/>
            </div>

            <div>
                <x-select name="difficulty" label="{{ __('Difficulty') }}" :options="['Easy', 'Medium', 'Hard']"
                          placeholder="{{ __('Select a difficulty') }}"/>
                <x-input-error :messages="$errors->get('difficulty')" class="mt-2"/>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 font-medium">{{ __('Longitude') }}</label>
                <x-input name="longitude" type="number"/>
                <x-input-error :messages="$errors->get('longitude')" class="mt-2"/>
            </div>

            <div>
                <label class="block text-gray-700 font-medium">{{ __('Altitude') }}</label>
                <x-input name="altitude" type="number"/>
                <x-input-error :messages="$errors->get('altitude')" class="mt-2"/>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="time" class="block text-gray-700 font-medium">{{ __('Duration') }}</label>
                <input type="time" id="time" name="time" step="1"
                       class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-300"/>
                <x-input-error :messages="$errors->get('time')" class="mt-2"/>
            </div>

            <div>
                <label for="track" class="block text-gray-700 font-medium">{{ __('Upload track') }} (.kml)</label>
                <input type="file" id="track" name="track" accept=".kml"
                       class="w-full border border-gray-300 rounded-lg p-2 mt-1 focus:ring focus:ring-blue-300"/>
                <x-input-error :messages="$errors->get('track')" class="mt-2"/>
            </div>
        </div>

        <x-button>{{__('Publish')}}</x-button>

    </form>

    <div class="text-center mt-6">
        <a href="{{ route('home') }}" class="text-blue-500 hover:underline">{{ __('Back to home') }}</a>
    </div>
</div>

</body>
</html>
