<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacultyRegRequest extends FormRequest
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
        return [
            'faculty_type'=>'required',
            'first_name'=>'required|alpha|max:255',
            'last_name'=>'required|alpha|max:255',
            'gender'=>'required',
            'email_id'=>'required|email|unique:faculties,email_id',
            'address'=>'required',
            'dob'=>'required|date',
            'phone'=>'required|regex:/[0-9]{10}/',
            'photo'=>'mimes:jpeg,bmp,png',
            'e_email'=>'required|email',
            'e_name'=>'required|alpha|max:255',
            'e_phone'=>'required|regex:/[0-9]{10}/',
            'e_rel'=>'required'
        ];
    }
}
