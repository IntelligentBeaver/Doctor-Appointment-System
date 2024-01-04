<x-dashboard>
    <x-styling.header>
        Users
    </x-styling.header>
    <x-styling.subheader>
        Manage current users
    </x-styling.subheader>
    {{-- Display all these code if User is logged in --}}
    @auth
        @if (Auth::user()->role === 'admin')
            <div>
                {{-- <x-styling.header class="mx-10">Users</x-styling.header>
                <x-styling.subheader class="mx-10">View current users</x-styling.subheader> --}}

                <div class="xs:m-0 md:m-10">
                    <table class="z-0 table">
                        <thead>
                            <tr class="bg-base-300">
                                <th class="text-xl font-bold"></th>
                                <th class="text-xl font-bold">Name</th>
                                <th class="text-xl font-bold">Email</th>
                                <th class="text-xl font-bold">Role</th>
                                <th class="text-xl font-bold">Action</th>
                            </tr>
                            @foreach ($users as $user)
                                <tr class="hover">
                                    <td class="text-base font-normal">{{ $user->id }}</td>
                                    <td class="text-base font-normal">{{ $user->name }}</td>
                                    <td class="text-base font-normal">{{ $user->email }}</td>
                                    <td class="text-base font-normal">{{ $user->role }}</td>
                                    <td class="flex gap-2 text-base font-normal">
                                        {{-- An Edit Button to edit the user's details --}}
                                        {{-- Checks if the User is the same as the Record --}}
                                        @if (Auth::user()->id === $user->id)
                                            <span class="font-bold">You</span>
                                        @else
                                            <a href="{{ route('admin.editusers', $user->id) }}">
                                                <button class="btn btn-info">Edit</button>
                                            </a>
                                            {{-- Button for delete --}}

                                            @if ($user->role === 'admin')
                                            @else
                                                <form class="inline" action="{{ route('admin.destroyusers', $user->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <a class="btn btn-error" href="#my_modal_8">Delete</a>
                                                    {{-- The popup if we click the Delete Button --}}
                                                    <div class="modal" id="my_modal_8" role="dialog">
                                                        <div class="modal-box">
                                                            <form method="dialog">
                                                            </form>
                                                            <h3 class="text-xl font-extrabold">Delete Record</h3>
                                                            <p class="py-4">Are you sure you want to delete this record
                                                            </p>
                                                            <div class="flex flex-row-reverse gap-4">
                                                                <div class="modal-action">
                                                                    <button class="btn btn-error"
                                                                        type="submit">Delete</button>
                                                                </div>
                                                                <div class="modal-action">
                                                                    <a class="btn btn-neutral"
                                                                        href="{{ route('admin.viewusers') }}">Close</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </thead>
                    </table>
                </div>
            </div>
        @endif

    @endauth
</x-dashboard>
