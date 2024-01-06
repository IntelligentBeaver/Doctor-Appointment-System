<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Get Started</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            p,
            a,
            li {
                font-family: 'Lato', sans-serif;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-family: 'Arvo', serif;
            }
        </style>
    </head>

    <body>
        {{-- Navbar Component --}}
        <x-navigation.navbar />
        {{-- End of Navbar --}}

        <x-message.error-message />
        <x-message.success-message />

        <div>
            {{ $slot }}
        </div>

        {{-- Footer Component --}}
        <x-footer />
        {{-- End of Footer --}}
    </body>

</html>
