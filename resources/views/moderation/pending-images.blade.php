<x-layouts.admin-layout title="Imágenes pendientes">

    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">
        {{ __('Pending images') }} ({{ $images->count() }})
    </h1>

    @if($images->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 px-4">
            @foreach($images as $image)
                <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col items-center p-4 relative">
                    <img src="{{ asset('storage/' . $image->path) }}"
                         alt="{{ $image->title }}"
                         class="w-full h-48 object-cover rounded mb-4">

                    <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $image->title }}</h2>

                    <div class="flex justify-center gap-3 mt-2">
                        <form action="{{ route('moderation.images.approve', $image) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                    class="inline-flex items-center gap-1 bg-emerald-600 text-white text-sm px-3 py-1.5 rounded-lg shadow hover:bg-emerald-700 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                </svg>
                                {{ __('Approve') }}
                            </button>
                        </form>

                        <button
                            onclick="document.getElementById('rejectionModal{{ $image->id }}').classList.remove('hidden')"
                            class="inline-flex items-center gap-1 bg-rose-600 text-white text-sm px-3 py-1.5 rounded-lg shadow hover:bg-rose-700 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            {{ __('Reject') }}
                        </button>
                    </div>
                </div>

                <div id="rejectionModal{{ $image->id }}"
                     class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-[1000] hidden">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ __('Rejection reason') }}</h2>

                        <form action="{{ route('moderation.images.reject', $image) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <textarea name="rejection_reason" required
                                      class="w-full h-32 p-3 border border-red-300 rounded-md mb-4 resize-none"
                                      placeholder="Explica por qué esta imagen fue rechazada..."></textarea>

                            <div class="flex justify-end space-x-3">
                                <button type="button"
                                        onclick="document.getElementById('rejectionModal{{ $image->id }}').classList.add('hidden')"
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
            @endforeach
        </div>

        <div class="mt-8">
            {{ $images->links() }}
        </div>
    @else
        <p class="text-center text-gray-500">{{ __('There are no pending images') }}</p>
    @endif

</x-layouts.admin-layout>
