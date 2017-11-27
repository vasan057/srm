<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentStageCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_stage_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('faculty_id');
            $table->integer('stage_id');
            $table->integer('stage_type')->comment('this is based on studentstage table 1 - student_enquired,2-document_received, 3-awaiting_pending_documents,4-offer_letter_applied, 5-conditional_offer_letter_applied, 6-full_offer_received,7-coe_applied ,8-coe_received, 9- student_withdrawn');
            $table->text('comment')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('flag')->default(1);
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
        Schema::dropIfExists('student_stage_comments');
    }
}
