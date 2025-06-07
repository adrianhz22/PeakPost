<x-app-layout>
    <x-slot name="title">{{ __('Create post') }}</x-slot>

    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">{{ __('Create post') }}</h1>

        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @include('posts.form-fields')
            <x-form.button>{{ __('Publish') }}</x-form.button>
        </form>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-blue-500 hover:underline">{{ __('Back to home') }}</a>
        </div>
    </div>
</x-app-layout>
