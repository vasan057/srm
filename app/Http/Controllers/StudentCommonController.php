<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Student;
use App\Model\StudentSuggest;
use App\Model\InstitutionCourse;
use App\Model\StudentFee;
use App\Model\Invoice;
use App\Model\StudentFeeHistory;
use App\Model\StudentReferral;
use App\Model\StudentReferralCommision;
use App\Http\Requests\StoreFeesRequest;
use Validator;
use PDF;
class StudentCommonController extends Controller
{
    public function getSuggest(Request $request,$id){
        $type = $request->course_type;
        $name = $request->course_name;
        $state = $request->state;
        $course = [];
        if($type || $name || $state){
            $course = InstitutionCourse::where('course_type','like','%'.$type.'%')
                                        ->Where('course_name','like','%'.$name.'%')
                                        ->Where('state_territory','like','%'.$state.'%')
                                        ->get();
        }
        $student = null;
        if($id){
            $student = Student::find($id);
        }
        return view('student.suggest',['student'=>$student,'courses'=>$course]);
    }
    public function postSuggest(Request $request,$id){
        $user_id = \Auth::user()->id;
        $student = Student::findOrFail($id);
        $course_id = $request->course;
        $course = InstitutionCourse::findOrFail($course_id);
        $suggest = StudentSuggest::firstOrNew(['student_id'=>$id,'course_id'=>$course_id]);
        $suggest->student_id = $id;
        $suggest->institute_id = isset($course->institute->id)?$course->institute->id:1;
        $suggest->institute_name = isset($course->institute->institute_name)?$course->institute->institute_name :1;
        $suggest->faculty_id = $user_id;
        $suggest->course_type = $course->course_type;
        $suggest->course_name = $course->course_name;
        $suggest->course_state = $course->state_territory;
        $suggest->flag = false;
        $suggest->notification_flag = false;
        $suggest->save();
        return response()->json(['success'=>'successfull saved']);
    }

    public function getFees($id){
        $user_id = \Auth::user()->id;
        $student = Student::findOrFail($id);
        return view('student.fees',['student'=>$student]);
    }
    public function postFees(StoreFeesRequest $request,$id){
        $user_id = \Auth::user()->id;
        $student = Student::findOrFail($id);
        $suggest_id = $request->input('institution');
        $fee = StudentFee::where('student_id',$id)->where('suggest_id',$suggest_id)->first();
        $pre_bal = 0;
        if($fee){
            $grand_total = $fee->grand_total;
            $paid = $fee->amount_paid;
            $c_paid = $request->input('amountpaid',0);
            $fee->amount_paid = $paid+floatval($c_paid);
            $pre_bal = $paid;
            $fee->balance_amount = $fee->grand_total - $fee->amount_paid;
            if($fee->balance_amount < 1) $fee->flag = true;
            $fee->save();
        }else{
            $fee = new StudentFee;
            $fee->student_id = $id;
            $fee->suggest_id = $suggest_id;
            $fee->scholarship = $request->input('scholarship',0) ? $request->input('scholarship') : 0;
            $fee->total_fees = $request->input('totalfees');
            $fee->grand_total = $fee->total_fees - $fee->scholarship;
            $fee->amount_paid = $request->input('amountpaid',0);
            $fee->balance_amount = $fee->grand_total - $fee->amount_paid;
            $fee->paid_to = $request->input('paidto');
            $fee->paid_by = $request->input('paidby');
            $fee->note = $request->input('notes');
            $fee->updated_by = $user_id;
            if($fee->balance_amount < 1) $fee->flag = true;
            $fee->save();
        }
    // insert history details
        $history = new StudentFeeHistory;
        $history->fee_id = $fee->id;
        $history->student_id = $id;
        $history->suggest_id =  $suggest_id;
        $history->scholarship = $fee->scholarship;
        $history->total_fees = $request->input('totalfees');
        $history->grand_total = $fee->grand_total;
        $history->amount_paid = $request->input('amountpaid',0);
        $history->pre_balance = $pre_bal;
        $history->post_balance = $fee->balance_amount;
        $history->balance_amount = $fee->balance_amount;
        $history->paid_to = $fee->paid_to;
        $history->paid_by = $request->input('paidby');
        $history->paid_by = $request->input('notes');
        $history->save();

        //  create invoice table
         // dd($fee->suggest);
        $invoice = Invoice::firstOrNew(['student_id'=>$id,'institute_id'=>$fee->suggest->institute_id,'suggest_id'=>$suggest_id]);
        $invoice->total_fees = $fee->total_fees;
        $invoice->amount = $fee->total_fees;
        $invoice->save();
        
        return response()->json(['success'=>'success']);

    }

