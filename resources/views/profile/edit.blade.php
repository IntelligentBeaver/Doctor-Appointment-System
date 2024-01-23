<x-dashboard>
    <div class="flex items-center justify-between pr-10">
        <div>
            <x-styling.header>
                Profile
            </x-styling.header>
            <x-styling.subheader>
                Configure Information
            </x-styling.subheader>
        </div>
        <div class="avatar">
            <div class="xs:w-16 w-14 rounded-full md:w-24 lg:w-32">
                <img class="object-contain" src="{{ asset(Auth::user()->image) }}" srcset="" alt="">
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="bg-base-200 card-move-y p-4 shadow-md sm:rounded-xl sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-base-200 card-move-y p-4 shadow-md sm:rounded-xl sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-base-200 card-move-y p-4 shadow-md sm:rounded-xl sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-dashboard>
