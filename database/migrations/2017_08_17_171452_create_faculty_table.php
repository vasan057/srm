<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pid')->nullable();
            $table->string('staff_id',100)->index();
            $table->string('password');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('dob')->nullable();
            $table->string('gender',8)->nullable();
            $table->string('address')->nullable();
            $table->string('email_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('photo')->nullable();
            $table->string('e_name')->nullable();
            $table->string('e_rel')->nullable();
            $table->string('e_email')->nullable();
            $table->string('e_phone')->nullable();
            $table->integer('faculty_type')->comment('refers faculty type table')->nullable();
            $table->rememberToken();
            $table->integer('notify_faculty')->nullable();
            $table->boolean('flag');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculties');
    }
}
