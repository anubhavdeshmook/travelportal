<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\EmailController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\DestinationController;
use App\Http\Controllers\Backend\DestinationPageController;
use App\Http\Controllers\Backend\CurrnencyController;
use App\Http\Controllers\Backend\OfferController;
use App\Http\Controllers\Backend\commissionController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\EnquireController;
use App\Http\Controllers\Backend\BookingController;



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

Route::group(['namespace'=>'Backend', 'prefix'=>'admin', 'as'=>'admin.'], function () {
    
    Route::any('/login', [App\Http\Controllers\Backend\LoginController::class, 'index'])->name('login');    

    Route::group(['middleware'=> 'admin'], function () {

        
        Route::get('/dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');
        Route::any('/logout', [App\Http\Controllers\Backend\LoginController::class, 'logout'])->name('logout');
        
        // Email Routes
        Route::get('/email', [EmailController::class, 'index'])->name('email');
        Route::get('/email/{email}/view', [EmailController::class, 'view'])->name('email.view');
        Route::get('/email/create', [EmailController::class,'create'])->name('email.create');
        Route::post('/email/save', [EmailController::class,'save'])->name('email.save');
        Route::get('/email/{email}/edit', [EmailController::class,'edit'])->name('email.edit');
        Route::post('/email/update', [EmailController::class,'update'])->name('email.update');
        Route::get('/email/delete', [EmailController::class,'delete'])->name('email.delete');      
        Route::get('/email/changeStatus', [EmailController::class,'changeStatus'])->name('email.changestatus');
        Route::get('/email/search', [EmailController::class,'search'])->name('email.filter');

        //User Routes
        
        Route::get('/user', [UserController::class, 'index'])->name('user');
        Route::get('/user/{user}/view', [UserController::class, 'view'])->name('user.view');
        Route::get('/user/create', [UserController::class,'create'])->name('user.create');
        Route::post('/user/save', [UserController::class,'save'])->name('user.save');
        Route::get('/user/{user}/edit', [UserController::class,'edit'])->name('user.edit');
        Route::post('/user/update', [UserController::class,'update'])->name('user.update');
        Route::get('/user/delete', [UserController::class,'delete'])->name('user.delete');      
        Route::get('/user/changeStatus', [UserController::class,'changeStatus'])->name('user.changestatus');
        Route::get('/user/search', [UserController::class,'search'])->name('user.filter');

        // Destination Manager
        Route::get('/destination', [DestinationController::class, 'index'])->name('destination');
        Route::get('/destination/{user}/view', [DestinationController::class, 'view'])->name('destination.view');
        Route::get('/destination/create', [DestinationController::class,'create'])->name('destination.create');
        Route::post('/destination/save', [DestinationController::class,'save'])->name('destination.save');
        Route::get('/destination/{user}/edit', [DestinationController::class,'edit'])->name('destination.edit');
        Route::post('/destination/update', [DestinationController::class,'update'])->name('destination.update');
        Route::get('/destination/delete', [DestinationController::class,'delete'])->name('destination.delete');      
        Route::get('/destination/changeStatus', [DestinationController::class,'changeStatus'])->name('destination.changestatus');
        Route::get('/destination/search', [DestinationController::class,'search'])->name('destination.filter');

       //Destination Page
       Route::get('/destination/page', [DestinationPageController::class, 'index'])->name('destination.page');
       Route::get('/destination/page/{user}/view', [DestinationPageController::class, 'view'])->name('destination.page.view');
       Route::get('/destination/page/create', [DestinationPageController::class,'create'])->name('destination.page.create');
       Route::post('/destination/page/save', [DestinationPageController::class,'save'])->name('destination.page.save');
       Route::get('/destination/page/{user}/edit', [DestinationPageController::class,'edit'])->name('destination.page.edit');
       Route::post('/destination/page/update', [DestinationPageController::class,'update'])->name('destination.page.update');
       Route::get('/destination/page/delete', [DestinationPageController::class,'delete'])->name('destination.page.delete');      
       Route::get('/destination/page/changeStatus', [DestinationPageController::class,'changeStatus'])->name('destination.page.changestatus');
       Route::get('/destination/page/search', [DestinationPageController::class,'search'])->name('destination.page.filter');
 
       //Destination Images 

       Route::post('/destination/images/update', [DestinationPageController::class,'imagesupdate'])->name('destination.images.update');
       Route::get('/destination/images/delete', [DestinationPageController::class,'imagesdelete'])->name('destination.image.delete');
       
        //Currency Manager
        Route::get('/currency', [CurrnencyController::class, 'index'])->name('currency');
        Route::get('/currency/{user}/view', [CurrnencyController::class, 'view'])->name('currency.view');
        Route::get('/currency/create', [CurrnencyController::class,'create'])->name('currency.create');
        Route::post('/currency/save', [CurrnencyController::class,'save'])->name('currency.save');
        Route::get('/currency/{id}/edit', [CurrnencyController::class,'edit'])->name('currency.edit');
        Route::post('/currency/update', [CurrnencyController::class,'update'])->name('currency.update');
        Route::get('/currency/delete', [CurrnencyController::class,'delete'])->name('currency.delete');      
        Route::get('/currency/changeStatus', [CurrnencyController::class,'changeStatus'])->name('currency.changestatus');
        Route::get('/currency/search', [CurrnencyController::class,'search'])->name('currency.filter');

        //Offers
        Route::get('/offers', [OfferController::class, 'index'])->name('offers');
        Route::get('/offers/{user}/view', [OfferController::class, 'view'])->name('offers.view');
        Route::get('/offers/create', [OfferController::class,'create'])->name('offers.create');
        Route::post('/offers/save', [OfferController::class,'save'])->name('offers.save');
        Route::get('/offers/{id}/edit', [OfferController::class,'edit'])->name('offers.edit');
        Route::post('/offers/update', [OfferController::class,'update'])->name('offers.update');
        Route::get('/offers/delete', [OfferController::class,'delete'])->name('offers.delete');      
        Route::get('/offers/changeStatus', [OfferController::class,'changeStatus'])->name('offers.changestatus');
        Route::get('/offers/search', [OfferController::class,'search'])->name('offers.filter');

        //commission Manager
        Route::get('/commission', [commissionController::class, 'index'])->name('commission');
        Route::get('/commission/{user}/view', [commissionController::class, 'view'])->name('commission.view');
        Route::get('/commission/create', [commissionController::class,'create'])->name('commission.create');
        Route::post('/commission/save', [commissionController::class,'save'])->name('commission.save');
        Route::get('/commission/{id}/edit', [commissionController::class,'edit'])->name('commission.edit');
        Route::post('/commission/update', [commissionController::class,'update'])->name('commission.update');
        Route::get('/commission/delete', [commissionController::class,'delete'])->name('commission.delete');      
        Route::get('/commission/changeStatus', [commissionController::class,'changeStatus'])->name('commission.changestatus');
        Route::get('/commission/search', [commissionController::class,'search'])->name('commission.filter');

        //tedtimonials 

        Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials');
        Route::get('/testimonials/{user}/view', [TestimonialController::class, 'view'])->name('testimonials.view');
        Route::get('/testimonials/create', [TestimonialController::class,'create'])->name('testimonials.create');
        Route::post('/testimonials/save', [TestimonialController::class,'save'])->name('testimonials.save');
        Route::get('/testimonials/{id}/edit', [TestimonialController::class,'edit'])->name('testimonials.edit');
        Route::post('/testimonials/update', [TestimonialController::class,'update'])->name('testimonials.update');
        Route::get('/testimonials/delete', [TestimonialController::class,'delete'])->name('testimonials.delete');      
        Route::get('/testimonials/changeStatus', [TestimonialController::class,'changeStatus'])->name('testimonials.changestatus');
        Route::get('/testimonials/search', [TestimonialController::class,'search'])->name('testimonials.filter');
        Route::post('/testinonal-sortable', [TestimonialController::class,'shortupdate'])->name('testimonials.sortable');
        
//enquire
        Route::get('/enquries', [EnquireController::class, 'index'])->name('enquries');
        Route::get('/enquries/{user}/view', [EnquireController::class, 'view'])->name('enquries.view');
        Route::get('/enquries/create', [EnquireController::class,'create'])->name('enquries.create');
        Route::post('/enquries/save', [EnquireController::class,'save'])->name('enquries.save');
        Route::get('/enquries/{id}/edit', [EnquireController::class,'edit'])->name('enquries.edit');
        Route::post('/enquries/update', [EnquireController::class,'update'])->name('enquries.update');
        Route::get('/enquries/delete', [EnquireController::class,'delete'])->name('enquries.delete');      
        Route::get('/enquries/changeStatus', [EnquireController::class,'changeStatus'])->name('enquries.changestatus');
        Route::get('/enquries/search', [EnquireController::class,'search'])->name('enquries.filter');
        
//booking
        Route::get('/booking', [BookingController::class, 'index'])->name('booking');
        Route::get('/booking/{user}/view', [BookingController::class, 'view'])->name('booking.view');
        // Route::get('/destination/search', [DestinationController::class,'search'])->name('destination.filter');
        Route::get('/booking/search', [BookingController::class,'search'])->name('booking.filter');



    });
});
