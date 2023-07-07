<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Auth;

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
    public function __construct()
    {
        //$this->middleware('admin');
        //$this->middleware('guest:admin')->except('logout');

    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            //dd($request->all());
            try {

                $validatedData = $request->validate([
                    'email'   => 'required|email',
                    'password' => 'required|min:6'
                ]);

                if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    return redirect('/admin/dashboard');

                }else{
                    \Session::flash('admin-login-error', 'Invalid credentials.');
                     return redirect('/admin/login');
                }

            } catch (\Exception $e) {
                \Session::flash('admin-login-error', $e->getMessage());
                 return redirect('/admin/login');

            }

        }else{

            if(Auth::guard('admin')->check())
            {
                return redirect('/admin/dashboard');
            }
            return view('backend/auth/login');
        }
        
    }

    public function login(Request $request)
    {
        $inputVal = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
   
        if (auth()->attempt(array('email' => $inputVal['email'], 'password' => $inputVal['password']))) {
            if ($inputVal["role"] == "admin") {
                if (auth()->user()->is_admin == 1) {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('admin/login')
                        ->with('error', 'You are not authorized to access this section.');
                }
            } else {
                return redirect()->route('/');
            }
        } else {
            if ($inputVal["role"] == "admin") {
                return redirect()->route('admin.login')
                    ->with('error', 'Email & Password are incorrect.');
            } else {
                return redirect()->route('login')
                    ->with('error', 'Email & Password are incorrect.');
            }
        }
    }

    public function logout(Request $request){
        \Session::flash('admin-logout', "Logout successfully.");
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}




