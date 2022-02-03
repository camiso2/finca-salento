<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\registerBedroom;
use App\RegisterOrder;

class OrderController extends Controller
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


   public function bedroomOccupation()
   {
       try {
        $data = [
            'bedroomOccupation' => registerBedroom::where('occupation',1)->get()
        ];
        return response()->json($data);
       } catch (\Exception $e) {
           Log::info("Error List bedrooms occupation true :: " . $e->getMessage());
           return $e->getMessage();
       }
   }
   public function registerOrder(Request $request)
    {

        try {
            RegisterOrder::create($request->all());
            return response()->json(['success' => 'success']);
        } catch (\Exception $e) {
            Log::info("Error Register Booking:: " . $e->getMessage());
            return $e->getMessage();
        }
    }
}
