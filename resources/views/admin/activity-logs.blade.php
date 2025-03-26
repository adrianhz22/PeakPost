<x-layouts.admin-layout title="Registro de actividad">
    <h1 class="text-3xl font-bold mb-6 text-center">Historial de actividad</h1>
    <div class="container mx-auto px-4 py-6">
        <div class="space-y-4">

            @foreach ($logs as $log)
                <div class="flex justify-between items-center p-3 mb-3 text-base font-medium border rounded-lg shadow-md
                    @if (in_array($log->action, ['Usuario eliminado', 'Comentario eliminado', 'Post eliminado', 'Post rechazado']))
                        text-red-700 border-red-300 bg-red-100
                    @elseif ($log->action == 'Post actualizado')
                        text-yellow-700 border-yellow-300 bg-yellow-100
                    @elseif (in_array($log->action, ['Usuario registrado', 'Nuevo comentario', 'Nuevo post creado', 'Post aprobado']))
                        text-green-700 border-green-300 bg-green-100
                    @else
                        text-gray-700 border-gray-300 bg-gray-100
                    @endif" role="alert">
                    <div class="flex items-center">
                        <svg class="shrink-0 inline w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="font-semibold">{{ $log->action }}</span> : {{ $log->description }}
                    </div>

                    <div class="text-gray-600 text-xs whitespace-nowrap">
                        {{ $log->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</x-layouts.admin-layout>
