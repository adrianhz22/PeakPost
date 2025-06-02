<x-app-layout>
    <div class="container mx-auto mt-10 px-4">
        <h1 class="text-3xl font-bold text-center mb-6">{{ __('My likes') }}</h1>

        @if($likedPosts->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($likedPosts as $post)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{ asset($post->image) }}" alt="Imagen de {{ $post->title }}"
                             class="w-full h-48 object-cover">
                        <div class="p-5">
                            <a href="{{ route('posts.show', $post->id) }}"
                               class="text-xl font-semibold text-blue-500 hover:underline">
                                {{ $post->title }}
                            </a>
                            <p class="text-gray-600 mt-2">{!! Str::limit(strip_tags($post->body), 100) !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center">
                <img src="{{ asset('assets/like.png') }}" alt="Sin posts likeados"
                     class="mx-auto w-60 h-auto">

                <p class="text-gray-600 text-lg mb-4">
                    {{ __('You haven´t liked any posts yet. Explore and like some!') }}
                </p>
                <a href="{{ route('posts.index') }}"
                   class="bg-blue-500 text-white px-6 py-2 rounded-3xl hover:bg-blue-600 transition duration-300">
                    {{ __('Explore posts') }}
                </a>
            </div>
        @endif

    </div>
</x-app-layout>
