<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentPtesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_ptes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->string('pte_type',20)->nullable();
            $table->float('listening')->default(0.00);
            $table->float('reading')->default(0.00);
            $table->float('writing')->default(0.00);
            $table->float('speaking')->default(0.00);
            $table->float('overall')->default(0.00);
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
        Schema::dropIfExists('student_ptes');
    }
}
