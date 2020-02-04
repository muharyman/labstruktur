<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\APIController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class RegisterController extends APIController{

    public function __invoke(Request $request){
        // Validate Request
        $validator = Validator::make($request->all(), [
    		'nama_login' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'idjabatan' => ['required', 'integer']
        ]);
        
    	if ($validator->fails()) {
    		return $this->respondRequestError($validator->errors());
        }
        
        // Create user
        $input = $request->except('password_confirmation');
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['user'] = $user;
        $success['token'] = $user->createToken(env('APP_NAME', 'labstruktur'))->accessToken;
        return $this->respondSuccess($success);
    }
}