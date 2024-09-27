<x-app-layout>
    <x-slot:header>
        @include('components.front.navbar')
    </x-slot:header>
    {{-- <div class="sm:hidden">
        <label for="tabs" class="sr-only">Select your country</label>
        <select id="tabs"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option>Profile</option>
            <option>Dashboard</option>
            <option>setting</option>
            <option>Invoioce</option>
        </select>
    </div>

    <ul class="hidden overflow-hidden text-sm font-medium text-center text-gray-500 rounded-lg shadow pt-14 sm:flex">
        @foreach ($categories as $category)
            <li class="w-full focus-within:z-10">
                <a href="#"
                    class="inline-block w-full p-4 text-gray-900 bg-gray-100 border-r border-gray-200 rounded-s-lg focus:ring-4 focus:ring-blue-300 active focus:outline-none"
                    aria-current="page">{{ $category->name }}</a>
            </li>
        @endforeach
    </ul> --}}

    <section class="py-16 md:px-16">
        <div class="grid grid-cols-12 gap-x-8">
            <div class="col-span-8 px-8 py-4 space-y-6 border-r border-gray-100">
                @foreach ($posts as $post)
                    <div>
                        <a href="{{ route('profile.user', $post->writer->user->username) }}"
                            class="flex items-center gap-x-2">
                            <img src="{{ Storage::url($post->writer->user->avatar) }}" alt="{{ $post->name }}"
                                class="object-cover rounded-full w-7 h-7 aspect-square">
                            <span class="text-sm font-medium hover:underline">{{ $post->writer->user->name }}</span>
                        </a>

                        <a href="{{ route('post.detail', $post->slug) }}" class="flex gap-x-3">
                            <div class="mt-3">
                                <h3 class="text-xl font-bold hover:underline">{{ $post->title }}</h3>
                                <p class="text-sm font-medium text-secondary">{{ Str::limit($post->description, 100) }}
                                </p>

                                <span class="flex items-center mt-2 text-xs gap-x-1 text-secondary">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    {{ $post->created_at->diffForHumans() }}
                                </span>
                            </div>

                            <img src="{{ Storage::url($post->thumbnail) }}" alt=""
                                class="object-cover mt-3 rounded-md w-44 h-28 aspect-video">
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="col-span-3">
                <div class="px-5 py-4 border-l border-gray-100">
                    <h4 class="mb-4 font-semibold">Populer Writers</h4>

                    <div class="space-y-6">
                        @foreach ($writers as $writer)
                            <div>
                                <a href="{{ route('profile.user', $writer->user->username) }}"
                                    class="flex items-center gap-x-2">
                                    <img src="{{ Storage::url($writer->user->avatar) }}"
                                        alt="{{ $writer->user->username }}"
                                        class="object-cover rounded-full w-7 h-7 aspect-square">
                                    <span class="text-sm font-medium hover:underline">{{ $writer->user->name }}</span>
                                </a>

                                <p class="text-sm text-secondary ml-9">Has created {{ $writer->posts_count }} articles
                                </p>
                            </div>
                        @endforeach

                        <div class="w-full">
                            <h5 class="font-semibold">Populer Topics</h5>

                            <div class="flex flex-wrap gap-3">
                                @foreach ($categories as $category)
                                    <div class="mt-3">
                                        <a href="{{ route('category', $category->slug) }}"
                                            class="px-3 py-2 text-sm bg-gray-100 rounded-md">{{ $category->name }}</a>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
