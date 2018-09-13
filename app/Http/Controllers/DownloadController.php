<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Download;

use Carbon\Carbon;


class DownloadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getDownload(Request $request){
        $download = Download::where(['publication_id'=>$request->publication_name,'publication_date'=>substr($request->publication_date,0,10)])->first();

        if($download != null){
            return response()->json($download,200);
        } else {
            return response()->json(null,201);
        }        
    }




}
