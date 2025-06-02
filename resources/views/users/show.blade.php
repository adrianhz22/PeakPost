<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4">
            <div class="bg-white shadow-lg rounded-lg p-8">

                <div class="flex flex-col items-center mb-6">
                    <div class="w-48 h-48 rounded-full overflow-hidden border-4 border-gray-300 shadow-sm">
                        <img
                            src="{{ $user->profile_photo ? asset($user->profile_photo) : asset('assets/default-photo.jpg') }}"
                            alt="Foto de perfil"
                            class="w-full h-full object-cover"
                        >
                    </div>

                    <h1 class="text-2xl font-semibold text-center text-gray-800 mt-4">
                        {{ __('Profile of') }} {{ $user->username }}
                    </h1>

                    <div class="flex justify-center gap-12 mt-4 text-center">
                        <div>
                            <p class="text-gray-600 text-sm">{{ __('Followers') }}</p>
                            <a href="{{ route('users.followers', $user) }}"
                               class="text-xl font-semibold text-blue-600">{{ $followersCount }}</a>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">{{ __('Followed') }}</p>
                            <a href="{{ route('users.following', $user) }}"
                               class="text-xl font-semibold text-blue-600">{{ $followingCount }}</a>
                        </div>
                    </div>

                    @if(auth()->id() !== $user->id)
                        <div class="mt-6">
                            @if(auth()->user()->isFollowing($user))
                                <form action="{{ route('unfollow', $user) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-red-600">
                                        {{ __('Unfollow') }}
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('follow', $user) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-600">
                                        {{ __('Follow') }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="space-y-4 text-gray-700 mb-8 text-center">
                    <p class="text-lg font-medium text-gray-800">
                        <span class="font-semibold">{{ __('Joined on:') }}</span> {{ $user->created_at->format('d/m/Y') }}
                    </p>

                    <p class="text-2xl font-bold text-blue-600 mt-4">
                        <span class="font-semibold text-gray-800">{{ __('Likes received:') }}</span> {{ $user->total_likes }}
                    </p>
                </div>

                <div class="mt-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ __('Achievements unlocked') }}</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($allAchievements as $achievement)
                            <div class="text-center bg-gray-50 p-4 rounded-lg shadow-md">
                                <div class="text-xs text-gray-500 mb-1">
                                    {{ min($postCount, $achievement->target_posts) }} / {{ $achievement->target_posts }}
                                    posts
                                </div>
                                <img src="{{ asset($achievement->image) }}"
                                     class="w-20 h-20 object-cover mx-auto mb-2
                                        @if(!in_array($achievement->id, $userAchievementIds)) grayscale opacity-40 @endif"
                                     alt="{{ $achievement->name }}">
                                <p class="text-sm text-gray-500">{{ $achievement->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">{{ __('Posts') }}</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($posts as $post)
                            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-xl transition duration-300">
                                @if($post->image)
                                    <div class="w-full h-48 bg-gray-200 rounded-lg mb-4">
                                        <img src="{{ asset($post->image) }}" alt="Imagen del post"
                                             class="w-full h-full object-cover rounded-lg">
                                    </div>
                                @endif

                                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $post->title }}</h3>
                                <p class="text-gray-600 text-sm mb-2">{{ Str::limit($post->content, 120) }}</p>
                                <a href="{{ route('posts.show', $post) }}"
                                   class="text-blue-500 text-sm hover:underline">Leer
                                    más</a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</x-app-layout>
