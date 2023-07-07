<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Booking;
use App\Models\SearchResults;
use App\Models\Guestdetails;
use File;
use Auth;
use Stripe;
use Session;


class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe.stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    public function stripePost(Request $request, $id)
    {

        foreach($request->fn as $key => $guestname){
            $guest_data[] = array('fullname'=>$guestname." ".$request->ln[$key]);
        }
        $request->session()->put("user".Auth::id()."member", json_encode($guest_data));

        // $hotelsdata = SearchResults::latest()->get()->first();
        $hotel_session_data = $request->session()->get('hotel_session_detail');
        $hotel_previous_page_data = json_decode($hotel_session_data);

        $netrate = $hotel_previous_page_data->rooms[0]->rates[0]->net;

        $stripe = new \Stripe\StripeClient(
            'sk_test_51LQ3OxSJcivFFDaSFEV0FcFh16mpC5NEEgzZdOTUKJua2MN2zd81avfAIQnDewwUj8CTlt7uXS14i9WqgcV4J69Q00i8t80RTP'
        );

        $productIdGenerate = $stripe->products->create([
            'name' => $hotel_previous_page_data->name,
        ]);
        $productId = $productIdGenerate->id;
        // print_r($prduct_id->id);die;
        // $price = Price::create([
        //   'unit_amount' => $netreate,
        //   "currency" => $user->currency,
        //   'recurring' => [
        //     'interval' => 'month',
        //   ],
        //   'product' => $product->id,
        //   'tax_behavior' => 'exclusive',
        // ]);
        // echo "Asd";die;
        // $stripe = new \Stripe\StripeClient(
        //     'sk_test_51LQ3OxSJcivFFDaSFEV0FcFh16mpC5NEEgzZdOTUKJua2MN2zd81avfAIQnDewwUj8CTlt7uXS14i9WqgcV4J69Q00i8t80RTP'
        //   );

        $priceIdGenerate = $stripe->prices->create([
            'unit_amount' => ($netrate * 100),
            'currency' => 'usd',
            'product' => $productId,
        ]);
        $priceId = $priceIdGenerate->id;


        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));



        $checkout_session = \Stripe\Checkout\Session::create([
            'customer_email' => $request->usermail,
            'line_items' => [[
                # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
                'price' => $priceId,
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => env('WEBSITE') . 'success'.'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => env('WEBSITE') . 'cancel',
        ]);

        return Redirect::to($checkout_session->url);
    }




    public function successTransaction(Request $request)
    {
        // echo "<pre>";
        // $stripe = new \Stripe\StripeClient(
        //     'sk_test_51LQ3OxSJcivFFDaSFEV0FcFh16mpC5NEEgzZdOTUKJua2MN2zd81avfAIQnDewwUj8CTlt7uXS14i9WqgcV4J69Q00i8t80RTP'
        // );
        // print_R($_GET['session_id']);die;
       $stripe = \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));


        // new \Stripe\setApiKey(env('STRIPE_SECRET'));

$session = \Stripe\Checkout\Session::retrieve($_GET['session_id']);


$customer = \Stripe\Customer::retrieve($session->customer);
$paymentIntent = \Stripe\PaymentIntent::retrieve($session->payment_intent);
$Extrastringremove =  str_replace("Stripe\Checkout\Session JSON:"," ",$session);
$trans_id = json_decode($Extrastringremove)->payment_intent;


        $guestdata = $request->session()->get("user".Auth::id()."member");
        // print_R(json_decode($guestdata)[0]->fullname);die;
        if(json_decode($guestdata)[0]->fullname!=" "){
            Guestdetails::create(array('user_id'=>Auth::id(),'guest_details'=>$guestdata));
            $request->session()->forget("user".Auth::id()."member");
        }
        
        $hotel_session_data = $request->session()->get('hotel_session_detail');
        $hotel_previous_page_data = json_decode($hotel_session_data);

        //echo '<pre>';

        // $apiKey = '9ca5adce58604afb450de6904c1777ad';
        // $sharedSecret = 'a2678d86c3';
        $apiKey = env('HOTEL_BEDS_API_KEY');
        $sharedSecret = env('HOTEL_BEDS_SECRET_KEY');
        $apiUrl = config('app.hote_bed_api_url_testing');

        $signature = hash("sha256", $apiKey . $sharedSecret . time());
        $minRateKey = '';
        // if (!empty($hotel_previous_page_data)) {
        //     foreach ($hotel_previous_page_data->rooms as $key => $value) {
        //         foreach ($value->rates as $key1 => $value1) {
        //             if (!empty($value1) && !empty($value1->net)  && $value1->net == $hotel_previous_page_data->minRate) {
        //                 $minRateKey = $value1->rateKey;
        //             }
        //         }
        //     }
        // }
        // echo "<pre>";
        // print_R($hotel_previous_page_data);die;
        
        $minRateKey = $hotel_previous_page_data->rooms[0]->rates[0]->rateKey;

        return redirect()->route('booking-confirm', [$minRateKey,$trans_id]);
    }

    public function cancelTransaction(Request $request)
    {
        echo "Cancelled";
        die;
    }
}
