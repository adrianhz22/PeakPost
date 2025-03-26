<x-layouts.admin-layout title="Registro de actividad">
    <h1 class="text-3xl font-bold mb-6 text-center">Historial de actividad</h1>
    <div class="container mx-auto px-4 py-6">
        <div class="space-y-4">
            @foreach($logs as $log)
                <div>
                    <div>
                        <p>{{ ($log->action) }}</p>
                        <p>{{ $log->description }}</p>
                        <p>{{ $log->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-layouts.admin-layout>
