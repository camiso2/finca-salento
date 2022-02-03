<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\getMessage;
use App\Custom\authenticate;
use App\registerBedroom;

class BedroomController extends Controller
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

    public function index()
    {
        return View('dashboard.bedrooms', compact('listBedroom'));
    }


    public function registerBedroom(Request  $request)
    {
        try {
            ini_set('memory_limit', '256M');
            $file = $request->file('fileImage');
            $extension = $file->getClientOriginalExtension();
            $file_name = Auth::user()->id . "-" . authenticate::randomLakname(15) . '.' . $file->getClientOriginalExtension();
            $destinationPath = "bedrooms/";
            if (!file_exists($destinationPath)) {
                if (!mkdir($destinationPath, 0777, true)) {
                    return response()->json(['success' => 'error']);
                }
            }
            $image = Image::make($file);
            $image->resize(640, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->orientate();
            //$image->insert('img/logo-latintak-marca-img.png', 'bottom-right');
            $image->save($destinationPath . $file_name);
            registerBedroom::create($request->all());
            $registerImage = registerBedroom::latest('id')->first();
            $registerImage->fileImage = $destinationPath . $file_name;
            $registerImage->codeRoom = "00" . $registerImage->id;
            $registerImage->save();
            return response()->json(['success' => 'success']);
        } catch (\Exception $e) {
            Log::info("Error Register Bedroom:: " . $e->getMessage());
            return $e->getMessage();
        }
    }

    public function ListBedroomsAll()
    {
        try {
            $listBedrooms  = registerBedroom::orderBy('id', 'DESC')->get();
            return response()->json($listBedrooms);
        } catch (\Exception $e) {
            Log::info("Error List Bedroom :: " . $e->getMessage());
            return $e->getMessage();
        }
    }
}