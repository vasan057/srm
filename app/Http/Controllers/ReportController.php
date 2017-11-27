<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\StudentReferral;
use App\Model\StudentFollowup;
class ReportController extends Controller
{
    public function getReferral(Request $request){
    	$from = $request->input('from',false);
    	$to = $request->input('to',false);
    	$report = StudentReferral::paginate(2);
    	
    	if($from && $to){
    		$from = date('Y-m-d',strtotime($from));
    		$to = date('Y-m-d 23:59:59',strtotime($to));
    		$report = StudentReferral::whereBetween('created_at',[$from,$to])->paginate(2);
    	}

    	return view('report.referral',['report'=>$report]);
    }

    public function getStatisticalReports(Request $request){
        $from = $request->input('from',false);
        $to = $request->input('to',false);
        $student = StudentFollowup::where();    
    }
}
