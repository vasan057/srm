<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsLetterHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_letter_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('updated_by');
            $table->string('subject')->null();
            $table->string('header')->null();
            $table->text('body')->null();
            $table->text('body_text')->null();
            $table->text('to_mail')->null();
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
        Schema::dropIfExists('news_letter_histories');
    }
}
