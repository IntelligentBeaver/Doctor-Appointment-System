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
            <div class="py-2">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text text-base">Email:</span>
                    </div>
                    <input class="input input-bordered w-full rounded-xl" id="email" name="email" type="email"
                        value="{{ old('email') }}" placeholder="example@example.com" required autofocus
                        autocomplete="username">
                </label>
            </div>


            <div class="py-2">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text text-base">Password:</span>
                    </div>
                    <input class="input input-bordered w-full rounded-xl" id="password" name="password" type="password"
                        placeholder="Your password" required autocomplete="current-password">
                </label>
            </div>


            <div class="py-2">
                <p>Don't have an account? <a class="link-hover hover:link-info" href="{{ route('register') }}">Sign
                        in</a></p>
            </div>

            <div class="mt-2 flex items-center">
                <button class="btn min-w-32 btn-secondary" type=" submit">Login</button>
            </div>




            <!-- Email Address -->
            {{-- <div>
                <label for="email">Email:</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    autocomplete="username">
            </div> --}}


            <!-- Password -->
            {{-- <div>
                <label for="password">Password:</label>
                <input id="password" name="password" type="password" required autocomplete="current-password">
            </div> --}}



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
