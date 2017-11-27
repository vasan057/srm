<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewletterTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newletter_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject')->nullable();
            $table->string('name')->nullable();
            $table->string('photo_id')->nullable();
            $table->string('header_text')->nullable();
            $table->text('body')->nullable();
            $table->string('signature')->nullable();
            $table->text('footer_text')->nullable();
            $table->string('footer_website_link')->nullable();
            $table->string('footer_phone_no')->nullable();
            $table->string('building_no')->nullable();
            $table->string('street_name')->nullable();
            $table->string('suburb')->nullable();
            $table->string('state')->nullable();
            $table->string('post_code')->nullable();
            $table->string('country')->nullable();
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
        Schema::dropIfExists('newletter_templates');
    }
}
