<?php

namespace Database\Seeders;
use App\Models\Feedback;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    
    public function run(): void
    {
        Feedback::create([
            'email' => 'user1@example.com',
            // 'email_subject' => 'Great Service!',
            'comment' => 'Really enjoyed the experience.',
            'rating' => 5,
            'date' => now(),
        ]);
        Feedback::create([
            'email' => 'user2@example.com',
            // 'email_subject' => 'Needs Improvement',
            'comment' => 'Could be better.',
            'rating' => 3,
            'date' => now()->subDay(),
        ]);
    }
}
