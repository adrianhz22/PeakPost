<div>
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
        <tr class="bg-gray-200">
            <th class="border px-4 py-2">ID</th>
            <th class="border px-4 py-2">Nombre</th>
            <th class="border px-4 py-2">Email</th>
            <th class="border px-4 py-2">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="border">
                <td class="px-4 py-2">{{ $user->id }}</td>
                <td class="px-4 py-2">{{ $user->name }}</td>
                <td class="px-4 py-2">{{ $user->email }}</td>
                <td class="px-4 py-2 text-center">
                    <button wire:click="deleteUser({{ $user->id }})"
                            class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600">
                        <i class="fa-solid fa-trash"></i> Eliminar
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
