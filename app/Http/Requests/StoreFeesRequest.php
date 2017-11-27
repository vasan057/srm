<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeesRequest extends FormRequest
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
         'institution' => 'required',
            'coursename' => 'required',
            'totalfees' => 'required|numeric',
            'paidto' => 'required',
            'amountpaid' => 'required|numeric',
            'paidby' => 'required'
           
        ];
    }
    public function attributes()
    {
        return
        [
         'institution' => 'institution name',
            'coursename' => 'course name',
            'totalfees' => 'total fees',
            'paidto' => 'paid to',
            'amountpaid' => 'amount paid',
            'paidby' => 'paid by'
           
        ];
    }
}
