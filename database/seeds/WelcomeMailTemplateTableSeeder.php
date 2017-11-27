<?php

use Illuminate\Database\Seeder;
use App\Model\WelcomeMailTemplate;
class WelcomeMailTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $template = new WelcomeMailTemplate;
        $template->subject = 'Welcome Mail';
        $template->name = 'Kandel Consultant';
        $template->photo_id = 1;
        $template->header_text = 'Greetings from Kandel Consultancy';
        $template->body = 'Welcome to Kandel Consultant Student Relations Manager Your login details are below';
        $template->signature = 'Kandel Consultancy';
        $template->footer_text = 'You are receiving this because you registered at Kandel Consultanct';
        $template->footer_link1 = '';
        $template->footer_link2 = '';
        $template->footer_website_link = 'http://www.kandelconsultant.com/';
        $template->footer_phone_no = '+61-425 779 082';
        $template->building_no = 'Level 10';
        $template->street_name = '230 Collins Street';
        $template->suburb = 'Melbourne';
        $template->state = 'Victoria';
        $template->post_code = '3000';
        $template->country = 'Australia';
        $template->save();
    }
}
