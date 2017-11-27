<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRegRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'student_type' => 'required',
            'title' => 'required',
            'first_name' => 'required|alpha|max:255',
            'last_name' => 'required|alpha|max:255',
            'dob' => 'required',
            'nationality' => 'required',
            'address' => 'required',
            'email_id' => 'required|email',
            'phone' => 'required|regex:/[0-9]{10}/',
            'disability' => 'required',
            'health_type' => 'required_if:student_type,Onshore Student',
            'health_cover_name' => 'required_if:student_type,Onshore Student',
            'expiry_date' => 'required_if:student_type,Onshore Student',
            'visa_expiry_date' => 'required_if:student_type,Onshore Student',
            'visa_grand_date' => 'required_if:student_type,Onshore Student',
            'visa_sub_class' => 'required_if:student_type,Onshore Student',
            'referral_name' =>'required_if:referredBy,name',
            'facebook_name' =>'required_if:referredBy,facebook',
            'website_name' =>'required_if:referredBy,website',
            'others_referral_name' =>'required_if:referredBy,others',
            'magazine_name' =>'required_if:referredBy,magazine',
        ];
        foreach($this->edu_course_title as $key=>$value){
            $req = 'required';
            if( $key == 0 && $value == null){
                $req = 'required_with:edu_course_title.'.$key;
            }else{
                $rules['edu_course_title.'.$key] = 'required';
            }
            $rules['course_name.'.$key] = $req;
            $rules['institution.'.$key] = $req;
            $rules['country_val.'.$key] = $req;
            $rules['country_state.'.$key] = $req;
            $rules['year_from.'.$key] = $req;
            $rules['year_to.'.$key] = $req;
            $rules['duration.'.$key] = $req;
            $rules['backlogs.'.$key] = $req;
        }
        foreach($this->course_title as $key=>$value){
            $req = 'required';
            if( $key == 0 && $value == null){
                $req = 'required_with:course_title.'.$key;
            }else{
                $rules['course_title.'.$key] = 'required';
            }
            $rules['precourse.'.$key] = $req;
            $rules['commencement_year.'.$key] = $req;
        }
        foreach($this->employer_name as $key=>$value){
            $req = 'required';
            if( $key == 0 && $value == null){
                $req = 'required_with:employer_name.'.$key;
            }else{
                $rules['employer_name.'.$key] = 'required';
            }
            $rules['from.'.$key] = $req;
            $rules['to.'.$key] = $req;
        }
           
        return $rules;

    }

   
}
