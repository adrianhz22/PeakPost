<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-semibold text-center text-gray-800 mb-6">
                    Usuarios que sigue {{ $user->username }}
                </h1>

                <div class="space-y-4">
                    @foreach($following as $followed)
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 rounded-full overflow-hidden">
                                <img
                                    src="{{ $followed->profile_photo ? asset($followed->profile_photo) : asset('assets/default-photo.jpg') }}"
                                    alt="Foto de perfil" class="w-full h-full object-cover">
                            </div>
                            <div>
                                <a href="{{ route('users.show', $followed) }}"
                                   class="font-semibold">{{ $followed->name }} {{ $followed->last_name }}</a>
                                <p class="text-gray-600">{{ $followed->username }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
