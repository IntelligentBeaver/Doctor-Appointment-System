@extends('layouts.app')
@section('appointments-section')
    {{-- <div class="my-8 overflow-clip">
        <x-styling.header>
            Search by Specializations:
        </x-styling.header>
        <div class="carousel carousel-center rounded-box max-w-full space-x-8 p-4">
            @foreach ($specialization as $specializationindex)
                <div class="carousel-item max-w-30">
                    <x-status-card>
                        <x-slot:title>{{ $specializationindex->SpecializationName }}</x-slot>
                    </x-status-card>
                </div>
            @endforeach
        </div>
    </div> --}}
    <div>
        <x-styling.header>
            View Doctors:
        </x-styling.header>

        @if (isset($doctor) && !$doctor->isEmpty())
            @foreach ($doctor as $doctorindex)
                <div class="my-8 px-8">
                    <div class="card card-side bg-base-300 card-move-y mx-auto flex max-w-5xl flex-col md:flex-row lg:py-8">

                        <figure class="mx-auto overflow-hidden pl-8">
                            <img class="mask mask-squircle w-32" src="{{ asset($doctorindex->user->image) }}" alt="Doctor" />
                        </figure>

                        <div class="card-body flex flex-col items-center justify-between gap-4 md:flex-row">
                            <div class="flex flex-col">
                                <h2 class="card-title text-2xl">{{ $doctorindex->DoctorName }}</h2>
                                @if ($doctorindex->specialization)
                                    <p>{{ $doctorindex->specialization->SpecializationName }}</p>
                                @else
                                    <p>No specialization available</p>
                                @endif
                            </div>

                            {{-- Availibilities --}}
                            <div>
                                @if ($doctorindex->availabilities->isNotEmpty())
                                    <div class="flex flex-col items-center md:flex-row md:gap-8">
                                        <h3 class="text-lg font-extrabold">Availabilities:</h3>

                                        @foreach ($doctorindex->availabilities as $availability)
                                            <div class="flex flex-col items-center justify-center">
                                                <p class="pb-2 text-lg font-bold">{{ $availability->Date }}</p>

                                                <a class="btn btn-outline btn-primary"
                                                    href="#">{{ $availability->Status }}</a>
                                            </div>
                                        @endforeach
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
