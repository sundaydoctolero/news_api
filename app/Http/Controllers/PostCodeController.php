<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Suburb;

class PostCodeController extends Controller
{
    public function getPostCode(Request $request){
        $post_code = Suburb::where('Suburb',$request->suburb)->first();

        if($post_code != null){
            return $this->respondSuccess($post_code,'Success!!');
        }

        return $this->respondError("Suburb Not Found!!");
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

}
