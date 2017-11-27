<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\NewletterTemplate;
use App\Model\NewsLetterHistory;
use Validator;
use Mail;
use App\Mail\NewsLetter;
class NewsLetterController extends Controller
{
    public function getIndex(){
    	 $newsletter = NewletterTemplate::first();
    	return view('news-letter.index',['newsletter'=>$newsletter]);
    }

    public function postIndex(Request $request){
    	$user_id = \Auth::user()->id;
    	Validator::make($request->all(),[
    					'email' => 'required|emails',
    					'subject' => 'required',
    					'header_text' => 'required',
    					'body' => 'required'
    				])->validate();
    	$subject  = $request->input('subject');
    	$mails = $request->input('email');
    	$res = Mail::send('emails.newsletter',['data'=>$request->all()],function($msg)use($mails,$subject){
    		$mails = explode(',',$mails);
    		foreach ($mails as $key => $value) {
    			$msg->to($value);
    		}
    		$msg->subject($subject);
    	});
    	$ns = new NewsLetterHistory;
    	$ns->subject = $request->input('subject');
    	$ns->header = $request->input('header_text');
    	$ns->body = $request->input('body');
    	$ns->body_text = $request->input('text');
    	$ns->to_mail = $request->input('email');
    	$ns->updated_by = $user_id;
    	$ns->save();
    	return response()->json(['success'=>'success']);
    }
}
