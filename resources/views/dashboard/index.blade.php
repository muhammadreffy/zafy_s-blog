<x-app-layout title="Dashboard">

    <x-slot:header>
        @include('components.dashboard.navbar')
    </x-slot:header>

    @include('components.dashboard.sidebar')

    <section class="px-8 mt-24 sm:ml-72 md:px-0">


        {{-- <h2 class="text-lg font-medium">Latest Posts</h2>
        <div class="grid w-full gap-4 my-4 md:grid-cols-2 lg:w-9/12">
            @forelse ($posts as $post)
                <div
                    class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <img class="object-cover w-full h-48 rounded-t-lg" src="{{ Storage::url($post->thumbnail) }}"
                            alt="" />
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy
                                technology acquisitions 2021</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise
                            technology acquisitions of 2021 so far, in reverse chronological order.</p>
                        <a href="#"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Read more
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <p>No posts yet</p>
            @endforelse
        </div> --}}
    </section>
</x-app-layout>
