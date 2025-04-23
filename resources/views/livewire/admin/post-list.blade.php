<div>
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Lista de Posts</h1>

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
