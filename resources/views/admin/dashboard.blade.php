<x-dashboard userName="{{ Auth::user()->role }}">
    <div>
        <x-styling.header>{{ Auth::user()->name }}</x-styling.header>
        <x-styling.subheader class="text-xl">Your dashboard</x-styling.subheader>

    </div>
    {{-- <div class="drawer">
        <input class="drawer-toggle" id="my-drawer" type="checkbox" />
        <div class="drawer-content flex px-12">

            <!-- Page content here -->
            <label class="btn btn-secondary drawer-button" for="my-drawer">Open drawer</label>

        </div>


        <div class="drawer-side">
            <label class="drawer-overlay" for="my-drawer" aria-label="close sidebar"></label>
            <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">

                <!-- Sidebar content here -->
                <li>
                    <a class="" href="{{ route('admin.viewusers') }}">View Users</a>
                </li>

            </ul>
        </div>
    </div> --}}

</x-dashboard>
