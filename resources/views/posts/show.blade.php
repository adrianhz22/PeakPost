<x-app-layout>
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-10">

        @if(auth()->user()->hasRole('admin') && $post->status === 'pending')
            <div class="w-full flex justify-center gap-4 py-6 bg-gray-50 border-b border-gray-200">
                <form action="{{ route('moderation.approve', $post) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                            class="inline-flex items-center gap-2 bg-emerald-600 text-white text-sm px-4 py-2 rounded-lg shadow hover:bg-emerald-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Aprobar
                    </button>
                </form>
                <button
                    onclick="document.getElementById('rejectionModal').classList.remove('hidden')"
                    class="inline-flex items-center gap-2 bg-rose-600 text-white text-sm px-4 py-2 rounded-lg shadow hover:bg-rose-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Rechazar
                </button>
            </div>
        @endif

        <img src="{{ asset($post->image) }}" alt="Imagen del post" class="w-full h-80 object-cover">

        <div class="p-6">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>

            @if($post->rejection_reason)
                <div class="mt-4 mb-4 p-2 bg-red-100 border border-red-300 rounded">
                    <strong>Motivo del rechazo:</strong> {{ $post->rejection_reason }}
                </div>
            @endif

            <p class="text-gray-700 leading-relaxed text-lg">{!! $post->body !!}</p>

            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-6 text-lg bg-gray-100 p-6 rounded-lg shadow-md">
                <div>
                    <p class="font-semibold text-gray-800">{{ __('Province') }}</p>
                    <p class="text-gray-600">{{ $post->province }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">{{ __('Difficulty') }}</p>
                    <p class="text-gray-600">{{ $post->difficulty }}</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">{{ __('Longitude') }}</p>
                    <p class="text-gray-600">{{ $post->longitude }} km</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">{{ __('Altitude') }}</p>
                    <p class="text-gray-600">{{ $post->altitude }} m</p>
                </div>
                <div>
                    <p class="font-semibold text-gray-800">{{ __('Duration') }}</p>
                    <p class="text-gray-600">{{ floor($post->duration / 60) }}h {{ $post->duration % 60 }}m</p>
                </div>
            </div>

            @if($post->track)
                <div class="mt-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ __('Route on the map') }}</h2>
                    <div id="map" class="h-96 w-full rounded-lg shadow-md"></div>
                </div>
            @endif

            <div class="mt-6 flex justify-between items-center">
                <div class="flex space-x-4">
                    @can('update', $post)
                        <a href="{{ route('posts.edit', $post->id) }}"
                           class="flex items-center bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 transition duration-200 ease-in-out">
                            <i class="fas fa-pencil-alt mr-2"></i> {{ __('Edit') }}
                        </a>
                    @endcan
                    @can('delete', $post)
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                              id="deleteForm-{{ $post->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                    onclick="confirmDelete({{ $post->id }})"
                                    class="flex items-center bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-red-700 transition duration-200 ease-in-out">
                                <i class="fas fa-trash-alt mr-2"></i> {{ __('Delete') }}
                            </button>
                        </form>
                    @endcan
                </div>

                <a href="{{ route('post.pdf', $post->id) }}"
                   class="flex items-center space-x-2 text-gray-700 hover:text-red-600 transition duration-200 ease-in-out mt-4 md:mt-0">
                    <i class="fas fa-file-pdf text-red-500 hover:text-red-700 transition duration-200 ease-in-out"></i>
                    <span class="font-medium">{{ __('Download PDF') }}</span>
                </a>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" class="text-blue-500 hover:underline font-medium">
                    {{ __('Back to home') }}
                </a>
            </div>
        </div>

        <div class="p-6 border-t">
            <h2 class="text-2xl font-semibold mb-4">{{ __('Comments') }}</h2>
            <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-6">
                @csrf
                <textarea name="content" rows="3" class="w-full p-3 border rounded focus:ring focus:ring-blue-300"
                          placeholder="{{ __('Write a comment...') }}" required></textarea>
                <button type="submit" class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    {{ __('Comment') }}
                </button>
            </form>

            <div class="space-y-4">
                @foreach ($post->comments->where('parent_id', null) as $comment)
                    <div class="bg-gray-100 p-4 rounded-lg shadow mb-4"
                         x-data="{ menu: false, editMode: false }">
                        <div class="flex items-center justify-between relative">
                            <div class="flex items-center space-x-2">
                                <img
                                    src="{{ $comment->user->profile_photo ? asset($comment->user->profile_photo) : asset('assets/default-photo.jpg') }}"
                                    alt="Profile"
                                    class="w-8 h-8 rounded-full object-cover border border-gray-300 aspect-square"
                                >
                                <a href="{{ route('users.show', $comment->user) }}">
                                    {{ $comment->user->username }}
                                </a>
                                <span class="text-sm text-gray-500">{{ $comment->created_at->format('d/m/Y') }}</span>
                            </div>

                            <div class="relative">
                                <button @click="menu = !menu"
                                        class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>

                                <div x-show="menu" @click.away="menu = false" x-cloak
                                     class="absolute right-0 top-full mt-2 w-40 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 z-50">
                                    @can('update', $comment)
                                        <button @click="editMode = true; menu = false"
                                                class="w-full px-4 py-2 text-left">
                                            {{ __('Edit') }}
                                        </button>
                                    @endcan

                                    @can('delete', $comment)
                                        <button type="submit" form="deleteForm-{{ $comment->id }}"
                                                class="w-full px-4 py-2 text-left">
                                            {{ __('Delete') }}
                                        </button>
                                        <form id="deleteForm-{{ $comment->id }}"
                                              action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                              class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </div>

                        <div x-show="editMode" x-transition class="mt-2">
                            <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                                @csrf @method('PUT')
                                <textarea name="content" rows="3"
                                          class="w-full p-3 border rounded focus:ring focus:ring-blue-300"
                                          required>{{ $comment->content }}</textarea>
                                <button type="submit"
                                        class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    {{ __('Save Changes') }}
                                </button>
                            </form>
                        </div>

                        <div x-show="!editMode" class="mt-2">
                            <p>{{ $comment->content }}</p>
                        </div>

                        <div class="mt-2" x-data="{ showReplyForm: false }">
                            <button @click="showReplyForm = !showReplyForm"
                                    class="text-blue-500 hover:underline font-medium">
                                {{ __('Reply') }}
                            </button>

                            <form x-show="showReplyForm" x-cloak action="{{ route('comments.store', $post) }}"
                                  method="POST" class="mt-2">
                                @csrf
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                <textarea name="content" rows="2"
                                          class="w-full p-2 border rounded focus:ring focus:ring-blue-300"
                                          placeholder="{{ __('Write a reply...') }}" required></textarea>
                                <button type="submit"
                                        class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    {{ __('Reply') }}
                                </button>
                            </form>
                        </div>

                        @if($comment->replies->count())
                            <div class="ml-4 mt-4 space-y-2">
                                @foreach ($comment->replies as $reply)
                                    <div class="bg-gray-200 p-3 rounded relative"
                                         x-data="{ menu: false, editMode: false }">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-2">
                                                <img
                                                    src="{{ $reply->user->profile_photo ? asset($reply->user->profile_photo) : asset('assets/default-photo.jpg') }}"
                                                    alt="Profile"
                                                    class="w-8 h-8 rounded-full object-cover border border-gray-300 aspect-square"
                                                >
                                                <a href="{{ route('users.show', $reply->user) }}">
                                                    {{ $reply->user->username }}
                                                </a>
                                                <span
                                                    class="text-sm text-gray-500 ml-2">{{ $reply->created_at->format('d/m/Y') }}</span>
                                            </div>

                                            <div class="relative">
                                                <button @click="menu = !menu"
                                                        class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>

                                                <div x-show="menu" @click.away="menu = false" x-cloak
                                                     class="absolute right-0 top-full mt-2 w-40 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 z-50">
                                                    @can('update', $comment)
                                                        <button @click="editMode = true; menu = false"
                                                                class="w-full px-4 py-2 text-left">
                                                            {{ __('Edit') }}
                                                        </button>
                                                    @endcan

                                                    @can('delete', $comment)
                                                        <button type="submit" form="deleteForm-{{ $comment->id }}"
                                                                class="w-full px-4 py-2 text-left">
                                                            {{ __('Delete') }}
                                                        </button>
                                                        <form id="deleteForm-{{ $comment->id }}"
                                                              action="{{ route('comments.destroy', $comment->id) }}"
                                                              method="POST" class="hidden">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    @endcan
                                                </div>

                                            </div>
                                        </div>

                                        <div x-show="editMode" x-transition class="mt-2">
                                            <form action="{{ route('comments.update', $reply->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <textarea name="content" rows="2"
                                                          class="w-full p-2 border rounded focus:ring focus:ring-blue-300"
                                                          required>{{ $reply->content }}</textarea>
                                                <button type="submit"
                                                        class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                                    {{ __('Save Changes') }}
                                                </button>
                                            </form>
                                        </div>

                                        <div x-show="!editMode" class="mt-1">
                                            {{ $reply->content }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div id="rejectionModal"
         class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-[1000] hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Motivo del rechazo</h2>

            <form action="{{ route('moderation.reject', $post) }}" method="POST">
                @csrf
                @method('PATCH')

                <textarea name="rejection_reason" required
                          class="w-full h-32 p-3 border border-red-300 rounded-md mb-4 resize-none"
                          placeholder="Explica por qué se rechaza esta publicación..."></textarea>

                <div class="flex justify-end space-x-3">
                    <button type="button"
                            onclick="document.getElementById('rejectionModal').classList.add('hidden')"
                            class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400 transition">
                        Cancelar
                    </button>
                    <button type="submit"
                            class="bg-rose-600 text-white px-4 py-2 rounded-lg hover:bg-rose-800 transition">
                        Enviar rechazo
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('components.confirm-delete')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var map = L.map('map').setView([37.95, -1.09], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var trackUrl = "{{ asset($post->track) }}";

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
