<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\APIController;
use App\Utils\Logging;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Validator;

class LoginController extends APIController
{

    public function login(Request $request)
    {
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
            if (!$user->status_user){
                return $this->respondError('this account is not active');
            }
            $user->last_login = Carbon::now();
            $user->last_ip_login = $request->ip();
            $user->save();
            $token = $user->createToken(env('APP_NAME', 'labstruktur'))->accessToken;
            Logging::action('Berhasil Login');
            return $this->respondSuccess([
                'user' =>new UserResource($user),
                'token'=>$token
            ]);
        }else{
            return $this->respondUnauthorized();
        }
    }
}