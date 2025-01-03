<div class="navbar-end gap-4 lg:flex">
    {{-- Theme Toggler --}}
    {{-- <label class="hidden cursor-pointer gap-2 dark:flex">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
        </svg>
        <input class="toggle theme-controller" type="checkbox" value="mytheme" />
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="5" />
            <path
                d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4" />
        </svg>
    </label>


    <label class="flex cursor-pointer gap-2 dark:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="5" />
            <path
                d="M12 1v2M12 21v2M4.2 4.2l1.4 1.4M18.4 18.4l1.4 1.4M1 12h2M21 12h2M4.2 19.8l1.4-1.4M18.4 5.6l1.4-1.4" />
        </svg>
        <input class="toggle theme-controller" type="checkbox" value="dark" />

        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
        </svg>
    </label> --}}

    {{-- Theme toggler ends --}}
    @auth
        <div class="dropdown dropdown-bottom dropdown-end">
            <div class="m-1" tabindex="0">
                <div class="btn btn-ghost btn-circle avatar" role="button" tabindex="0">
                    <div class="w-10 rounded-full">
                        <img src="{{ asset(Auth::user()->image) }}" alt="{{ Auth::user()->name }}" />
                    </div>
                </div>
            </div>
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
            {{-- End of Unauthenticated users --}}
        @else
            @if (Route::has('login'))
                <a class="btn btn-primary" href="{{ route('login') }}">Log in</a>
            @endif
            @if (Route::has('register'))
                <a class="btn btn-outline" href="{{ route('register') }}">Sign up</a>
            @endif

        @endauth

    </div>
</div>
{{-- <div class="navbar-end lg:hidden">
    <div class="dropdown dropdown-end">
        <div class="btn btn-ghost lg:hidden" role="button" tabindex="0">
            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
            </svg>
        </div>
    </div>
</div> --}}
