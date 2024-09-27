<x-app-layout title="Posts">
    <x-slot:header>
        @include('components.dashboard.navbar')
    </x-slot:header>

    @include('components.dashboard.sidebar')

    <section class="max-w-4xl px-8 mt-24 sm:ml-72 md:px-0">

        <x-toast.success session="successfullAddNewPost" />
        <x-toast.danger session="failedAddNewPost" />


        <x-toast.success session="updatedPostSuccessfully" />
        <x-toast.warning session="updatePostFailed" />

        <x-toast.success session="deletedPostSuccessfully" />
        <x-toast.warning session="deletePostFailed" />

        <div class="flex justify-between">
            <x-button.link route="dashboard.posts.create" label="Add new a Post" />

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
            <table class="w-full text-sm text-left text-gray-500 rtl:text-right whitespace-nowrap">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Thumbnail
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Description
                        </th>

                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($posts as $post)
                        <tr class="border-b odd:bg-white even:bg-gray-50">
                            <td scope="row" class="px-6 py-4">
                                <img src="{{ Storage::url($post->thumbnail) }}"
                                    alt="{{ $post->writer->user->username }}"
                                    class="object-cover w-24 bg-center rounded-md aspect-video h-14">
                            </td>

                            <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                                {{ Str::limit($post->title, 30) }}
                            </th>

                            <td scope="row" class="px-6 py-4 font-medium text-gray-900">
                                {{ Str::limit($post->description, 45) }}
                            </td>

                            <td scope="row" class="px-6 py-4 font-medium text-gray-900">
                                <div class="flex gap-2">
                                    <x-button.show :route="'dashboard.posts.show'" :params="$post->slug" />

                                    <x-button.edit :route="'dashboard.posts.edit'" :params="$post->slug" />

                                    <form action="{{ route('dashboard.posts.destroy', $post->slug) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-button.delete label="Are you sure you want to delete this post?"
                                            id="{{ $post->id }}" />
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="border-b odd:bg-white even:bg-gray-50 text-nowrap">
                            <td class="px-6 py-4 text-center" colspan="4">You haven't created any articles yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>
