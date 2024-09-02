<x-app-layout title="Categories">
    <x-slot:header>
        @include('components.dashboard.navbar')
    </x-slot:header>

    @include('components.dashboard.sidebar')

    <section class="px-4 mt-24 sm:px-0 sm:ml-72">
        <div class="mt-5">
            <x-toast.success session="successfullAddCategory" />
            <x-toast.success session="updatedCategory" />
            <x-toast.success session="successDeleteCategory" />
        </div>
        <x-button.link route="dashboard.category.create" label="Add new Category" />

        <div class="relative w-full mt-8 overflow-x-auto shadow-md sm:w-6/12 sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 rtl:text-right">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Category
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

                                    <x-button.link route="dashboard.category.edit" :params="['slug' => $category->slug]" label="Edit" />

                                    <form
                                        action="
                                        {{ route('dashboard.category.destroy', ['slug' => $category->slug]) }}"
                                        method="POST">

                                        @csrf
                                        @method('DELETE')
                                        <x-button.index label="Delete"
                                            class="bg-red-600 hover:bg-red-500 focus:ring-red-600" />
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
