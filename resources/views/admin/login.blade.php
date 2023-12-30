<x-signinlogin>
    <x-styling.header class="text-error">
        Admin Login
    </x-styling.header>
    @guest
        <x-message.error-message />
        <x-message.success-message />


        <!-- Session Status -->
        @if (session('status'))
            <p>{{ session('status') }}</p>
        @endif
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <!-- Email Address -->
            <div>
                <label for="email">Email:</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    autocomplete="username">
            </div>

            <!-- Password -->
            <div>
                <label for="password">Password:</label>
                <input id="password" name="password" type="password" required autocomplete="current-password">
            </div>

            <!-- Remember Me -->
            <div>
                <label>
                    <input id="remember_me" name="remember" type="checkbox">
                    Remember me
                </label>
            </div>

            <div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot your password?</a>
                @endif

                <button type="submit">Log in</button>
            </div>
        </form>
    @endguest

    @auth
        <h1>You are already logged in.</h1>
    @endauth
</x-signinlogin>
