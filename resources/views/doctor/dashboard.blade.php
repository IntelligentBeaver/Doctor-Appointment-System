<x-dashboard>

    <div>
        <x-styling.header>{{ Auth::user()->name }}</x-styling.header>
        <x-styling.subheader>Your dashboard</x-styling.subheader>
    </div>

    <div class="xs:flex-col my-8 flex flex-wrap justify-evenly gap-2 sm:flex-row">
        <x-status-card class="basis-1/4" href="{{ route('doctor.appointment.view') }}">
            <x-slot:title>Appointments</x-slot>
            {{ $appointmentCount }}
        </x-status-card>

        <x-status-card class="basis-1/4">
            <x-slot:title>Today</x-slot>
            {{ $todaysAppointments }}
        </x-status-card>

        <x-status-card class="basis-1/4">
            <x-slot:title>Patients</x-slot>
            {{ $count }}
        </x-status-card>
    </div>

</x-dashboard>
