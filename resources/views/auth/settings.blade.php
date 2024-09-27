<x-app-layout title="{{ Auth::user()->username }} - Profile">
    <x-slot:header>
        @include('components.dashboard.navbar')
    </x-slot:header>

    <section class="mx-auto my-24 md:w-7/12">
        <div class="px-8">
            <x-toast.success session="UpdatedSuccessProfile" />

            <h3 class="text-xl font-semibold">My Profile</h3>

            <form action="{{ route('update_profile', $user->username) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="px-4 py-5 my-2 rounded-md shadow-md">
                    <div class="flex items-center mb-4 gap-x-4">
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->username }}"
                            class="object-cover w-24 h-24 rounded-md">
                        <div class="flex flex-col gap-y-3">
                            <div class="items-center md:flex gap-x-2">
                                <label for="avatar"
                                    class="px-3 py-2 text-sm font-medium text-white rounded-sm cursor-pointer bg-primary hover:bg-color_hover">
                                    Select Photo
                                </label>
                                <input type="file" id="avatar" name="avatar" hidden>

                                @error('avatar')
                                    <span class="block mt-3 text-xs text-red-600 md:mt-0">
                                        {{ $message }}
                                    </span>
                                @enderror

                            </div>

                            <p class="text-xs w-52 text-secondary">
                                Your profile picture should have a 1:1 ratio and be no larger than 2MB.
                            </p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <x-forms.input-text label="Name" id="name" name="name" value="{{ $user->name }}" />
                    </div>

                    <div class="mb-3">
                        <x-forms.input-text label="Username" id="username" name="username"
                            value="{{ $user->username }}" />
                    </div>

                    <div class="mb-7">
                        <x-forms.input-text label="Email" id="email" name="email" value="{{ $user->email }}" />
                    </div>

                    <div class="p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50" role="alert">
                        Fill in if you want to change the password.
                    </div>

                    <div class="mb-3">
                        <x-forms.input-text type="password" label="Current Password" id="password"
                            name="current_password" placeholder="••••••••" />
                    </div>

                    <div class="mb-3">
                        <x-forms.input-text type="password" label="New Password" id="password" name="password"
                            placeholder="••••••••"
                            description="Use at least 8 characters with a combination of letters and numbers" />
                    </div>

                    <div class="mb-4">
                        <x-forms.input-text type="password" label="Confirm New Password" id="confirm_password"
                            name="confirm_password" placeholder="••••••••" />
                    </div>

                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white rounded-md bg-primary hover:bg-color_hover focus:ring-primary focus:outline-none focus:ring-4">
                        Save Changes
                    </button>

                    {{-- <x-forms.button label="Save Changes" /> --}}
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
