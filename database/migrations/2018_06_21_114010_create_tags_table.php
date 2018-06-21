<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_tag');
        });

        Schema::create('task_in_tag', function (Blueprint $table) {
            $table->integer('task_id')->references('id')->on('tasks')->onDelete('CASCADE');
            $table->integer('tag_id')->references('id')->on('tags')->onDelete('CASCADE');
            $table->primary(['task_id', 'tag_id']);
            $table->string('name_tag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_in_tag');
        Schema::dropIfExists('tags');
    }
}
