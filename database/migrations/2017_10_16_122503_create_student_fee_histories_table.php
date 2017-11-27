<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentFeeHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_fee_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fee_id');
            $table->integer('student_id');
            $table->integer('suggest_id');
            $table->decimal('scholarship',10,2)->nullable();
            $table->decimal('total_fees',10,2)->nullable();
            $table->decimal('grand_total',10,2)->nullable();
            $table->decimal('amount_paid',10,2)->nullable();
            $table->decimal('pre_balance',10,2)->nullable();
            $table->decimal('post_balance',10,2)->nullable();
            $table->decimal('balance_amount',10,2)->nullable();
            $table->string('paid_to',30)->nullable();
            $table->string('paid_by',30)->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('student_fee_histories');
    }
}
