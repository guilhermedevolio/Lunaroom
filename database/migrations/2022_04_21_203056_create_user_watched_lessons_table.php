<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWatchedLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_watched_lessons', function (Blueprint $table) {
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('course_id')->references('id')->on('courses');
            $table->foreignId('lesson_id')->references('id')->on('lessons');
            $table->timestamp('watched_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_watched_lessons');
    }
}
