<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Your Doctor Appointment System</title>

        <script src="https://kit.fontawesome.com/bfa75e5c98.js" crossorigin="anonymous"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="position-relative m-0 p-0">
        <div id="app">
            {{-- Navigation Bar --}}
            <x-navbar />

            <x-error-message />
            <x-success-message />
            @guest
                @yield('adminlogin')
                {{-- @else
                {{ route('denied') }} --}}
            @endguest
            <!-- Homepage Content (from welcome.blade.php)-->
            <main>
                @yield('homecontent')
                @yield('test')
            </main>


            {{-- Dashboard Conents (from components/dashboard.blade.php) --}}
            <main>
                @auth
                    @yield('dashboardcontent')
                @endauth
            </main>

            {{-- Footer --}}
            <x-footer />
        </div>
    </body>

</html>
