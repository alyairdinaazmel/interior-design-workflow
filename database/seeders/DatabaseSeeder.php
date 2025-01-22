<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            UsersSeeder::class,
            WorkflowTemplatesSeeder::class,  // Run template seeder first
            WorkflowStagesSeeder::class,     // And stages seeder, if needed
            ClientsSeeder::class,
            ProjectsSeeder::class,           // Now projects can reference an existing template
            WorkflowInstancesSeeder::class,
            WorkflowLogsSeeder::class,
            TasksSeeder::class,
            TaskCommentsSeeder::class,
            TaskDocumentsSeeder::class,
        ]);
    }
}
