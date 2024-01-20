<x-dashboard>
    <div class="my-8">
        <x-styling.header>
            Add Time
        </x-styling.header>
        <div class="md:px-20">
            <div class="bg-base-200 card-move-y mx-auto my-8 flex items-center rounded-xl px-10 py-10">
                <form class="w-full" method="POST" action="{{ route('admin.timeslots.store') }}">
                    @csrf

                    {{-- <select class="select select-bordered" id="specialization" name="specialization" required>
                        <option disabled selected>Pick one</option>
                        @foreach ($doctors as $doctorindex)
                            <option value="{{ $doctorindex->DoctorName }}">{{ $doctorindex->DoctorName }}</option>
                        @endforeach
                    </select> --}}

                    <div class="mt-4">
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text text-base font-semibold">Select Doctor:</span>
                            </div>
                            <select class="select select-bordered select-primary w-full max-w-xs" id="doctor"
                                name="doctor" required>
                                <option disabled selected>Pick one</option>
                                @foreach ($doctors as $doctorindex)
                                    <option value="{{ $doctorindex->DoctorID }}">
                                        {{ $doctorindex->DoctorName }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>

                    <x-styling.input class="input-bordered input-primary" name="start_time" type="time"
                        label="Start Time" />
                    <x-styling.input class="input-bordered input-primary" name="end_time" type="time"
                        label="End Time" />

                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text text-base font-semibold">Select days</span>
                            <span class="label-text-alt">within the next week</span>
                        </div>
                        <input class="flatpickr input-bordered input-primary" id="selected_days" name="selected_days"
                            type="text" placeholder="Select dates">
                    </label>

                    <div class="py-4">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Include Flatpickr initialization script -->
    <script>
        flatpickr("#selected_days", {
            mode: "multiple",
            dateFormat: "Y-m-d",
            minDate: "today",
            maxDate: new Date().fp_incr(6), // Set maximum date to 6 days from today
            altInput: true,
            altFormat: "Y-m-d",
            inline: false,
        });
    </script>
</x-dashboard>
