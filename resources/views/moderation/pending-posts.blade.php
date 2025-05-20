<x-layouts.admin-layout title="Posts pendientes">

    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">{{ __('Pending posts') }} ({{ $pendingCount }})</h1>

    <div class="container mx-auto px-6 py-2">
        @if($posts->count() > 0)

            <div class="space-y-6">
                @foreach($posts as $post)
                    <div class="bg-white shadow-md rounded-lg p-6 flex flex-col md:flex-row md:items-start gap-4 w-full">
                        <div class="w-full md:w-32 flex-shrink-0">
                            <img src="{{ asset($post->image) }}" alt="Imagen del post"
                                 class="w-full h-32 object-cover rounded-lg">
                        </div>

                        <div class="flex-1 overflow-hidden">
                            <a href="{{ route('posts.show', $post) }}"
                               class="text-xl font-semibold text-gray-800 hover:text-blue-500 block break-words">
                                {{ $post->title }}
                            </a>

                            <div class="text-gray-600 mt-2 flex flex-wrap gap-x-4 gap-y-1 text-sm">
                                <p><strong>{{ __('Author') }}</strong> {{ $post->user->name }}</p>
                                <p><strong>{{ __('Date') }}</strong> {{ $post->created_at->format('d/m/Y') }}</p>
                            </div>

                            <p class="text-gray-700 mt-4 text-sm break-words">
                                {!! Str::limit(strip_tags($post->body), 300) !!}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-center mt-12">
                {{ $posts->links() }}
            </div>

        @else
            <p class="text-center text-gray-500">{{ __('There are no pending posts') }}</p>
        @endif
    </div>

</x-layouts.admin-layout>
