<x-app-layout title="Posts">
    <x-slot:header>
        @include('components.dashboard.navbar')
    </x-slot:header>

    @include('components.dashboard.sidebar')

    <section class="px-8 mt-24 sm:ml-72 md:px-0">

        <x-toast.success session="successfullAddNewPost" />
        <x-toast.success session="updatedPostSuccessfully" />


        <x-button.link route="dashboard.posts.create" label="Add new a Post" />

        <div class="relative w-full mt-8 overflow-x-auto shadow-md sm:w-9/12 sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 rtl:text-right ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Thuhmbnail
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
                                <div class="flex">
                                    <x-button.show :route="'dashboard.posts.show'" :params="$post->slug" />

                                    <x-button.edit :route="'dashboard.posts.edit'" :params="$post->slug" />

                                    <form action="{{ route('dashboard.posts.destroy', $post->slug) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <x-button.delete />
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
