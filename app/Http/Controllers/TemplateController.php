<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\InvoiceTemplate;
use App\Model\NewletterTemplate;
use App\Model\InvoiceReminderTemplate;
use App\Model\CoeReminderTemplate;
use App\Model\LofReminderTemplate;
use App\Model\WelcomeMailTemplate;
use App\Model\ResetMailTemplate;
use App\Http\Requests\InvoiceTemplateRequest;
use App\Http\Requests\NewsletterTemplateRequest;
use App\Http\Requests\InvoiceReminderTemplateRequest;
use App\Http\Requests\LOFReminderTemplateRequest;
use App\Http\Requests\COEReminderTemplateRequest;
use App\Http\Requests\WelcomeMailTemplateRequest;
use App\Http\Requests\ResetMailTemplateRequest;
class TemplateController extends Controller
{
    public function getInvoice(){
        $invoice = InvoiceTemplate::first();
        return view('template.invoice',['invoice'=>$invoice]);
    }
    public function postInvoice(InvoiceTemplateRequest $request){
        $invoice = InvoiceTemplate::firstOrNew(['id'=>1]);
        $invoice->invoice_description = $request->input('invoice_description',NULL);
        $invoice->building_no = $request->input('building_no',NULL);
        $invoice->street_name = $request->input('street_name',NULL);
        $invoice->suburb = $request->input('suburb',NULL);
        $invoice->state = $request->input('state',NULL);
        $invoice->post_code = $request->input('post_code',NULL);
        $invoice->phone = $request->input('phone',NULL);
        $invoice->fax = $request->input('fax',NULL);
        $invoice->website = $request->input('website',NULL);
        $invoice->ac_name = $request->input('ac_name',NULL);
        $invoice->bank_name = $request->input('bank_name',NULL);
        $invoice->bsb_name = $request->input('bsb_name',NULL);
        $invoice->ac_number = $request->input('ac_number',NULL);
        $invoice->photo_id = $request->input('photo_id',NULL);
        $invoice->save();
        $data = view('template.preview.invoice',['invoice'=>$invoice])->render();
        return response()->json(['success'=>$data]);
    }
    public function getNewsletter(){
        $newsletter = NewletterTemplate::first();
        return view('template.newsletter',['newsletter'=>$newsletter]);
    }

    public function postNewsletter(NewsletterTemplateRequest $request){
        $newsletter = NewletterTemplate::firstOrNew(['id'=>1]);
        $newsletter->subject = $request->input('subject',NULL);
        $newsletter->name = $request->input('name',NULL);
        $newsletter->photo_id = $request->input('photo_id',NULL);
        $newsletter->header_text = $request->input('header_text',NULL);
        $newsletter->body = $request->input('body',NULL);
        $newsletter->signature = $request->input('signature',NULL);
        $newsletter->footer_text = $request->input('footer_text',NULL);
        $newsletter->footer_website_link = $request->input('footer_website_link',NULL);
        $newsletter->footer_phone_no = $request->input('footer_phone_no',NULL);
        $newsletter->building_no = $request->input('building_no',NULL);
        $newsletter->street_name = $request->input('street_name',NULL);
        $newsletter->suburb = $request->input('suburb',NULL);
        $newsletter->state = $request->input('state',NULL);
        $newsletter->post_code = $request->input('post_code',NULL);
        $newsletter->country = $request->input('country',NULL);
        $newsletter->save();
        $data = view('template.preview.newsletter',['newsletter'=>$newsletter])->render();
        return response()->json(['success'=>$data]);

    }
    public function getInvoiceReminder(){
        $invoice_reminder = InvoiceReminderTemplate::first();
        return view('template.invoice-reminder',['invoice_reminder'=>$invoice_reminder]);
    }

