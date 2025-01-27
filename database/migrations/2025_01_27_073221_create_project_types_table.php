<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('project_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., Residential, Commercial
            $table->timestamps();
        });

        // Optional: Seed initial project types
        DB::table('project_types')->insert([
            ['name' => 'Residential', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Commercial', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Outdoor and Landscaping', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Specialized Installations', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Custom Decorative Services', 'created_at' => now(), 'updated_at' => now()],
            // Add more types as needed
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('project_types');
    }
};
