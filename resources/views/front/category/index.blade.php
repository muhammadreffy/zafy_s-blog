<x-app-layout title="Category - {{ $category->name }}">
    <x-slot:header>
        @include('components.front.navbar')
    </x-slot:header>

    <section class="py-16 md:px-16">
        <div class="flex flex-col items-center gap-1 mt-8">
            <h3 class="text-3xl font-bold">{{ $category->name }}</h3>
            <span class="text-secondary">This category has {{ $category->posts->count() }} posts</span>
        </div>

        <div class="mt-10">
            <h4 class="mb-6 text-xl font-semibold">Latest Posts</h4>

            <div class="grid grid-cols-12 gap-10">
                @foreach ($posts as $post)
                    <div class="col-span-6">
                        <a href="{{ route('post.detail', $post->slug) }}">
                            <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->name }}"
                                class="object-cover w-full rounded-md aspect-video">
                        </a>

                        <a href="{{ route('profile.user', $post->writer->user->username) }}"
                            class="flex items-center mt-3 gap-x-1">
                            <img src="{{ Storage::url($post->writer->user->avatar) }}"
                                alt="{{ $post->writer->user->name }}" class="object-cover w-4 h-4 rounded-full">
                            <span class="text-sm hover:underline">{{ $post->writer->user->name }}</span>
                        </a>

                        <a href="{{ route('post.detail', $post->slug) }}" class="flex flex-col gap-1 mt-2">
                            <h4 class="text-lg font-semibold">{{ $post->title }}</h4>
                            <p class="text-sm text-secondary">{{ Str::limit($post->description, 150) }}</p>
                        </a>

                        <span class="flex items-center mt-3 text-xs text-secondary gap-x-1">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            {{ $post->created_at->diffForHumans() }}
                        </span>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
</x-app-layout>