    public function postInvoiceReminder(InvoiceReminderTemplateRequest $request){
        $invoice_reminder = InvoiceReminderTemplate::firstOrNew(['id'=>1]);
        $invoice_reminder->subject = $request->input('subject',NULL);
        $invoice_reminder->name = $request->input('name',NULL);
        $invoice_reminder->photo_id = $request->input('photo_id',NULL);
        $invoice_reminder->header_text = $request->input('header_text',NULL);
        $invoice_reminder->body = $request->input('body',NULL);
        $invoice_reminder->signature = $request->input('signature',NULL);
        $invoice_reminder->footer_text = $request->input('footer_text',NULL);
        $invoice_reminder->footer_website_link = $request->input('footer_website_link',NULL);
        $invoice_reminder->footer_phone_no = $request->input('footer_phone_no',NULL);
        $invoice_reminder->building_no = $request->input('building_no',NULL);
        $invoice_reminder->street_name = $request->input('street_name',NULL);
        $invoice_reminder->suburb = $request->input('suburb',NULL);
        $invoice_reminder->state = $request->input('state',NULL);
        $invoice_reminder->post_code = $request->input('post_code',NULL);
        $invoice_reminder->country = $request->input('country',NULL);
        $invoice_reminder->save();
        $data = view('template.preview.invoice-reminder',['invoice_reminder'=>$invoice_reminder])->render();
        return response()->json(['success'=>$data]);

    }
    public function getLOFReminder(){
        $lof = LofReminderTemplate::first();
        return view('template.lof-reminder',['lof'=>$lof]);
    }
    public function postLOFReminder(LOFReminderTemplateRequest $request){
        $lof = LofReminderTemplate::firstOrNew(['id'=>1]);
        $lof->subject = $request->input('subject',NULL);
        $lof->name = $request->input('name',NULL);
        $lof->photo_id = $request->input('photo_id',NULL);
        $lof->header_text = $request->input('header_text',NULL);
        $lof->body = $request->input('body',NULL);
        $lof->signature = $request->input('signature',NULL);
        $lof->footer_text = $request->input('footer_text',NULL);
        $lof->footer_website_link = $request->input('footer_website_link',NULL);
        $lof->footer_phone_no = $request->input('footer_phone_no',NULL);
        $lof->building_no = $request->input('building_no',NULL);
        $lof->street_name = $request->input('street_name',NULL);
        $lof->suburb = $request->input('suburb',NULL);
        $lof->state = $request->input('state',NULL);
        $lof->post_code = $request->input('post_code',NULL);
        $lof->country = $request->input('country',NULL);
        $lof->save();
        $data = view('template.preview.lof-reminder',['lof'=>$lof])->render();
        return response()->json(['success'=>$data]);

    }
    public function getCOEReminder(){
        $coe = CoeReminderTemplate::first();
        return view('template.coe-reminder',['coe'=>$coe]);
    }
    public function postCOEReminder(COEReminderTemplateRequest $request){
        $coe = CoeReminderTemplate::firstOrNew(['id'=>1]);
        $coe->subject = $request->input('subject',NULL);
        $coe->name = $request->input('name',NULL);
        $coe->photo_id = $request->input('photo_id',NULL);
        $coe->header_text = $request->input('header_text',NULL);
        $coe->body = $request->input('body',NULL);
        $coe->signature = $request->input('signature',NULL);
        $coe->footer_text = $request->input('footer_text',NULL);
        $coe->footer_website_link = $request->input('footer_website_link',NULL);
        $coe->footer_phone_no = $request->input('footer_phone_no',NULL);
        $coe->building_no = $request->input('building_no',NULL);
        $coe->street_name = $request->input('street_name',NULL);
        $coe->suburb = $request->input('suburb',NULL);
        $coe->state = $request->input('state',NULL);
        $coe->post_code = $request->input('post_code',NULL);
        $coe->country = $request->input('country',NULL);
        $coe->save();
        $data = view('template.preview.coe-reminder',['coe'=>$coe])->render();
        return response()->json(['success'=>$data]);

    }
    public function getWelcomeMail(){
        $welcome = WelcomeMailTemplate::first();
        return view('template.welcome-mail',['welcome'=>$welcome]);
    }
    public function postWelcomeMail(WelcomeMailTemplateRequest $request){
        $welcome = WelcomeMailTemplate::firstOrNew(['id'=>1]);
        $welcome->subject = $request->input('subject',NULL);
        $welcome->name = $request->input('name',NULL);
        $welcome->photo_id = $request->input('photo_id',NULL);
        $welcome->header_text = $request->input('header_text',NULL);
        $welcome->body = $request->input('body',NULL);
        $welcome->signature = $request->input('signature',NULL);
        $welcome->footer_text = $request->input('footer_text',NULL);
        $welcome->footer_website_link = $request->input('footer_website_link',NULL);
        $welcome->footer_phone_no = $request->input('footer_phone_no',NULL);
        $welcome->building_no = $request->input('building_no',NULL);
        $welcome->street_name = $request->input('street_name',NULL);
        $welcome->suburb = $request->input('suburb',NULL);
        $welcome->state = $request->input('state',NULL);
        $welcome->post_code = $request->input('post_code',NULL);
        $welcome->country = $request->input('country',NULL);
        $welcome->save();
        $data = view('template.preview.welcome-mail',['welcome'=>$welcome])->render();
        return response()->json(['success'=>$data]);

    }
    public function getResetMail(){
        $reset = ResetMailTemplate::first();
        return view('template.reset-mail',['reset'=>$reset]);
    }
    public function postResetMail(ResetMailTemplateRequest $request){
        $reset = ResetMailTemplate::firstOrNew(['id'=>1]);
        $reset->subject = $request->input('subject',NULL);
        $reset->name = $request->input('name',NULL);
        $reset->photo_id = $request->input('photo_id',NULL);
        $reset->header_text = $request->input('header_text',NULL);
        $reset->body = $request->input('body',NULL);
        $reset->signature = $request->input('signature',NULL);
        $reset->footer_text = $request->input('footer_text',NULL);
        $reset->footer_website_link = $request->input('footer_website_link',NULL);
        $reset->footer_phone_no = $request->input('footer_phone_no',NULL);
        $reset->building_no = $request->input('building_no',NULL);
        $reset->street_name = $request->input('street_name',NULL);
        $reset->suburb = $request->input('suburb',NULL);
        $reset->state = $request->input('state',NULL);
        $reset->post_code = $request->input('post_code',NULL);
        $reset->country = $request->input('country',NULL);
        $reset->save();
        $data = view('template.preview.reset-mail',['reset'=>$reset])->render();
        return response()->json(['success'=>$data]);

    }
}
