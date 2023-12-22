<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>
    </head>

    <body>
        <h1>Log In</h1>
        <form action="{{ route('loginsuccess') }}" method="POST">
            @csrf

            <label for="Name">
                <input id="Name" name="Name" type="text" placeholder="Username">
            </label>
            <br>
            <label for="Password">
                <input id="Password" name="Password" type="password" placeholder="Password">
            </label>
            <br>
            <input type="submit" value="Log In">

        </form>
    </body>

</html>
