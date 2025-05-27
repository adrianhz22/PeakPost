@props(['action'])

<div class="max-w-4xl mx-auto space-y-6">
    <form action="{{ $action }}" method="GET" class="space-y-4">
        <div class="bg-white dark:bg-gray-100 p-6 rounded-lg shadow-md">
            <div class="relative">
                <input
                    type="text"
                    name="search"
                    class="w-full border h-12 pl-4 pr-10 rounded-lg shadow-sm dark:text-gray-800 dark:border-gray-300 dark:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Buscar por nombre o email"
                    value="{{ request('search') }}"
                >
                <button type="submit" class="absolute top-1/2 right-3 -translate-y-1/2">
                    <svg class="text-teal-600 h-5 w-5 fill-current dark:text-teal-700"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 56.966 56.966">
                        <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786
                             c0-12.682-10.318-23-23-23s-23,10.318-23,23
                             s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162
                             l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92
                             c0.779,0,1.518-0.297,2.079-0.837
                             C56.255,54.982,56.293,53.08,55.146,51.887z
                             M23.984,6c9.374,0,17,7.626,17,17
                             s-7.626,17-17,17s-17-7.626-17-17S14.61,6,23.984,6z"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4">
            <div class="relative w-full sm:w-auto">
                <select
                    name="days"
                    class="appearance-none border rounded-lg h-12 pl-3 pr-10 w-full dark:bg-gray-200 dark:border-gray-300 text-gray-700"
                    onchange="this.form.submit()"
                >
                    <option value="">Todos</option>
                    <option value="7" {{ request('days') == 7 ? 'selected' : '' }}>Últimos 7 días</option>
                    <option value="30" {{ request('days') == 30 ? 'selected' : '' }}>Últimos 30 días</option>
                    <option value="90" {{ request('days') == 90 ? 'selected' : '' }}>Últimos 90 días</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                    <svg class="w-4 h-4 text-gray-600 dark:text-gray-800" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5.25 7.75L10 12.5l4.75-4.75" stroke="currentColor" stroke-width="2" fill="none"
                              stroke-linecap="round"/>
                    </svg>
                </div>
            </div>

            <div class="relative w-full sm:w-auto">
                <select
                    name="role"
                    class="appearance-none border rounded-lg h-12 pl-3 pr-10 w-full dark:bg-gray-200 dark:border-gray-300 text-gray-700"
                    onchange="this.form.submit()"
                >
                    <option value="">Todos los roles</option>
                    @foreach(\Spatie\Permission\Models\Role::all() as $role)
                        <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                    <svg class="w-4 h-4 text-gray-600 dark:text-gray-800" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5.25 7.75L10 12.5l4.75-4.75" stroke="currentColor" stroke-width="2" fill="none"
                              stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </form>
</div>
