<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institution_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('institute_id')->nullable();
            $table->string('state_territory')->nullable();
            $table->string('course_abv')->nullable();
            $table->string('course_name')->nullable();
            $table->integer('course_duration')->nullable();
            $table->string('degree')->nullable();
            $table->string('course_type')->nullable();
            $table->string('location')->nullable();
            $table->string('intake',700)->nullable();
            $table->string('campus')->nullable();
            $table->boolean('flag')->nullable();
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
        Schema::dropIfExists('institution_courses');
    }
}
