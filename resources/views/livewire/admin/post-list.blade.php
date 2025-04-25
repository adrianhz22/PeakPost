<div>
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Lista de Posts</h1>

    <div>
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Crear un post</h1>

        <form wire:submit.prevent="createPost">
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Título</label>
                <input type="text" wire:model="title" class="mt-1 block w-full">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="body" class="block text-gray-700">Contenido</label>
                <textarea wire:model="body" class="mt-1 block w-full"></textarea>
                @error('body') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-gray-700">Imagen</label>
                <input type="file" wire:model="image" class="mt-1 block w-full">
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="track" class="block text-gray-700">Track</label>
                <input type="file" wire:model="track" class="mt-1 block w-full">
                @error('track') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="province" class="block text-gray-700">Provincia</label>
                <input type="text" wire:model="province" class="mt-1 block w-full">
                @error('province') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="difficulty" class="block text-gray-700">Dificultad</label>
                <input type="text" wire:model="difficulty" class="mt-1 block w-full">
                @error('difficulty') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="longitude" class="block text-gray-700">Longitud</label>
                <input type="number" wire:model="longitude" class="mt-1 block w-full">
                @error('longitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="altitude" class="block text-gray-700">Altitud</label>
                <input type="number" wire:model="altitude" class="mt-1 block w-full">
                @error('altitude') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="time" class="block text-gray-700">Duración</label>
                <input type="text" wire:model="time" class="mt-1 block w-full">
                @error('time') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Crear post</button>
        </form>
    </div>

    @if($posts->count() > 0)
        @foreach($posts as $post)
            <div class="bg-white shadow-md rounded-lg p-6 mb-6 flex space-x-6">

                <img src="{{ asset($post->image) }}" alt="Imagen del post" class="w-32 h-32 object-cover rounded-lg">

                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ $post->title }}
                    </h2>

                    <div class="text-gray-600 mt-2 flex items-center space-x-4">
                        <p><strong>Autor:</strong> {{ $post->user->name }}</p>
                        <p><strong>Fecha:</strong> {{ $post->created_at->format('d/m/Y') }}</p>
                    </div>

                    <p class="text-gray-700 mt-4">{!! Str::limit($post->body, 150) !!}</p>

                    <div class="mt-4">
                        <button
                            wire:click="deletePost({{ $post->id }})"
                            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
                        >
                            Eliminar
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center text-gray-500">No hay posts disponibles.</p>
    @endif
</div>
