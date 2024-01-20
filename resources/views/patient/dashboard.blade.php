<x-dashboard>
    <div>
        <x-styling.header>{{ Auth::user()->name }}</x-styling.header>
        <x-styling.subheader>Your dashboard</x-styling.subheader>
    </div>

    <div class="xs:flex-col my-8 flex flex-row flex-wrap justify-evenly gap-2 sm:flex-row">
        <x-status-card class="basis-1/4">
            <x-slot:title>Appointments</x-slot>
            {{ $appointmentCount }}
            {{-- {{ $totaldoctors }} --}}
        </x-status-card>

        <x-status-card class="basis-1/4">
            <x-slot:title>Today</x-slot>
            {{ $todaysAppointments->count() }}
        </x-status-card>

        <x-status-card class="basis-1/4">
            <x-slot:title>Doctors</x-slot>
            {{ $count }}
        </x-status-card>
    </div>

</x-dashboard>
