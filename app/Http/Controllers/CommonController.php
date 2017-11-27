<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Model\StudentOtherReferral;
use App\Model\Gallery;
use Excel;
use DB;
use App\Model\InstitutionCourse;
use App\Model\StudentReferral;
use App\Model\Student;
class CommonController extends Controller
{
    public function postAddReferral(Request $request){
        $validate = Validator::make($request->except('_token'),[
            'other_referral_name' => 'required',
            'other_referral_email' => 'required|email',
            'other_referral_phone' => 'required|regex:/[0-9]{10}/'
        ])->validate();
        $referral = StudentOtherReferral::firstOrNew(['email'=>$request->input('other_referral_email')]);
        $referral->name = $request->input('other_referral_name','');
        $referral->phone = $request->input('other_referral_phone');
        $referral->description = $request->input('desc','');
        $referral->save();
        return ['success'=>$referral];
    }

    public function postUploadImage(Request $request){
        $validate = Validator::make($request->all(),[
            'photo'=>'mimes:jpeg,bmp,png,svg'
        ])->validate();
        $time = time();
        if($request->hasFile('photo')){
            $path = $request->file('photo')->storeAs(
                'avatars', $time."_".$request->file('photo')->getClientOriginalName()
            );
            $gallery = new Gallery;
            $gallery->full_path = $path;
            $gallery->original_name = $request->file('photo')->getClientOriginalName();
            $gallery->file_name = $time.'_'.$request->file('photo')->getClientOriginalName();
            $gallery->is_active = true;
            $gallery->save();
            return response()->json(['success'=>$gallery]);
        }
        return response()->json(['fails'=>'error']);
    }

    public function postUploadCourse(Request $request){
        $time = time();
        if($request->hasFile('course_file')){
            $path = $request->file('course_file')->storeAs(
                'course', $time."_".$request->file('course_file')->getClientOriginalName()
            );
            $ids = false;
            $time_stamp = date('Y-m-d H:i:s');
            Excel::load(storage_path('app/'.$path), function($reader) use($time_stamp){
                
                // Getting all results
                
                // ->all() is a wrapper for ->get() and will work the same
                $results = $reader->all();
                $results = $reader->get();
                $data = [];
                if(count($results)){
                    foreach($results as $result){
                        $data[] = [
                            'state_territory' => $result->state_territory,
                            'course_abv' => $result->course_abv,
                            'course_name' => $result->course_name,
                            'course_duration' => $result->course_duration,
                            'degree' => $result->degree,
                            'course_type' => $result->course_type,
                            'location' => $result->location,
                            'intake' => $result->intake ? strtolower($result->intake):NULL,
                            'campus' => $result->campus,
                            'flag' => FALSE,
                            'created_at' => $time_stamp
                        ];
                    }
                }
                if(!empty($data)){
                    DB::transaction(function() use ($data){
                        InstitutionCourse::insert($data);
                    });
                }
            });
            $ids = InstitutionCourse::where('created_at',$time_stamp)->pluck('id');
            if($ids && count($ids)){
                return response()->json(['success'=>$ids]);
            }
        }
        return response()->json(['fails'=>'error']);
    }

    public function getAutoContact(Request $request){
        print_r($request->all());
    }

    
}
