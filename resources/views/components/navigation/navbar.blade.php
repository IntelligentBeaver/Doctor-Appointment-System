<nav class="navbar bg-base-200 text-base-content sticky">


    {{-- Items in the left side(start) of the navigation bar --}}
    <x-navigation.navbar-start />

    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            @if (Route::has('contacts'))
                <li><a class="py-3" href="{{ route('contacts') }}">Contact Us</a></li>
            @endif
            @if (Route::has('appointments'))
                <li><a class="py-3" href="{{ route('appointments') }}">Appointments</a></li>
            @endif
        </ul>
    </div>

    {{-- Items in the right side(end) of the navigation bar --}}
    <x-navigation.navbar-end />


</nav>

<script>
    function toggleMenu() {
        var menu = document.getElementById('responsiveMenu');
        menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
    }
</script>
