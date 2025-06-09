<x-layouts.admin-layout title="Administracion">
    <h1 class="text-3xl font-bold mb-6 text-center">{{ __('Welcome to admin panel') }}</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-2xl shadow-lg p-6 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">{{ __('Total posts') }}</h2>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalPosts }}</p>
            </div>
            <div class="bg-blue-100 text-blue-600 p-4 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M19 21H5a2 2 0 01-2-2V7a2 2 0 012-2h4l2-2h4l2 2h4a2 2 0 012 2v12a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">{{ __('Pending posts') }}</h2>
                <p class="text-3xl font-bold text-yellow-500 mt-2">{{ $pendingPosts }}</p>
            </div>
            <div class="bg-yellow-100 text-yellow-500 p-4 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">{{ __('Rejected posts') }}</h2>
                <p class="text-3xl font-bold text-red-600 mt-2">{{ $rejectedPosts }}</p>
            </div>
            <div class="bg-red-100 text-red-600 p-4 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">{{ __('Total users') }}</h2>
                <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalUsers }}</p>
            </div>
            <div class="bg-green-100 text-green-600 p-4 rounded-full">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M4 20c0-2.21 3.58-4 8-4s8 1.79 8 4"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-6 mt-10">
        <h2 class="text-xl font-semibold mb-4 text-center">{{ __('Status of the posts') }}</h2>
        <canvas id="postsChart" height="100"></canvas>
    </div>

    <x-scripts.posts-chart-script :labels="$chartData['labels']" :data="$chartData['data']" />

</x-layouts.admin-layout>
