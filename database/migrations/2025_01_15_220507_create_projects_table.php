<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('client_id');
            $table->decimal('budget', 15, 2);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('status'); // e.g., "Not Started", "In Progress", "Completed"
            $table->text('project_description')->nullable(); // Project-specific preferences/requirements
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
