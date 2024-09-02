<x-app-layout title="{{ $user->username }} - {{ $user->name }}">
    <x-slot:header>
        @include('components.front.navbar')
    </x-slot:header>

    <section class="py-16 md:px-16">
        <div class="flex flex-col items-center justify-center gap-2 mt-8">
            <img src="{{ Storage::url($user->avatar) }}" alt="" class="object-cover w-16 h-16 rounded-md">
            <div class="flex flex-col items-center">
                <h4 class="text-2xl font-bold">{{ $user->name }}</h4>
                <span class="text-sm font-medium">&#64;{{ $user->username }}</span>
                <span class="block mt-2 text-sm text-secondary">
                    Joined Since {{ $user->writer->created_at->format('M d Y') }}
                </span>
            </div>
        </div>

        @if ($user->writer->posts->count())
            <div class="flex flex-col w-8/12 mx-auto mt-5 text-center">
                <a href="{{ route('post.detail', $user->writer->posts[0]->slug) }}">
                    <img src="{{ Storage::url($user->writer->posts[0]->thumbnail) }}"
                        alt="{{ $user->writer->posts[0]->title }}"
                        class="object-cover w-full rounded-md aspect-video md:h-96">
                    <h3 class="mt-2 text-2xl font-semibold">{{ $user->writer->posts[0]->title }}</h3>
                    <p class="text-secondary">{{ Str::limit($user->writer->posts[0]->description, 150) }}</p>
                </a>

                <span class="flex items-center justify-center mt-5 text-sm text-secondary gap-x-1">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                    </svg>

                    {{ date('M d Y', strtotime($user->writer->posts[0]->created_at)) }}

                </span>
            </div>

            <div class="grid grid-cols-12 gap-10 mt-10">
                @foreach ($user->writer->posts->skip(1) as $post)
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
        @else
            <p class="my-10 text-center">No posts have been written by the user yet.</p>
        @endif

        {{-- <h5 class="mt-10 mb-5 text-xl font-medium">
            {{ $user->name }} has created {{ $user->writer->posts->count() }} posts
        </h5> --}}


    </section>
</x-app-layout>
