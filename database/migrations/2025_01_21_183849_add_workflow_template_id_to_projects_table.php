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
        Schema::table('projects', function (Blueprint $table) {
            // Add a new unsigned big integer column for the workflow_template_id
            $table->unsignedBigInteger('workflow_template_id')->after('budget')->nullable();

            // Optionally, add the foreign key constraint if your workflow_templates table exists.
            // Remove or adjust "nullable()" if you want this column to always be set.
            $table->foreign('workflow_template_id')
                  ->references('id')
                  ->on('workflow_templates')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Drop the foreign key first then the column.
            $table->dropForeign(['workflow_template_id']);
            $table->dropColumn('workflow_template_id');
        });
    }
};
