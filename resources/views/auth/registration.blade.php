<x-app-layout title="Registration Account">
    <section class="px-6 py-8 bg-gray-50">
        <div class="flex flex-col items-center justify-center mx-auto">
            <div class="mb-4">
                <x-logo />
            </div>
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-secondary md:text-2xl">
                        Create an account
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('auth.registration-store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <x-forms.input-text label="Name" id="name" name="name" placeholder="type your name"
                            description="Name must be between 3 and 50 characters" />

                        <x-forms.input-text label="Username" id="username" name="username"
                            placeholder="type your username"
                            description="Username must be between 3 and 30 characters" />

                        <x-forms.input-file label="Avatar" id="avatar" name="avatar" />

                        <x-forms.input-text label="Email" id="email" name="email"
                            placeholder="type your email" />

                        <x-forms.input-text type="password" label="Password" id="password" name="password"
                            placeholder="••••••••"
                            description="Use at least 8 characters with a combination of letters and numbers" />

                        <x-forms.input-text type="password" label="Confirm Password" id="confirm_password"
                            name="confirm_password" placeholder="••••••••" />

                        <x-forms.button label="Create an Account" />

                        <p class="text-sm font-light text-gray-500">
                            Already have an account?
                            <a href="{{ route('auth.login') }}" class="font-medium text-primary hover:underline">
                                Login here
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
