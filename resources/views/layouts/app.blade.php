<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Your Doctor Appointment System</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>
        <div id="app">
            {{-- Navigation Bar --}}

            {{-- If authenticated, then show dashboard,logout option --}}
            @auth
                <x-navbar />

                {{-- If not authenticated,then show login and register --}}
            @else
                <x-navbar />
            @endauth



            <!-- Page Content -->
            <main>
                @yield('homecontent')
            </main>

            {{-- Footer --}}
            <x-footer />
        </div>
    </body>

</html>
