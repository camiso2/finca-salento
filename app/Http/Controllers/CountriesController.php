<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\getMessage;
use App\Custom\authenticate;
use App\Country;
use App\registerBedroom;

class CountriesController extends Controller
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


   public function listCountriesAll()
   {
       try {
        $data = [
            'listCountries'  => Country::orderBy('id', 'DESC')->get(),
            'beroomsOccupationFalse' => registerBedroom::whereNull('occupation')->get()
        ];
        return response()->json($data);
       } catch (\Exception $e) {
           Log::info("Error List countries :: " . $e->getMessage());
           return $e->getMessage();
       }
   }
}
