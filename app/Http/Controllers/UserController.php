<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use App\Mail\ManuMailer;
use App\Mail\SendMail;
use DB;
use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Guestdetails;
use App\Models\SearchResults;
use App\Support\Collection;


class UserController extends Controller
{
    /**
     * Render the user profile page.
     */
    public function profile(Request $request)
    {
        if (auth()->user()) {
            if ($request->isMethod('post')) {
                try {
                    $this->validate($request, [
                        'email' => 'required|email',
                        'name' => 'required|min:3|max:50',
                        'mobile' => 'required|min:10|max:10',
                        'address' => 'required|min:3|max:150',
                        'city' => 'required|min:3|max:50',
                        'postcode' => 'required|min:5|max:15',
                    ]);


                    $dob = Null;
                    if (isset($request->dob) && !empty($request->dob)) {
                        $dob = date("Y-m-d", strtotime($request->dob));
                    }
                    if (User::where('id', auth()->user()->id)->update([
                        'name' => $request->name,
                        'mobile' => $request->mobile,
                        'address' => $request->address,
                        'city' => $request->city,
                        'postcode' => $request->postcode,
                        'subscribe_news_letter' => ((isset($request->subscribe_news_letter) && $request->subscribe_news_letter == 1) ? $request->subscribe_news_letter : 0),
                        'dob' => $dob
                    ])) {
                        \Session::flash('alert-success', 'Profile updated successfully.');
                        return \Redirect::back();
                    } else {
                        \Session::flash('alert-danger', 'Error Processing Request.');
                        return \Redirect::back();
                    }
                } catch (\Exception $e) {
                    \Session::flash('alert-danger', $e->getMessage());
                    return \Redirect::back();
                }
            } else {

                if (empty(auth()->user()->email_verified_at)) {
                    return view('auth.verify');
                } else {
                    return view('user.profile');
                }
            }
        } else {
            redirect('/logout');
        }
    }

    /**
     * Show all the bookings of a user.
     */
    public function myBookings()
    {
        $request = request()->query();
        // dd($request);
        $apiKey = '53ff4a90712d67752c06eb55c5d7f28a';
        $sharedSecret = '873b4e732c';
        $apiUrl = config('app.hote_bed_api_url_testing');
        $signature = hash("sha256", $apiKey . $sharedSecret . time());

        if (!empty($request['booking_date_from']) && !empty($request['booking_date_to'])) {
            $url = 'https://api.test.hotelbeds.com/hotel-api/1.0/bookings?from=' . '1' . '&to=' . '300' . '&start=' . $request['booking_date_from'] . '&end=' . $request['booking_date_to'] . '&clientReference=' . auth()->user()->name;
        } else if (!empty($request['booking_date_from']) && empty($request['booking_date_to'])) {
            $url = 'https://api.test.hotelbeds.com/hotel-api/1.0/bookings?from=' . '1' . '&to=' . '300' . '&start=' . $request['booking_date_from'] . '&end=' . '2022-08-22' . '&clientReference=' . auth()->user()->name;
        } else if (empty($request['booking_date_from']) && !empty($request['booking_date_to'])) {
            $url = 'https://api.test.hotelbeds.com/hotel-api/1.0/bookings?from=' . '1' . '&to=' . '300' . '&start=' . '2022-03-01' . '&end=' . $request['booking_date_to'] . '&clientReference=' . auth()->user()->name;
        } else {
            $url = 'https://api.test.hotelbeds.com/hotel-api/1.0/bookings?from=' . '1' . '&to=' . '300' . '&start=' . '2022-03-01' . '&end=' . '2022-03-30' . '&clientReference=' . auth()->user()->name;
        }
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            // CURLOPT_POSTFIELDS =>$postdata,
            CURLOPT_HTTPHEADER => array(
                'Api-key:' . $apiKey,
                'X-Signature:' . $signature,
                'Accept: application/json',
                'Accept-Encoding: gzip',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $results = json_decode($response, true);

        $userId = Auth::id();
        $user_booking_details = Booking::latest()->where('user_id',$userId)->get();
        return view('user.mybookings', compact('results', 'request','user_booking_details'));
    }

    /**
     * Change user password.
     */
    public function changePassword(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'current_password' => 'required',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required',
            ]);


            $user = Auth::user();

            if (!Hash::check($request->current_password, $user->password)) {

                \Session::flash('alert-danger', 'Old password does not match!');
                return \Redirect::back();
            }

            $user->password = Hash::make($request->password);
            $user->save();

