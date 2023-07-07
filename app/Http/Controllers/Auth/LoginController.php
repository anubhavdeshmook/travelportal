<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
    }




//You are not authorized to access this section.
//Email & Password are incorrect.

    public function login(Request $request)
    {
      
        $inputVal = $request->all();
        
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required',
            ]);
       
            if (Auth::guard('web')->attempt(['email' => $inputVal['email'], 'password' => $inputVal['password']])) {
                
                $user = \Auth::user();
                $user = $user->toArray();
                
                $status = true;
                $title = "Success";
                $message = "Login successfully.";      
                $data = $user; 
            
            } else {
                $status = false;
                $title = "Failed";
                $message = "Email & Password are incorrect.";
                $data = [];
            }
        } catch (\Exception $e) {
            $status = false;
            $title = "Failed";
            $message = $e->getMessage();
            $data = [];
        }

        return response()->json(['status'=>$status,'title'=>$title,'message'=>$message,'data'=>$data]);

        
    }

}
