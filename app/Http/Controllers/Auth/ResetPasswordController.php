<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Model\Faculty;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
   
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest',['except' => ['getChangePassword', 'postChangePassword']]);
    }

    
    public function resetPassword($token){
        $reset_table = \DB::table('password_resets')->where('token',$token)->first();
        if($reset_table){
            return view('auth.passwords.reset',['token'=>$token,'email'=>$reset_table->email_id]);
        }else{
            abort(404);
        }
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'email_id' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }
    protected function credentials(Request $request)
    {
        return $request->only(
            'email_id', 'password', 'password_confirmation', 'token'
        );
    }
    public function reset(Request $request)
    {
        $this->validate($request, $this->rules(), $this->validationErrorMessages());
        $reset_table = \DB::table('password_resets')->where('token',$request->token)->first();
        $token = $reset_table->token;
        $email = $reset_table->email_id;
        if($token == $request->token && $email == $request->email_id){
            $faculty = \App\Model\Faculty::where('email_id',$email)->first();
            $faculty->password = bcrypt($request->password);
            $faculty->save();
            \DB::table('password_resets')->where('token',$token)->delete();
            \Auth::login($faculty);
            return redirect()->to('faculty');
        }else{
            return back()->with('status','Invalid token');
        }

    }

    public function getChangePassword(){
        return view('auth/passwords.change-password');
    }
    public function postChangePassword(Request $request){
        $user_id = \Auth::user()->id;
        \Validator::make($request->all(),['current_password'=>'required','password'=>'required','password_confirmation'=>'required|same:password'])->validate();
        $current_password   = $request->input('current_password');
        if(\Hash::check($current_password, \Auth::user()->password)){
               $user = Faculty::find($user_id);
               $user->password = bcrypt($request->input('password'));
               $user->save();
              return redirect()->route('home')->with('success','password changed successfully changed'); 
             //  return back()->with('success','password changed successfully changed');
        }else{
            return back()->with('fail','Missmatch current password');
        }
    }


   
  
}
