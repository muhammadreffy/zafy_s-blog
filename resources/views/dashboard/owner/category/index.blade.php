<x-app-layout title="Categories">
    <x-slot:header>
        @include('components.dashboard.navbar')
    </x-slot:header>

    @include('components.dashboard.sidebar')

    <section class="max-w-4xl px-4 mt-24 sm:px-0 sm:ml-72">
        <div>
            <x-toast.success session="successfullyAddedCategory" />
            <x-toast.danger session="failedAddCategory" />

            <x-toast.success session="updatedCategorySuccess" />
            <x-toast.warning session="updateCategoryFailed" />

            <x-toast.success session="successDeleteCategory" />
            <x-toast.danger session="failedDeleteCategory" />
        </div>

        <div class="flex justify-between">
            <x-button.link route="dashboard.category.create" label="Add new Category" />

            <form class="flex items-center">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" name="search" id="simple-search"
                        class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary focus:border-primary"
                        placeholder="Search" required>

                    <button type="submit" class="hidden">
                        Search
                    </button>
                </div>
            </form>
        </div>

        <div class="relative w-full mt-8 overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 rtl:text-right">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr class="border-b odd:bg-white even:bg-gray-50">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                                {{ $category->name }}
                            </th>
                            <td class="px-6 py-4">
                                <div class="flex gap-x-3">

                                    {{-- <x-button.link route="dashboard.category.edit" :params="$category->slug" label="Edit" /> --}}

                                    <x-button.edit :route="'dashboard.category.edit'" :params="$category->slug" />


                                    <form
                                        action="
                                        {{ route('dashboard.category.destroy', $category->slug) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')
                                        {{-- <x-button.index label="Delete"
                                            class="bg-red-600 hover:bg-red-500 focus:ring-red-600" /> --}}

                                        <x-button.delete label="Are you sure you want to delete this category?"
                                            id="{{ $category->id }}" />
                                    </form>
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr class="border-b odd:bg-white even:bg-gray-50">
                            <td class="px-6 py-4 text-center" colspan="4">No Category data has been added yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>
