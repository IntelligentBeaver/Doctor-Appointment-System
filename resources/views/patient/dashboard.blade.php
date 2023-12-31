<x-dashboard>

    <div>
        <x-styling.header>{{ Auth::user()->name }}</x-styling.header>
        <x-styling.subheader>Your dashboard</x-styling.subheader>
    </div>

    <div class="xs:flex-col my-8 flex flex-row flex-wrap justify-evenly gap-2 sm:flex-row">
        <x-status-card class="basis-1/4">
            <x-slot:title>Appointments</x-slot>
            NULL
            {{-- {{ $totaldoctors }} --}}
        </x-status-card>

        <x-status-card class="basis-1/4">
            <x-slot:title>Doctors</x-slot>
            NULL
            {{-- {{ $totalpatients }} --}}
        </x-status-card>

        <x-status-card class="basis-1/4">
            <x-slot:title>Some other feature</x-slot>
            Coming Soon.
        </x-status-card>
    </div>

</x-dashboard>
