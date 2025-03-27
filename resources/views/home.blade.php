<x-app-layout>
    @if(session('success'))
        <div class="bg-green-600 text-white text-center p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mx-auto px-6 py-2">
        <h1 class="text-4xl font-semibold text-center mb-8">{{__('Home')}}</h1>

        <div class="mb-6 flex justify-center">
            <form action="{{ route('home') }}" method="GET" class="max-w-[480px] w-full px-4">
                <div class="relative">
                    <input
                        type="text"
                        name="query"
                        class="w-full border h-12 shadow-lg p-4 rounded-full dark:text-gray-800 dark:border-gray-700 dark:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="{{ __('Search') }}"
                        value="{{ request('query') }}"
                    >
                    <button type="submit" class="absolute top-3.5 right-3">
                        <svg class="text-teal-600 h-5 w-5 fill-current dark:text-teal-700"
                             xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 56.966 56.966">
                            <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23 s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92 c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17 s-17-7.626-17-17S14.61,6,23.984,6z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <div class="flex justify-center mb-8">
            <a href="{{ route('posts.create') }}" class="flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 via-blue-600 to-blue-500 text-white font-extrabold text-lg rounded-full shadow-2xl hover:from-blue-600 hover:via-blue-700 hover:to-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-opacity-70 active:bg-blue-800 active:shadow-inner transform hover:scale-110 transition duration-500 ease-in-out disabled:opacity-50 disabled:cursor-not-allowed ml-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" class="w-8 h-8 mr-4 -ml-2 text-white animate-pulse">
                    <path d="M12 4v16m8-8H4" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"></path>
                </svg> {{__('Create post')}}
            </a>
        </div>

        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
                <div class="bg-white p-6 rounded-lg shadow-xl border transition-all duration-300 hover:scale-105 transform hover:shadow-2xl hover:border-blue-300">
                    <img src="{{ $post->image }}" class="w-full h-48 object-cover rounded-lg transition-transform duration-300 ease-in-out transform" alt="Imagen del post">
                    <h2 class="mt-4 text-xl font-semibold text-gray-800 hover:text-blue-600 transition-colors">
                        <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">
                            {{ $post->title }}
                        </a>
                    </h2>
                    <p class="mt-2 text-gray-700 break-words">{!! Str::limit(strip_tags($post->body), 100) !!}</p>
                    <livewire:like-post :post="$post" />
                </div>
            @endforeach
        </div>
        <div class="flex justify-center mt-16">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>


