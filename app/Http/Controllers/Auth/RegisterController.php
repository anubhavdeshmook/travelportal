<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use Carbon\Carbon;
use App\Mail\ManuMailer;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],

            //'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $save_status = false;
        $title = "Failed";
        $message = "Something went wrong. Please try again";


        try {
            $user = User::create([
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'gender' => ($data['gender'] == 1) ? 1 : 0,
                'is_admin' => 0,
            ]);
            if (!$user->id) {
                throw new Error("Something went wrong ! Please try again.");
            } else {

                $replacement = [];
                $replacement['USER_NAME'] = $data['name'];


                $save_status = true;
                $title = "Success";
                $message = "You have registered successfully. Verification link has been sent on email address";



                //Create Password Reset Token
                DB::table('password_resets')->insert([
                    'email' => $data['email'],
                    'token' => \Str::random(64),
                    'created_at' => Carbon::now()
                ]);

                //Get the token just created above
                $tokenData = DB::table('password_resets')
                    ->where('email', $data['email'])->first();

                $token = $tokenData->token;
                $link = \App::make('url')->to('/verify-email') . '/' . $token . '?email=' . urlencode($data['email']);

                $replacement['EMAIL_VERIFICATION_LINK'] = "<a href='" . $link . "' style='color:#1a0dab;'>Email Verification Link</a>";

                $data2 = ['to' => $data['email'], 'template' => 'welcome-user', 'hooksVars' => $replacement];
                \Mail::to($data['email'])->send(new ManuMailer($data2));
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        echo json_encode(['status' => $save_status, 'title' => $title, 'message' => $message]);
        die;
    }
}
