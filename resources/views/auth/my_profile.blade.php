<x-app-layout title="{{ Auth::user()->username }} ({{ Auth::user()->name }})">
    <x-slot:header>
        @include('components.dashboard.navbar')
    </x-slot:header>

    <section class="mx-auto mt-24 md:w-7/12">
        <div class="px-8">
            <h3 class="text-xl font-semibold">My Profile</h3>

            <div class="px-4 py-2 rounded-md shadow-md">
                <div class="flex my-3 gap-x-3">
                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->username }}"
                        class="object-cover w-16 h-16 rounded-full">
                    <div class="space-y-[0.4px] flex flex-col justify-center">
                        <p class="text-lg">
                            {{ Auth::user()->name }}
                        </p>
                        <p class="text-sm text-secondary">
                            <span class="text-emerald-500">Status : </span>{{ $status }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="px-4 py-5 my-4 rounded-md shadow-md">
                <h3 class="mb-2 text-lg font-medium">Personal Information</h3>

                <div class="mb-3">
                    <p class="mb-1 text-sm text-secondary">Full Name</p>
                    <p class="w-full p-2 bg-gray-100 border border-gray-300 rounded border-1">
                        {{ Auth::user()->name }}
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-x-2">
                    <div>
                        <p class="text-sm text-secondary">Username</p>
                        <p class="w-full p-2 bg-gray-100 border border-gray-300 rounded border-1">
                            {{ Auth::user()->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-secondary">Email</p>
                        <p class="w-full p-2 bg-gray-100 border border-gray-300 rounded border-1">
                            {{ Auth::user()->email }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
