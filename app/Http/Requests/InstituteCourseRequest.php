<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstituteCourseRequest extends FormRequest
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
            'course_type' => 'required',
            'course_name' => 'required',
            'course_duration' => 'required|numeric',
            'campus' => 'required'
        ];
    }

    public function attributes(){
        return [
        'course_type' => 'Degree',
        ];
    }
}
