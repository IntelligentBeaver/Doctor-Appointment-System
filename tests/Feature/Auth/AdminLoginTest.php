<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_log_in_through_admin_form(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->post('/admin/login', ['email' => $admin->email, 'password' => 'password'])
            ->assertRedirect(route('admin.dashboard'));

        $this->assertAuthenticatedAs($admin);
    }

    public function test_non_admin_is_not_left_logged_in_by_admin_form(): void
    {
        $patient = User::factory()->create(['role' => 'patient']);

        $this->from('/admin/login')
            ->post('/admin/login', ['email' => $patient->email, 'password' => 'password'])
            ->assertRedirect('/admin/login');

        $this->assertGuest();
    }
}
