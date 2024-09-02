<x-app-layout title="Login Account">
    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="mb-4">
                <x-logo />
            </div>

            <x-toast.success session="registrationSuccessful" />

            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
                        Sign in to your account
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('auth.login-authenticate') }}" method="POST">
                        @csrf

                        <x-forms.input-text label="Email" id="email" name="email"
                            placeholder="type your email" />

                        <x-forms.input-text type="password" label="Password" id="password" name="password"
                            placeholder="••••••••" />

                        <x-forms.button label="Sign in" />
                        <p class="text-sm font-light text-gray-500">
                            Don’t have an account yet?
                            <a href="{{ route('auth.registration') }}"
                                class="font-medium text-primary hover:underline">Sign up
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
