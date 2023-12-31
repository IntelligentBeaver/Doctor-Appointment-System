<!-- resources/views/admin/users/edit.blade.php -->

<x-dashboard userName="Admin">
    <x-styling.header>
        {{ $users->name }}
    </x-styling.header>
    <x-styling.subheader>
        Edit information
    </x-styling.subheader>


    @auth
        <div class="hero bg-base-200 h-[60svh]">
            <form action="{{ route('admin.updateusers', $users->id) }}" method="post">
                @csrf
                @method('put')

                <x-error-message />

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

                @if ($users->role === 'admin')
                @else
                    <div class="form-control mt-4">
                        <label class="label cursor-pointer" for="admin_role">
                            <span class="label-text text-error">Assign Admin Role</span>
                            <input class="checkbox checkbox-error" id="admin_role" name="admin_role" type="checkbox"
                                {{ $users->role === 'admin' ? 'checked' : '' }}>
                    </div>
                @endif
                <div class="form-control mt-8 w-full"><button class="btn btn-success" type="submit">Update</button>
                </div>
            </form>
        </div>

    @endauth
</x-dashboard>
