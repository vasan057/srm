<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceTemplateRequest extends FormRequest
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
            'invoice_description' => 'required',
            'street_name' => 'required',
            'suburb' => 'required',
            'state' => 'required',
            'post_code' => 'required',
            'phone' => 'regex:/[0-9]{10}/',
            'fax' => 'nullable|regex:/^\+?[0-9]{7,}$/',
            'ac_name' => 'required',
            'bank_name' => 'required',
            'bsb_name' => 'required',
            'ac_number' => 'required',
        ];
    }
}
