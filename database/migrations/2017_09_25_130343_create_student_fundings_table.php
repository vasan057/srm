<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentFundingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_fundings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->boolean('self')->default(0);
            $table->boolean('loan')->default(0);
            $table->boolean('family')->default(0);
            $table->boolean('government')->default(0);
            $table->boolean('private')->default(0);
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
        Schema::dropIfExists('student_fundings');
    }
}
