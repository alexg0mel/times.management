<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MovePlantimeField extends Migration
{

    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->integer('plan_time')->default(0);
        });

        Schema::table('task_in_group', function (Blueprint $table) {
            $table->dropColumn('plan_time');
        });

        Schema::table('times', function (Blueprint $table) {
            $table->dropColumn('fact_time');
        });

        Schema::table('times', function (Blueprint $table) {
            $table->integer('fact_time')->default(0);
        });

    }


    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn('plan_time');
        });

        Schema::table('task_in_group', function (Blueprint $table) {
            $table->dateTime('plan_time')->nullable();
        });

        Schema::table('times', function (Blueprint $table) {
            $table->dropColumn('fact_time');
        });

        Schema::table('times', function (Blueprint $table) {
            $table->dateTime('fact_time')->nullable();
        });
    }
}
