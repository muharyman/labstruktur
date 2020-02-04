<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\APIController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class LoginController extends APIController{

    public function __invoke(Request $request){
        // Validate Request
        $validator = Validator::make($request->all(), [
    		'nama_login' => ['required', 'string'],
    		'password' => ['required'],
    	]);
    	if ($validator->fails()) {
    		return $this->respondRequestError($validator->errors());
        }
        
        // Check credentials
        $credentials = $request->only('nama_login', 'password');
        if (Auth::attempt($credentials)){
            $user = Auth::user();
            $token = $user->createToken(env('APP_NAME', 'labstruktur'))->accessToken;
            return $this->respondSuccess(['token'=>$token]);
        }else{
            return $this->respondUnauthorized();
        }
    }
}