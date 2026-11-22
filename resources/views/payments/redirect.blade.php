<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Redirecting to eSewa</title>
    </head>
    <body onload="document.getElementById('esewa-form').submit()">
        <p>Redirecting you to eSewa to complete the payment.</p>

        <form id="esewa-form" action="{{ $action }}" method="POST">
            @foreach ($fields as $name => $value)
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endforeach
            <noscript><button type="submit">Continue to eSewa</button></noscript>
        </form>
    </body>
</html>