    public function getDownload($id){
        $history = StudentFeeHistory::findOrFail($id);
        $pdf = PDF::loadView('student.pdf',['bill'=>$history]);
        // return view('student.pdf',['bill'=>$history]);

       return $pdf->download('download.pdf');
    }

    public function postSearchReferral(Request $request){
        Validator::make($request->all(),['ref_by'=>'required','name'=>'required'],['ref_by.required'=>'Please select atleast one','name.required'=>'please select option'])->validate();
        $type = $request->input('ref_by');
        $value = $request->input('name');
        $value = $value? $value : 'NA';
        $referrals = StudentReferral::where($type,$value)->get();
        $first = $referrals->first();
        $title = "";
        if(!$first){
            $view =  view('student.referral-list',['referrals'=>$referrals,'title'=>$title]);
            return response()->json(['success'=>$view->render()]);
        }
        switch ($type){
            case 'ref_student_id':
            $title = "Student : ".$first->refStudent->first_name.' '.$first->refStudent->last_name;
            break;
            case 'facebook_url':
            $title = "Facebook Page: ".$first->facebook_url;
            break;
            case 'website_url':
            $title = "Website Name: ".$first->website_url;
            break;
            case 'magazine_name':
            $title = "Magazine Name: ".$first->magazine_name;
            break;
            default :
            $title ="Referred Person Name: ".$first->others->name;
            break;
        }

        $view =  view('student.referral-list',['referrals'=>$referrals,'title'=>$title]);
        return response()->json(['success'=>$view->render()]);
    }

    public function getReferralDetail($id){
        $referral = StudentReferral::findOrFail($id);
        $commision = $referral->commision;
        $type = $amount = $gift ='';
        $flag = false;
        if($commision){
            $type = $commision->referral_prize;
            $amount = $commision->referral_prize_amount;
            $gift = $commision->referral_gift_voucher;
            $flag = $commision->flag;
        }
        $view = view('student.referral-details',[
                            'referral'=>$referral,
                            'type' => $type,
                            'amount' => $amount,
                            'gift' => $gift,
                            'flag'  => $flag
                        ]);
        return response()->json(['success'=>$view->render()]);
    }

    public function postReferralDetail(Request $request,$id){
        Validator::make($request->all(),[
            'prize_type' => 'required',
            'commision_amount' => 'required_if:prize_type,amount|numeric',
            'gift' => 'required_if:prize_type,gift',
            'status' => 'required'
        ],
        [
            'commision_amount.required_if'=>'The commision amount field is required',
            'gift.required_if'=>'The Voucher or gift field is required'
        ])->validate();
        
        
        $commision = StudentReferralCommision::firstOrNew(['reference_id'=>$id]);
        $commision->referral_prize = $request->input('prize_type',NULL);
        $commision->referral_prize_amount = $request->input('commision_amount',NULL);
        $commision->referral_gift_voucher = $request->input('gift',NULL);
        $commision->flag = $request->input('status',false);
        $commision->date = date('Y-m-d');
        $commision->save();
        return response()->json(['success'=>'success']);

    }
    
    public function getBackTOAdd($id){
        $student = Student::findOrFail($id);
        $student->stage->student_withdrawn = false;
        $student->stage->save();
        return back()->with('success','With drown successfully');
    }
}
