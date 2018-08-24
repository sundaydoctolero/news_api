<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ChangePasswordRequest;
use DB;
use Illuminate\Http\Response;
use App\User;


class ChangePasswordController extends Controller
{
    public function process(ChangePasswordRequest $request){
        
        return $this->getPasswordResetTableRow($request) ? $this->changePassword($request) : $this->tokenNotFound();
    }


    private function getPasswordResetTableRow($request){
        
        return DB::table('password_resets')->where(['email'=>$request->email,'token'=>$request->resetToken])->first();
    }

    private function deletePasswordResetTableRow($request){
        
        return DB::table('password_resets')->where(['email'=>$request->email,'token'=>$request->resetToken])->delete();
    }

    private function tokenNotFound(){
        return response()->json([
            'error' => 'Token or Email is not valid',
        ],Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    private function changePassword($request){
        $user = User::where('email',$request->email)->first();
        $user->update(['password'=>$request->password]);
        $this->deletePasswordResetTableRow($request);
        return $this->successResponse();
    }

    private function successResponse(){
        return response()->json([
            'success' => 'Password successfully Changed!!',
        ],Response::HTTP_CREATED);
    }

}
