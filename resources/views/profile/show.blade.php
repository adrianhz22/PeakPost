<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('My profile') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body class="bg-gray-100 text-gray-900">

<x-navigation/>

<div class="max-w-4xl mx-auto mt-12 p-8 bg-white shadow-lg rounded-2xl">
    <div class="flex flex-col md:flex-row items-center md:items-start gap-8">

        <form action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data" id="uploadForm"
              class="relative group w-48 h-48 shrink-0">
            @csrf
            <input type="file" name="profile_photo" id="fileInput" class="hidden"
                   onchange="document.getElementById('uploadForm').submit();">

            <div onclick="document.getElementById('fileInput').click()" class="cursor-pointer">
                <img
                    src="{{ Auth::user()->profile_photo ? asset(Auth::user()->profile_photo) : asset('assets/default-photo.jpg') }}"
                    alt="Foto de perfil"
                    class="w-48 h-48 rounded-full object-cover border border-gray-300 shadow-md aspect-square">
                <div
                    class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-full opacity-0 group-hover:opacity-100 transition">
                    <i data-lucide="camera" class="text-white w-6 h-6"></i>
                </div>
            </div>
        </form>

        <div class="flex-1">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ __('My profile') }}</h1>
            <div class="space-y-3 text-gray-700 text-base">
                <p><span class="font-semibold">{{ __('Name:') }}</span> {{ $user->name }} {{ $user->last_name }}</p>
                <p><span class="font-semibold">{{ __('Username:') }}</span> {{ $user->username }}</p>
                <p><span class="font-semibold">{{ __('Email:') }}</span> {{ $user->email }}</p>
                <p><span class="font-semibold">{{ __('Member since:') }}</span> {{ $user->created_at->format('d/m/Y') }}</p>
                <p><span class="font-semibold">{{ __('Likes received:') }}</span> {{ $user->total_likes }}</p>
            </div>

            <div class="mt-6">
                <a href="{{ route('profile.edit') }}"
                   class="inline-flex items-center px-5 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition shadow-sm">
                    <i data-lucide="settings" class="w-4 h-4 mr-2"></i>
                    {{ __('Edit profile') }}
                </a>
            </div>
        </div>
    </div>

    <div class="mt-10">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ __('Achievements unlocked') }}</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
            @foreach($allAchievements as $achievement)
                <div class="bg-gray-50 p-4 rounded-lg shadow text-center hover:shadow-md transition">
                    <div class="text-sm text-gray-500 mb-1">
                        {{ min($postCount, $achievement->target_posts) }} / {{ $achievement->target_posts }} posts
                    </div>
                    <img src="{{ asset($achievement->image) }}"
                         class="w-20 h-20 object-cover mx-auto mb-2
                         @if(!in_array($achievement->id, $userAchievementIds)) grayscale opacity-40 @endif"
                         alt="{{ $achievement->name }}">
                    <p class="text-sm font-medium text-gray-600">{{ $achievement->description }}</p>
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
