<div class="max-w-7xl mx-auto" x-data="{ formMode: null }"
     x-init="@this.on('editingPostStarted', () => formMode = 'edit')">

    <button @click="formMode = formMode === 'create' ? null : 'create'; $wire.resetForm()"
            class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 mb-6">
        <span x-show="formMode !== 'create'">{{ __('Create new post') }}</span>
        <span x-show="formMode === 'create'">{{ __('Close form') }}</span>
    </button>

    <div x-show="formMode === 'create'" x-transition class="mt-4 bg-white shadow-md rounded-md p-6 max-w-2xl">
        <h2 class="text-lg font-semibold mb-4 text-gray-800">{{ __('Create new post') }}</h2>
        @include('components.post-form-livewire', [
            'submitAction' => 'createPost',
            'submitButtonText' => 'Create post',
            'submitButtonClass' => 'mt-4 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700',
            'showCancel' => false,
        ])
    </div>

    @if($editingPostId)
        <div x-show="formMode === 'edit'" x-transition
             class="mt-4 bg-yellow-50 border border-yellow-200 shadow-md rounded-md p-6 max-w-2xl mx-auto">
            <h2 class="text-lg font-semibold mb-4 text-yellow-800">{{ __('Edit post') }}</h2>
            @include('components.post-form-livewire', [
                'submitAction' => 'updatePost',
                'submitButtonText' => 'Update post',
                'submitButtonClass' => 'bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700',
                'showCancel' => true,
            ])
        </div>
    @endif

    @if($posts->count() > 0)
        @foreach($posts as $post)
            <div class="bg-white shadow-md rounded-lg p-6 mb-6 flex space-x-6 relative">
                <img src="{{ asset($post->image) }}" alt="Imagen del post" class="w-32 h-32 object-cover rounded-lg">
                <div class="flex-1">
                    <a href="{{ route('posts.show', $post) }}"
                       class="text-xl font-semibold text-gray-800 hover:text-blue-500 block break-words">
                        {{ $post->title }}
                    </a>
                    <div class="text-gray-600 mt-2 flex items-center space-x-4">
                        <p><strong>{{ __('Author:') }}</strong> {{ $post->user->name }}</p>
                        <p><strong>{{ __('Date:') }}</strong> {{ $post->created_at->format('d/m/Y') }}</p>
                    </div>
                    <p class="text-gray-700 mt-4">{!! Str::limit(strip_tags($post->body), 150) !!}</p>

                    <div class="mt-4 absolute top-4 right-4" x-data="{ menu: false }">
                        <button @click="menu = !menu" type="button"
                                class="flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"/>
                            </svg>
                        </button>
                        <div x-show="menu" @click.away="menu = false"
                             class="absolute right-0 mt-2 w-44 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                            <button wire:click="editPost({{ $post->id }})" @click="formMode = 'edit'"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                {{ __('Edit') }}
                            </button>
                            <button wire:click="deletePost({{ $post->id }})"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100">
                                {{ __('Delete') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="mt-6 mb-6">
            {{ $posts->links() }}
        </div>

    @else
        <p class="text-center text-gray-500">{{ __('There are no posts available.') }}</p>
    @endif

</div>
