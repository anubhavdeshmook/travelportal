<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    return '<h1>Cache facade value cleared</h1>';
});

Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return '<h1>Storage folder linked</h1>';
});

Route::any('/checkemailormobile', 'HomeController@checkemailormobile');
Route::any('/getpopulardestinations', 'HomeController@getpopulardestinations');
Route::post('/savehotelsessiondata', 'HomeController@savehotelsessiondata');

Route::any('/resetpassword', 'UserController@resetpassword');
Route::get('/password-reset/{token}', 'UserController@getPassword');
Route::post('/password-reset-submit', 'UserController@postPassword')->name('password.change');

Route::post('/send-verification-email', 'UserController@sendverificaitonemail')->name('verification.resend');
Route::get('/verify-email/{token}', 'UserController@verifyemail');

Route::get('/', 'HomeController@index')->name('index');
Route::any('/hotels', 'HomeController@hotelResults');
Route::get('/hotel-detail/{id}', 'HomeController@hotelDetail')->name('hotel-detail');


Route::post('/login-check', 'UserController@checkUserlogin')->name('CheckUserLogin');

Route::get('/userhotelroom/{code}/{rc}', 'HomeController@hotelroom')->name('hotelroom');



\Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/booking-confirm/{id}/{trid}', 'UserController@bookingConfirmation')->name('booking-confirm');
    // Route::post('/booking-confirm/', 'UserController@bookingConfirmation')->name('booking-confirm');
    Route::get('/booking-review', 'UserController@bookingReviewView')->name('view-booking-review');
    Route::get('/booking-confirmed', 'UserController@bookingConfirmView')->name('view-booking-confirm');
    Route::any('/profile', 'UserController@profile');

    Route::any('/my-bookings', 'UserController@myBookings')->name('my-bookings');
    
    Route::any('/change-password', 'UserController@changePassword');
    
    Route::any('/booking/{id}/view', 'UserController@bookingView')->name('booking.view');
    
    Route::get('/userhotelDetail/{code}', 'HomeController@hotelDetailwithuser')->name('hotelDetailwithUser');
});

//        stripe
// Route::get('stripeCard', 'StripePaymentController@stripe');
Route::post('stripe/{code}', 'StripePaymentController@stripePost')->name('stripe.post');
Route::get('success', 'StripePaymentController@successTransaction')->name('success');
Route::post('cancel', 'StripePaymentController@cancelTransaction')->name('cancel');




Route::any('/logout', 'UserController@logout')->name('logout');


Route::any('/logout', 'UserController@logout')->name('logout');

/////   Footer Content
Route::view('about_','extras.about');
Route::view('services_','extras.services');
Route::view('client_','extras.clients');
Route::view('contact_','extras.contact');
