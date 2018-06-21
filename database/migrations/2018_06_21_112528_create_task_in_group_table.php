<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskInGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_in_group', function (Blueprint $table) {
            $table->integer('group_id')->references('id')->on('groups')->onDelete('RESTRICT');
            $table->integer('task_id')->references('id')->on('tasks')->onDelete('RESTRICT');
            $table->primary(['group_id', 'task_id']);
            $table->dateTime('plan_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_in_group');
    }
}