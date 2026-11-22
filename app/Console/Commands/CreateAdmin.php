<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

/**
 * Admins cannot self-register, so the first admin is created from the command line.
 */
class CreateAdmin extends Command
{
    protected $signature = 'admin:create {email : Email address for the new admin} {--name=Administrator : Display name}';

    protected $description = 'Create an administrator account';

    public function handle(): int
    {
        $email = (string) $this->argument('email');
        $name = (string) $this->option('name');
        $password = (string) $this->secret('Password (min. 8 characters)');
        $confirmation = (string) $this->secret('Confirm password');

        $validator = Validator::make(
            ['name' => $name, 'email' => $email, 'password' => $password, 'password_confirmation' => $confirmation],
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'confirmed', Password::defaults()],
            ],
        );

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'image' => 'images/avatar/placeholder.jpg',
            'password' => Hash::make($password),
            'role' => 'admin',
        ]);

        $this->info("Admin {$email} created.");

        return self::SUCCESS;
    }
}
