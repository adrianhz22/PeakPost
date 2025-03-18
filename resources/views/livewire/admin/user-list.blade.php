<div class="max-w-7xl mx-auto">
    <div class="inline-block min-w-full py-2 align-middle">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">ID</th>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900">Nombre</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Correo</th>
                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Registro</th>
                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                        <span class="sr-only">Acciones</span>
                    </th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 bg-white">
                @foreach($users as $user)
                    <tr>
                        <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $user->id }}</td>
                        <td class="px-3 py-4 text-sm text-gray-500">{{ $user->name }}</td>
                        <td class="px-3 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                        <td class="px-3 py-4 text-sm text-center text-gray-500">
                            {{ $user->created_at->format('d/m/Y') }}
                        </td>

                        <td class="py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6" x-data="{ menu: false }">
                            <div class="inline-block text-left">
                                <button x-on:click="menu = !menu" type="button"
                                        class="flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                    <span class="sr-only">Open options</span>
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                         fill="currentColor" aria-hidden="true">
                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                                    </svg>
                                </button>

                                <div x-show="menu" x-on:click.away="menu = false"
                                     class="absolute right-32 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 focus:outline-none">
                                    <div>
                                        <a href="#"
                                           class="text-gray-500 font-medium hover:text-gray-900 hover:bg-gray-50 block px-4 py-2 text-sm">
                                            Detalle
                                        </a>
                                    </div>
                                    <div>
                                        <button wire:click="deleteUser({{ $user->id }})"
                                                class="cursor-pointer text-gray-500 font-medium hover:text-gray-900 hover:bg-gray-50 block px-4 py-2 text-sm">
                                            Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
