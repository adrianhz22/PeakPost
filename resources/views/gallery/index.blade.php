<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ __('Image gallery') }}</h2>

        <button id="toggleFormBtn"
                class="mb-4 text-sm bg-gray-100 text-gray-700 px-4 py-1.5 rounded hover:bg-gray-200 transition focus:outline-none">
            {{ __('+ Upload image') }}
        </button>

        <form id="uploadForm"
              action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data"
              class="hidden origin-top scale-y-0 transition-transform duration-300 bg-white border border-gray-200 rounded-lg p-3 mb-8 w-full sm:w-fit mx-auto shadow-sm">
            @csrf
            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-2 sm:space-y-0">
                <input type="file" name="image" required
                       class="text-sm border border-gray-300 rounded px-3 py-1 focus:outline-none focus:ring-1 focus:ring-indigo-400 w-full sm:w-auto">
                <input type="text" name="title" placeholder="{{ __('Title of the image') }}" required
                       class="text-sm border border-gray-300 rounded px-3 py-1 focus:outline-none focus:ring-1 focus:ring-indigo-400 w-full sm:w-64">
                <button type="submit"
                        class="bg-indigo-500 text-white text-sm px-4 py-1.5 rounded hover:bg-indigo-600 transition w-full sm:w-auto">
                    {{ __('Upload') }}
                </button>
            </div>
        </form>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            @foreach ($images as $image)
                <div>
                    <img src="{{ asset('storage/' . $image->path) }}"
                         alt="{{ $image->title }}"
                         class="gallery-image w-full h-48 object-cover rounded-lg cursor-pointer transition hover:opacity-80">
                    <p class="mt-1 text-sm italic text-gray-600 text-center">{{ $image->title }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $images->links() }}
        </div>
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
