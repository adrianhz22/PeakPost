<x-app-layout>
    @if(session('success'))
        <div class="bg-green-600 text-white text-center p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mx-auto px-6 py-2">
        <h1 class="text-4xl font-semibold text-center mb-8">{{ __('Home') }}</h1>

        <x-filters.post-filter :action="route('home')" :provinces="$provinces" :difficulties="$difficulties" />

        <div class="flex justify-center my-10">
            <a href="{{ route('posts.create') }}"
               class="flex items-center px-6 py-3 bg-blue-600 text-white font-bold rounded-lg shadow hover:bg-blue-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                {{ __('Create post') }}
            </a>
        </div>

        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
                <div class="bg-white p-6 rounded-lg shadow-lg border hover:shadow-xl transition-all">
                    <img src="{{ $post->image }}"
                         class="w-full h-48 object-cover rounded-md"
                         alt="Imagen del post">
                    <h2 class="mt-4 text-xl font-semibold text-gray-800 hover:text-blue-600 transition-colors">
                        <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p class="mt-2 text-gray-600">{!! Str::limit(strip_tags($post->body), 100) !!}</p>

                    <div class="mt-4 flex items-center justify-between">

                        <div class="flex items-center space-x-3">
                            <img
                                src="{{ $post->user->profile_photo ? asset($post->user->profile_photo) : asset('assets/default-photo.jpg') }}"
                                alt="Profile"
                                class="w-8 h-8 rounded-full object-cover border border-gray-300 aspect-square">
                            <a href="{{ route('users.show', $post->user) }}"
                               class="text-sm font-semibold text-gray-800 hover:text-blue-600">
                                {{ $post->user->username }}
                            </a>
                        </div>

                        <div class="text-sm text-gray-500">
                            {{ $post->created_at->format('d M, Y') }}
                        </div>

                        <div class="text-sm text-gray-600">
                            <livewire:like-post :post="$post"/>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="flex justify-center mt-12">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
