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
            'user_id' => 2, // Assuming staff user with ID 2
            'comment' => 'Initial meeting went well.',
        ]);

        TaskComment::create([
            'task_id' => 2,
            'user_id' => 2,
            'comment' => 'Design drafts are in progress as per client requirements.',
        ]);
    }
}
