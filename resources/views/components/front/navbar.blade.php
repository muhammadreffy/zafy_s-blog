<nav class="fixed w-full top-0 bg-white border-gray-200 px-4 lg:px-6 py-2.5 border-b">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto">
        <x-logo />
        <div class="flex items-center lg:order-2">
            @if (!Auth::check())
                <a href="{{ route('auth.login') }}"
                    class="text-gray-800 hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none">
                    Sign in
                </a>
                <a href="{{ route('auth.registration') }}"
                    class="text-white bg-primary hover:bg-color_hover focus:ring-4 focus:ring-primary font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 focus:outline-none">
                    Get started
                </a>
            @else
                <div>
                    <button type="button" class="flex items-center text-sm rounded-full gap-x-2 " aria-expanded="false"
                        data-dropdown-toggle="dropdown-user">
                        <h2 class="hidden md:block">{{ Auth::user()->name }}</h2>
                        <span class="sr-only">Open user menu</span>
                        <img class="object-cover w-8 h-8 rounded-full" src="{{ Storage::url(Auth::user()->avatar) }}"
                            alt="{{ Auth::user()->username }}">
                    </button>
                </div>
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow mr-end"
                    id="dropdown-user">
                    <ul class="py-1" role="none">
                        <li>
                            <a href="{{ route('dashboard.index') }}"
                                class="block px-10 py-2 text-gray-700 hover:bg-gray-100" role="menuitem">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile', Auth::user()->username) }}"
                                class="block px-10 py-2 text-gray-700 hover:bg-gray-100" role="menuitem">
                                My Profil
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('settings', Auth::user()->username) }}"
                                class="block px-10 py-2 text-gray-700 hover:bg-gray-100" role="menuitem">
                                Settings
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="block w-full px-10 py-2 text-gray-700 text-start hover:bg-gray-100"
                                    role="menuitem">Sign Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endif
            {{-- <button data-collapse-toggle="mobile-menu-2" type="button"
                class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                aria-controls="mobile-menu-2" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"></path>
                </svg>
                <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button> --}}
        </div>
        {{-- <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                <li>
                    <a href="#"
                        class="block py-2 pl-3 pr-4 rounded bg-primary-700 lg:bg-transparent lg:text-primary lg:p-0"
                        aria-current="page">Home</a>
                </li>
            </ul>
        </div> --}}
    </div>
</nav>
