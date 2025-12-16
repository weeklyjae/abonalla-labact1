<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Database\Seeder;

class SampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactMessage::truncate();

        $users = User::factory()
            ->count(10)
            ->create();

        ContactMessage::factory()
            ->count(50)
            ->state(function () use ($users) {
                $user = $users->random();

                return [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'message' => fake()->paragraphs(2, true),
                ];
            })
            ->create();
    }
}

