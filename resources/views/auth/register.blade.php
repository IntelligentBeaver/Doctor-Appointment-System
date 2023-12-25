<x-signinlogin>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Logo -->
        <div>
            <img class="w-30" src="{{ asset('path/to/your/logo.png') }}" alt="Logo">
        </div>

        <!-- Name -->
        <div>
            <label for="name">Name:</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                autocomplete="name">
            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email">Email:</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                autocomplete="username">
            @error('email')
                <p>{{ $message }}</p>
            @enderror
        </div>

        {{-- Role --}}
        <label class="form-control w-full max-w-xs" for="role">
            <div class="label">
                <span class="label-text">Select Your Role:</span>
            </div>
            <select class="select select-bordered" id="role" name="role">
                <option disabled selected>Pick one</option>
                <option value="doctor">Doctor</option>
                <option value="patient">Patient</option>
            </select>
        </label>

        <!-- Password -->
        <div class="mt-4">
            <label for="password">Password:</label>
            <input id="password" name="password" type="password" required autocomplete="new-password">
            @error('password')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation">Confirm Password:</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                autocomplete="new-password">
            @error('password_confirmation')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-4 flex items-center justify-end">
            <a href="{{ route('login') }}">Already registered?</a>
            <button type="submit">Register</button>
        </div>
    </form>
    </x-register--log>
