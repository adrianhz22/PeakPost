<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="font-sans text-gray-900 antialiased">
<div class="absolute top-4 left-4 z-50">
    <a href="/">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="h-24 w-auto">
    </a>
</div>

<div
    class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ asset('assets/fondo.png') }}')"
>

    <img src="{{ asset('assets/welcome.png') }}" alt="PeakPost" class="w-64 h-64">

    <div
        class="w-full sm:max-w-md px-6 py-4 bg-white/90 dark:bg-gray-800/90 shadow-md overflow-hidden sm:rounded-lg backdrop-blur">
        {{ $slot }}
    </div>
</div>
</body>
</html>
