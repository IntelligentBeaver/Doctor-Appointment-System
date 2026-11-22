<?php

namespace Tests\Feature\Admin;

use App\Models\Availability;
use App\Models\Contact;
use App\Models\Specialization;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesClinicData;
use Tests\TestCase;

class TimeSlotsAndContentTest extends TestCase
{
    use CreatesClinicData;
    use RefreshDatabase;

    public function test_admin_adds_slots_without_duplicates(): void
    {
        $admin = $this->makeAdmin();
        $doctor = $this->makeDoctor();
        $this->makeTimeSlot('10:00:00', '10:30:00');
        $this->makeTimeSlot('10:30:00', '11:00:00');
        $this->makeTimeSlot('15:00:00', '15:30:00');

        $payload = [
            'doctor' => $doctor->DoctorID,
            'start_time' => '10:00',
            'end_time' => '11:00',
            'selected_days' => now()->addDay()->toDateString().', '.now()->addDays(2)->toDateString(),
        ];

        $this->actingAs($admin)->post(route('admin.timeslots.store'), $payload)->assertSessionHasNoErrors();
        $this->actingAs($admin)->post(route('admin.timeslots.store'), $payload);

        $this->assertSame(4, Availability::count());
    }

    public function test_admin_cannot_add_slots_in_the_past_or_for_unknown_doctors(): void
    {
        $admin = $this->makeAdmin();
        $doctor = $this->makeDoctor();
        $this->makeTimeSlot();

        $this->actingAs($admin)->post(route('admin.timeslots.store'), [
            'doctor' => $doctor->DoctorID,
            'start_time' => '10:00',
            'end_time' => '11:00',
            'selected_days' => now()->subDay()->toDateString(),
        ])->assertSessionHasErrors('selected_days');

        $this->actingAs($admin)->post(route('admin.timeslots.store'), [
            'doctor' => 999,
            'start_time' => '10:00',
            'end_time' => '11:00',
            'selected_days' => now()->addDay()->toDateString(),
        ])->assertSessionHasErrors('doctor');

        $this->assertSame(0, Availability::count());
    }

    public function test_duplicate_specializations_are_rejected(): void
    {
        Specialization::create(['SpecializationName' => 'Cardiology']);

        $this->actingAs($this->makeAdmin())->post('/admin/addspecialization', [
            'specializationname' => 'Cardiology',
            'description' => 'Heart',
        ])->assertSessionHasErrors('specializationname');

        $this->assertSame(1, Specialization::count());
    }

    public function test_contact_form_validates_input(): void
    {
        $this->post('/contacts', [])->assertSessionHasErrors(['email', 'phone', 'description']);

        $this->post('/contacts', [
            'email' => 'visitor@example.com',
            'phone' => '9800000000',
            'description' => 'Do you open on Saturdays?',
        ])->assertRedirect(route('home'));

        $this->assertSame(1, Contact::count());
    }
}
