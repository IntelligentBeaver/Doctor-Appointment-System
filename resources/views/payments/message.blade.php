@extends('layouts.app')
@section('payment-message')
    <div class="my-12 flex justify-center">
        @if ($type === 'success')
            <div
                class="bg-success card-move-y flex max-w-3xl flex-col content-center items-center justify-center rounded-xl p-24">
                <x-styling.header class="text-neutral">
                    {{ $msg }}
                </x-styling.header>
                <x-styling.subheader class="text-neutral">
                    {{ $desc }}
                </x-styling.subheader>
            @elseif ($type === 'error')
                <div
                    class="bg-error card-move-y flex max-w-3xl flex-col content-center items-center justify-center rounded-xl p-24">
                    <x-styling.header class="text-neutral">
                        {{ $msg }}
                    </x-styling.header>
                    <x-styling.subheader class="text-neutral">
                        {{ $desc }}
                    </x-styling.subheader>
        @endif


        <div class="pt-8">
            <a class="btn btn-neutral w-24 lg:w-48 2xl:w-56" href="{{ route('home') }}">Home</a>
        </div>
    </div>
    </div>
@endsection
