<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_stages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('faculty_id');
            $table->integer('institute_id')->nullable();
            $table->boolean('student_enquired')->default(0);
            $table->boolean('document_received')->default(0);
            $table->boolean('awaiting_pending_documents')->default(0);
            $table->boolean('offer_letter_applied')->default(0);
            $table->boolean('conditional_offer_letter_applied')->default(0);
            $table->boolean('full_offer_received')->default(0);
            $table->boolean('coe_applied')->default(0);
            $table->boolean('coe_received')->default(0);
            $table->boolean('student_withdrawn')->default(0);
            $table->boolean('last_checked')->default(0);
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
        Schema::dropIfExists('student_stages');
    }
}
