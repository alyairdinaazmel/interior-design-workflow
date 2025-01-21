<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('workflow_instances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('workflow_template_id');
            $table->string('status'); // Overall status (e.g., "In Progress", "Completed")
            $table->unsignedBigInteger('current_stage_id'); // Current active stage
            $table->dateTime('started_at');
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('workflow_template_id')->references('id')->on('workflow_templates')->onDelete('cascade');
            // You may add a foreign key for current_stage_id if desired:
            $table->foreign('current_stage_id')->references('id')->on('workflow_stages')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('workflow_instances');
    }
};
