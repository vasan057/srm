<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('emails', function($attribute, $value, $parameters, $validator) {
            $value = str_replace(' ','',$value);
            $array = explode(',', $value);
            foreach($array as $email) //loop over values
            {
                $email_to_validate['email'][]=$email;
            }
            $rules = array('email.*'=>'email');
            $messages = array(
                 'email.*'=>trans('validation.emails')
            );
            $validator = Validator::make($email_to_validate,$rules,$messages);
            if ($validator->passes()) {
                return true;
            } else {
                return false;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
