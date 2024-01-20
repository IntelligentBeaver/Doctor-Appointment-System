@extends('layouts.app')

@section('payment-section')
    <form action="{{ route('payments.store') }}" method="POST">
        @csrf

        <input name="appointment_id" type="hidden" value="{{ $appointment->AppointmentID }}">
        <input type="hidden" value="{{ $appointment->DoctorID }}">
        <input type="hidden" value="{{ $appointment->PatientID }}">
        <input type="hidden" value="{{ $appointment->Status }}">
        <input type="hidden" value="{{ $appointment->TokenNumber }}">

        <div class="bg-base-200 my-50 card-move-y mx-auto my-20 max-w-[500px] rounded-xl px-10 py-14">
            <div class="flex items-center justify-between gap-10 py-4">
                <h1 class="text-6xl font-bold">
                    Payment
                </h1>
                <div>
                    <img class="h-full w-full object-cover dark:hidden" src="{{ asset('images/logo-light.svg') }}"
                        alt="Light Image">
                    <img class="max-w-24 hidden h-full w-full object-cover dark:block"
                        src="{{ asset('images/logo-dark.svg') }}" alt="Dark Image">
                </div>
            </div>

            <div class="py-2">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text text-base font-semibold">Token Number:</span>
                    </div>
                    <input class='input input-bordered input-primary w-full rounded-xl' id="token_number"
                        name="token_number" type="text" value="{{ $appointment->TokenNumber }}" autofocus disabled>
                </label>
            </div>

            <div class="py-2">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text text-base font-semibold">Name:</span>
                    </div>
                    <input class='input input-bordered input-primary w-full rounded-xl' id="name" name="name"
                        type="text" value="{{ $name }}" autofocus disabled>
                </label>
            </div>

            <div class="py-2">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text text-base font-semibold">Email:</span>
                    </div>
                    <input class='input input-bordered input-primary w-full rounded-xl' id="email" name="email"
                        type="email" value="{{ $email }}" autofocus disabled>
                </label>
            </div>

            <div class="py-2">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text text-base font-semibold">Address:</span>
                    </div>
                    <input class='input input-bordered input-primary w-full rounded-xl' id="email" name="email"
                        type="email" value="{{ $address }}" autofocus disabled>
                </label>
            </div>

            <div class="mt-8 flex items-center justify-center">
                <input name="amount" type="hidden" value="500">
                <input class="btn btn-success mt-8 w-36 lg:w-48 2xl:w-56" type="submit" value="Pay with E-Sewa">
            </div>
        </div>
    </form>
@endsection
