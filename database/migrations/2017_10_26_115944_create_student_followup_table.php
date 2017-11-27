<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentFollowupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_followups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('faculty_id');
            $table->text('comments')->nullable();
            $table->text('remark')->nullable();
            $table->boolean('flag')->default(0)->comment('If 0 then pending, 1 completed');
            $table->dateTime('remind_time')->nullable();
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
        Schema::dropIfExists('student_followups');
    }
}
