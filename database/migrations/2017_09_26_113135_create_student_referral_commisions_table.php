<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentReferralCommisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_referral_commisions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('person_name')->nullable();
            $table->integer('reference_id')->comment('refered from student_refrrals_table');
            $table->string('referral_prize')->nullable();
            $table->decimal('referral_prize_amount',5,2)->nullable();
            $table->text('referral_gift_voucher')->nullable();
            $table->date('date')->nullable();
            $table->boolean('flag')->default(0);
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
        Schema::dropIfExists('student_referral_commisions');
    }
}
