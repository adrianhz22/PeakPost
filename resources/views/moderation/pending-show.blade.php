<x-app-layout>
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-10">

        <div class="mb-6">
            <img src="{{ $post->image }}" alt="Imagen del post" class="w-full h-64 object-cover rounded-lg">
        </div>

        <div class="space-y-6">

            <h1 class="text-3xl font-semibold text-gray-800">{{ $post->title }}</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <div>
                    <p><strong>{{ __('Author') }}</strong> {{ $post->user->name }}</p>
                </div>
                <div>
                    <p><strong>{{ __('Province') }}</strong> {{ $post->province }}</p>
                </div>
                <div>
                    <p><strong>{{ __('Difficulty') }}</strong> {{ $post->difficulty }}</p>
                </div>
                <div>
                    <p><strong>{{ __('Longitude') }}</strong> {{ $post->longitude }} km</p>
                </div>
                <div>
                    <p><strong>{{ __('Altitude') }}</strong> {{ $post->altitude }} m</p>
                </div>
                <div>
                    <p><strong>{{ __('Duration') }}</strong> {{ $post->time }}</p>
                </div>
            </div>

            <div class="text-gray-700 leading-relaxed mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ __('Content') }}</h2>
                <p>{!! $post->body !!}</p>
            </div>

            <div class="my-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ __('Route on the map') }}</h2>
                <div id="map" style="height: 500px;"></div>
            </div>

            <div class="mt-6 flex justify-start space-x-4">
                <form action="{{ route('moderation.approve', $post) }}" method="POST" class="inline-block">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                            class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition">
                        {{ __('Approve') }}
                    </button>
                </form>

                <form action="{{ route('moderation.reject', $post) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-700 transition">
                        {{ __('Reject') }}
                    </button>
                </form>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('moderation.pending-posts') }}" class="text-blue-500 hover:underline font-medium">
                    {{ __('Back to pending posts') }}
                </a>
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
