<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Student;
use App\Model\StudentStage;
use App\Model\StudentSuggest;
use App\Model\StudentStageComment;
use App\Model\InstituteFollowup;
use App\Model\Institution;
use Validator;
class StudentStageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
         $stage = StudentStage::firstOrCreate(['student_id'=>$id]);
        return view('student.student-stage',['student'=>$student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $user_id  = \Auth::user()->id;
        $student = Student::findOrFail($id);
        $type_id = $request->input('type_id');
        $check = $request->input('check');
        $field = $request->input('type');
        $href = $request->href;
        $suggest = $request->input('suggest',false);
        $view = view('student.stage-form',['student'=>$student,'type'=>$type_id,'check'=>$check,'field'=>$field,'href'=>$href,'suggest'=>$suggest]);
        return response()->json(['success'=>$view->render()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_id  = \Auth::user()->id;
        Validator::make($request->all(),['comments'=>'required'])->validate();
        $field = $request->input('field','student_enquired');
        $stage = StudentStage::firstOrNew(['student_id'=>$id]);
        $stage->$field = $request->input('check',0);
        $stage->faculty_id = $user_id;
        $stage->save();
        // update flag 0 for previus one
        if($field == 'student_withdrawn' && $stage->$field){
            StudentStageComment::where('stage_id',$stage->id)->delete();
            $this->updateWithDrawn($stage);
        }else{
            $update = StudentStageComment::where('stage_id',$stage->id)->update(['flag'=>false]);
        }

        // if suggest
        if($field == 'coe_applied'){
            $suggest = $request->input('suggest',false);
            $this->postUpdateInstitute($suggest,$id);
        }
        $comment = new StudentStageComment;
        $comment->comment = $request->input('comments');
        $comment->student_id = $id;
        $comment->stage_id = $stage->id;
        $comment->is_active = true;
        $comment->stage_type = $request->input('type_id');
        $comment->save();
        return response()->json(['success'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function postUpdateInstitute($suggest_id,$id){
         $user_id  = \Auth::user()->id;
         $su_id =NULL;
         $institute_id = NULL;
         if($suggest_id){
            StudentSuggest::where('student_id',$id)->update(['flag'=>false]);
            $suggest = StudentSuggest::find($suggest_id);
            $suggest->flag = true;
            $suggest->save();
            $institute_id = $suggest->institute_id;
            $su_id = $suggest_id;
         }
         $stage = StudentStage::firstOrNew(['student_id'=>$id]);
         $stage->suggest_id  = $su_id;
         $stage->institute_id = $institute_id;
         $stage->save();
         if($suggest_id){
            // how many days followps
            $ins = Institution::findOrFail($institute_id);
            $remind = $ins->coe_remind;
            $no_of_days = $ins->no_of_days_coe_recieved;
             // flag one pre followups
            InstituteFollowup::where('student_id',$id)->update(['flag'=>true]);
            $institute = new InstituteFollowup;
            $institute->institute_id = $institute_id;
            $institute->course_id = $suggest->course_id;
            $institute->course_name = $suggest->course_name;
            $institute->course_type = $suggest->course_type;
            $institute->coe_receiving_date = date('Y-m-d',strtotime('+'.$no_of_days.' days'));
            $institute->coe_applied_date = date('Y-m-d');
            $institute->is_sent = false;
            $institute->course_type = $suggest->course_type;
            $institute->student_id = $id;
            $institute->flag = false;
            $institute->comments = 'COE applied';
            $institute->faculty_id = $user_id;
            $institute->remind_time = date('Y-m-d',strtotime('+'.$remind.' days'));
            $institute->save();
         }
         
         return true;
         // return response()->json(['success'=>'success']);
         // 
    } 

    private function updateWithDrawn($stage){
        $stage->institute_id = false;
        $stage->student_enquired = false;
        $stage->document_received = false;
        $stage->awaiting_pending_documents = false;
        $stage->offer_letter_applied = false;
        $stage->conditional_offer_letter_applied = false;
        $stage->full_offer_received = false;
        $stage->coe_applied = false;
        $stage->coe_received = false;
        $stage->save();
        $stage->student->fees()->delete();
        $stage->student->suggest()->delete();
        $stage->student->followup()->delete();
    }
}
