<x-app-layout title="Create new Post">

    <x-slot:header>
        @include('components.dashboard.navbar')
    </x-slot:header>

    @include('components.dashboard.sidebar')

    <section class="px-4 mt-24 sm:ml-72">

        <h2 class="text-xl font-semibold text-primary">Create new Post</h2>

        <form action="{{ route('dashboard.posts.store') }}" method="POST" enctype="multipart/form-data"
            class="w-full mt-4 space-y-3 md:w-3/4">
            @csrf

            <div class="grid-cols-2 sm:grid gap-x-2">
                <x-forms.input-text label="Title" id="title" name="title" />

                <div>
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900">
                        Category
                    </label>
                    <select id="category" name="category_id"
                        class="block w-full p-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary focus:border-primary">

                        <option disabled selected>Choose a category</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <p class="mt-2 text-xs text-red-600">
                        @error('category')
                            {{ $message }}
                        @enderror
                    </p>
                </div>
            </div>

            <x-forms.input-file label="Thumbnail" id="thumbnail" name="thumbnail" />

            <x-forms.textarea label="Description" id="description" name="description" />

            <x-forms.button label="Add a new post" />

        </form>

    </section>

</x-app-layout>
