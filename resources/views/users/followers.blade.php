<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seguidores de {{ $user->username }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">

<x-navigation/>

<div class="max-w-3xl mx-auto mt-12 p-8 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-semibold text-center text-gray-800 mb-6">
        Seguidores de {{ $user->username }}
    </h1>

    <div class="space-y-4">
        @foreach($followers as $follower)
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 rounded-full overflow-hidden">
                    <img
                        src="{{ $follower->profile_photo ? asset($follower->profile_photo) : asset('assets/default-photo.jpg') }}"
                        alt="Foto de perfil" class="w-full h-full object-cover">
                </div>
                <div>
                    <a href="{{ route('users.show', $follower) }}"
                       class="font-semibold">{{ $follower->name }} {{ $follower->last_name }}</a>
                    <p class="text-gray-600">{{ $follower->username }}</p>
                </div>
            </div>
        @endforeach
    </div>

</div>

</body>
</html>
