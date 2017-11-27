<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Model\Student;
use App\Model\StudentFollowup;
use App\Model\Institution;
use App\Model\InstituteFollowup;
use DB;
class ChartController extends Controller
{
    public function postIndex(Request $request){
    	Validator::make($request->all(),[	
    		'type' => 'required',
    		'from' => 'required|date',
    		'to' => 'required|date'
    	])->validate();
    	$type = $request->input('type');
    	$from = date('Y-m-d',strtotime($request->input('from')));
    	$to = date('Y-m-d 23:59:59',strtotime($request->input('to')));
    	$data = [];
    	switch ($type) {
    		case 'student':
    			$data = $this->getStudent([$from,$to]);
    			break;

    		case 'student-followup':
    			$data = $this->getStudentFollowUp([$from,$to]);
    			break;

    		case 'institution':
    			$data = $this->getInstitution([$from,$to]);
    			break;
    			
    		case 'instituion-followup':
    			$data = $this->getInstitutionFollowup([$from,$to]);
    			break;
    			
    		case 'invoice-followup':
    			$data = $this->getStudentFollowUp([$from,$to]);
    			break;
    		
    		default:
    			$data = $this->getStudent([$from,$to]);
    			break;
    	}
    	return response()->json(['success'=>$data]);
    }

    private function getStudent($data){
    	$student = Student::whereBetween('created_at',$data)
    					->select(DB::raw('DATE(created_at) as date'),DB::raw('count(*) as total'))
				    	->groupBy(DB::raw('CAST(created_at AS DATE)'))
				    	->get();
		$res = [];
		if(count($student)) {
			$res = [];
			foreach($student as $stu){
				$res[] = [strtotime($stu->date)*1000,$stu->total];
			}
		}
		return ['data'=>$res,'type'=>'Registerd Student'];
    }
    private function getStudentFollowUp($data){
    	$student = StudentFollowup::whereBetween('remind_time',$data)
    					->where('flag',0)
    					->select(DB::raw('DATE(remind_time) as date'),DB::raw('count(*) as total'))
				    	->groupBy(DB::raw('CAST(remind_time AS DATE)'))
				    	->get();
		$res = [];
		if(count($student)) {
			$res = [];
			foreach($student as $stu){
				$res[] = [strtotime($stu->date)*1000,$stu->total];
			}
		}
		return ['data'=>$res,'type'=>'Student Followup'];
    }

    private function getInstitution($data){
    	$student = Institution::whereBetween('created_at',$data)
    					->select(DB::raw('DATE(created_at) as date'),DB::raw('count(*) as total'))
				    	->groupBy(DB::raw('CAST(created_at AS DATE)'))
				    	->get();
		$res = [];
		if(count($student)) {
			$res = [];
			foreach($student as $stu){
				$res[] = [strtotime($stu->date)*1000,$stu->total];
			}
		}
		return ['data'=>$res,'type'=>'Institution'];
    }
    private function getInstitutionFollowup($data){
    	$student = InstituteFollowup::whereBetween('remind_time',$data)
    					->where('flag',0)
    					->select(DB::raw('DATE(remind_time) as date'),DB::raw('count(*) as total'))
				    	->groupBy(DB::raw('CAST(remind_time AS DATE)'))
				    	->get();
		$res = [];
		if(count($student)) {
			$res = [];
			foreach($student as $stu){
				$res[] = [strtotime($stu->date)*1000,$stu->total];
			}
		}
		return ['data'=>$res,'type'=>'Institution Followup'];
    }



}
