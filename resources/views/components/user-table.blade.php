@props(['users'])

<div class="inline-block min-w-full py-2 align-middle">
    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
        <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
            <tr>
                <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">ID</th>
                <th class="py-3.5 text-left text-sm font-semibold text-gray-900">{{ __('Name') }}</th>
                <th class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">{{ __('Email') }}</th>
                <th class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">{{ __('Registration') }}</th>
                <th class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only">{{ __('Actions') }}</span></th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
            @foreach($users as $user)
                <tr>
                    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $user->id }}</td>
                    <td class="px-3 py-4 text-sm text-gray-500">{{ $user->name }}</td>
                    <td class="px-3 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                    <td class="px-3 py-4 text-sm text-center text-gray-500">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="py-4 pr-4 text-right text-sm sm:pr-6">
                        <x-user-actions :user="$user"/>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
