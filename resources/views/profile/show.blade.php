<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi perfil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script> <!-- Librería de iconos -->
</head>

<body class="bg-gray-100 text-gray-900">

<x-navigation/>

<div class="max-w-lg mx-auto mt-12 p-8 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-semibold text-center text-gray-800 mb-6">Perfil de Usuario</h1>

    <div class="relative flex flex-col items-center mb-6">

        <form action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf

            <input type="file" name="profile_photo" id="fileInput" class="hidden"
                   onchange="document.getElementById('uploadForm').submit();">

            <div class="relative group w-32 h-32 cursor-pointer" onclick="document.getElementById('fileInput').click()">
                <img
                    @if ($user->profile_photo)
                        src="{{ asset('storage/' . $user->profile_photo) }}"
                    @else
                        src="{{ asset('assets/default-photo.jpg') }}"
                    @endif
                    alt="Foto de perfil"
                    class="w-32 h-32 rounded-full border border-gray-300 shadow-sm">

                <div
                    class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-full opacity-0 group-hover:opacity-100 transition">
                    <i data-lucide="pencil" class="text-white w-6 h-6"></i>
                </div>
            </div>
        </form>
    </div>

    <div class="space-y-4 text-gray-700">
        <p><strong class="font-medium">Nombre:</strong> {{ $user->name }}</p>
        <p><strong class="font-medium">Email:</strong> {{ $user->email }}</p>
        <p><strong class="font-medium">Fecha de creación:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
    </div>

    <div class="mt-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Logros desbloqueados</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($user->achievements as $achievement)
                <div class="text-center bg-gray-50 p-4 rounded-lg shadow-md">
                    <img src="{{ asset($achievement->image) }}" alt="{{ $achievement->name }}"
                         class="w-20 h-20 object-cover mx-auto mb-2">
                    <p class="text-sm text-gray-500">{{ $achievement->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
</script>

</body>
</html>
