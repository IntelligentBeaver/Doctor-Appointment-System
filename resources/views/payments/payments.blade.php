@extends('layouts.app')

@section('payment-section')
    <form action="{{ route('payments.store') }}" method="POST">
        @csrf
        <x-styling.input name="name" type="text" label="Enter Name" />
        <x-styling.input name="email" type="email" label="Enter Email" />
        <input name="amount" type="hidden" value="99">
        <input class="btn btn-primary" type="submit">
    </form>
@endsection
