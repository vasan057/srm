<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('suggest_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->integer('institute_id')->nullable();
            $table->decimal('total_fees',10,2)->nullable();
            $table->decimal('amount',10,2)->nullable();
            $table->decimal('consult_percentage',10,2)->nullable();
            $table->decimal('sub_total',10,2)->nullable();
            $table->decimal('gst',10,2)->nullable();
            $table->decimal('grand_total',10,2)->nullable();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->boolean('paid_status')->default(false);
            $table->boolean('notify_flag')->default(false);
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
