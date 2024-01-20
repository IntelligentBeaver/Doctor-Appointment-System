@php
    $previousDate = null;
@endphp
@extends('layouts.app')
@section('appointments-section')
    <div>
        <x-styling.header>
            View Doctors:
        </x-styling.header>

        @if (isset($doctors))
            @foreach ($doctors as $doctor)
                <div class="my-8 px-8">
                    <div class="card card-side bg-base-300 card-move-y mx-auto flex max-w-5xl flex-col py-8 sm:flex-row">

                        <figure class="mx-auto overflow-hidden pl-8">
                            <img class="mask mask-squircle w-32" src="{{ asset($doctor->user->image) }}" alt="Doctor" />
                        </figure>

                        <div class="card-body flex flex-col items-center justify-between gap-4 sm:flex-row">
                            <div class="flex flex-col">
                                <h2 class="card-title text-2xl">{{ $doctor->DoctorName }}</h2>
                            </div>

                            {{-- Availibilities --}}
                            <div>
                                @if ($doctor->availabilities->isNotEmpty())
                                    <div class="flex flex-col items-center md:flex-row md:gap-8">
                                        <h3 class="text-lg font-extrabold">Availabilities:</h3>
                                        <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                                            @php
                                                $previousDate = null;
                                            @endphp

                                            @foreach ($doctor->availabilities as $availability)
                                                @php
                                                    $timeslotID = $availability->timeSlot->TimeSlotID;
                                                    $currentStartTime = \Carbon\Carbon::parse($availability->timeSlot->StartTime);
                                                    $endTime = \Carbon\Carbon::parse($availability->timeSlot->EndTime);
                                                    $startTime = $currentStartTime->copy(); // Create a copy to avoid modifying the original
                                                    $date = \Carbon\Carbon::parse($availability->Date);
                                                @endphp

                                                @if ($previousDate !== $date->format('Y-m-d'))
                                                    @if ($previousDate !== null)
                                        </div> <!-- Close the previous div -->
                                @endif
                                <div class="p-4">
                                    <p class="font-extrabold">
                                        {{ $date->format('Y-m-d') }}
                                    </p>
                                    @php
                                        $previousDate = $date->format('Y-m-d');
                                    @endphp
            @endif

            <p>
                <a class="link-secondary"
                    href="{{ route('patient.appointment.book', ['doctorId' => $doctor->DoctorID, 'availabilityId' => $availability->AvailabilityID, 'timeslotID' => $timeslotID, 'appointdate' => $date, 'startTime' => $currentStartTime->format('H:i'), 'endTime' => $endTime->format('H:i')]) }}">
                    {{ $currentStartTime->format('H:i') }} - {{ $startTime->addHour()->format('H:i') }}
                </a>
            </p>
        @endforeach

        @if ($previousDate !== null)
    </div> <!-- Close the last div -->
    @endif
    </div>
@else
    <p>No availabilities for this doctor.</p>
    @endif
    </div>

    </div>
    </div>
    </div>
    @endforeach
@else
    <p class="text-center">{{ $message ?? 'No doctors available.' }}</p>
    @endif
    </div>
@endsection
