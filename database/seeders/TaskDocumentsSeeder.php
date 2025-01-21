<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TaskDocument;

class TaskDocumentsSeeder extends Seeder
{
    public function run()
    {
        TaskDocument::create([
            'task_id'     => 1,
            'file_path'   => 'documents/consultation_notes.pdf',
            'file_name'   => 'Consultation Notes',
            'uploaded_by' => 2, // Assuming staff user with ID 2
        ]);

        TaskDocument::create([
            'task_id'     => 2,
            'file_path'   => 'documents/design_drafts.pdf',
            'file_name'   => 'Design Drafts',
            'uploaded_by' => 2,
        ]);
    }
}
