<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Response;
use Mail;
use DB;
use Carbon\Carbon;


class ResetPasswordController extends Controller
{
    public function sendEmail(Request $request){
        
    
        if(!$this->validateEmail($request->email)){
            return $this->failedResponse();
        }
        
        $this->send($request->email);
        return $this->successResponse();


    }

    public function validateEmail($email){
        return !!User::where('email',$email)->first();
    }

    public function failedResponse(){
        return response()->json([
            'error' => 'Email not found',
        ],Response::HTTP_NOT_FOUND);
    }

    public function successResponse(){
        return response()->json([
            'data' => 'Email successfully sent. Please check your inbox',
        ],Response::HTTP_OK);
    }

    public function send($email){
        $token = $this->createToken($email);

        Mail::send(['html'=>'mail.reset_password'],['email'=>$email,'token'=>$token],
            function($message){
                $message->to(['sysadmin@cccdms.com'],'LinkMe Systems')
                    ->subject('Password Reset Email');
            });
    }

    public function createToken($email){
        $oldToken = DB::table('password_resets')->where('email',$email)->first();

        if($oldToken){
            $this->saveToken($email,$oldToken->token);
            return $oldToken->token;
        }


        $token = str_random(60);
        $this->saveToken($email,$token);
        return $token;
    }

    public function saveToken($email,$token){
        DB::table('password_resets')->insert([
            'email' =>$email,
            'token' => $token,
            'created_at' => Carbon::now()
            ]);
    }

}
