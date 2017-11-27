<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstitutionUpdateRequest extends FormRequest
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
            'name' => 'required|alpha',
            'state' => 'required',
            'lof_duration' => 'required|numeric',
            'lof_remainer' => 'required|numeric',
            'coe_duration' => 'required|numeric',
            'coe_remainder' => 'required|numeric',
            'invoice_date' => 'required|numeric',
            'invoice_remainder' => 'required|numeric',
            'address' => 'required',
            'email' => 'required|email|unique:institutions,email_id,'.$this->institution.',id',
            // 'website' => 'url',
            'phone' => 'required|regex:/[0-9]{10}/',
            'fax_no' => 'required|regex:/^\+?[0-9]{7,}$/',
            'ielts_listening' => 'required|numeric|max:9.9',
            'ielts_reading' => 'required|numeric|max:9.9',
            'ielts_writing' => 'required|numeric|max:9.9',
            'ielts_speaking' => 'required|numeric|max:9.9',
            'ielts_overall' => 'required|numeric|max:9.9',
            'pte_listening' => 'required|numeric|max:9.9',
            'pte_reading' => 'required|numeric|max:9.9',
            'pte_writing' => 'required|numeric|max:9.9',
            'pte_speaking' => 'required|numeric|max:9.9',
            'pte_overall' => 'required|numeric|max:9.9'
        ];
    }
}
