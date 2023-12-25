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
            <div class="flex h-[80svh] justify-center">
                <h1 class="self-center text-6xl">This is {{ $userName }}'s Dashboard</h1>
            </div>
            {{ $slot }}
        </div>

        {{-- Footer Component --}}
        <x-footer />
        {{-- End of Footer --}}
    </body>

</html>
