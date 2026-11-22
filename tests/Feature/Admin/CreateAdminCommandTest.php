<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateAdminCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_an_admin(): void
    {
        $this->artisan('admin:create', ['email' => 'root@example.com'])
            ->expectsQuestion('Password (min. 8 characters)', 'secret-pass')
            ->expectsQuestion('Confirm password', 'secret-pass')
            ->assertSuccessful();

        $this->assertSame('admin', User::where('email', 'root@example.com')->value('role'));
    }

    public function test_it_rejects_mismatched_passwords(): void
    {
        $this->artisan('admin:create', ['email' => 'root@example.com'])
            ->expectsQuestion('Password (min. 8 characters)', 'secret-pass')
            ->expectsQuestion('Confirm password', 'other-pass')
            ->assertFailed();

        $this->assertSame(0, User::count());
    }
}
