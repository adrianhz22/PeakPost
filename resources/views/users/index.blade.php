<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buscar usuarios</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gray-100 text-gray-900">

<x-navigation/>

<div class="max-w-4xl mx-auto mt-12 p-8 bg-white shadow-lg rounded-lg">
    <h1 class="text-2xl font-semibold mb-6 text-center">Buscar usuarios</h1>

    <form action="{{ route('users.index') }}" method="GET" class="mb-8">
        <div class="flex gap-2">
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Buscar por nombre o username"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Buscar
            </button>
        </div>
    </form>

    @if($users->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($users as $user)
                <div class="bg-gray-100 rounded-lg p-4 text-center shadow hover:shadow-lg transition">
                    <a href="{{ route('users.show', $user) }}">
                        <img
                            src="{{ $user->profile_photo ? asset($user->profile_photo) : asset('assets/default-photo.jpg') }}"
                            class="w-24 h-24 mx-auto rounded-full object-cover mb-2" alt="{{ $user->name }}">
                        <h2 class="text-lg font-semibold">{{ $user->name }}</h2>
                        <p class="text-sm text-gray-600">{{ '@' . $user->username }}</p>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $users->withQueryString()->links() }}
        </div>

    @else
        <p class="text-gray-600 text-center">No se encontraron usuarios.</p>
    @endif

</div>

<script>
    lucide.createIcons();
</script>

</body>
</html>
