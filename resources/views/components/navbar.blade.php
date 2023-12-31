<nav class="navbar bg-base-200 text-base-content sticky py-5">


    <div class="navbar-start flex">
        <div class="dropdown">
            <div class="btn btn-ghost lg:hidden" role="button" tabindex="0">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
            <ul class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                @if (Route::has('login'))

                    @auth
                        <li class="no-animation py-5 text-center">{{ Auth::user()->name }}</li>


                        @if (auth()->user()->role === 'doctor')
                            <li><a class="py-5 font-bold" href="{{ url('/doctor.dashboard') }}">Doctor Dashboard</a></li>
                        @elseif(auth()->user()->role === 'patient')
                            <li><a class="py-5 font-bold" href="{{ route('patient.dashboard') }}">Patient Dashboard</a></li>
                        @else
                            <li><a class="py-5 font-bold" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                            <li>
                                <a class="py-5 font-bold" href="{{ route('admin.viewusers') }}">View Users</a>
                            </li>
                        @endif


                        <li><a class="py-5 font-bold" href="{{ route('profile.edit') }}">Profile</a></li>
                        <div class="divider m-0 p-0"></div>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="py-5 font-bold text-red-400"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </button>
                                </a>
                            </form>
                        </li>
                    @else
                        <li><a class="py-5" href="{{ route('login') }}">Log in</a></li>
                        @if (Route::has('register'))
                            <li><a class="py-5" href="{{ route('register') }}">Register</a></li>
                        @endif
                    @endauth

                @endif
            </ul>
        </div>


        @auth
            <div class="hidden lg:flex">
                <div class="drawer">
                    <input class="drawer-toggle" id="my-drawer" type="checkbox" />
                    <div class="drawer-content flex px-12">

                        <!-- Page content here -->
                        <label class="btn btn-ghost btn-outline drawer-button" for="my-drawer">
                            <i class="fa-solid fa-bars"></i>
                        </label>

                    </div>


                    <div class="drawer-side z-10">
                        <label class="drawer-overlay" for="my-drawer" aria-label="close sidebar"></label>
                        <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">

                            <!-- Sidebar content here -->
                            @if (auth()->user()->role === 'doctor')
                                <li><a class="py-5 font-bold hover:shadow-lg" href="{{ route('doctor.dashboard') }}">Doctor
                                        Dashboard</a>
                                </li>
                            @elseif(auth()->user()->role === 'patient')
                                <li><a class="py-5 font-bold hover:shadow-lg"
                                        href="{{ route('patient.dashboard') }}">Patient
                                        Dashboard</a>
                                </li>
                            @else
                                <li><a class="py-5 font-bold hover:shadow-lg" href="{{ route('admin.dashboard') }}">Admin
                                        Dashboard</a>
                                </li>
                                <li>
                                    <a class="py-5 font-bold hover:shadow-lg" href="{{ route('admin.viewusers') }}">View
                                        Users</a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        @endauth
        <div><a class="mx-4" href="{{ route('home') }}">Bruh™️</a></div>
    </div>

    <div class="navbar-center hidden lg:flex">

        <ul class="menu menu-horizontal px-1">
            <li><a class="py-4 font-bold hover:shadow-lg" href="{{ route('contacts') }}">Contact Us</a></li>
            <li><a class="py-4 font-bold hover:shadow-lg">Item 2</a></li>
        </ul>
    </div>

    <div class="navbar-end hidden gap-4 lg:flex">
        @if (Route::has('login'))
            @auth
                <div class="dropdown dropdown-bottom dropdown-end">
                    <div class="btn m-1" role="button" tabindex="0"> {{ Auth::user()->name }}</div>
                    <ul class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow" tabindex="0">


                        @if (auth()->user()->role === 'doctor')
                            <li><a class="py-5 font-bold" href="{{ route('doctor.dashboard') }}">Doctor
                                    Dashboard</a>
                            </li>
                        @elseif(auth()->user()->role === 'patient')
                            <li><a class="py-5 font-bold" href="{{ route('patient.dashboard') }}">Patient
                                    Dashboard</a>
                            </li>
                        @else
                            <li><a class="py-5 font-bold" href="{{ route('admin.dashboard') }}">Admin
                                    Dashboard</a>
                            </li>
                        @endif


                        <li><a class="py-5 font-bold" href="{{ route('profile.edit') }}">Profile</a></li>

                        <div class="divider m-0 p-0"></div>

                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="font-bold text-red-400"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </button>
                                </a>
                            </form>
                        </li>

                    </ul>
                @else
                    <a class="btn btn-primary" href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a class="btn btn-outline" href="{{ route('register') }}">Sign up</a>
                    @endif
                    {{-- End of Unauthenticated users --}}
                @endauth
        @endif
    </div>
    </div>

    <div class="navbar-end lg:hidden">
        <div class="dropdown dropdown-end">
            <div class="btn btn-ghost lg:hidden" role="button" tabindex="0">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
            <ul class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                <li><a class="py-5 font-bold hover:shadow-lg" href="#">Link 2</a></li>
                <li><a class="py-4 font-bold hover:shadow-lg" href="{{ route('contacts') }}">Contact Us</a></li>
            </ul>
        </div>
    </div>
</nav>

<script>
    function toggleMenu() {
        var menu = document.getElementById('responsiveMenu');
        menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
    }
</script>
