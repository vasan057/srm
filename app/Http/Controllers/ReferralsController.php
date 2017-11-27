<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\StudentReferral;
class ReferralsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facebook = StudentReferral::where('facebook_url','!=',NULL)->groupBy('facebook_url')->pluck('facebook_url');
        $web = StudentReferral::where('website_url','!=',NULL)->groupBy('website_url')->pluck('website_url');
        $magazine = StudentReferral::where('magazine_name','!=',NULL)->groupBy('magazine_name')->pluck('magazine_name');
        $student = StudentReferral::where('ref_student_id','!=',NULL)->groupBy('ref_student_id')->with('refStudent')->get()->pluck('ref_student_id','refStudent.first_name');
        $others = StudentReferral::where('ref_other_id','!=',NULL)->groupBy('ref_other_id')->with('others')->get()->pluck('ref_other_id','others.name');
        return view('student.referral',['face'=>$facebook,'web'=>$web,'magazine'=>$magazine,'student'=>$student,'others'=>$others]);
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
        //
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
