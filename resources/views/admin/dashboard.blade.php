<x-dashboard>

    <div>
        <x-styling.header>{{ Auth::user()->name }}</x-styling.header>
        <x-styling.subheader>Your dashboard</x-styling.subheader>
    </div>

    <div class="my-8 flex flex-wrap justify-evenly gap-2">
        <x-status-card class="basis-1/4">
            <x-slot:title>Doctors</x-slot>
            {{ $totaldoctors }}
        </x-status-card>

        <x-status-card class="basis-1/4">
            <x-slot:title>Patients</x-slot>
            {{ $totalpatients }}
        </x-status-card>

        <x-status-card class="basis-1/4">
            <x-slot:title>Appointments</x-slot>
            Coming Soon.
        </x-status-card>
    </div>
</x-dashboard>
