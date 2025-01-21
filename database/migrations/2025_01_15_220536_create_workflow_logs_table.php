<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('workflow_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workflow_instance_id');
            $table->unsignedBigInteger('stage_id'); // Related stage (if applicable)
            $table->string('action'); // E.g., "Stage Completed", "Comment Added"
            $table->text('comments')->nullable();
            $table->dateTime('timestamp');
            $table->timestamps();

            $table->foreign('workflow_instance_id')->references('id')->on('workflow_instances')->onDelete('cascade');
            $table->foreign('stage_id')->references('id')->on('workflow_stages')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('workflow_logs');
    }
};
