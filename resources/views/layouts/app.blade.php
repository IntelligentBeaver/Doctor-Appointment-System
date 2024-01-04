<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Your Doctor Appointment System</title>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com" rel="preconnect">
        <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Arvo:ital,wght@0,400;0,700;1,400;1,700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
            rel="stylesheet">
        <script src="https://kit.fontawesome.com/bfa75e5c98.js" crossorigin="anonymous"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="position-relative m-0 p-0">
        <div id="app">
            {{-- Navigation Bar --}}
            <x-navigation.navbar />

            <x-error-message />

            <x-success-message />

            @guest
                @yield('adminlogin')
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

            @yield('contactssection')

            {{-- Footer --}}
            <x-footer />
        </div>
    </body>

</html>
