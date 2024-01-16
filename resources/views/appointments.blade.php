@extends('layouts.app')
@section('appointments-section')
    <div class="my-8 overflow-clip">
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
    </div>
    </div>
@endsection
