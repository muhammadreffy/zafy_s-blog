<x-app-layout title="Create new Category">

    <x-slot:header>
        @include('components.dashboard.navbar')
    </x-slot:header>

    @include('components.dashboard.sidebar')

    <section class="mt-24 sm:ml-72">

        <h2 class="text-xl font-semibold text-primary">Create new Category</h2>

        <form action="{{ route('dashboard.category.store') }}" method="POST" class="mt-4 w-80">
            @csrf

            <x-forms.input-text label="Name" id="name" name="name" />

            <x-forms.button label="Add category" />

        </form>

    </section>

</x-app-layout>
