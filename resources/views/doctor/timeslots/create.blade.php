<x-dashboard>
    <div class="my-8">
        <x-styling.header>
            Add Time
        </x-styling.header>
        <div class="md:px-20">
            <div class="bg-base-200 mx-auto my-8 flex items-center rounded-xl px-10 py-10">
                <form class="w-full" method="POST" action="{{ route('doctor.timeslots.store') }}">
                    @csrf
                    <x-styling.input name="start_time" type="time" label="Start Time" />
                    <x-styling.input name="end_time" type="time" label="End Time" />


                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text text-base font-semibold">Pick a day</span>
                            <span class="label-text-alt">Week</span>
                        </div>
                        <select class="select select-bordered" id="day_of_week" name="day_of_week" required>
                            <option disabled selected>Pick one</option>
                            <option value="Sunday">Sunday</option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                        </select>
                    </label>

                    <div class="py-4">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-dashboard>
