<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('workflow_template_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workflow_template_stage_id'); // FK to stages table
            $table->string('title'); // Task title
            $table->text('description')->nullable(); // Optional task description
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('workflow_template_stage_id')
                ->references('id')
                ->on('workflow_template_stages')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('workflow_template_tasks');
    }
};
