<nav class="navbar bg-base-200 text-base-content sticky py-5">
    <div class="navbar-start">
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

                        @if (auth()->user()->role === 'doctor')
                            <li><a class="py-5 font-bold" href="{{ url('/dashboard') }}">Doctor Dashboard</a></li>
                        @elseif(auth()->user()->role === 'patient')
                            <li><a class="py-5 font-bold" href="{{ route('patient-dashboard') }}">Patient Dashboard</a></li>
                        @else
                            <li><a class="py-5" href="">Admin Dashboard</a></li>
                        @endif


                        <li><a class="py-5">{{ Auth::user()->name }}</a></li>
                        <li><a class="py-5">{{ Auth::user()->email }}</a></li>
                        <li><a class="py-5" href="{{ route('profile.edit') }}">Profile</a></li>
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


        <a class="mx-4" href="{{ route('home') }}">Bruh™️</a>
    </div>

    <div class="navbar-center hidden lg:flex">

        <ul class="menu menu-horizontal px-1">
            <li><a>Item 1</a></li>
            <li><a>Item 2</a></li>
        </ul>
    </div>

    <div class="navbar-end hidden gap-4 lg:flex">

        @if (Route::has('login'))

            {{-- For Authenticated Users --}}
            @auth
                <ul class="menu menu-horizontal px-1">
                    <li>
                        <details>
                            <summary>
                                <a class="" onclick="toggleMenu()">
                                    {{ Auth::user()->name }}
                                </a>
                            </summary>
                            <ul class="w-60 p-2">
                                <li><a>{{ Auth::user()->name }}</a></li>
                                <li><a>{{ Auth::user()->email }}</a></li>
                                <li><a href="{{ route('profile.edit') }}">Profile</a></li>
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
                    </li>
                    </details>
                </ul>
                @if (auth()->user()->role === 'doctor')
                    <a class="py-5 font-bold" href="{{ url('/dashboard') }}">Doctor Dashboard</a>
                @elseif(auth()->user()->role === 'patient')
                    <a class="py-5 font-bold" href="{{ route('patient-dashboard') }}">Patient Dashboard</a>
                @else
                    <a class="py-5" href="">Admin Dashboard</a>
                @endif
                {{-- End for Authenticated Users --}}


                {{-- Show this for Unauthenticated Users --}}
            @else
                <a class="btn btn-primary" href="{{ route('login') }}">Log in</a>
                @if (Route::has('register'))
                    <a class="btn btn-outline" href="{{ route('register') }}">Sign up</a>
                @endif
                {{-- End of Unauthenticated users --}}

            @endauth

        @endif
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
                <li><a class="py-5" href="#">Link1</a></li>
                <li><a class="py-5" href="#">Link2</a></li>
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
