<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\StudentFollowup;
use App\Model\InstituteFollowup;
use App\Model\CoeReminderTemplate;
use App\Model\InvoiceTemplate;
use App\Model\NewletterTemplate;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = StudentFollowup::where('flag',false)->orderBy('remind_time','ASC')->get();
        $ins_followups = InstituteFollowup::where('flag',false)->orderBy('remind_time','ASC')->get();
        $coe = CoeReminderTemplate::first();
        $invoice = InvoiceTemplate::first();
        $newsletter = NewletterTemplate::first();
        return view('home.index',['students'=>$students,'ins_followups'=>$ins_followups,'coe'=>$coe,'invoice'=>$invoice,'newsletter'=>$newsletter]);
    }
}
