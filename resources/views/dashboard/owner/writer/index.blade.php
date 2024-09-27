<x-app-layout title="Writers">
    <x-slot:header>
        @include('components.dashboard.navbar')
    </x-slot:header>

    @include('components.dashboard.sidebar')

    <section class="mt-24 sm:ml-72">
        @role('owner')
            <div class="relative w-full mt-8 overflow-x-auto shadow-md sm:w-8/12 sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 rtl:text-right ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Avatar
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Status
                            </th>

                            {{-- <th scope="col" class="px-6 py-3">
                                Action
                            </th> --}}
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($writers as $writer)
                            <tr class="border-b odd:bg-white even:bg-gray-50 text-nowrap">
                                <td class="px-6 py-4">
                                    <img src="{{ Storage::url($writer->user->avatar) }}" alt="{{ $writer->user->username }}"
                                        class="object-cover bg-center rounded-full w-14 h-14 aspect-square">
                                </td>

                                <th scope="row" class="px-6 py-4 font-medium text-gray-900">
                                    {{ $writer->user->name }}
                                </th>

                                @if ($writer->is_active)
                                    <td class="px-6 py-4">
                                        <span
                                            class="px-4 py-2 text-sm font-medium text-green-400 bg-green-100 border border-green-400 rounded-full">
                                            Active
                                        </span>
                                    </td>
                                    {{-- <td class="px-6 py-4">
                                        <form action="" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <x-button.index label="DELETE"
                                                class="bg-red-600 hover:bg-red-500 focus:ring-red-600" />
                                        </form>
                                    </td> --}}
                                @else
                                    <td class="px-6 py-4">
                                        <x-button.index label="PENDING" class="bg-orange-500 cursor-default focus:ring-0" />
                                    </td>

                                    <td class="px-6 py-4">
                                        <form action="{{ route('dashboard.writers.update-status', $writer) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <x-button.index label="APPROVE"
                                                class="bg-primary hover:bg-color_hover focus:ring-primary" />
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr class="border-b odd:bg-white even:bg-gray-50 text-nowrap">
                                <td class="px-6 py-4 text-center" colspan="4">No author data available yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <div class="flex flex-col items-center justify-center w-full p-6 shadow-md sm:w-7/12">
                <svg class="text-gray-800 w-11 h-11" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M4 4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H4Zm10 5a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm0 3a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1Zm-8-5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm1.942 4a3 3 0 0 0-2.847 2.051l-.044.133-.004.012c-.042.126-.055.167-.042.195.006.013.02.023.038.039.032.025.08.064.146.155A1 1 0 0 0 6 17h6a1 1 0 0 0 .811-.415.713.713 0 0 1 .146-.155c.019-.016.031-.026.038-.04.014-.027 0-.068-.042-.194l-.004-.012-.044-.133A3 3 0 0 0 10.059 14H7.942Z"
                        clip-rule="evenodd" />
                </svg>

                <div class="mt-3 text-center">
                    <h3 class="text-lg font-semibold text-secondary">Spread Benefits</h3>
                    <p class="mb-3 text-sm text-tertiary">
                        Join as a writer on our website and<br>help spread useful information to
                        many people.
                    </p>

                    @if ($writerStatus == 'pending')
                        <x-button.index label="PENDING" class="bg-orange-500 cursor-default focus:ring-0" />
                    @elseif ($writerStatus == 'active')
                        <x-button.link route="dashboard.posts.create" label="Create a Post" />
                    @else
                        <form action="{{ route('dashboard.writers.apply') }}" method="POST">
                            @csrf
                            <x-button.index label="Apply as a writer"
                                class="bg-primary hover:bg-color_hover focus:ring-primary" />
                        </form>
                    @endif
                </div>
            </div>
        @endrole

    </section>

</x-app-layout>
