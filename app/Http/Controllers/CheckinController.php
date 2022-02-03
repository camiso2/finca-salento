<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\getMessage;
use App\RegisterCheckin;
use App\registerBedroom;


class CheckinController extends Controller
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

    public function registerCheckin(Request  $request)
    {
        try {

            RegisterCheckin::create($request->all());
            $registerBedroom = registerBedroom::find($request->debroom_id);
            $registerBedroom->occupation = '1';
            $registerBedroom->save();
            return response()->json(['success' => 'success']);
        } catch (\Exception $e) {
            Log::info("Error Register checkin:: " . $e->getMessage());
            return $e->getMessage();
        }
    }

}
