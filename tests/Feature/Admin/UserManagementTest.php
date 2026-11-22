<?php

namespace Tests\Feature\Admin;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesClinicData;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use CreatesClinicData;
    use RefreshDatabase;

    public function test_update_ignores_fields_other_than_name_and_email(): void
    {
        $patient = $this->makePatient();
        $user = $patient->user;
        $originalPassword = $user->password;

        $this->actingAs($this->makeAdmin())->put(route('admin.updateusers', $user->id), [
            'name' => 'Renamed',
            'email' => 'renamed@example.com',
            'role' => 'admin',
            'password' => 'hijacked',
        ])->assertRedirect(route('admin.viewusers'));

        $user->refresh();
        $this->assertSame('Renamed', $user->name);
        $this->assertSame('patient', $user->role);
        $this->assertSame($originalPassword, $user->password);
    }

    public function test_admin_checkbox_promotes_a_doctor_with_appointments(): void
    {
        $doctor = $this->makeDoctor();
        $this->makeAppointment($this->makePatient(), $doctor);
        $user = $doctor->user;

        $this->actingAs($this->makeAdmin())->put(route('admin.updateusers', $user->id), [
            'name' => $user->name,
            'email' => $user->email,
            'admin_role' => 'on',
        ])->assertRedirect(route('admin.viewusers'));

        $this->assertSame('admin', $user->fresh()->role);
        $this->assertNull($user->fresh()->doctor);
    }

    public function test_admin_can_delete_patients_and_doctors(): void
    {
        $admin = $this->makeAdmin();
        $patient = $this->makePatient();
        $doctor = $this->makeDoctor();
        $this->makeAppointment($patient, $doctor);

        $this->actingAs($admin)->delete(route('admin.destroyusers', $patient->user_id))->assertRedirect(route('admin.viewusers'));
        $this->actingAs($admin)->delete(route('admin.destroyusers', $doctor->user_id))->assertRedirect(route('admin.viewusers'));

        $this->assertSame(1, User::count());
        $this->assertSame(0, Appointment::count());
    }

    public function test_admin_cannot_delete_themselves(): void
    {
        $admin = $this->makeAdmin();

        $this->actingAs($admin)->delete(route('admin.destroyusers', $admin->id));

        $this->assertModelExists($admin);
    }

    public function test_non_admins_cannot_reach_admin_pages(): void
    {
        $patient = $this->makePatient();

        $this->actingAs($patient->user)->get(route('admin.viewusers'))->assertRedirect();
        $this->actingAs($patient->user)->delete(route('admin.destroyusers', $patient->user_id));

        $this->assertModelExists($patient->user);
    }
}
