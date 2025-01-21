<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('workflow_stages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workflow_template_id');
            $table->string('name');
            $table->integer('order'); // Order of the stage in the template
            $table->timestamps();

            $table->foreign('workflow_template_id')->references('id')->on('workflow_templates')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('workflow_stages');
    }
};
