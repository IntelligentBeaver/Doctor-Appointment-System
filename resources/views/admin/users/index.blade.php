<x-dashboard userName="Admin">
    @auth
        @if (Auth::user()->role === 'admin')
            <div class="m-10">

                <div>
                    <x-styling.header>Users.</x-styling.header>
                </div>
                {{-- <label class="btn" for="my_modal_6">open modal</label> --}}

                <!-- Put this part before </body> tag -->
                {{-- <input class="modal-toggle" id="my_modal_6" type="checkbox" />
                <div class="modal" role="dialog">
                    <div class="modal-box">
                        <h3 class="text-lg font-bold">Hello!</h3>
                        <p class="py-4">This modal works with a hidden checkbox!</p>
                        <div class="modal-action">
                            <button class="btn btn-error" for="my_modal_6">Close!</button>
                        </div>
                    </div>
                </div> --}}

                <table class="z-0 table">
                    <thead>
                        <tr class="bg-base-300">
                            <th class="text-lg font-bold"></th>
                            <th class="text-lg font-bold">Name</th>
                            <th class="text-lg font-bold">Email</th>
                            <th class="text-lg font-bold">Role</th>
                            <th class="text-lg font-bold">Action</th>
                        </tr>
                        @foreach ($users as $user)
                            <tr class="hover">
                                <td class="">{{ $user->id }}</td>
                                <td class="">{{ $user->name }}</td>
                                <td class="">{{ $user->email }}</td>
                                <td class="">{{ $user->role }}</td>
                                <td class="flex gap-2">
                                    <a href="{{ route('admin.editusers', $user->id) }}">
                                        <button class="btn btn-success">Edit</button>
                                    </a>
                                    <form class="inline" action="{{ route('admin.destroyusers', $user->id) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')

                                        <a class="btn btn-error" href="#my_modal_8">Delete</a>
                                        <!-- Put this part before </body> tag -->
                                        <div class="modal" id="my_modal_8" role="dialog">
                                            <div class="modal-box">
                                                <form method="dialog">
                                                </form>
                                                <h3 class="text-xl font-extrabold">Delete Record</h3>
                                                <p class="py-4">Are you sure you want to delete this record</p>


                                                <div class="flex flex-row-reverse gap-4">
                                                    <div class="modal-action">
                                                        <button class="btn btn-error" type="submit">Delete</button>
                                                    </div>
                                                    <div class="modal-action">
                                                        <a class="btn btn-neutral"
                                                            href="{{ route('admin.viewusers') }}">Close</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </thead>
                </table>
            </div>
        @endif

    @endauth
</x-dashboard>
