<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\InstitutionCourse;
use App\Http\Requests\InstituteCourseRequest;
class InstitutionCourseController extends Controller
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
        $courses = InstitutionCourse::where('institute_id',$id)->get();
        return view('institution-course.show',['courses'=>$courses]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = InstitutionCourse::find($id);
        return view('institution-course.edit',['course'=>$course]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InstituteCourseRequest $request, $id)
    {
        $update = InstitutionCourse::find($id);
        $update->course_type = $request->course_type;
        $update->course_name = $request->course_name;
        $update->course_duration = $request->course_duration;
        $update->campus = $request->campus;
        $update->save();
        $request->session()->flash('update', 'Created was successful!');
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
        $course = InstitutionCourse::find($id);
        $course->delete();
        return redirect()->back()->with(['delete'=>'success']);

    }
}
