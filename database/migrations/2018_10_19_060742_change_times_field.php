<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTimesField extends Migration
{

    public function up()
    {
        Schema::table('times', function (Blueprint $table) {
            $table->dropColumn('step_opis');
        });

        Schema::table('times', function (Blueprint $table) {
            $table->text('step_opis') ;
        });
    }


    public function down()
    {


        Schema::table('times', function (Blueprint $table) {
            $table->dropColumn('step_opis');
        });

        Schema::table('times', function (Blueprint $table) {
            $table->json('step_opis');
        });
    }
}
