<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Au;
use Carbon\Carbon;


class AuController extends Controller
{
    public function index(){
        $properties = Au::where(['Publication_Name'=>'Sample','Publication_Date'=> Carbon::now()->toDateString()])->get();
        $properties->load('agents');

        return $this->respondSuccess($properties,'Hello Hahah');

    }

    public function findProperty(Request $request){

        $property = Au::where([
            'state' => $request->State,
            'unit_no' => $request->Unit_No,
            'street_no' => $request->Street_No,
            'street_no_suffix' => $request->Street_No_Suffix,
            'street_name' => $request->Street_Name,
            'street_extension' => $request->Street_Extension,
            'suburb' => $request->Suburb,
            'property_type' => $request->Property_Type,
            'sale_rent' => $request->Sale_Rent,

        ])->orderBy('id','DESC')->first();


        if($property != null){
            return $this->respondSuccess($property,'Property Generated');
        }

        return $this->respondError('Property Not Found!!');

    }

    public function respondSuccess($data,$message){
        return response()->json([
            'data' => $data,
            'message' => $message
        ],200);
    }


    public function respondError($error){
        return response()->json([
            'error' => $error
        ],404);
    }


    public function saveProperty(Request $request){
        $property = Au::create($request->all());
        $property->agents()->createMany($request->agents);

        return $this->respondSuccess($property,'Success!!');
    }

}
