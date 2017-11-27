<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('doc_id')->nullable()->comment('if any external doc referes here');
            $table->boolean('passport')->default(0);
            $table->boolean('visa')->default(0);
            $table->boolean('overseas_qualification')->default(0);
            $table->boolean('australian_qualification')->default(0);
            $table->boolean('current_transcript')->default(0);
            $table->boolean('overseas_student_health_cover')->default(0);
            $table->boolean('current_coe')->default(0);
            $table->boolean('ielts')->default(0);
            $table->boolean('is_active');
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
        Schema::dropIfExists('student_documents');
    }
}
