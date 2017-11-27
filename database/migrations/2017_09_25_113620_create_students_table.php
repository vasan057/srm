<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->nullable();
            $table->string('title',10)->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('dob')->nullable();
            $table->string('nationality',100)->nullable();
            $table->text('address')->nullable();
            $table->string('email_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('disability',3)->nullable();
            $table->integer('photo_id')->nullable();
            $table->integer('updated_by');
            $table->boolean('is_onshore')->comment('if onshore health cover and visa details update');
            $table->boolean('is_staff_assigned')->default(0);
            $table->integer('staff_assigned_by')->nullable();
            $table->integer('staff_assigned_to')->nullable();
            $table->boolean('withdrawn_flag')->default(0);
            $table->boolean('university_applied_flag')->default(0);
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
        Schema::dropIfExists('students');
    }
}
