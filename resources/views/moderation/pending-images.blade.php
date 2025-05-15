<x-layouts.admin-layout title="Imágenes pendientes">

    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">
        Imágenes pendientes ({{ $images->count() }})
    </h1>

    @if($images->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-4">
            @foreach($images as $image)
                <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col items-center p-4">
                    <img src="{{ asset('storage/' . $image->path) }}"
                         alt="{{ $image->title }}"
                         class="w-full h-48 object-cover rounded mb-4">

                    <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $image->title }}</h2>

                    <div class="flex flex-col space-y-2 w-full">
                        <form action="{{ route('moderation.images.approve', $image) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <button type="submit"
                                    class="w-full mt-2 bg-green-500 text-white py-2 rounded hover:bg-green-600 transition">
                                Aprobar
                            </button>
                        </form>

                        <form action="{{ route('moderation.images.reject', $image) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <textarea name="rejection_reason" placeholder="Motivo del rechazo" required
                                      class="w-full p-2 border border-red-300 rounded-md"></textarea>

                            <button type="submit"
                                    class="w-full mt-2 bg-red-500 text-white py-2 rounded hover:bg-red-600 transition">
                                Rechazar
                            </button>
                        </form>

                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $images->links() }}
        </div>

    @else
        <p class="text-center text-gray-500">{{ __('No hay imagenes pendientes') }}</p>
    @endif

</x-layouts.admin-layout>
