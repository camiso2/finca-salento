<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\getMessage;
use App\Custom\authenticate;
use App\Custom\RandomName;
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
        $listBedroom = registerBedroom::orderBy('id','desc');

        return View('dashboard.bedrooms', compact('listBedroom'));
    }

    /**
     *  Register data the bedrooms
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function registerBedroom(Request  $request): JsonResponse
    {
        try {
            ini_set('memory_limit', '256M');
            $file = $request->file('fileImage');
            $file_name = Auth::user()->id . "-" . RandomName::randomName(15) . '.' . $file->getClientOriginalExtension();
            $destinationPath = "bedrooms/";
            if (!file_exists($destinationPath)) {
                if (!mkdir($destinationPath, 0777, true)) {
                    return response()->json(['success' => 'error']);
                }
            }
            if (!$this->saveImage($file, $destinationPath, $file_name)) {
                return response()->json(['success' => 'error']);
            }
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

    /**
     * save and redimention image in folder
     *
     * @param String $file
     * @param String $destinationPath
     * @param String $file_name
     * @return Boolean
     */
    public function saveImage(String $file, String $destinationPath, String $file_name): bool
    {
        try {
            $image = Image::make($file);
            $image->resize(640, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $image->orientate();
            $image->save($destinationPath . $file_name);
            if ($image) {
                return true;
            }
            return false;
        } catch (\Exception $e) {
            Log::info("Error save img :: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get all data bedrooms with use the scope local model registerBedroom
     *
     * @return JsonResponse
     */

    public function ListBedroomsAll(): JsonResponse
    {
        try {
            $listBedrooms  = registerBedroom::ListBedroomsAll()->get()->toArray();
            return response()->json($listBedrooms);
        } catch (\Exception $e) {
            Log::info("Error List Bedroom :: " . $e->getMessage());
            return $e->getMessage();
        }
    }
}
