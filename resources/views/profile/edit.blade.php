<x-dashboard>
    <x-slot:title>
        Profile
    </x-slot>
    <x-slot:subtitle>
        Configure Information
    </x-slot>
    {{-- <x-styling.header class="mx-10">
        {{ __('Profile') }}
    </x-styling.header>
    <x-styling.subheader class="mx-10">{{ __('Edit your Information') }}</x-styling.subheader> --}}

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="bg-base-200 xs:rounded-3xl p-4 shadow-md sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-base-200 xs:rounded-3xl p-4 shadow-md sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-base-200 xs:rounded-3xl p-4 shadow-md sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-dashboard>
