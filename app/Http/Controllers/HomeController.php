<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\User;
use App\Models\DestinationPage;
use App\Models\Destination;
use App\Models\SearchResults;
use App\Models\Offer;
use App\Models\Amenities;
use App\Support\Collection;
use File;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $popularPlaces = DestinationPage::where(['status' => 1, 'popular' => 1])
            ->with(['Country' => function ($q) {
                $q->orderBy('name');
            }])->take(8)->get();

        $bookingPopularPlaces = Destination::where(['status' => 1, 'is_popular' => 1])
            ->with(['Country' => function ($q) {
                $q->orderBy('name');
            }])->select('name')->take(10)->get();

        $bookingPopularPlacesArr = [];
        if (!empty($bookingPopularPlaces) && count($bookingPopularPlaces) > 0) {
            foreach ($bookingPopularPlaces as $key => $value) {
                $bookingPopularPlacesArr[] = $value['name'];
            }
        }

        $bookingPopularPlaces =  $bookingPopularPlacesArr;


        $latestOffers = Offer::where(['status' => 1])->orderBy('amount', 'DESC')->get();


        return view('index', ['popular_places' => $popularPlaces, 'booking_popular_places' => $bookingPopularPlaces, 'latest_offer' => $latestOffers]);
    }

    public function checkemailormobile(Request $request)
    {
        if ($request->has('field') && $request->has('mobile') && $request->field != '' && $request->mobile != '' &&  $request->field == 'mobile'  &&  User::where('mobile', $request->mobile)->count() > 0) {
            echo true;
            die;
        } else if ($request->has('field') && $request->has('email') &&  $request->field != '' && $request->email != '' && $request->field == 'email'  &&  User::where('email', $request->email)->count() > 0) {
            echo true;
            die;
        } else {
            echo false;
            die;
        }
    }

    public function getpopulardestinations(Request $request)
    {
        try {
            if ($request->search_term != '') {


            }

            if ($request->search_term != '') {
                $bookingPopularPlaces = Destination::where(['status' => 1])->where('name', 'like', '%' . $request->search_term . '%')->orderBy('name')->select('name')->get();
            } else if ($request->search_term == 'all') {
                $bookingPopularPlaces = Destination::where(['status' => 1])->orderBy('name')->select('name')->get();
            } else {
                $bookingPopularPlaces = Destination::where(['status' => 1, 'is_popular' => 1])->orderBy('name')->select('name')->get();
            }

            $bookingPopularPlacesArr = [];
            if (!empty($bookingPopularPlaces) && count($bookingPopularPlaces) > 0) {
                foreach ($bookingPopularPlaces as $key => $value) {
                    $bookingPopularPlacesArr[] = $value['name'];
                }

                $status = true;
                $message = "Search destinations";
                $data = $bookingPopularPlacesArr;

                $bookingPopularPlaces =  $bookingPopularPlacesArr;
            } else {
                $status = false;
                $message = "No destinations found";
                $data = [];
            }
        } catch (\Exception $e) {
            $message = $e->getMessage();
            $status = false;
            $data = [];
        }

        return response()->json([
            'message' => $message,
            'status' => $status,
            'data' => $data
        ]);
    }

    public function hotelResults(Request $request)
    {

        $destination = trim($request->get('hotel_search_destination'));
        $checkIn = trim($request->get('checkIn'));
        $checkOut = trim($request->get('checkOut'));
        $guests = trim($request->get('guests'));
        $rooms = trim($request->get('room'));
        $request->session()->put('checkin',$checkIn);
        $request->session()->put('checkout',$checkOut);
        //$request->session()->forget('hotel_session_detail');
        $amenities = Amenities::where(['status' => 1])->pluck('name', 'id');
        if (!empty($destination) && !empty($checkIn) && !empty($checkOut) && !empty($guests) && !empty($rooms)) {
            $destinationCode = Destination::where(['status' => 1])->where('name', 'like', '%' . $destination . '%')->select('code')->first();

            $checkIn = date('Y-m-d', strtotime($checkIn));
            $checkOut = date('Y-m-d', strtotime($checkOut));



            $check_result_exist = SearchResults::select('id','created_at')
                ->where([
                    ['destination', '=', $destination],
                    ['destination_code', '=', $destinationCode->code],
                    ['check_in_date', '=', $checkIn],
                    ['check_out_date', '=', $checkOut],
                    ['rooms', '=', $rooms],
                    ['guests', '=', $guests]
                ])->first();

                if(!empty($check_result_exist)){
                    $created_at_date = $check_result_exist->created_at->format('m-d-Y');
                    $current_date = date('m-d-Y');
                if($created_at_date != $current_date){
                    $check_result_exist="";
                }
            }

            if (!empty($check_result_exist) && File::exists(public_path('hotel_beds/' . $check_result_exist->id . ".json"))) {
                $jsonString = file_get_contents(public_path() . "/hotel_beds/" . $check_result_exist->id . ".json");
                $paging_data = json_decode($jsonString);

            } else {
                $apiKey = config('app.hotel_beds_api_key');
                $sharedSecret = config('app.hotel_beds_secret_key');
                $apiUrl = config('app.hote_bed_api_url_testing');

                $signature = hash("sha256", $apiKey . $sharedSecret . time());
                $mainSearchObj =  [];
                $stayObj = [];
                $stayObj['checkIn'] = $checkIn;
                $stayObj['checkOut'] = $checkOut;
                $stayObj['shiftDays'] = '2';
                $stayObj['currency'] = 'USD';
                $mainSearchObj['stay'] = $stayObj;

                $occupanciesObj = [];
                $innerOccupaniesArr = [];
                $innerOccupaniesArr['rooms'] = $rooms;
                $innerOccupaniesArr['adults'] = $guests;
                $innerOccupaniesArr['children'] = 0;

                $occupanciesObj[] = $innerOccupaniesArr;
                $mainSearchObj['occupancies'] = $occupanciesObj;

                $destinationObj = [];
                $destinationObj['code'] = (isset($destinationCode->code) && !empty($destinationCode->code)) ? $destinationCode->code : ((isset($request->hotel_search_destination) && !empty($request->hotel_search_destination)) ? $request->hotel_search_destination : '');
                //$destinationObj['zone'] = 1;
                $mainSearchObj['destination'] = $destinationObj;


                $filterObj = [];
                if ($request->has('min_price') && $request->get('min_price') != '') {
                    $filterObj['minRate'] = $request->get('min_price');
                }
                if ($request->has('max_price') && $request->get('max_price') != '') {
                    $filterObj['maxRate'] = $request->get('max_price');
                }

                if ($request->has('user_rating') && $request->get('user_rating') != '') {
                    $user_rating = $request->get('user_rating');


                    $min = min($user_rating);
                    //$max = max($user_rating);

                    $reviewInnerObj['minRate'] = $min;
                    $reviewInnerObj['maxRate'] = 5;
                    $reviewInnerObj['type'] = "HOTELBEDS";

                    $innrArr[] = $reviewInnerObj;

                    $filterObj['reviews'] = $innrArr;
                }

                /*
                "reviews": [{
                    "type": "HOTELBEDS",
                    "maxRate": 5,
                    "minRate": 5,
                    "minReviewCount": 5
                }],
                */




                if ($request->has('star_category') && $request->get('star_category') != '') {
                    $star_category = $request->get('star_category');


                    $min = min($star_category);
                    $max = max($star_category);

                    $filterObj['minCategory'] = $min;
                    $filterObj['maxCategory'] = $max;
                }
                /*
                    "minCategory": 4,
		            "maxCategory": 5,
                */
                // dd($signature);
                if (!empty($filterObj)) {
                    $mainSearchObj['filter'] = $filterObj;
                }

                $postData = json_encode($mainSearchObj);

                $curl = curl_init();
                // dd($postData);
                // dd($signature);
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.test.hotelbeds.com/hotel-api/1.0/hotels',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => $postData,
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
                $decodeData = json_decode($response);
                // dd($decodeData);
                // echo "<pre>";print_r($decodeData);die;

                $paging_data = [];
                if (isset($decodeData->hotels->hotels) && !empty($decodeData->hotels->hotels)) {
                    $paging_data = $decodeData->hotels->hotels;

                    foreach ($paging_data as $key => $hotel) {
                        $paging_data[$key]->hotel_image = 'images/no-img.jpeg';
                        if (isset($hotel->code) && !empty($hotel->code)) {
                            $curl2 = curl_init();
                            curl_setopt_array($curl2, array(
                                CURLOPT_URL => 'https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels/' . $hotel->code . '/details',
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => '',
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => 'GET',
                                //CURLOPT_POSTFIELDS =>$postData,
                                CURLOPT_HTTPHEADER => array(
                                    'Api-key:' . $apiKey,
                                    'X-Signature:' . $signature,
                                    'Accept: application/json',
                                    'Accept-Encoding: gzip',
                                    'Content-Type: application/json'
                                ),
                            ));

                            $response2 = curl_exec($curl2);
                            curl_close($curl2);

                            $hotel_detail = json_decode($response2);

                            if (isset($hotel->categoryName) && !empty($hotel->categoryName)) {
                                $paging_data[$key]->star_counter = getRatingCount($hotel->categoryName);
                            } else {
                                $paging_data[$key]->star_counter = 0;
                            }

                            if (isset($hotel_detail->hotel) && !empty($hotel_detail->hotel)) {
                                $paging_data[$key]->hotel_detail = $hotel_detail->hotel;

                                if (isset($hotel_detail->hotel->images) && !empty($hotel_detail->hotel->images)) {
                                    $paging_data[$key]->hotel_image = 'http://photos.hotelbeds.com/giata/' . $hotel_detail->hotel->images[0]->path;
                                }
                            } else {
                                $paging_data[$key]->hotel_detail = [];
                            }
                        } else {
                            $paging_data[$key]->hotel_detail = [];
                        }
                    }



                    // save search result with json file
                    $search_results = new SearchResults();
                    $search_results->destination = $destination;
                    $search_results->destination_code = $destinationCode->code;
                    $search_results->check_in_date = $checkIn;
                    $search_results->check_out_date = $checkOut;
                    $search_results->rooms = $rooms;
                    $search_results->guests = $guests;
                    $search_results->save();

                    $requestGUID = $search_results->id;
                    // put response in json file
                    if (!File::exists(public_path('hotel_beds/' . $requestGUID . ".json"))) {
                        //$newJsonString = json_encode($response);
                        $newJsonString = json_encode($paging_data, JSON_PRETTY_PRINT);
                        file_put_contents(public_path('hotel_beds/' . $requestGUID . '.json'), ($newJsonString));
                        //stripslashes
                    }
                }
            }

            $collection = new Collection($paging_data);

            if (!empty($collection)) {
                if ($request->has('type') && $request->has('order') && in_array($request->get('type'), ['hotel', 'location', 'rating', 'price']) && in_array($request->get('order'), ['asc', 'desc'])) {
                    if ($request->get('type') == 'hotel') {
                        if ($request->get('order') == 'desc') {
                            $collection = $collection->sortByDesc('name');
                        } else {
                            $collection = $collection->sortBy('name');
                        }
                    } else if ($request->get('type') == 'rating') {
                        if ($request->get('order') == 'desc') {
                            $collection = $collection->sortByDesc('star_counter');
                        } else {
                            $collection = $collection->sortBy('star_counter');
                        }
                    } else if ($request->get('type') == 'price') {
                        if ($request->get('order') == 'desc') {
                            $collection = $collection->sortByDesc('minRate');
                        } else {
                            $collection = $collection->sortBy('minRate');
                        }
                    }
                } else {
                    $collection = $collection->sortBy('name');
                }
            }

            $paging_data = $collection->paginate(10);

            return view('hotels.index', ['paging_data' => $paging_data, 'amenities' => $amenities]);
        } else {
            return redirect('/');
        }
    }

    public function savehotelsessiondata(Request $request)
    {
        //dd($request->get('hotel_session_data'));
        $request->session()->forget('hotel_session_detail');
        $request->session()->put('hotel_session_detail', $request->get('hotel_session_data'));
        $hotel_detail = $request->session()->get('hotel_session_detail');
        $decoded_data = json_decode($hotel_detail);

        //echo '<pre>';
        //print_r($decoded_data->code);die;
        return \Response::json(['hotel_id' => $decoded_data->code], 200);
    }

    public function hotelDetail(Request $request, $id)
    {

        $hotel_session_data = $request->session()->get('hotel_session_detail');
        $hotel_previous_page_data = json_decode($hotel_session_data);

        //echo '<pre>';
        // echo "<pre>";
        // print_r($hotel_previous_page_data);die;
        // $apiKey = '9ca5adce58604afb450de6904c1777ad';
        // $sharedSecret = 'a2678d86c3';
        $apiKey = env('HOTEL_BEDS_API_KEY');
        $sharedSecret = env('HOTEL_BEDS_SECRET_KEY');
        $apiUrl = config('app.hote_bed_api_url_testing');

        $signature = hash("sha256", $apiKey . $sharedSecret . time());
        // echo $signature;die;
        $minRateKey = '';


        if (!empty($hotel_previous_page_data)) {
            foreach ($hotel_previous_page_data->rooms as $key => $value) {
                foreach ($value->rates as $key1 => $value1) {
                    if (!empty($value1) && !empty($value1->net) == $hotel_previous_page_data->minRate) {
                        $minRateKey = $value1->rateKey;
                    }
                }
            }
        }


        if (!empty($id) && !empty($id)) {
            $curl2 = curl_init();
            curl_setopt_array($curl2, array(
                CURLOPT_URL => 'https://api.test.hotelbeds.com/hotel-content-api/1.0/hotels/' . $id . '/details',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                //CURLOPT_POSTFIELDS =>$postData,
                CURLOPT_HTTPHEADER => array(
                    'Api-key:' . $apiKey,
                    'X-Signature:' . $signature,
                    'Accept: application/json',
                    'Accept-Encoding: gzip',
                    'Content-Type: application/json'
                ),
            ));

            $response2 = curl_exec($curl2);


            curl_close($curl2);
            //echo  $response2;die;


            $hotel_detail = json_decode($response2);

            //echo '<pre>';
            //print_r($hotel_detail);die;

            if (isset($hotel_detail->hotel) && !empty($hotel_detail->hotel)) {
                $hotel_detail_arr = $hotel_detail->hotel;
            } else {
                $hotel_detail_arr = [];
            }

            //echo json_encode($hotel_previous_page_data);
            //echo '<pre>';
            //print_r($hotel_detail_arr);

            //echo '<br>';
            //print_r($hotel_previous_page_data);die;

            return view('hotels.detail', ['hotel_detail_arr' => $hotel_detail_arr, 'hotel_previous_page_data' => $hotel_previous_page_data, 'minRateKey' => $minRateKey]);
        } else {
            return redirect('/');
        }
    }




    /////
    public function hotelDetailwithuser(Request $request,$id)
    {

        $checkin = $request->session()->get('checkin');
        $checkout = $request->session()->get('checkout');
        $checkin = date('Y-m-d',strtotime($checkin));
        $checkout = date('Y-m-d',strtotime($checkout));
        $hotelsdata = SearchResults::where([['check_in_date', '=', $checkin],['check_out_date','=',$checkout]])->get()->first();

        $hotel_session_data = $request->session()->get('hotel_session_detail');
        $hotel_previous_page_data = json_decode($hotel_session_data);

        // echo "<pre>";
        // print_r(json_decode($hotel_session_data));die;
        //echo '<pre>';

        // $apiKey = '9ca5adce58604afb450de6904c1777ad';
        // $sharedSecret = 'a2678d86c3';
        $apiKey = env('HOTEL_BEDS_API_KEY');
        $sharedSecret = env('HOTEL_BEDS_SECRET_KEY');
        $apiUrl = config('app.hote_bed_api_url_testing');

        $signature = hash("sha256", $apiKey . $sharedSecret . time());
        $minRateKey = '';

        // echo "<pre>";
        // print_r($hotel_previous_page_data);die;
        if (!empty($hotel_previous_page_data)) {
            foreach ($hotel_previous_page_data->rooms as $key => $value) {
                foreach ($value->rates as $key1 => $value1) {
                    if (!empty($value1) && !empty($value1->net) == $hotel_previous_page_data->minRate) {
                        $minRateKey = $value1->rateKey;
                    }
                }
            }
        }


        $loginUserData = User::where('id',Auth::id())->select('email','mobile')->get();


        return view('bookings.booking-review', compact('hotel_previous_page_data','hotelsdata','loginUserData'));

            // return view('hotels.detail', ['hotel_detail_arr' => $hotel_detail_arr, 'hotel_previous_page_data' => $hotel_previous_page_data, 'minRateKey' => $minRateKey]);

    }

    public function hotelroom(Request $request,$id,$rc)
    {
        $checkin = $request->session()->get('checkin');
        $checkout = $request->session()->get('checkout');
        $checkin = date('Y-m-d',strtotime($checkin));
        $checkout = date('Y-m-d',strtotime($checkout));
        $hotelsdata = SearchResults::where([['check_in_date', '=', $checkin],['check_out_date','=',$checkout]])->get()->first();

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

        if (!empty($hotel_previous_page_data)) {
            foreach ($hotel_previous_page_data->rooms as $key => $value) {
                if($value->code==$rc){
                    $get_zerokeyararray = $hotel_previous_page_data->rooms[0];
                    $hotel_previous_page_data->rooms[0] = $value;
                    $hotel_previous_page_data->rooms[1] = $get_zerokeyararray;
                    // $minRateKey = $value->rates[0]->rateKey;
                    $minRateKey = isset($value->rates[0]->rateKey)? $value->rates[0]->rateKey:$value->rates[0]->shiftRates[0]->rateKey;
                }
            }
        }
        // echo $minRateKey;die;
        $encodeagainsession = json_encode($hotel_previous_page_data);
        $request->session()->put('hotel_session_detail', $encodeagainsession);
        $hotel_session_data = $request->session()->get('hotel_session_detail');

        $hotel_previous_page_data = json_decode($hotel_session_data);
        // echo "<pre>";
        // print_r($hotel_previous_page_data);die;

        $loginUserData = User::where('id',Auth::id())->select('email','mobile')->get();


        return view('bookings.booking-review', compact('hotel_previous_page_data','hotelsdata','loginUserData'));

            // return view('hotels.detail', ['hotel_detail_arr' => $hotel_detail_arr, 'hotel_previous_page_data' => $hotel_previous_page_data, 'minRateKey' => $minRateKey]);
    }
}



