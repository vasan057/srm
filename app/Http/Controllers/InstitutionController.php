<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InstitutionStoreRequest;
use App\Http\Requests\InstitutionUpdateRequest;
use App\Model\Institution;
use App\Model\InstitutionCourse;
use App\Model\InstitutionIelts;
use App\Model\InstitutionPte;
class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutes = Institution::get();
        return view('institution.index',['institutes'=>$institutes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('institution.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstitutionStoreRequest $request)
    {
        $institution = new Institution;
        $institution->institute_name = $request->input('name', NULL);
        $institution->state_territory = $request->input('state', NULL);
        $institution->lof = $request->input('lof_duration', NULL);
        $institution->lof_remind = $request->input('lof_remainer', NULL);
        $institution->no_of_days_coe_recieved = $request->input('coe_duration', NULL);
        $institution->coe_remind = $request->input('coe_remainder', NULL);
        $institution->invoice_clear_date = $request->input('invoice_date', NULL);
        $institution->invoice_remind = $request->input('invoice_remainder', NULL);
        $institution->university_address = $request->input('address', NULL);
        $institution->email_id = $request->input('email', NULL);
        $institution->website_address = $request->input('website', NULL);
        $institution->contact_no = $request->input('phone', NULL);
        $institution->fax_no = $request->input('fax_no', NULL);
        $institution->photo_id = $request->input('photo_id', NULL);
        $institution->intake_month = $request->input('intake_month', NULL);
        $institution->flag= true;
        $institution->save();
        $iltes = new InstitutionIelts;
        $iltes->listening = $request->input('ielts_listening',NULL);
        $iltes->reading = $request->input('ielts_reading',NULL);
        $iltes->writing = $request->input('ielts_writing',NULL);
        $iltes->speaking = $request->input('ielts_speaking',NULL);
        $iltes->overall = $request->input('ielts_overall',NULL);
        $iltes->flag = true;
        $iltes->institute_id = $institution->id;
        $iltes->save();
        $pte = new InstitutionPte;
        $pte->listening = $request->input('pte_listening',NULL);
        $pte->reading = $request->input('pte_reading',NULL);
        $pte->writing = $request->input('pte_writing',NULL);
        $pte->speaking = $request->input('pte_speaking',NULL);
        $pte->overall = $request->input('pte_overall',NULL);
        $pte->institute_id = $institution->id;
        $pte->flag = true;
        $pte->save();
        if($request->course_id){
            $update = InstitutionCourse::whereIn('id',$request->course_id)
                        ->update(['institute_id'=>$institution->id,'flag'=>true]);
        }
        $request->session()->flash('success', 'Created was successful!');
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
        $institution = Institution::find($id);
        $courses = $institution->course;
        return view('institution.show',['courses'=>$courses,'institution'=>$institution]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $institute = Institution::find($id);
        return view('institution.edit',['institute'=>$institute]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InstitutionUpdateRequest $request, $id)
    {
        $institution = Institution::find($id);
        $institution->institute_name = $request->input('name', NULL);
        $institution->state_territory = $request->input('state', NULL);
        $institution->lof = $request->input('lof_duration', NULL);
        $institution->lof_remind = $request->input('lof_remainer', NULL);
        $institution->no_of_days_coe_recieved = $request->input('coe_duration', NULL);
        $institution->coe_remind = $request->input('coe_remainder', NULL);
        $institution->invoice_clear_date = $request->input('invoice_date', NULL);
        $institution->invoice_remind = $request->input('invoice_remainder', NULL);
        $institution->university_address = $request->input('address', NULL);
        $institution->email_id = $request->input('email', NULL);
        $institution->website_address = $request->input('website', NULL);
        $institution->contact_no = $request->input('phone', NULL);
        $institution->fax_no = $request->input('fax_no', NULL);
        $institution->photo_id = $request->input('photo_id', NULL);
        $institution->intake_month = $request->input('intake_month', NULL);
        $institution->flag= true;
        $institution->save();
        $iltes = InstitutionIelts::firstOrNew(['institute_id'=>$institution->id]);
        $iltes->listening = $request->input('ielts_listening',NULL);
        $iltes->reading = $request->input('ielts_reading',NULL);
        $iltes->writing = $request->input('ielts_writing',NULL);
        $iltes->speaking = $request->input('ielts_speaking',NULL);
        $iltes->overall = $request->input('ielts_overall',NULL);
        $iltes->save();
        $pte = InstitutionPte::firstOrNew(['institute_id'=>$institution->id]);
        $pte->listening = $request->input('pte_listening',NULL);
        $pte->reading = $request->input('pte_reading',NULL);
        $pte->writing = $request->input('pte_writing',NULL);
        $pte->speaking = $request->input('pte_speaking',NULL);
        $pte->overall = $request->input('pte_overall',NULL);
        $pte->save();
        if($request->course_id){
            $update = InstitutionCourse::whereIn('id',$request->course_id)
                        ->update(['institute_id'=>$institution->id,'flag'=>true]);
        }
        $request->session()->flash('success', 'Created is successful!');
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
        $institution = Institution::find($id)->delete();
        return redirect()->back()->with('delete','deleted successfully');
    }
}
