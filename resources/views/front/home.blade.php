<x-app-layout>
    <x-slot:header>
        @include('components.front.navbar')
    </x-slot:header>

    <section>
        <div class="grid h-screen max-w-screen-xl px-4 mx-auto lg:gap-6 xl:gap-4 lg:grid-cols-12">
            <div class="mx-auto place-self-center lg:col-span-7">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl xl:text-6xl">
                    Discover Inspiration and Share Your Story
                </h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl">
                    Read and write in one place designed for <br /> sharing ideas, stories, and experiences.
                </p>
                <a href="{{ route('auth.login') }}"
                    class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary hover:bg-color_hover focus:ring-4 focus:ring-primary">
                    Start Reading
                    <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <a href="{{ route('dashboard.writers.index') }}"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100">
                    Start Writing
                </a>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex lg:justify-center">
                <img src="{{ asset('img/mockup.svg') }}" alt="mockup" class="mr-24">
            </div>


        </div>
        <footer class="-mt-12 border-t border-gray-200">
            <div class="flex justify-center py-3 text-sm gap-x-5 text-secondary">
                <a href="">Help</a>
                <a href="">Status</a>
                <a href="">About</a>
                <a href="">Blog</a>
                <a href="">Privacy</a>
                <a href="">Carrers</a>
                <a href="">Teams</a>
            </div>
        </footer>
    </section>

    {{-- <section class="flex items-center justify-center h-screen pt-24">
        <div class="grid justify-center grid-cols-1 gap-8 text-center bg-red-700 md:grid-cols-2 md:text-left">
            <div>
                <h1 class="text-4xl font-bold md:text-5xl xl:text-6xl">Discover Inspiration and Share Your Story</h1>
            </div>
            <div class="flex justify-center">
                <img src="{{ asset('img/mockup.svg') }}" alt="mockup" class="w-3/4">
            </div>
        </div>
    </section> --}}

</x-app-layout>
