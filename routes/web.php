<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test',function(){ $date= Carbon\Carbon::now()->addDays(30); dd($date); });
Route::get('/logout',function(){
    \Auth::logout();
    return redirect('/');
});
Route::get('auth/reset/{token}','Auth\ResetPasswordController@resetPassword');
Auth::routes();
Route::group(['middleware'=>'auth'],function(){

    Route::get('/home', 'HomeController@index')->name('home');
     // chart data
    Route::post('/chart','ChartController@postIndex');
    Route::get('/change-password','Auth\ResetPasswordController@getChangePassword');
    Route::post('/change-password','Auth\ResetPasswordController@postChangePassword');
    Route::get('faculty/profile','FacultyController@getProfile');
    Route::post('faculty/profile','FacultyController@postProfile');
    Route::get('faculty/editprofile','FacultyController@editProfile');
    Route::post('faculty/editprofile/{id?}','FacultyController@postEditProfile');
    Route::resource('/faculty','FacultyController');
    Route::resource('/faculty-type','FacultyTypeController');
    Route::resource('/institution','InstitutionController');
    Route::resource('/institution-course','InstitutionCourseController');
    Route::get('invoice/download/{id}','InvoiceController@getDownload');
    Route::get('invoice/send/{id}','InvoiceController@getSend');
    Route::resource('/invoice','InvoiceController');
    Route::resource('/reminder','ReminderController');

    Route::get('news-letter','NewsLetterController@getIndex');
    Route::post('news-letter','NewsLetterController@postIndex');
    // All student controllers
    Route::group(['prefix'=>'student'],function(){
        Route::get('/suggest/{id?}','StudentCommonController@getSuggest');
        Route::post('/suggest/{id?}','StudentCommonController@postSuggest');
        Route::get('/fees/{id?}','StudentCommonController@getFees');
        Route::post('/fees/{id?}','StudentCommonController@postFees');
        Route::get('/fees/{id?}/download','StudentCommonController@getDownload');
        Route::post('/search-referral','StudentCommonController@postSearchReferral');
        Route::get('/referral-detail/{id}','StudentCommonController@getReferralDetail');
        Route::post('/referral-detail/{id}','StudentCommonController@postReferralDetail');
        Route::get('/back-to-add/{id}','StudentCommonController@getBackTOAdd');
        Route::resource('/referral','ReferralsController');
        Route::resource('/followup','StudentFollowupController');
        Route::post('/stage/update-institute/{id}','StudentStageController@postUpdateInstitute');
        Route::resource('/stage','StudentStageController');
    });
   
    Route::resource('/student','StudentController');

    // Report controller
    Route::group(['prefix'=>'report'], function(){
        Route::get('/referral','ReportController@getReferral');
    });    

    Route::group(['prefix'=>'common'],function(){
        Route::post('add-referral','CommonController@postAddReferral');
        Route::post('upload-image','CommonController@postUploadImage');
        Route::post('upload-course','CommonController@postUploadCourse');
        Route::get('delete-all/student','StudentController@getDeleteAll');
        Route::get('auto-contact','CommonController@getAutoContact');
    });
    Route::group(['prefix'=>'template'],function(){
        Route::get('invoice','TemplateController@getInvoice');
        Route::post('invoice','TemplateController@postInvoice');
        Route::get('newsletter','TemplateController@getNewsletter');
        Route::post('newsletter','TemplateController@postNewsletter');
        Route::get('invoice-reminder','TemplateController@getInvoiceReminder');
        Route::post('invoice-reminder','TemplateController@postInvoiceReminder');
        Route::get('lof-reminder','TemplateController@getLOFReminder');
        Route::post('lof-reminder','TemplateController@postLOFReminder');
        Route::get('coe-reminder','TemplateController@getCOEReminder');
        Route::post('coe-reminder','TemplateController@postCOEReminder');
        Route::get('welcome-mail','TemplateController@getWelcomeMail');
        Route::post('welcome-mail','TemplateController@postWelcomeMail');
        Route::get('reset-mail','TemplateController@getResetMail');
        Route::post('reset-mail','TemplateController@postResetMail');
    });
    Route::get('/', 'HomeController@index');
});
// Route::get('/faculty-reg',function(){ return view('faculty-reg.index'); }); 

/*Manage countrys*/
Route::any('manage-countries','CountriesController@managecountries');
/*edit countrys*/
Route::any('edit-countries/{id}','CountriesController@editcountries');