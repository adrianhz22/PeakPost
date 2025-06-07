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
                        {{ __('Approve') }}
                    </button>
                </form>
                <button
                    onclick="document.getElementById('rejectionModal').classList.remove('hidden')"
                    class="inline-flex items-center gap-2 bg-rose-600 text-white text-sm px-4 py-2 rounded-lg shadow hover:bg-rose-700 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    {{ __('Reject') }}
                </button>
            </div>
        @endif

        <img src="{{ asset($post->image) }}" alt="Imagen del post" class="w-full h-80 object-cover">

        <div class="p-6">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $post->title }}</h1>

            @if($post->rejection_reason)
                <div class="mt-4 mb-4 p-2 bg-red-100 border border-red-300 rounded">
                    <strong>{{ __('Rejection reason:') }}</strong> {{ $post->rejection_reason }}
                </div>
            @endif

            <p class="text-gray-700 leading-relaxed text-lg">{!! $post->body !!}</p>

            @include('partials.attributes')

            @if($post->track)
                <div class="mt-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ __('Route on the map') }}</h2>
                    <div id="map" class="h-96 w-full rounded-lg shadow-md"></div>
                </div>
            @endif

            <div class="mt-6 flex justify-between items-center">
                @include('partials.mod-buttons')

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
                    @include('partials.comment')
                @endforeach
            </div>
        </div>
    </div>
    <div id="rejectionModal"
         class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-[1000] hidden">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ __('Rejection reason:') }}</h2>

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
                        {{ __('Cancel') }}
                    </button>
                    <button type="submit"
                            class="bg-rose-600 text-white px-4 py-2 rounded-lg hover:bg-rose-800 transition">
                        {{ __('Send rejection') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @include('components.confirm-delete')

    @include('components.map-script')

</x-app-layout>
