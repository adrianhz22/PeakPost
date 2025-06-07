<div class="flex space-x-4">
    @can('update', $post)
        <a href="{{ route('posts.edit', $post->id) }}"
           class="flex items-center bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-700 transition duration-200 ease-in-out">
            <i class="fas fa-pencil-alt mr-2"></i> {{ __('Edit') }}
        </a>
    @endcan
    @can('delete', $post)
        <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
              id="deleteForm-{{ $post->id }}">
            @csrf
            @method('DELETE')
            <button type="button"
                    onclick="confirmDelete({{ $post->id }})"
                    class="flex items-center bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-red-700 transition duration-200 ease-in-out">
                <i class="fas fa-trash-alt mr-2"></i> {{ __('Delete') }}
            </button>
        </form>
    @endcan
</div>
