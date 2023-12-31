@extends('layouts.app')
@section('dashboardcontent')
    <div class="flex flex-col">
        @auth
            {{-- <x-styling.header class="px-8"><span>{{ $title }}</span></x-styling.header>
            <x-styling.subheader class="px-8"><span>{{ $subtitle }}</span></x-styling.subheader> --}}
            @if (Auth::user()->role == 'admin')
                {{ $slot }}
            @elseif (Auth::user()->role == 'doctor')
                {{ $slot }}
            @elseif (Auth::user()->role == 'patient')
                {{ $slot }}
            @else
                {{ 'Role not identified' }}
            @endif
        @endauth

    </div>
@endsection
