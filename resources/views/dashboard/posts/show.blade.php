<x-app-layout title="{{ $post->title }}">
    <div class="w-full px-8 my-8 lg:w-7/12 lg:mx-auto">
        <a href="{{ route('dashboard.posts.index') }}">
            <svg class="w-6 h-6 text-gray-800 lg:w-12 lg:h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14M5 12l4-4m-4 4 4 4" />
            </svg>
        </a>

        <div>
            <h3 class="text-xl font-bold text-black mt-7 lg:text-3xl">
                {{ $post->title }}
            </h3>

            <div class="flex items-center mt-6 gap-x-3">
                <img src="{{ Storage::url($post->writer->user->avatar) }}" alt="{{ $post->writer->user->username }}"
                    class="rounded-full w-14 h-14">

                <div>
                    <h6 class="font-medium">{{ $post->writer->user->name }}</h6>
                    <span class="text-sm text-tertiary">
                        {{ $post->created_at->diffForHumans() }} .
                    </span>
                    <span class="text-sm text-tertiary">
                        {{ date('M d,Y', strtotime($post->created_at)) }}
                    </span>
                </div>
            </div>

            <div>
                <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}"
                    class="object-cover w-full mx-auto mt-8 bg-center rounded-md md:h-96 aspect-video">

                <a href="" class="block mt-4 text-sm text-center text-tertiary">{{ $category->name }}</a>

                <p class="mt-6">{{ $post->description }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
