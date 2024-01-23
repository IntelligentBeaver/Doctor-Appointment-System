@extends('layouts.app')
@section('confirm')
    {{-- <h2>Confirm Appointment</h2>
    <p>TimeSlot ID: {{ $timeslotID }}</p>
    <p>Doctor: {{ $doctor->DoctorName }}</p>
    <p>Availability Date: {{ \Carbon\Carbon::parse($appointdate)->format('Y-m-d') }}</p>
    <p>Start Time: {{ $startTime }} <br>End Time: {{ $endTime }}
    </p> --}}

    <div class="my-12 flex justify-center">
        <div
            class="bg-info card-move-y flex w-full max-w-3xl flex-col content-center items-center justify-center rounded-xl p-12">
            <x-styling.header class="text-neutral text-center">
                Confirm Appointment
            </x-styling.header>

            <x-styling.subheader class="text-neutral">
                Doctor:
            </x-styling.subheader>
            <p class="text-neutral"> {{ $doctor->DoctorName }}</p>

            <x-styling.subheader class="text-neutral">
                Availability Date:
            </x-styling.subheader>
            <p class="text-neutral"> {{ \Carbon\Carbon::parse($appointdate)->format('Y-m-d') }}</p>
            <x-styling.subheader class="text-neutral">
                Start Time:
            </x-styling.subheader>
            <p class="text-neutral"> {{ $startTime }}</p>
            <x-styling.subheader class="text-neutral">
                End Time:
            </x-styling.subheader>
            <p class="text-neutral"> {{ $endTime }}</p>

            <x-styling.subheader class="text-neutral">
                Price:
            </x-styling.subheader>
            <p class="text-neutral font-black">Rs.500</p>
            <form method="POST" action="{{ route('patient.appointment.store') }}">
                @csrf
                <input name="date" type="hidden" value="{{ \Carbon\Carbon::parse($appointdate)->format('Y-m-d') }}">
                <input name="doctor_id" type="hidden" value="{{ $doctor->DoctorID }}">
                <input name="timeslotID" type="hidden" value="{{ $timeslotID }}">
                <input name="availability_id" type="hidden" value="{{ $availability->AvailabilityID }}">
                <input name="start_time" type="hidden"
                    value="{{ \Carbon\Carbon::parse($startTime)->format('Y-m-d H:i:s') }}">
                <input class="btn mt-8 w-36 lg:w-48 2xl:w-56" type="submit" value="Confirm Appointment">
            </form>

        </div>
    </div>


    <!-- Add any other details you want to display -->
    {{-- 
    <form method="POST" action="{{ route('patient.appointment.store') }}">
        @csrf
        <input name="date" type="hidden" value="{{ \Carbon\Carbon::parse($appointdate)->format('Y-m-d') }}">
        <input name="doctor_id" type="hidden" value="{{ $doctor->DoctorID }}">
        <input name="timeslotID" type="hidden" value="{{ $timeslotID }}">
        <input name="availability_id" type="text" value="{{ $availability->AvailabilityID }}">
        <input name="start_time" type="hidden" value="{{ \Carbon\Carbon::parse($startTime)->format('Y-m-d H:i:s') }}">
        <input class="btn btn-primary" type="submit" value="Confirm Appointment">
    </form> --}}
@endsection
