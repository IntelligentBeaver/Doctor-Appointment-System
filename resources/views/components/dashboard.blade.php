@extends('layouts.app')
@section('dashboardcontent')
    <div class="flex flex-col">

        {{ $slot }}
    </div>
@endsection
