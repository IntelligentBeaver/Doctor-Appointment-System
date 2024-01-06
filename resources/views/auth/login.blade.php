<x-signinlogin>

    <!-- Session Status -->
    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <div class="bg-base-200 my-50 mx-auto my-20 max-w-[500px] rounded-xl px-10 py-14">
        <h1 class="text-5xl font-bold">
            Login
        </h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <x-styling.input name="email" type="email" label="Email" />

            {{-- Password --}}
            <x-styling.input name="password" type="password" label="Password" />

            {{-- Other Links --}}
            <div class="py-2">
                <p>Don't have an account? <a class="link-hover hover:link-info" href="{{ route('register') }}">Sign
                        in</a></p>
            </div>

            <div class="mt-2 flex items-center">
                <button class="btn min-w-32 btn-secondary" type=" submit">Login</button>
            </div>

            <!-- Remember Me -->
            {{-- <div>
                <label>
                    <input id="remember_me" name="remember" type="checkbox">
                    Remember me
                </label>
            </div> --}}

            {{-- <div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Forgot your password?</a>
                @endif
                <button type="submit">Log in</button>
            </div> --}}

        </form>
    </div>
</x-signinlogin>
