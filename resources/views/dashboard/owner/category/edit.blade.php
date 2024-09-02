<x-app-layout title="Edit Categories">

    <x-slot:header>
        @include('components.dashboard.navbar')
    </x-slot:header>

    @include('components.dashboard.sidebar')

    <section class="mt-24 sm:ml-72">
        <h2 class="text-xl font-semibold text-primary">Edit Category</h2>

        <form action="{{ route('dashboard.category.update', ['slug' => $category->slug]) }}" method="POST"
            class="mt-4 w-80">
            @csrf
            @method('PUT')

            <x-forms.input-text label="Name" id="name" name="name" value="{{ $category->name }}" />

            <x-forms.button label="Update Category" />
        </form>
    </section>
</x-app-layout>
