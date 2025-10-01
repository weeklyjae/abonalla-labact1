<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class SampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactMessage::truncate();

        $messages = [];
        $users = [
            ['name' => 'Alex Rivera', 'email_prefix' => 'alex.rivera'],
            ['name' => 'Jamie Cruz', 'email_prefix' => 'jamie.cruz'],
            ['name' => 'Morgan Lee', 'email_prefix' => 'morgan.lee'],
            ['name' => 'Taylor Watts', 'email_prefix' => 'taylor.watts'],
            ['name' => 'Jordan Blake', 'email_prefix' => 'jordan.blake'],
            ['name' => 'Casey Morgan', 'email_prefix' => 'casey.morgan'],
            ['name' => 'Riley Santos', 'email_prefix' => 'riley.santos'],
            ['name' => 'Hayden Brooks', 'email_prefix' => 'hayden.brooks'],
            ['name' => 'Quinn Harper', 'email_prefix' => 'quinn.harper'],
            ['name' => 'Avery Flores', 'email_prefix' => 'avery.flores'],
        ];
        $topics = [
            'web design support',
            'Laravel development',
            'travel photography tips',
            'video editing assistance',
            'UI prototyping guidance',
            'content planning ideas',
            'portfolio collaboration',
            'social media visuals',
            'website performance review',
            'branding refresh project',
        ];

        $purposes = [
            'I would love to learn more about your availability for',
            'Could you share how you usually approach',
            'I am gathering quotes related to',
            'Our team is researching potential partners for',
            'I am curious about your process when tackling',
            'We are planning a small campaign that includes',
            'I am exploring mentorship opportunities focused on',
            'We have a client asking for help with',
            'I am drafting a proposal that features',
            'We are scheduling discovery calls for',
        ];

        $followUps = [
            'Let me know if you have time for a quick chat.',
            'Looking forward to any resources you can point me to.',
            'Please tell me if your schedule allows a quick consultation.',
            'Happy to provide more details whenever convenient.',
            'If this aligns with your work, I would appreciate next steps.',
            'Please advise on your preferred way to follow up.',
            'Hope to hear your thoughts soon.',
            'Let me know if a short call works for you.',
            'Appreciate any insight you can share.',
            'Excited to hear your perspective.',
        ];

        $intros = [
            'Hello there!',
            'Good day!',
            'Greetings!',
            'Hope you are well!',
            'I hope this message finds you well!',
            'Hey!',
            'Warm regards!',
            'Pleasant day!',
            'Trust you are doing great!',
            'Nice to connect!',
        ];

        for ($i = 1; $i <= 50; $i++) {
            $topic = $topics[($i - 1) % count($topics)];
            $purpose = $purposes[($i - 1) % count($purposes)];
            $followUp = $followUps[($i - 1) % count($followUps)];
            $user = $users[($i - 1) % count($users)];
            $intro = $intros[($i - 1) % count($intros)];

            $messages[] = [
                'name' => "{$user['name']}",
                'email' => "{$user['email_prefix']}@example.com",
                'user_id' => null,
                'message' => "{$intro} {$purpose} {$topic}. {$followUp} Reference #" . str_pad((string) $i, 3, '0', STR_PAD_LEFT) . '.',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        ContactMessage::insert($messages);
    }
}

