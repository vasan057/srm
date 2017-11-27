<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('institute_name',700)->nullable();
            $table->string('country',100)->nullable();
            $table->string('state_territory',100)->nullable();
            $table->string('intake_month',700)->nullable();
            $table->integer('max_backlogs')->nullable();
            $table->integer('no_of_days_coe_recieved')->nullable();
            $table->integer('coe_remind')->nullable();
            $table->integer('lof')->nullable();
            $table->integer('lof_remind')->nullable();
            $table->integer('invoice_clear_date')->nullable();
            $table->integer('invoice_remind')->nullable();
            $table->text('university_address')->nullable();
            $table->string('email_id')->nullable();
            $table->string('website_address')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('fax_no')->nullable();
            $table->boolean('flag')->nullable();
            $table->integer('photo_id')->nullable();
            $table->integer('file_id')->nullable();

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
        Schema::dropIfExists('institutions');
    }
}
