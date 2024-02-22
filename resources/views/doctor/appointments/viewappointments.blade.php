<x-dashboard>
    <x-styling.header>
        Appointments
    </x-styling.header>
    <x-styling.subheader>
        All Appointments
    </x-styling.subheader>
    <div>
        <div class="xs:m-0 overflow-scroll md:m-10">
            <table class="z-0 table">
                <thead>
                    <tr class="bg-base-300">
                        <th class="text-xl font-bold">Token No.</th>
                        <th class="text-xl font-bold">Doctor Name</th>
                        <th class="text-xl font-bold">Patient Name</th>
                        <th class="text-xl font-bold">Date</th>

                        <th class="text-xl font-bold">Time</th>
                        <th class="text-xl font-bold">Status</th>
                        <th class="text-xl font-bold">Action</th>
                    </tr>
                    @foreach ($appointments as $appointmentindex)
                        <tr class="hover">
                            <td class="text-base font-normal">{{ $appointmentindex->TokenNumber }}</td>
                            <td class="text-base font-normal">{{ $appointmentindex->doctor->DoctorName }}</td>
                            <td class="text-base font-normal">
                                {{ $appointmentindex->patient->PatientName }}</td>
                            <td class="text-base font-normal">{{ $appointmentindex->Date }}</td>
                            <td class="text-base font-normal">
                                {{ \Carbon\Carbon::parse($appointmentindex->timeSlot->StartTime)->format('H:i') }}
                                -
                                {{ \Carbon\Carbon::parse($appointmentindex->timeSlot->EndTime)->format('H:i') }}
                            </td>
                            <td class="text-base font-normal">
                                @if ($appointmentindex->Status == 'Unpaid')
                                    <span class="text-warning font-bold">{{ $appointmentindex->Status }}</span>
                                @elseif ($appointmentindex->Status == 'Booked')
                                    <span class="text-success font-bold">{{ $appointmentindex->Status }}</span>
                                @endif
                            </td>
                            <td class="flex gap-2 text-base font-normal">
                                <form class="inline" id="cancelForm" method="POST"
                                    action="{{ route('doctor.appointment.destroy', ['AppointmentID' => $appointmentindex->AppointmentID]) }}">
                                    @csrf
                                    @method('delete')
                                    @if ($appointmentindex->Status == 'Unpaid')
                                        <input class="btn btn-error" id="cancelButton" type="submit"
                                            value="Cancel Appointment">
                                    @else
                                        <p>Already Paid</p>
                                    @endif
                                </form>
                                {{-- @elseif ($appointmentindex->Status == 'Booked') --}}

                            </td>
                        </tr>
                    @endforeach
                </thead>
            </table>
        </div>
    </div>
</x-dashboard>
