<div class="bg-gray-100 p-4 rounded-lg shadow mb-4"
     x-data="{ menu: false, editMode: false }">
    <div class="flex items-center justify-between relative">
        <div class="flex items-center space-x-2">
            <img
                src="{{ $comment->user->profile_photo ? asset($comment->user->profile_photo) : asset('assets/default-photo.jpg') }}"
                alt="Profile"
                class="w-8 h-8 rounded-full object-cover border border-gray-300 aspect-square"
            >
            <a href="{{ route('users.show', $comment->user) }}">
                {{ $comment->user->username }}
            </a>
            <span class="text-sm text-gray-500">{{ $comment->created_at->format('d/m/Y') }}</span>
        </div>

        <div class="relative">
            <button @click="menu = !menu"
                    class="text-gray-500 hover:text-gray-700 focus:outline-none">
                <i class="fas fa-ellipsis-v"></i>
            </button>

            <div x-show="menu" @click.away="menu = false" x-cloak
                 class="absolute right-0 top-full mt-2 w-40 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 z-50">
                @can('update', $comment)
                    <button @click="editMode = true; menu = false"
                            class="w-full px-4 py-2 text-left">
                        {{ __('Edit') }}
                    </button>
                @endcan

                @can('delete', $comment)
                    <button type="submit" form="deleteForm-{{ $comment->id }}"
                            class="w-full px-4 py-2 text-left">
                        {{ __('Delete') }}
                    </button>
                    <form id="deleteForm-{{ $comment->id }}"
                          action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                          class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                @endcan
            </div>
        </div>
    </div>

    <div x-show="editMode" x-transition class="mt-2">
        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf @method('PUT')
            <textarea name="content" rows="3"
                      class="w-full p-3 border rounded focus:ring focus:ring-blue-300"
                      required>{{ $comment->content }}</textarea>
            <button type="submit"
                    class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ __('Save Changes') }}
            </button>
        </form>
    </div>

    <div x-show="!editMode" class="mt-2">
        <p>{{ $comment->content }}</p>
    </div>

    <div class="mt-2" x-data="{ showReplyForm: false }">
        <button @click="showReplyForm = !showReplyForm"
                class="text-blue-500 hover:underline font-medium">
            {{ __('Reply') }}
        </button>

        <form x-show="showReplyForm" x-cloak action="{{ route('comments.store', $post) }}"
              method="POST" class="mt-2">
            @csrf
            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
            <textarea name="content" rows="2"
                      class="w-full p-2 border rounded focus:ring focus:ring-blue-300"
                      placeholder="{{ __('Write a reply...') }}" required></textarea>
            <button type="submit"
                    class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ __('Reply') }}
            </button>
        </form>
    </div>

    @if($comment->replies->count())
        <div class="ml-4 mt-4 space-y-2">
            @foreach ($comment->replies as $reply)
                <div class="bg-gray-200 p-3 rounded relative"
                     x-data="{ menu: false, editMode: false }">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <img
                                src="{{ $reply->user->profile_photo ? asset($reply->user->profile_photo) : asset('assets/default-photo.jpg') }}"
                                alt="Profile"
                                class="w-8 h-8 rounded-full object-cover border border-gray-300 aspect-square"
                            >
                            <a href="{{ route('users.show', $reply->user) }}">
                                {{ $reply->user->username }}
                            </a>
                            <span
                                class="text-sm text-gray-500 ml-2">{{ $reply->created_at->format('d/m/Y') }}</span>
                        </div>

                        <div class="relative">
                            <button @click="menu = !menu"
                                    class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>

                            <div x-show="menu" @click.away="menu = false" x-cloak
                                 class="absolute right-0 top-full mt-2 w-40 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 divide-y divide-gray-100 z-50">
                                @can('update', $comment)
                                    <button @click="editMode = true; menu = false"
                                            class="w-full px-4 py-2 text-left">
                                        {{ __('Edit') }}
                                    </button>
                                @endcan

                                @can('delete', $comment)
                                    <button type="submit" form="deleteForm-{{ $comment->id }}"
                                            class="w-full px-4 py-2 text-left">
                                        {{ __('Delete') }}
                                    </button>
                                    <form id="deleteForm-{{ $comment->id }}"
                                          action="{{ route('comments.destroy', $comment->id) }}"
                                          method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endcan
                            </div>

                        </div>
                    </div>

                    <div x-show="editMode" x-transition class="mt-2">
                        <form action="{{ route('comments.update', $reply->id) }}" method="POST">
                            @csrf @method('PUT')
                            <textarea name="content" rows="2"
                                      class="w-full p-2 border rounded focus:ring focus:ring-blue-300"
                                      required>{{ $reply->content }}</textarea>
                            <button type="submit"
                                    class="mt-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                {{ __('Save Changes') }}
                            </button>
                        </form>
                    </div>

                    <div x-show="!editMode" class="mt-1">
                        {{ $reply->content }}
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
