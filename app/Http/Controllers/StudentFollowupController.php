<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Student;
use App\Model\StudentFollowup;
use Validator;

class StudentFollowupController extends Controller
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
    	$user_id = \Auth::user()->id;
        Validator::make($request->all(),[
        	'remind_date' => 'required|date',
        	'comments' => 'required',
        	'student_id' => 'required'
        	])->validate();
        $prev_followup = StudentFollowup::where(['student_id'=>$request->input('student_id'),'faculty_id'=>$user_id])->update(['flag'=>true]);

        $follow = new StudentFollowup;
        $follow->student_id = $request->input('student_id');
        $follow->faculty_id = $user_id;
        $follow->remind_time = $request->input('remind_date');
        $follow->comments = $request->input('comments');
        $follow->save();
        return response()->json(['success'=>'success']);

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
        $student = Student::find($id);
        $view = view('student.followup-detail',['student'=>$student]);
        return response()->json(['success'=>$view->render(),'student'=>$student]);
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
        //
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
}
