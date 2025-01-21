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
            ClientsSeeder::class,
            ProjectsSeeder::class,
            WorkflowTemplatesSeeder::class,
            WorkflowStagesSeeder::class,
            WorkflowInstancesSeeder::class,
            WorkflowLogsSeeder::class,
            TasksSeeder::class,
            TaskCommentsSeeder::class,
            TaskDocumentsSeeder::class,
        ]);
    }
}
