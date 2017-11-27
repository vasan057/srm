<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionPtesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institution_ptes', function (Blueprint $table) {
            $table->increments('id');
            $table->float('institute_id');
            $table->float('listening');
            $table->float('reading');
            $table->float('writing');
            $table->float('speaking');
            $table->float('overall');
            $table->boolean('flag')->nullable();
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
        Schema::dropIfExists('institution_ptes');
    }
}
