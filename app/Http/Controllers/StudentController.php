<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StudentRegRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Model\Student;
use App\Model\StudentEducation;
use App\Model\StudentHealthCover;
use App\Model\StudentVisa;
use App\Model\StudentCourse;
use App\Model\StudentIelts;
use App\Model\StudentPte;
use App\Model\StudentWork;
use App\Model\StudentFunding;
use App\Model\StudentDocument;
use App\Model\StudentReferral;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(20);
        return view('student.index',['students'=>$students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRegRequest $request)
    {
        $count = Student::count() ? Student::count() : 0;
        $count = $count+1;
        $user_id = \Auth::user()->id;
        $s_type = $request->input('student_type');
        $student_type = false;
        if($s_type == 'Onshore Student') $student_type = TRUE;
        $student = new Student;
        $student->title = $request->input('title',NULL);
        $student->first_name = $request->input('first_name',NULL);
        $student->middle_name = $request->input('middle_name',NULL);
        $student->last_name = $request->input('last_name',NULL);
        $student->dob = $request->input('dob',NULL);
        $student->photo_id = $request->input('photo_id',NULL);
        $student->nationality = $request->input('nationality',NULL);
        $student->address = $request->input('address',NULL);
        $student->email_id = $request->input('email_id',NULL);
        $student->phone = $request->input('phone',NULL);
        $student->disability = $request->input('disability',NULL);
        $student->is_onshore = $student_type;
        $student->is_staff_assigned = $request->input('staff',NULL) ? 1:0 ;
        $student->staff_assigned_by = $request->input('staff',NULL) ? $user_id:NULL ;
        $student->staff_assigned_to = $request->input('staff',NULL);
        $student->updated_by = $user_id;
        $student->username = str_replace(' ','',$request->first_name).str_replace(' ','',$request->last_name).str_pad($count,2,0,STR_PAD_LEFT);
        $student->save();
        // check whether onshore or offshore
        if($request->student_type == 'Onshore Student'){
            $this->addOnshoreDetails($request,$student->id);
        }
        $edu = $this->addEducation($request,$student->id);
        if(isset($edu['insert']) && !empty($edu['insert'])) StudentEducation::insert($edu['insert']);
        $pref_course = $this->addPreferredCourse($request,$student->id);
        if(isset($pref_course['insert']) && !empty($pref_course['insert'])) StudentCourse::insert($pref_course['insert']);
        // English Language Proficiency
        $en_prof = $this->addEngLanProf($request,$student->id);
        // work experience
        $work_exp = $this->addWorkExp($request,$student->id);
        if(isset($work_exp['insert']) && !empty($work_exp['insert'])) StudentWork::insert($work_exp['insert']);
        // Funding Sources
        $student_fundings = $this->addStudentFund($request,$student->id);
        // documents
        $docs = $this->AddDocuments($request,$student->id);
        // references
        $ref = $this->addReferrence($request,$student->id);
        $request->session()->flash('success', 'Created was successful!');
        return response()->json(['success'=>$student]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('student.edit',['student'=>$student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentUpdateRequest $request, $id)
    {
        $user_id = \Auth::user()->id;
        $s_type = $request->input('student_type');
        $student_type = false;
        if($s_type == 'Onshore Student') $student_type = TRUE;
        $student = Student::findOrFail($id);
        $student->title = $request->input('title',NULL);
        $student->first_name = $request->input('first_name',NULL);
        $student->middle_name = $request->input('middle_name',NULL);
        $student->last_name = $request->input('last_name',NULL);
        $student->dob = $request->input('dob',NULL);
        if($request->input('photo_id',NULL))  $student->photo_id = $request->input('photo_id',NULL);
        $student->nationality = $request->input('nationality',NULL);
        $student->address = $request->input('address',NULL);
        $student->email_id = $request->input('email_id',NULL);
        $student->phone = $request->input('phone',NULL);
        $student->disability = $request->input('disability',NULL);
        $student->is_onshore = $student_type;
        $student->is_staff_assigned = $request->input('staff',NULL) ? 1:0 ;
        $student->staff_assigned_by = $request->input('staff',NULL) ? $user_id:NULL ;
        $student->staff_assigned_to = $request->input('staff',NULL);
        $student->updated_by = $user_id;
        $student->save();
        // check whether onshore or offshore
        if($request->student_type == 'Onshore Student'){
            $this->addOnshoreDetails($request,$id);
        }
        $edu = $this->addEducation($request,$id);
        if(isset($edu['update']) && !empty($edu['update'])) $this->updateEducation($edu['update'],$id);
        if(isset($edu['insert']) && !empty($edu['insert'])) StudentEducation::insert($edu['insert']);
        $pref_course = $this->addPreferredCourse($request,$student->id);
        if(isset($pref_course['update']) && !empty($pref_course['update'])) $this->updatePreferredCourse($pref_course['update'],$id);
        if(isset($pref_course['insert']) && !empty($pref_course['insert'])) StudentCourse::insert($pref_course['insert']);
        // English Language Proficiency
        $en_prof = $this->addEngLanProf($request,$id);
        // work exp
        $work_exp = $this->addWorkExp($request,$student->id);
        if(isset($work_exp['update']) && !empty($work_exp['update'])) $this->updateWorkExp($work_exp['update'],$id);
        if(isset($work_exp['insert']) && !empty($work_exp['insert'])) StudentWork::insert($work_exp['insert']);
        // documents
        $docs = $this->AddDocuments($request,$student->id);
        // references
        $ref = $this->addReferrence($request,$student->id);
        // Funding Sources
        $student_fundings = $this->addStudentFund($request,$student->id);
        return response()->json(['success'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $student = Student::find($id);
        $student->delete();
        $request->session()->flash('delete', 'deleted was successful!');
        return response()->json(["success"=>'success']);
    }

    private function addEducation($request,$student_id){
        if(!empty($request->edu_course_title) && $request->edu_course_title[0]){
            $insert = [];
            $update = [];
            foreach($request->edu_course_title as $key=>$value){
                $data =[
                    'course_title' => $value,
                    'course_name' => $request->course_name[$key],
                    'institution' => $request->institution[$key],
                    'country' => $request->country_val[$key],
                    'state' => $request->country_state[$key],
                    'course_from' => date('Y-m-d',strtotime($request->year_from[$key])),
                    'course_to' => date('Y-m-d',strtotime($request->year_to[$key])),
                    'duration' => $request->duration[$key],
                    'is_completed' => $request->status[$key],
                    'backlogs'=>$request->backlogs[$key],
                    'is_active'=>true,
                    'student_id'=>$student_id
                ];
                if(isset($request->edu_id[$key])){
                    unset($data['is_active'],$data['student_id']);
                    $update[$request->edu_id[$key]] = $data;
                }else{
                    $insert[] = $data;
                }
            }
            return ['insert'=>$insert,'update'=>$update];
        }
        return false;
        // $edu = new StudentEducation;
    }
    private function updateEducation($data,$id){
        if(!empty($data)){
            $pre_id = array_keys($data);
            // delete removed from edit view page
            StudentEducation::whereNotIn('id',$pre_id)->where('student_id',$id)->delete();
            foreach($data as $key=>$value){
                StudentEducation::where('id',$key)->update($value);
            }
        }
    }

    private function addOnshoreDetails($request,$student_id){
        $health = StudentHealthCover::firstOrNew(['student_id'=>$student_id]);
        $visa = StudentVisa::firstOrNew(['student_id'=>$student_id]);
        $health->student_id = $student_id;
        $health->health_type = $request->input('health_type',NULL);
        $health->health_cover_name = $request->input('health_cover_name',NULL);
        $health->expiry_date = $request->input('expiry_date',NULL);
        $health->is_active = true;
        $health->save();
        // insert visa
        $visa->student_id = $student_id;
        $visa->visa_expiry_date = $request->input('visa_expiry_date',NULL);
        $visa->visa_grand_date = $request->input('visa_grand_date',NULL);
        $visa->visa_sub_class = $request->input('visa_sub_class',NULL);
        $visa->is_active = true;
        $visa->save();
        return true;

    }

    private function addPreferredCourse($request,$student_id){
        if(!empty($request->input('course_title',[]))){
            $insert = [];
            $update = [];
            foreach($request->input('course_title') as $key=>$value){
                $data = [
                    'student_id'=>$student_id,
                    'course_title'=>$request->course_title[$key],
                    'course_name'=>$request->precourse[$key],
                    'commencement_year'=>$request->commencement_year[$key].'-01-01'
                ];
                if(isset($request->course_id[$key])){
                    unset($data['student_id']);
                    $update[$request->course_id[$key]] = $data;
                }else{
                    $insert[] = $data;
                }
            }
            return ['insert'=>$insert,'update'=>$update];
        }
        return false;
    }

    private function updatePreferredCourse($data,$id){
        if(!empty($data)){
            $pre_id = array_keys($data);
            // delete removed from edit view page
            StudentCourse::whereNotIn('id',$pre_id)->where('student_id',$id)->delete();
            foreach($data as $key=>$value){
                StudentCourse::where('id',$key)->update($value);
            }
        }
    }

    private function addEngLanProf($request,$student_id){
        $pte = StudentPte::firstOrNew(['student_id'=>$student_id]);
        $ilte = StudentIelts::firstOrNew(['student_id'=>$student_id]);
        if($request->ielts_listening){
            $ilte->student_id = $student_id;
            $ilte->ielts_type = $request->input('ielts_type');
            $ilte->listening = $request->input('ielts_listening');
            $ilte->reading = $request->input('ielts_reading');
            $ilte->writing = $request->input('ielts_writing');
            $ilte->speaking = $request->input('ielts_speaking');
            $ilte->save();
            $overall = ($ilte->listening+$ilte->reading+$ilte->writing+$ilte->speaking)/4;
            $overall = round($overall,2);
            $ilte->overall = $overall;
            $ilte->save();
        }
        if($request->pte_listening){
            $pte->student_id = $student_id;
            $pte->pte_type = $request->input('pte_type');
            $pte->listening = $request->input('pte_listening');
            $pte->reading = $request->input('pte_reading');
            $pte->writing = $request->input('pte_writing');
            $pte->speaking = $request->input('pte_speaking');
            $pte->save();
            $overall = ($pte->listening+$pte->reading+$pte->writing+$pte->speaking)/4;
            $overall = round($overall,2);
            $pte->overall = $overall;
            $pte->save();
        }

    }
    private function addWorkExp($request,$student_id){
        if(!empty($request->input('employer_name',[])) && $request->employer_name[0]){
            $insert = [];
            $update = [];
            foreach($request->input('employer_name') as $key=>$value){
                $data = [
                    'student_id'=>$student_id,
                    'employer_name'=>$request->employer_name[$key],
                    'work_from'=>date('Y-m-d',strtotime($request->from[$key])),
                    'work_to'=>date('Y-m-d',strtotime($request->to[$key])),
                    'responsibility'=>$request->responsibilty[$key]
                ];
                if(isset($request->work_id[$key])){
                    unset($data['student_id']);
                    $update[$request->work_id[$key]] = $data;
                }else{
                    $insert[] = $data;
                }
            }
            return ['insert'=>$insert,'update'=>$update];
        }
        return false;
    }
    private function updateWorkExp($data,$id){
        if(!empty($data)){
            $pre_id = array_keys($data);
            // delete removed from edit view page
            StudentWork::whereNotIn('id',$pre_id)->where('student_id',$id)->delete();
            foreach($data as $key=>$value){
                StudentWork::where('id',$key)->update($value);
            }
        }
    }

    private function addStudentFund($request,$student_id){
        $funding = StudentFunding::firstOrNew(['student_id'=>$student_id]);
        $funding->self = $request->input('funding_self',false);
        $funding->loan = $request->input('funding_loan',false);
        $funding->family = $request->input('funding_family',false);
        $funding->government = $request->input('scholarship_government',false);
        $funding->private = $request->input('scholarship_private',false);
        $funding->save();
    }
    private function AddDocuments($request,$student_id){
        $doc = StudentDocument::firstOrNew(['student_id'=>$student_id]);
        $doc->passport = $request->input('passport',0);
        $doc->visa = $request->input('visa',0);
        $doc->overseas_qualification = $request->input('overseas_qualification',0);
        $doc->australian_qualification = $request->input('australian_qualification',0);
        $doc->current_transcript = $request->input('current_transcript',0);
        $doc->overseas_student_health_cover = $request->input('overseas_student_health_cover',0);
        $doc->current_COE = $request->input('current_coe',0);
        $doc->IELTS = $request->input('ielts',0);
        $doc->is_active = $request->input('scholarship_private',0);
        $doc->save();
    }
    private function addReferrence($request,$student_id){
        if($request->input('referredBy',NULL) && $request->input('referredBy') !='')
            $ref_by = $request->input('referredBy',NULL);
            $ref_by = isset($ref_by) ? trans('cmn.'.$ref_by) : NULL;
            $ref = StudentReferral::firstOrNew(['student_id'=>$student_id]);
            $ref->referral_method = $ref_by;
            $ref->ref_student_id = $request->input('referral_name',NULL);
            $ref->ref_other_id = $request->input('others_referral_name',NULL);
            $ref->facebook_url = $request->input('facebook_name',NULL);
            $ref->website_url = $request->input('website_name',NULL);
            $ref->magazine_name = $request->input('magazine_name',NULL);
            $ref->is_active = true;
            $ref->save();
    }

    public function getDeleteAll(){
        $students = Student::get();
        foreach($students as $student){
            $student->delete();
        }
        return redirect()->to('students');
    }

    
}
