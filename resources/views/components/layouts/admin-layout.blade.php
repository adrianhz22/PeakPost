<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Administracion' }}</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100 text-gray-900">

<x-navigation />

<div class="flex h-screen">
    <aside class="w-1/6 bg-gray-800 text-white p-5">
        <h2 class="text-xl font-bold mb-4">Panel</h2>
        <ul>
            <li class="mb-3"><a href="{{ route('admin.dashboard') }}" class="hover:text-gray-400">Dashboard</a></li>
            <li class="mb-3"><a href="{{ route('admin.users') }}" class="hover:text-gray-400">Usuarios</a></li>
            <li class="mb-3"><a href="{{ route('admin.posts') }}" class="hover:text-gray-400">Posts pendientes</a></li>
        </ul>
    </aside>

    <main class="w-4/5 p-6">
        {{ $slot }}
    </main>
</div>

</body>
</html>
