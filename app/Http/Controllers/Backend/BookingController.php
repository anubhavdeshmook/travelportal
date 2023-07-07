<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {  
        DB::beginTransaction();
        try {

            $bookings = Booking::sortable()->latest()->paginate(config('app.limit'))->withQueryString();
            // $bookings = Booking::sortable()->whereJsonContains('booking_response', ['booking' => ['status' => 'CONFIRMED']])->paginate(config('app.limit'))->withQueryString();
            DB::commit();
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            redirect()->route('booking.list')->with("status", $exception->getMessage());
        }
      return view('backend.booking.list', compact('bookings'));
    }


    public function view(Request $request,$id)
    {
        DB::beginTransaction();
        try {
            $bookings = Booking::find($id)->toArray();
            DB::commit();
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            redirect()->route('booking.view')->with("status", $exception->getMessage());
        }
        return view('backend.booking.view', compact('bookings'));
    }

    public function search(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->input('search');
            $userdetail = User::sortable()->where('name', 'LIKE', '%' . $data . '%')->first();
            $userId = $userdetail->id;    
            // $bookings = Booking::where('user_id', $userId )->get();
            // dd($bookings);
            $bookings = Booking::sortable()->where('user_id', $userId )->whereJsonContains('booking_response', ['booking' => ['status' => 'CONFIRMED']])->paginate(config('app.limit'))->withQueryString();
            // dd($bookings);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            redirect()->route('admin.booking')->with("status", $exception->getMessage());
        }
        return view('backend.booking.list', compact('bookings'));
    }
    
}
