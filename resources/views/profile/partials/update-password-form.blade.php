<section>
    <header>
        <h2 class="text-xl font-bold">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form class="mt-6 space-y-6" method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div>
            <label class="block text-sm font-medium"
                for="update_password_current_password">{{ __('Current Password') }}</label>
            <input class="input input-bordered mt-1 block w-full rounded-lg" id="update_password_current_password"
                name="current_password" type="password" autocomplete="current-password">
            @error('updatePassword.current_password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium" for="update_password_password">{{ __('New Password') }}</label>
            <input class="input input-bordered mt-1 block w-full rounded-lg" id="update_password_password"
                name="password" type="password" autocomplete="new-password">
            @error('updatePassword.password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label class="block text-sm font-medium"
                for="update_password_password_confirmation">{{ __('Confirm Password') }}</label>
            <input class="input input-bordered mt-1 block w-full rounded-lg" id="update_password_password_confirmation"
                name="password_confirmation" type="password" autocomplete="new-password">
            @error('updatePassword.password_confirmation')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


        <div class="flex items-center gap-4">
            <button class="btn btn-primary min-w-28 rounded-xl" type="submit">Save</button>
            @if (session('status') === 'password-updated')
                <p class="text-sm text-gray-600 dark:text-gray-400" x-data="{ show: true }" x-show="show" x-transition
                    x-init="setTimeout(() => show = false, 2000)">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
