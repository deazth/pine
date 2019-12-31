<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('reference_no');
            $table->string('name')->nullable();
            $table->string('descr')->nullable();
            $table->integer('user_id');
            $table->string('assign_id')->nullable();
            $table->string('parent_id')->nullable();
            $table->string('status');
            $table->integer('skill_id');
            $table->integer('skill_cat_id');
            $table->integer('rating_user')->nullable();
            $table->integer('rating_assign')->nullable();
            $table->string('success_rating_user')->nullable();
            $table->string('success_rating_assign')->nullable();
            $table->datetime('submit_date')->nullable();
            $table->datetime('complete_date')->nullable();
            $table->datetime('accepted_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
