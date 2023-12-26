<!-- resources/views/admin/users/edit.blade.php -->

<x-dashboard userName="Admin">
    @auth


        <x-styling.header>Edit: {{ $users->name }}</x-styling.header>

        <div class="hero bg-base-200 h-[60svh]">

            <form action="{{ route('admin.updateusers', $users->id) }}" method="post">
                @csrf
                @method('put')
                @if ($errors->any())
                    <div class="alert alert-error px-8">
                        <ul style="list-style-type:disc">
                            @foreach ($errors->all() as $error)
                                <li class="font-bold">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <!-- Form fields here, e.g. name, email, etc. -->
                <div class="form-control mt-4 w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Name:</span>
                    </div>
                    <input class="input input-bordered w-full max-w-xs" name="name" type="text"
                        value="{{ $users->name }}" placeholder="{{ $users->name }}" />
                </div>

                <div class="form-control mt-4 w-full max-w-xs">
                    <div class="label">
                        <span class="label-text">Email:</span>
                    </div>
                    <input class="input input-bordered w-full max-w-xs" name="email" type="email"
                        value="{{ $users->email }}">
                </div>


                <div class="form-control mt-4 w-full">
                    <div class="label">
                        <span class="label-text">Role:</span>
                    </div>
                    <select class="select select-bordered w-full max-w-xs" name="role">
                        <option value="admin" {{ $users->role === 'admin' ? 'selected' : '' }}>Admin
                        </option>
                        <option value="doctor" {{ $users->role === 'doctor' ? 'selected' : '' }}>Doctor
                        </option>
                        <option value="patient" {{ $users->role === 'patient' ? 'selected' : '' }}>
                            Patient</option>
                    </select>
                </div>

                <div class="form-control mt-8 w-full"><button class="btn btn-success" type="submit">Update</button></div>
            </form>
        </div>

    @endauth
</x-dashboard>
