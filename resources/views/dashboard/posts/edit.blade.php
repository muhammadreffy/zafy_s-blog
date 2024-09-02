<x-app-layout title="Edit Post - {{ $post->title }}">

    <x-slot:header>
        @include('components.dashboard.navbar')
    </x-slot:header>

    @include('components.dashboard.sidebar')

    <section class="px-4 mt-24 sm:ml-72">

        <a href="{{ route('dashboard.posts.index') }}">
            <svg class="w-6 h-6 text-gray-800 lg:w-10 lg:h-10" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14M5 12l4-4m-4 4 4 4" />
            </svg>
        </a>

        <h2 class="mt-6 text-xl font-semibold text-primary md:w-3/4">Edit Post : {{ $post->title }}</h2>

        <form action="{{ route('dashboard.posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data"
            class="w-full mt-4 space-y-3 md:w-3/4">
            @csrf
            @method('PUT')
            <div class="grid-cols-2 sm:grid gap-x-2">
                <x-forms.input-text label="Title" id="title" name="title" value="{{ $post->title }}" />

                <div>
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900">
                        Category
                    </label>
                    <select id="category" name="category_id"
                        class="block w-full p-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary focus:border-primary">

                        <option disabled selected>Choose a category</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $category->id == $post->category_id ? 'selected' : '' }}>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-2 text-xs text-red-600">
                        @error('category')
                            {{ $message }}
                        @enderror
                    </p>
                </div>
            </div>

            <x-forms.input-file label="Thumbnail" id="thumbnail" name="thumbnail" value="{{ $post->thumbnail }}" />


            <x-forms.textarea label="Description" id="description" name="description"
                value="{{ $post->description }}" />

            <x-forms.button label="Update now" />

        </form>

    </section>

</x-app-layout>
