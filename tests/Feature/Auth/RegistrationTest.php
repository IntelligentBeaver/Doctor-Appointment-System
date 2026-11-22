<?php

namespace Tests\Feature\Auth;

use App\Models\Doctor;
use App\Models\Specialization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_patients_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'patient',
            'phone' => '9800000000',
            'address' => 'Kathmandu',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('home'));
        $this->assertNotNull(User::where('email', 'test@example.com')->first()->patient);
    }

    public function test_new_doctors_can_register(): void
    {
        Specialization::create(['SpecializationName' => 'Cardiology']);

        $this->post('/register', [
            'name' => 'Dr Test',
            'email' => 'doc@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'doctor',
            'specialization' => 'Cardiology',
            'contact_information' => '9811111111',
        ])->assertRedirect(route('home'));

        $this->assertSame(1, Doctor::count());
    }

    public function test_users_cannot_register_as_admin(): void
    {
        $response = $this->post('/register', [
            'name' => 'Mallory',
            'email' => 'mallory@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'admin',
        ]);

        $response->assertSessionHasErrors('role');
        $this->assertGuest();
        $this->assertDatabaseMissing('users', ['email' => 'mallory@example.com']);
    }

    public function test_doctor_with_unknown_specialization_leaves_no_orphan_user(): void
    {
        $response = $this->post('/register', [
            'name' => 'Dr Ghost',
            'email' => 'ghost@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 'doctor',
            'specialization' => 'Does Not Exist',
            'contact_information' => '9811111111',
        ]);

        $response->assertSessionHasErrors('specialization');
        $this->assertDatabaseMissing('users', ['email' => 'ghost@example.com']);
    }
}
