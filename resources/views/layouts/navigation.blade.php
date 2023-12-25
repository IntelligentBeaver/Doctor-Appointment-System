{{-- <nav>
    <div>
        <a href="{{ route('dashboard') }}">
            <img class="w-auto h-9" src="{{ asset('path/to/your/logo.png') }}" alt="Logo">
        </a>
    </div>

    <div>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
        </ul>
    </div>

    <div>
        <button onclick="toggleMenu()">
            <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                </path>
            </svg>
        </button>
    </div>

    <div id="responsiveMenu" style="display: none;">
        <div>
            <div>
                <div>{{ Auth::user()->name }}</div>
                <div>{{ Auth::user()->email }}</div>
            </div>

            <div>
                <a href="{{ route('profile.edit') }}">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button onclick="event.preventDefault(); this.closest('form').submit();">Log Out</button>
                </form>
            </div>
        </div>
    </div>


</nav> --}}
