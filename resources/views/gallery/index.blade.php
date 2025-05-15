<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-4">
        <h2 class="text-xl font-semibold text-gray-800">Galeria de imagenes</h2>

        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image">Imagen</label>
                <input type="file" name="image" id="image" required>
            </div>

            <div class="form-group">
                <label for="title">Titulo</label>
                <input type="text" name="title" id="title" required>
            </div>

            <button type="submit">Subir imagen</button>
        </form>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            @foreach ($images as $image)
                <div>
                    <img src="{{ asset('storage/' . $image->path) }}"
                         class="rounded-lg shadow-md object-cover w-full h-48">
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $images->links() }}
        </div>

    </div>
</x-app-layout>
