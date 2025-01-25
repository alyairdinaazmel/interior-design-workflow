<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workflow_template_stages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workflow_template_id'); // FK to workflow_templates
            $table->string('name'); // Stage name
            $table->integer('order'); // Order of the stage in the template
            $table->timestamps();

            // Foreign key constraint to workflow_templates table
            $table->foreign('workflow_template_id')
                  ->references('id')
                  ->on('workflow_templates')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workflow_template_stages');
    }
};
