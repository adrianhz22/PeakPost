<x-layouts.admin-layout title="Registro de actividad">
    <h1 class="text-3xl font-bold mb-6 text-center">{{ __('Activity history') }}</h1>

    <div class="container mx-auto px-4 py-6">

        <div class="flex justify-between items-center mb-6">
            <form method="POST" action="{{ route('admin.logs.deleteLast') }}">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 text-sm">
                    {{ __('Delete the last 50 logs') }}
                </button>
            </form>

            <form method="GET" action="{{ route('admin.activity-log') }}" class="flex">
                <input type="date" name="date" value="{{ request('date') }}"
                       class="border rounded p-2 shadow-sm mr-2">
                <button type="submit"
                        class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    {{ __('Filter by date') }}
                </button>
            </form>
        </div>

        <div class="space-y-4">
            @forelse ($logs as $log)
                <div class="flex justify-between items-center p-3 mb-3 text-base font-medium border rounded-lg shadow-md
                    @if (in_array($log->action, ['Usuario eliminado', 'Comentario eliminado', 'Post eliminado', 'Post rechazado', 'Imagen eliminada', 'Imagen rechazada']))
                        text-red-700 border-red-300 bg-red-100
                    @elseif (in_array($log->action, ['Post actualizado', 'Usuario actualizado']))
                        text-yellow-700 border-yellow-300 bg-yellow-100
                    @elseif (in_array($log->action, ['Usuario registrado', 'Nuevo comentario', 'Nuevo post creado', 'Post aprobado', 'Imagen aprobada', 'Imagen subida', 'Usuario creado']))
                        text-green-700 border-green-300 bg-green-100
                    @else
                        text-gray-700 border-gray-300 bg-gray-100
                    @endif">
                    <div class="flex items-center">
                        <svg class="shrink-0 inline w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="font-semibold">{{ $log->action }}</span> : {{ $log->description }}
                    </div>
                    <div class="text-gray-600 text-xs whitespace-nowrap">
                        {{ $log->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">{{ __('There are no records for this day.') }}</p>
            @endforelse

            <div class="mt-6">
                {{ $logs->links() }}
            </div>

        </div>
    </div>
</x-layouts.admin-layout>
