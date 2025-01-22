<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Add the workflow_stage_id column as an unsigned big integer
            $table->unsignedBigInteger('workflow_stage_id')->nullable()->after('workflow_instance_id');

            // Add the foreign key constraint
            $table->foreign('workflow_stage_id')
                  ->references('id')
                  ->on('workflow_stages')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            // Drop the foreign key first
            $table->dropForeign(['workflow_stage_id']);

            // Then drop the column
            $table->dropColumn('workflow_stage_id');
        });
    }
};
