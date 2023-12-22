<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Register</title>
    </head>

    <body>
        <h1>Register</h1>
        <form action="{{ route('registersuccess') }}" method="POST">
            @csrf
            <label for="Name">Name:</label>
            <input id="Name" name="Name" type="text">
            <br>

            <label for="Email">Email:</label>
            <input id="Email" name="Email" type="text">
            <br>

            <label for="Address">Address:</label>
            <input id="Address" name="Address" type="text">
            <br>

            <label for="Password">Password:</label>
            <input id="Password" name="Password" type="password">
            <br>
            <button type="submit">Submit</button>

        </form>
    </body>

</html>
