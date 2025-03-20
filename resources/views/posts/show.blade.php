<x-app-layout>
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-10">
        <img src="{{ $post->image }}" alt="Imagen del post" class="w-full h-80 object-cover">

        <div class="p-6">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>
            <p class="text-gray-700 leading-relaxed text-lg">{!! $post->body !!}</p>

            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-6 text-lg bg-gray-100 p-6 rounded-lg shadow-md">
                <div>
                    <p class="font-semibold text-gray-800">Provincia</p>
                    <p class="text-gray-600">{{ $post->province }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">Dificultad</p>
                    <p class="text-gray-600">{{ $post->difficulty }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">Longitud</p>
                    <p class="text-gray-600">{{ $post->longitude }} km</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">Altitud</p>
                    <p class="text-gray-600">{{ $post->altitude }} m</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">Duración</p>
                    <p class="text-gray-600">{{ $post->time }}</p>
                </div>
            </div>

            <div class="mt-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Ruta en el mapa</h2>
                <div id="map" class="h-96 w-full rounded-lg shadow-md"></div>
            </div>

            <div class="mt-6 flex justify-between items-center">
                <div class="flex space-x-4">
                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post->id) }}"
                           class="flex items-center bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 transition duration-200 ease-in-out">
                            <i class="fas fa-pencil-alt mr-2"></i> Editar
                        </a>
                    @endcan

                    @can('delete', $post)
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="flex items-center bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-red-700 transition duration-200 ease-in-out">
                                <i class="fas fa-trash-alt mr-2"></i> Eliminar
                            </button>
                        </form>
                    @endcan
                </div>

                <a href="{{ route('post.pdf', $post->id) }}"
                   class="flex items-center space-x-2 text-gray-700 hover:text-red-600 transition duration-200 ease-in-out mt-4 md:mt-0">
                    <i class="fas fa-file-pdf text-red-500 hover:text-red-700 transition duration-200 ease-in-out"></i>
                    <span class="font-medium">Descargar PDF</span>
                </a>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-blue-500 hover:underline font-medium">
                    Volver al inicio
                </a>
            </div>
        </div>

        <div class="p-6 border-t">
            <h2 class="text-2xl font-semibold mb-4">Comentarios</h2>
            <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-6">
                @csrf
                <textarea name="content" rows="3" class="w-full p-3 border rounded focus:ring focus:ring-blue-300"
                          placeholder="Escribe un comentario..." required></textarea>
                <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Comentar
                </button>
            </form>

            <div class="space-y-4">
                @foreach ($post->comments as $comment)
                    <div class="bg-gray-100 p-4 rounded-lg shadow mb-4">
                        <div class="flex items-center justify-between">
                            <p class="font-semibold text-gray-800">{{ $comment->user->name }}</p>
                            <span class="text-sm text-gray-500">{{ $comment->created_at->format('d/m/Y') }}</span>
                        </div>
                        <p class="text-gray-700 mt-2">{{ $comment->content }}</p>
                        @can('delete', $comment)
                            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit">
                                    <i class="fas fa-trash-alt mr-2"></i>
                                </button>
                            </form>
                        @endcan
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var map = L.map('map').setView([37.95, -1.09], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var trackUrl = "{{ asset('storage/' . $post->track) }}";

            omnivore.kml(trackUrl)
                .on('ready', function () {
                    map.fitBounds(this.getBounds());
                })
                .addTo(map)
                .on('error', function (e) {
                    console.error('Error cargando el KML: ', e);
                });
        });
    </script>
</x-app-layout>
