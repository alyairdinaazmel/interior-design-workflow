<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskComment;

class TaskCommentsSeeder extends Seeder
{
    public function run()
    {
        TaskComment::create([
            'task_id' => 1,
            'user_id' => 2, // Jane Smith
            'comment' => 'Initial consultation went well. Client is satisfied with the progress.',
            'created_at' => now(),
        ]);

        TaskComment::create([
            'task_id' => 2,
            'user_id' => 2, // Jane Smith
            'comment' => 'Design drafts are being developed as per client specifications.',
            'created_at' => now(),
        ]);
    }
}
