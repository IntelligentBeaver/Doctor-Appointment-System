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
