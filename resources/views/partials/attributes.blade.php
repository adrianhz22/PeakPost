<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-6 text-lg bg-gray-100 p-6 rounded-lg shadow-md">
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
        <p class="text-gray-600">
            {{ floor($post->duration / 60) }}h {{ $post->duration % 60 }}m
        </p>
    </div>
</div>
