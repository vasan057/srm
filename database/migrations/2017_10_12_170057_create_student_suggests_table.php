<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentSuggestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_suggests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('institute_id');
            $table->integer('course_id');
            $table->string('institute_name')->nullable();
            $table->string('course_type')->nullable();
            $table->string('course_name')->nullable();
            $table->string('course_state')->nullable();
            $table->date('COE_receiving_date')->nullable();
            $table->date('COE_applied_date')->nullable();
            $table->date('remind_date')->nullable();
            $table->integer('faculty_id')->nullable();
            $table->integer('mail_sent_count')->nullable();
            $table->boolean('flag')->nullable();
            $table->boolean('notification_flag')->nullable();
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
        Schema::dropIfExists('student_suggests');
    }
}
