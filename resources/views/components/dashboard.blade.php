@extends('layouts.app')
@section('dashboardcontent')
    <div class="flex flex-col">
        @auth
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