            \Session::flash('alert-success', 'Password successfully changed!');
            return \Redirect::back();
        } else {
            return view('user.change-password');
        }
    }

    public function resetpassword(Request $request)
    {
        if ($request->has('forgot_email') && $request->forgot_email != '' &&  User::where('email', $request->forgot_email)->count() <= 0) {
            return response()->json([
                'message' => "Email address is not registered with us.",
                'status' => false
            ]);
        } else {

            $user = User::where('email', $request->forgot_email)->first();
            $replacement = [];
            $replacement['USER_NAME'] = $user->name;


            //Create Password Reset Token
            DB::table('password_resets')->insert([
                'email' => $request->forgot_email,
                'token' => \Str::random(64),
                'created_at' => Carbon::now()
            ]);

            //Get the token just created above
            $tokenData = DB::table('password_resets')
                ->where('email', $request->forgot_email)->first();

            $token = $tokenData->token;
            $link = \App::make('url')->to('/password-reset') . '/' . $token . '?email=' . urlencode($request->forgot_email);

            $replacement['RESET_PASSWORD_LINK'] = "<a href='" . $link . "' style='color:#1a0dab;'>Reset Link</a>";

            $data = ['to' => $request->forgot_email, 'template' => 'Reset_Password', 'hooksVars' => $replacement];
            \Mail::to($request->forgot_email)->send(new ManuMailer($data));
            if (count(\Mail::failures()) > 0) {
                return response()->json([
                    'message' => "A Network Error occurred. Please try again.",
                    'status' => false
                ]);
            } else {
                return response()->json([
                    'message' => "Reset password link has been sent to your email address.",
                    'status' => true
                ]);
            }
        }
    }

    public function getPassword($token, Request $request)
    {
        $email = '';
        if ($request->has('email')) {
            $email = $request->input('email');
        }
        return view('auth.passwords.reset', ['token' => $token, 'email' => $email]);
    }
    public function postPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',

        ]);

        $updatePassword = DB::table('password_resets')
            ->where(['email' => $request->email, 'token' => $request->token])
            ->first();

        if (!$updatePassword)
            return back()->withInput()->with('error', 'Invalid token!');

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect('/')->with('logout-success', 'Your password has been changed!');
    }

    /**
     * Logout current user.
     */
    public function logout(Request $request)
    {

        \Session::flash('logout-success', 'Logout successfully.');
        \Auth::logout();
        return redirect()->to('/');
    }

    public function sendverificaitonemail(Request $request)
    {
        if ($request->has('verification_email') && $request->verification_email != '' &&  User::where('email', $request->verification_email)->count() <= 0) {
            return response()->json([
                'message' => "Email address is not registered with us.",
                'status' => false
            ]);
        } else {
            $user = User::where('email', $request->verification_email)->first();
            if (!empty($user->email_verified_at)) {
                return response()->json([
                    'message' => "Email already verified.",
                    'status' => false
                ]);
            } else {

                $replacement = [];
                $replacement['USER_NAME'] = $user->name;



                DB::table('password_resets')->where('email', $request->verification_email)->delete();

                //Create Password Reset Token
                DB::table('password_resets')->insert([
                    'email' => $request->verification_email,
                    'token' => \Str::random(64),
                    'created_at' => Carbon::now()
                ]);

                //Get the token just created above
                $tokenData = DB::table('password_resets')
                    ->where('email', $request->verification_email)->first();

                $token = $tokenData->token;
                $link = \App::make('url')->to('/verify-email') . '/' . $token . '?email=' . urlencode($request->verification_email);
                $replacement['VERIFICATION_LINK'] = $link;
                $replacement['EMAIL_VERIFICATION_LINK'] = "<a href='" . $link . "' style='color:#1a0dab;'>Email Verification Link</a>";

                $data = ['to' => $request->verification_email, 'template' => 'Email_Verification', 'hooksVars' => $replacement];
                \Mail::to('singh.shubham@dotsquares.com')->send(new ManuMailer($data));
                if (count(\Mail::failures()) > 0) {

                    return redirect()->back()->with('verification-danger', 'A Network Error occurred. Please try again.');
                } else {

                    return redirect()->back()->with('verification-success', 'Email verification link has been sent on email.');
                }
            }
        }
    }

    public function verifyemail($token, Request $request)
    {
        $verifyEmail = DB::table('password_resets')
            ->where(['email' => $request->email, 'token' => $request->token])
            ->first();

        if (!$verifyEmail)
            return redirect('/')->with('alert-danger', 'Invalid token!');

        $user = User::where('email', $request->email)
            ->update(['email_verified_at' => date('Y-m-d H:i:s')]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect('/')->with('logout-success', 'Your account has been verified successfully!');
    }

    /**
     * [bookingConfirmation This is used to confirm the booking]
     * @return [type]
     */
    public function bookingConfirmation(Request $request,$ratekey,$transId)
    {
        // echo $ratekey;die;
        // dd($request->all());
        $apiKey = env('HOTEL_BEDS_API_KEY');
        $sharedSecret = env('HOTEL_BEDS_SECRET_KEY');
        $apiUrl = config('app.hote_bed_api_url_testing');
        $signature = hash("sha256", $apiKey . $sharedSecret . time());
        // echo"<pre>";print_r($signature);die;

        if (!empty($ratekey)) {
            $parts = explode(' ', auth()->user()->name);
            $name_first = array_shift($parts);
            $name_last = array_pop($parts);

            $url = 'https://api.test.hotelbeds.com/hotel-api/1.0/bookings';
            $data = array("holder" => array("name" => $name_first, "surname" => !empty($name_last) ? $name_last : auth()->user()->email), "rooms" => [array("rateKey" => $ratekey)], "clientReference" => auth()->user()->name, "remark" => "Booking Confirmation", "tolerance" => 2);

            $postdata = json_encode($data);
            // dd($signature);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $postdata,
                CURLOPT_HTTPHEADER => array(
                    'Api-key:' . $apiKey,
                    'X-Signature:' . $signature,
                    'Accept: application/json',
                    'Accept-Encoding: gzip',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            //$result = json_decode($response, true);
            $dataSave['user_id'] = auth()->user()->id;
            $dataSave['booking_response'] = $response;
            $dataSave['stripe_trans_id'] = $transId;
            // echo "<pre>";
            // print_R($dataSave);die;
            $bookings = Booking::create($dataSave);
            $decoded_response = json_decode($response);
            $details = [
                'hotelname' => $decoded_response->booking->hotel->name,
                'room' => $decoded_response->booking->hotel->rooms[0]->rates[0]->rooms,
                'type' => $decoded_response->booking->hotel->rooms[0]->name,
                'check_in' => $decoded_response->booking->hotel->checkIn,
                'check_out' => $decoded_response->booking->hotel->checkOut,
                'adults' => $decoded_response->booking->hotel->rooms[0]->rates[0]->adults,
                'childrens' => $decoded_response->booking->hotel->rooms[0]->rates[0]->children,
                'amount' => $decoded_response->booking->hotel->rooms[0]->rates[0]->net,
                'currency' => $decoded_response->booking->currency,
                'subject' => "Booking Confirmation"
            ];
            $loginuseremail = User::where('id',Auth::id())->select('email')->get();
            // $loginuseremail[0]->email
            // print_r(json_decode($response));die;
            // return response()->json(['success' => 1]);
            \Mail::to($loginuseremail[0]->email)->send(new SendMail($details));
            return redirect()->route('view-booking-confirm');
        } else {
            return response()->json(['success' => 0]);
        }
    }

    /**
     * Show the booking Confirmed View.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function bookingReviewView()
    {
        $bookingDetail = Booking::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->first();

        $bookingResponse =  json_decode($bookingDetail->booking_response);

        if (isset($bookingResponse->error)) {
            $message = $bookingResponse->error->message;
            \Session::flash('alert-danger', $message);
            return \Redirect::back();
            // return redirect()->back()->with(['status' => false, 'title' => "Failed", 'message' => $message]);
        } else {
            if ($bookingResponse && $bookingResponse->booking->status != 'CONFIRMED') {
                $bookingResponse =  [];
            }
        }
        // echo "<pre>";print_r($bookingResponse);
        return view('bookings.booking-review', compact('bookingResponse'));
    }

    public function bookingConfirmView()
    {
        $bookingDetail = Booking::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->first();

        $bookingResponse =  json_decode($bookingDetail->booking_response);

        if (isset($bookingResponse->error)) {
            $message = $bookingResponse->error->message;
            \Session::flash('alert-danger', $message);
            return \Redirect::back();
            // return redirect()->back()->with(['status' => false, 'title' => "Failed", 'message' => $message]);
        } else {
            if ($bookingResponse && $bookingResponse->booking->status != 'CONFIRMED') {
                $bookingResponse =  [];
            }
        }

        $guestData = Guestdetails::where('user_id',Auth::id())->orderBy('created_at','desc')->first();
        if(isset($guestData)){
            $guestNames = json_decode($guestData->guest_details);
        }else{
            $guestNames = "";
        }

        return view('bookings.booking-confirmation', compact('bookingResponse','guestNames'));
    }


    public function bookingView(Request $resquest,$id)
    {
        DB::beginTransaction();
        try {
            $bookings = Booking::find($id)->toArray();
            DB::commit();
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            redirect()->route('booking.view')->with("status", $exception->getMessage());
        }
        return view('bookings.booking-detailview', compact('bookings'));
    }
}
