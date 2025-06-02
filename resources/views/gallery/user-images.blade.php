<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">{{ __('My uploaded images') }}</h2>

        @if($images->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @foreach ($images as $image)
                    <div>
                        <img src="{{ asset('storage/' . $image->path) }}"
                             alt="{{ $image->title }}"
                             class="gallery-image w-full h-40 object-cover rounded-lg cursor-pointer transition duration-200 hover:scale-105 hover:opacity-80">
                        <p class="mt-1 text-sm font-medium text-gray-700 text-center">{{ $image->title }}</p>

                        @if($image->status === 'pending')
                            <p class="text-xs text-yellow-500 text-center mt-1">{{ __('Under review') }}</p>
                        @elseif($image->status === 'rejected')
                            <p class="text-xs text-red-500 text-center mt-1">{{ __('Reject') }}</p>
                            @if($image->reject_reason)
                                <p class="text-[11px] text-gray-500 text-center">{{ $image->reject_reason }}</p>
                            @endif
                        @endif
                        <form action="{{ route('gallery.destroy', $image->id) }}" method="POST"
                              class="mt-2 text-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-sm text-red-600 hover:underline">
                                {{ __('Delete') }}
                            </button>
                        </form>

                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $images->links() }}
            </div>
        @else
            <div class="text-center mt-10">
                <img src="{{ asset('assets/not-posts.png') }}" alt="Sin imágenes"
                     class="mx-auto w-60 h-auto mb-4">
                <p class="text-gray-600 text-lg mb-4">
                    {{ __('Wow... You haven´t uploaded any images yet. Why not start now?') }}
                </p>
                <a href="{{ route('gallery.create') }}"
                   class="bg-indigo-500 text-white px-6 py-2 rounded-3xl hover:bg-indigo-600 transition duration-300">
                    {{ __('+ Upload image') }}
                </a>
            </div>
        @endif
    </div>

    <div id="imageModal"
         class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
        <div class="relative max-w-4xl w-full px-4">
            <img id="modalImage" src="" alt="Vista ampliada"
                 class="max-h-[80vh] w-auto mx-auto rounded-lg shadow-lg">
            <button id="closeModal"
                    class="absolute top-2 right-4 text-white text-2xl font-bold hover:text-gray-300 focus:outline-none">
                &times;
            </button>
        </div>
    </div>
</x-app-layout>
