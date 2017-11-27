<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyAccessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_accesses', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('faculty_id');
            $table->boolean('faculty_menu');
            $table->boolean('faculty_reg');
            $table->boolean('faculty_view');
            $table->boolean('faculty_type_list');
            $table->boolean('student_menu');
            $table->boolean('student_reg');
            $table->boolean('student_view');
            $table->boolean('student_follow_up');
            $table->boolean('student_enquiry');
            $table->boolean('referral_commision');
            $table->boolean('reminder');
            $table->boolean('student_bulk_upload');
            $table->boolean('institution_menu');
            $table->boolean('institution_reg');
            $table->boolean('institution_view');
            $table->boolean('institution_application_download');
            $table->boolean('invoice_menu');
            $table->boolean('invoice_list');
            $table->boolean('invoice_archive');
            $table->boolean('news_letter_menu');
            $table->boolean('news_letter_send');
            $table->boolean('mail_templates_menu');
            $table->boolean('forgot_password_mail_template');
            $table->boolean('welcome_mail_template');
            $table->boolean('university_reminder_mail_template');
            $table->boolean('lof_reminder_mail_template');
            $table->boolean('invoice_reminder_mail_template');
            $table->boolean('news_letter_template');
            $table->boolean('settings_menu');
            $table->boolean('settings_change_password');
            $table->boolean('settings_add_remove_countries');
            $table->boolean('reports_menu');
            $table->boolean('statistical_report');
            $table->boolean('commision_report');
            $table->boolean('settings_invoice_settings');
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
        Schema::dropIfExists('faculty_accesses');
    }
}
