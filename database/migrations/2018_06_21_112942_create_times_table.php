<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->references('id')->on('groups')->onDelete('RESTRICT');
            $table->integer('task_id')->references('id')->on('tasks')->onDelete('RESTRICT');
            $table->integer('user_id')->references('id')->on('users')->onDelete('RESTRICT');
            $table->dateTime('fact_time');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->json('step_opis');

            $table->index(['group_id', 'task_id']);
            $table->index(['user_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('times');
    }
}
