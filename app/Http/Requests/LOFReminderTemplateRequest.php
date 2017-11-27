<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LOFReminderTemplateRequest extends FormRequest
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
            'subject'=>'required',
            'name'=>'required',
            'header_text'=>'required',
            'body'=>'required',
            'signature'=>'required',
            'footer_text'=>'required',
            'footer_website_link'=>'required',
            'footer_phone_no'=>'required',
            'building_no'=>'required',
            'street_name'=>'required',
            'suburb'=>'required',
            'state'=>'required',
            'post_code'=>'required',
            'country'=>'required',
        ];
    }
}
