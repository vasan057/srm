<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FacultyRegRequest;
use App\Http\Requests\FacultyRegEditRequest;
use App\Model\Faculty;
use App\Model\FacultyAccess;
use App\Model\Gallery;
use App\Model\WelcomeMailTemplate as Template;
use App\Notifications\WelcomeFaculty;
class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(Request $request)
    {
         $this->request = $request;
      
    }
    public function index()
    {
        $faculties = Faculty::where('faculty_type','!=',1)->get();
        return view('faculty.index',['faculties'=>$faculties]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacultyRegRequest $request)
    {
        $count = Faculty::count() ? Faculty::count() : 0;
        $count = $count+1;
        $faculty = new Faculty;
        $faculty->pid = $request->pid;
        $faculty->password = $request->password;
        $faculty->first_name = $request->first_name;
        $faculty->middle_name = $request->middle_name;
        $faculty->last_name = $request->last_name;
        $faculty->dob = $request->dob;
        $faculty->gender = $request->gender;
        $faculty->address = $request->address;
        $faculty->email_id = $request->email_id;
        $faculty->phone = $request->phone;
        $faculty->blood_group = $request->blood_group;
        $faculty->e_name = $request->e_name;
        $faculty->e_rel = $request->e_rel;
        $faculty->e_email = $request->e_email;
        $faculty->e_phone = $request->e_phone;
        $faculty->faculty_type = $request->faculty_type;
        $faculty->flag = $request->input('flag',false);
        $faculty->staff_id = str_replace(' ','',$faculty->first_name).str_replace(' ','',$faculty->last_name).str_pad($count,2,0,STR_PAD_LEFT);
        $faculty->save();
        // save image
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
            $faculty->photo_id = $gallery->id;
            $faculty->save();
        }
        // faculty accessability
        $access = new FacultyAccess;
        $access->faculty_id = $faculty->id;
        $access->faculty_menu = $request->input('faculty_menu',false);
        $access->faculty_reg = $request->input('faculty_reg',false);
        $access->faculty_view = $request->input('faculty_view',false);
        $access->faculty_type_list = $request->input('faculty_type_list',false);
        $access->student_menu = $request->input('student_menu',false);
        $access->student_reg = $request->input('student_reg',false);
        $access->student_view = $request->input('student_view',false);
        $access->student_follow_up = $request->input('student_follow_up',false);
        $access->student_enquiry = $request->input('student_enquiry',false);
        $access->referral_commision = $request->input('referral_commision',false);
        $access->reminder = $request->input('reminder',false);
        $access->student_bulk_upload = $request->input('student_bulk_upload',false);
        $access->institution_menu = $request->input('institution_menu',false);
        $access->institution_reg = $request->input('institution_reg',false);
        $access->institution_view = $request->input('institution_view',false);
        $access->institution_application_download = $request->input('institution_application_download',false);
        $access->invoice_menu = $request->input('invoice_menu',false);
        $access->invoice_list = $request->input('invoice_list',false);
        $access->invoice_archive = $request->input('invoice_archive',false);
        $access->news_letter_menu = $request->input('news_letter_menu',false);
        $access->news_letter_send = $request->input('news_letter_send',false);
        $access->mail_templates_menu = $request->input('mail_templates_menu',false);
        $access->forgot_password_mail_template = $request->input('forgot_password_mail_template',false);
        $access->welcome_mail_template = $request->input('welcome_mail_template',false);
        $access->university_reminder_mail_template = $request->input('university_reminder_mail_template',false);
        $access->lof_reminder_mail_template = $request->input('lof_reminder_mail_template',false);
        $access->invoice_reminder_mail_template = $request->input('invoice_reminder_mail_template',false);
        $access->news_letter_template = $request->input('news_letter_template',false);
        $access->settings_menu = $request->input('settings_menu',false);
        $access->settings_change_password = $request->input('settings_change_password',false);
        $access->settings_add_remove_countries = $request->input('settings_add_remove_countries',false);
        $access->reports_menu = $request->input('reports_menu',false);
        $access->statistical_report = $request->input('statistical_report',false);
        $access->commision_report = $request->input('commision_report',false);
        $access->settings_invoice_settings = $request->input('settings_invoice_settings',false);
        $access->save();


        $token =  str_random(64);
        \DB::table(config('auth.passwords.users.table'))->insert([
            'email_id' => $faculty->email_id, 
            'token' => $token
        ]);
        $link = url('auth/reset/'.$token);
        $faculty->notify(new WelcomeFaculty(Template::find(1),$link,$faculty));

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
        $faculty = Faculty::findOrFail($id);
        return view('faculty.edit',['faculty'=>$faculty]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FacultyRegEditRequest $request, $id)
    {
        $faculty = Faculty::findOrFail($id);
        $faculty->first_name = $request->first_name;
        $faculty->middle_name = $request->middle_name;
        $faculty->last_name = $request->last_name;
        $faculty->dob = $request->dob;
        $faculty->gender = $request->gender;
        $faculty->address = $request->address;
        $faculty->email_id = $request->email_id;
        $faculty->phone = $request->phone;
        $faculty->blood_group = $request->blood_group;
        $faculty->e_name = $request->e_name;
        $faculty->e_rel = $request->e_rel;
        $faculty->e_email = $request->e_email;
        $faculty->e_phone = $request->e_phone;
        $faculty->faculty_type = $request->faculty_type;
        $faculty->flag = $request->input('flag',false);
        $faculty->save();
        // save image
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
            $faculty->photo_id = $gallery->id;
            $faculty->save();
        }
        // faculty accessability
        $access = FacultyAccess::where('faculty_id',$faculty->id)->first();
        $access->faculty_id = $faculty->id;
        $access->faculty_menu = $request->input('faculty_menu',false);
        $access->faculty_reg = $request->input('faculty_reg',false);
        $access->faculty_view = $request->input('faculty_view',false);
        $access->faculty_type_list = $request->input('faculty_type_list',false);
        $access->student_menu = $request->input('student_menu',false);
        $access->student_reg = $request->input('student_reg',false);
        $access->student_view = $request->input('student_view',false);
        $access->student_follow_up = $request->input('student_follow_up',false);
        $access->student_enquiry = $request->input('student_enquiry',false);
        $access->referral_commision = $request->input('referral_commision',false);
        $access->reminder = $request->input('reminder',false);
        $access->student_bulk_upload = $request->input('student_bulk_upload',false);
        $access->institution_menu = $request->input('institution_menu',false);
        $access->institution_reg = $request->input('institution_reg',false);
        $access->institution_view = $request->input('institution_view',false);
        $access->institution_application_download = $request->input('institution_application_download',false);
        $access->invoice_menu = $request->input('invoice_menu',false);
        $access->invoice_list = $request->input('invoice_list',false);
        $access->invoice_archive = $request->input('invoice_archive',false);
        $access->news_letter_menu = $request->input('news_letter_menu',false);
        $access->news_letter_send = $request->input('news_letter_send',false);
        $access->mail_templates_menu = $request->input('mail_templates_menu',false);
        $access->forgot_password_mail_template = $request->input('forgot_password_mail_template',false);
        $access->welcome_mail_template = $request->input('welcome_mail_template',false);
        $access->university_reminder_mail_template = $request->input('university_reminder_mail_template',false);
        $access->lof_reminder_mail_template = $request->input('lof_reminder_mail_template',false);
        $access->invoice_reminder_mail_template = $request->input('invoice_reminder_mail_template',false);
        $access->news_letter_template = $request->input('news_letter_template',false);
        $access->settings_menu = $request->input('settings_menu',false);
        $access->settings_change_password = $request->input('settings_change_password',false);
        $access->settings_add_remove_countries = $request->input('settings_add_remove_countries',false);
        $access->reports_menu = $request->input('reports_menu',false);
        $access->statistical_report = $request->input('statistical_report',false);
        $access->commision_report = $request->input('commision_report',false);
        $access->settings_invoice_settings = $request->input('settings_invoice_settings',false);
        $access->save();

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
        $faculty = Faculty::findOrFail($id)->delete();
        return redirect('faculty')->with('delete','deleted');
    }

    private function uploadImage($file){
        $file = Storage::put($file,'');
    }

    public function getProfile(){
        $user_id = \Auth::user()->id;//dd($user_id);
         $faculties = Faculty::where('id',$user_id)->first();//dd($faculties);  
         return view('faculty.profile',['faculties'=>$faculties]);
       
      

    }

    public function editProfile(){
        $user_id = \Auth::user()->id;
         $faculties = Faculty::where('id',$user_id)->first();//dd($faculties);
       return view('faculty.editprofile',['faculties'=>$faculties]);
        
    }

    public function postEditProfile(Request $request,$user_id){
         
    
        $faculty = Faculty::findOrFail($user_id);
        $faculty->first_name = $request->first_name;
       $faculty->last_name = $request->last_name;
        $faculty->dob = $request->dob;
        $faculty->gender = $request->gender;
        $faculty->address = $request->address;
        $faculty->email_id = $request->email_id;
        $faculty->phone = $request->phone;
        $faculty->blood_group = $request->blood_group;
        $faculty->e_name = $request->e_name;
        $faculty->e_rel = $request->e_rel;
        $faculty->e_email = $request->e_email;
        $faculty->e_phone = $request->e_phone;
        $faculty->save();
      // dd($request->all());
        /* $inputs = $request->only('first_name','last_name','phone','email_id','gender','address','blood_group','e_name','e_rel','e_email','e_phone');dd($inputs);
            $validator = Admin::validation_adminprofile($inputs);
            if($validator->fails())
            {

            return redirect('admin/profile/edit')->withErrors($validator);

            }
            $adminprofile = Auth::guard('admin')->user();//dd($adminprofile);
            $inputs['updated_by']=$adminprofile->id;
            $adminprofile->fname = $inputs['fname'];
            $adminprofile->lname = $inputs['lname'];
            $adminprofile->email= $inputs['email'];
            $adminprofile->phone = $inputs['phone'];
            $adminprofile->password = Hash::make($inputs['changePassword']);
            $adminprofile->save();*/
            return redirect('faculty/profile')->with('success','profile updated successfully');
    }
}
