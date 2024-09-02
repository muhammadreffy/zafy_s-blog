<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <x-logo />
                </div>

                {{-- <form class="hidden w-96 lg:block">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search"
                            class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:ring-primary focus:border-primary"
                            placeholder="Search..." required />
                        <button type="submit" hidden>Search</button>
                    </div>
                </form> --}}
            </div>

            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div>
                        <button type="button" class="flex items-center text-sm rounded-full gap-x-2 "
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <h2 class="hidden font-semibold md:block">Halo, {{ Auth::user()->name }}</h2>
                            <span class="sr-only">Open user menu</span>
                            <img class="object-cover w-8 h-8 rounded-full"
                                src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->username }}">
                        </button>
                    </div>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow mr-end"
                        id="dropdown-user">
                        <ul class="py-1" role="none">
                            <li>
                                <a href="{{ route('dashboard.index') }}"
                                    class="block px-10 py-2 text-gray-700 hover:bg-gray-100" role="menuitem">Dashboard
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
                                    class="block px-10 py-2 text-gray-700 hover:bg-gray-100" role="menuitem">Settings
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
                </div>
            </div>
        </div>
    </div>
</nav>
