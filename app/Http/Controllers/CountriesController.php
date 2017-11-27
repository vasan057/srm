<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Model\Country;
use Validator;
class CountriesController extends Controller
{
	/*Manage Countries*/
    public function managecountries()
    {
    	$getCountrys = Country::paginate(10);
    	$data = [
    				'countries' => $getCountrys
    			];
    	return view('countries.managecountries',$data);
    }
    /*Edit Countries*/
    public function editcountries(Request $request,$edit_id)
    {
    	$fetch_country = Country::where('id',$edit_id)->first();
    	/*After Submit Update Query*/
    	if(Input::has('submit')){
    		$inputArr    		 = $request->only('country_code','country_name','edit_id');
    		$update_date = [
    						'country_code' => $inputArr['country_code'],
    						'country_name' => $inputArr['country_name']
    				    ];
    		$validate = Validator::make($request->all(),[
		            'country_code' => 'required|unique:countries,country_code,'.$edit_id,
		            'country_name' => 'required'
		        ])->validate();
                $update = Country::where('id',$edit_id)->update($update_date);
                if($update){
                	return redirect('manage-countries')->with('success','Successfully updated');
                }
    	}

    	$data = [
    				'edit_id' 		=> $edit_id,
    				'fetch_country' => $fetch_country
    			];
    	return view('countries.editcountries',$data);
    }
}
