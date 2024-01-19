@extends('layouts.app')

@section('payment-section')
    <form action="{{ route('payments.store') }}" method="POST">
        @csrf

        <div class="py-2">
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text text-base font-semibold">Name:</span>
                </div>
                <input class='input input-bordered w-full rounded-xl' id="name" name="name" type="text"
                    value="{{ $name }}" autofocus disabled>
            </label>
        </div>

        <div class="py-2">
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text text-base font-semibold">Email:</span>
                </div>
                <input class='input input-bordered w-full rounded-xl' id="email" name="email" type="email"
                    value="{{ $email }}" autofocus disabled>
            </label>
        </div>

        <input name="amount" type="hidden" value="500">
        <input class="btn btn-primary" type="submit">
    </form>
@endsection
