<x-app-layout>
    @if(session('success'))
        <div class="bg-green-600 text-white text-center p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-center mb-6">{{__('Home')}}</h1>

        <div>
            <form action="{{ route('home') }}" method="GET">
                <input type="text" name="query" value="{{ request('query') }}">
                <button type="submit">
                    Buscar
                </button>
            </form>
        </div>

        <div class="flex justify-end mb-4">
            <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700">
                + {{__('Create Post')}}
            </a>
        </div>

        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
                <div class="bg-white p-4 rounded-lg shadow-lg border">
                    <img src="{{ $post->image }}" class="w-full h-48 object-cover rounded-lg" alt="Imagen del post">
                    <h2 class="mt-3 text-xl font-semibold">
                        <a href="{{ route('posts.show', $post->id) }}" class="text-blue-600 hover:underline">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p class="mt-2 text-gray-700 break-words">{!! Str::limit(strip_tags($post->body, 100)) !!}</p>
                    <livewire:like-post :post="$post" />
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

