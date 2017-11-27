<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_referrals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->string('referral_method')->nullable();
            $table->integer('ref_student_id')->nullable();
            $table->integer('ref_other_id')->nullable();
            $table->text('facebook_url')->nullable();
            $table->text('website_url')->nullable();
            $table->string('magazine_name')->nullable();
            $table->boolean('is_active')->default(0);
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
        Schema::dropIfExists('student_referrals');
    }
}
