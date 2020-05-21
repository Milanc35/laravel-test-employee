<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $initialUsers = [
            [
                'name' => "admin",
                'email' => "admin@admin.com",
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ],
        ];

        $emails = array_column($initialUsers, 'email');
        $existEmails = User::whereIn('email', $emails)->select('email')->pluck('email')->toArray();
        foreach ($initialUsers as $key => $newUser) {
            if (in_array($key, $existEmails)) {
                // Update
                unset($initialUsers[$key]);
            }
        }

        User::insert($initialUsers);
    }
}
