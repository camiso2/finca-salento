<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\getMessage;
use App\Custom\authenticate;
use App\RegisterBoooking;

class BookingController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function registerBooking(Request  $request)
    {
        try {
 
            RegisterBoooking::create($request->all());
            return response()->json(['success' => 'success']);
        } catch (\Exception $e) {
            Log::info("Error Register Booking:: " . $e->getMessage());
            return $e->getMessage();
        }
    }
    public function ListBookingsAll()
    {
        try {
         $listBooking =  RegisterBoooking::orderBy('id', 'DESC')->Paginate(4);
         return response()->json($listBooking);
        } catch (\Exception $e) {
            Log::info("Error List Bookings :: " . $e->getMessage());
            return $e->getMessage();
        }
    }

}
