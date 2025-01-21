<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('workflow_instance_id');
            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('assigned_to'); // FK to users table
            $table->date('start_date'); // When the task starts
            $table->date('deadline');
            $table->string('status'); // E.g., "Pending", "In Progress", "Completed"
            $table->timestamps();

            $table->foreign('workflow_instance_id')->references('id')->on('workflow_instances')->onDelete('cascade');
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
