<x-signinlogin>

    <div class="bg-base-200 my-50 mx-auto my-20 max-w-[500px] rounded-xl px-10 py-14">

        <h1 class="text-5xl font-bold">
            Register
        </h1>

        <form id="registerForm" method="POST" action="{{ route('register') }}">
            @csrf
            <!-- Logo -->
            {{-- <div>
                <img class="w-30" src="{{ asset('path/to/your/logo.png') }}" alt="Logo">
            </div> --}}

            <!-- Name -->
            <div class="py-2">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text text-base">Name:</span>
                    </div>
                    <input class="input input-bordered w-full rounded-xl" id="name" name="name" type="text"
                        value="{{ old('name') }}" autofocus autocomplete="name">
                </label>
            </div>



            {{-- <div>
                <label for="name">Name:</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" autofocus
                    autocomplete="name">
            </div> --}}

            <!-- Email Address -->
            <div class="py-2">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text text-base">Email:</span>
                    </div>
                    <input class="input input-bordered w-full rounded-xl" id="email" name="email" type="email"
                        value="{{ old('email') }}" autocomplete="username">

                </label>
            </div>



            {{-- <div class="mt-4">
                <label for="email">Email:</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="username">
            </div> --}}


            {{-- Role --}}

            <div class="mt-4">
                <label class="form-control w-full max-w-xs" for="role">
                    <div class="label">
                        <span class="label-text">Select Your Role:</span>
                    </div>
                    <select class="select select-bordered" id="role" name="role" required>
                        <option disabled selected>Pick one</option>
                        <option value="doctor">Doctor</option>
                        <option value="patient">Patient</option>
                    </select>
                </label>
            </div>



            <div class="py-2" id="specializationFields" style="display: none;">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text text-base">Specialization:</span>
                    </div>
                    <input class="input input-bordered w-full rounded-xl" id="specializationname"
                        name="specializationname" type="text" placeholder="Enter specialization">
                </label>
            </div>

            {{-- <div class="mt-4" id="specializationFields" style="display: none;">
                <label for="specializationname">Specialization:</label>
                <input class="rounded-xl" id="specializationname" name="specializationname" type="text"
                    placeholder="Enter specialization">
            </div> --}}



            <div class="py-2" id="doctorFields" style="display: none;">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text text-base">Specialization:</span>
                    </div>
                    <input class="input input-bordered w-full rounded-xl" id="contact_information"
                        name="contact_information" type="text" value="{{ old('contact_information') }}">
                </label>
            </div>

            {{-- <div class="mt-4" id="doctorFields" style="display: none;">
                <label for="contact_information">Contact Information:</label>
                <input class="rounded-xl" id="contact_information" name="contact_information" type="text"
                    value="{{ old('contact_information') }}">
            </div> --}}





            <!-- Additional Fields for Patient -->
            <div class="py-2" id="patientField1" style="display: none;">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text text-base">Address:</span>
                    </div>
                    <input class="input input-bordered w-full rounded-xl" id="address" name="address" type="text"
                        value="{{ old('address') }}">
                </label>
            </div>

            {{-- 
            <div class="mt-4" id="patientField1" style="display: none;">
                <label for="address">Address:</label>
                <input class="rounded-xl" id="address" name="address" type="text" value="{{ old('address') }}">
            </div> --}}




            <div class="py-2" id="patientField2" style="display: none;">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text text-base">Phone:</span>
                    </div>
                    <input class="input input-bordered w-full rounded-xl" id="phone" name="phone" type="text"
                        value="{{ old('phone') }}">
                </label>
            </div>

            {{-- <div class="mt-4" id="patientField2" style="display: none;">
                <label for="phone">Phone:</label>
                <input class="rounded-xl" id="phone" name="phone" type="text" value="{{ old('phone') }}">
            </div> --}}



            <!-- Password -->
            <div class="py-2">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text text-base">Password:</span>
                    </div>
                    <input class="input input-bordered w-full rounded-xl" id="password" name="password" type="password"
                        required autocomplete="new-password">
                </label>
            </div>

            {{-- <div class="mt-4">
                <label for="password">Password:</label>
                <input id="password" name="password" type="password" required autocomplete="new-password">
            </div> --}}




            <!-- Confirm Password -->
            <div class="py-2">
                <label class="form-control w-full">
                    <div class="label">
                        <span class="label-text text-base">Confirm Password:</span>
                    </div>
                    <input class="input input-bordered w-full rounded-xl" id="password_confirmation"
                        name="password_confirmation" type="password" required autocomplete="new-password">
                </label>
            </div>

            {{-- <div class="mt-4">
                <label for="password_confirmation">Confirm Password:</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    autocomplete="new-password">
            </div> --}}

            <div class="mt-4 flex items-center justify-end gap-3">
                <a class="link-hover hover:link-info" href="{{ route('login') }}">Already registered?</a>
                <button class="btn min-w-32 btn-secondary" type="submit">Register</button>
            </div>

        </form>
    </div>
</x-signinlogin>

{{-- Conditional Fields for Doctor and Patient --}}

<!-- Additional Fields for Doctor -->
{{-- <div class="mt-4" id="specializationFields" style="display: block;">
    <label for="specializationname ">Specialization:</label>
    <select class="form-select" id="specializationname " name="specializationname ">
        <option disabled selected>Select specialization</option>

        @foreach (\App\Models\Specialization::getSpecializationList() as $id => $name)
            <option name="{{ $name }}" value="{{ $name }}">{{ $name }}</option>
        @endforeach

    </select>
</div> --}}
