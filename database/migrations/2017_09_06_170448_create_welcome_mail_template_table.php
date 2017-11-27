<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWelcomeMailTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('welcome_mail_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject')->nullable();
            $table->string('name')->nullable();
            $table->integer('photo_id')->nullable();
            $table->string('header_text')->nullable();
            $table->text('body')->nullable();
            $table->string('signature')->nullable();
            $table->string('footer_text')->nullable();
            $table->string('footer_link1')->nullable();
            $table->string('footer_link2')->nullable();
            $table->string('footer_website_link')->nullable();
            $table->string('footer_phone_no')->nullable();
            $table->string('building_no')->nullable();
            $table->string('street_name')->nullable();
            $table->string('suburb')->nullable();
            $table->string('state',100)->nullable();
            $table->string('post_code',10)->nullable();
            $table->string('country',100)->nullable();
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
        Schema::dropIfExists('welcome_mail_templates');
    }
}
