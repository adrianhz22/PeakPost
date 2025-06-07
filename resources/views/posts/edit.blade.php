<x-app-layout>
    <x-slot name="title">{{ __('Edit post') }}</x-slot>

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-lg mt-10">
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">{{ __('Edit post') }}</h1>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            @include('posts.form-fields', ['post' => $post])
            <x-form.button>{{ __('Save Changes') }}</x-form.button>
        </form>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-blue-500 hover:underline">{{ __('Back to home') }}</a>
        </div>
    </div>
</x-app-layout>
