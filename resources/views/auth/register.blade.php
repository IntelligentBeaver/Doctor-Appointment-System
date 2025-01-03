<x-signinlogin>

    <div class="card-move-y bg-base-200 my-50 mx-auto my-20 max-w-[500px] rounded-xl px-10 py-14">

        <div class="flex items-center justify-between gap-10 py-4">
            <h1 class="text-6xl font-bold">
                Register
            </h1>
            <div>
                <img class="h-full w-full object-cover dark:hidden" src="{{ asset('images/logo-light.svg') }}"
                    alt="Light Image">
                <img class="max-w-24 hidden h-full w-full object-cover dark:block"
                    src="{{ asset('images/logo-dark.svg') }}" alt="Dark Image">
            </div>
        </div>

        <form id="registerForm" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <!-- Logo -->
            {{-- <div>
                <img class="w-30" src="{{ asset('images/logo.png') }}" alt="Logo">
            </div> --}}

            <!-- Name -->
            <x-styling.input name="name" type="text" label="Name" />

            {{-- Email Address --}}
            <x-styling.input name="email" type="email" label="Email" />

            {{-- Role --}}
            <div class="mt-4">
                <label class="form-control w-full max-w-xs" for="role">
                    <div class="label">
                        <span class="label-text text-base font-semibold">Select Your Role:</span>
                    </div>
                    <select class="select select-bordered" id="role" name="role" required>
                        <option disabled selected>Pick one</option>
                        <option value="doctor">Doctor</option>
                        <option value="patient">Patient</option>
                    </select>
                </label>
            </div>


            {{-- Additional Fields for Doctor --}}

            {{-- Specialization --}}
            <div class="mt-4" id="specializationFields" style="display: none">
                <label class="form-control w-full max-w-xs" for="SpecializationID">
                    <div class="label">
                        <span class="label-text text-base font-semibold">Select Specialization:</span>
                    </div>
                    <select class="select select-bordered" id="specialization" name="specialization" required>
                        <option disabled selected>Pick one</option>
                        @foreach ($specializations as $id => $name)
                            <option value="{{ $name }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </label>
            </div>

            {{-- Contact Information --}}
            <div id="doctorFields" style="display: none">
                <x-styling.input name="contact_information" type="text" label="Contact Information" />
            </div>


            <!-- Additional Fields for Patient -->

            {{-- Address --}}
            <div id="patientField1" style="display: none">
                <x-styling.input name="address" type="text" label="Address" />
            </div>

            {{-- Phone --}}
            <div id="patientField2" style="display: none">
                <x-styling.input name="phone" type="text" label="Phone" />
            </div>


            {{-- Image Upload for Avatar --}}
            <div class="py-4">
                <label class="form-control w-full max-w-xs">
                    <div class="label">
                        <span class="label-text text-base font-semibold">Upload an Image:</span>
                        <span class="label-text-alt">Avatar</span>
                    </div>
                    <input class="file-input file-input-bordered w-full max-w-xs" id="image" name="image"
                        type="file" />
                </label>
            </div>



            <!-- Password -->
            <x-styling.input name="password" type="password" label="Password" />

            <!-- Confirm Password -->
            <x-styling.input name="password_confirmation" type="password" label="Confirm Password" />

            {{-- Other Links --}}
            <div class="mt-4 flex items-center justify-end gap-3">
                <a class="link-hover hover:link-info" href="{{ route('login') }}">Already registered?</a>
                <button class="btn min-w-32 btn-secondary" type="submit">Register</button>
            </div>

        </form>
    </div>
</x-signinlogin>
