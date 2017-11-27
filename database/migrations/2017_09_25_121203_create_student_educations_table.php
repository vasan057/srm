<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_educations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->string('course_title')->nullable();
            $table->string('course_name')->nullable();
            $table->text('institution')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->date('course_from')->nullable();
            $table->date('course_to')->nullable();
            $table->integer('duration')->nullable();
            $table->boolean('is_completed')->default(0);
            $table->integer('backlogs')->default(0);
            $table->boolean('is_active');
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
        Schema::dropIfExists('student_eductions');
    }
}
