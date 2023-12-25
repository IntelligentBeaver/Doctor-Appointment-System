<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Get Started</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>

        {{-- Navbar Component --}}
        <x-navbar />
        {{-- End of Navbar --}}

        <div>
            <h1>This section has come from register--login</h1>
            {{ $slot }}
        </div>

        {{-- Footer Component --}}
        <x-footer />
        {{-- End of Footer --}}
    </body>

</html>
