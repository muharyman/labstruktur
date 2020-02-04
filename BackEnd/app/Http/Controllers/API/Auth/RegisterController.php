<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\APIController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\VerifyEmailRequest;
use Carbon\Carbon;
use Validator;

class RegisterController extends APIController
{

    public function register(Request $request)
    {
        // Validate Request
        $validator = Validator::make($request->all(), [
            'nama_login' => ['required', 'string', 'max:255', 'unique:users'],
            'nama_user' => ['required', 'string', 'max:255'],
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
        $input['user_created'] = Carbon::now();
        $input['status_user'] = true;
        do{
            $input['verification_token'] = str_random(60);
        }while(User::where('verification_token', $input['verification_token'])->first() instanceof User);
        $user = User::create($input);

        // send verification email
        $user->notify(new VerifyEmailRequest($user->verification_token));

        $success['user'] = $user;
        $success['token'] = $user->createToken(env('APP_NAME', 'labstruktur'))->accessToken;
        return $this->respondSuccess($success);

    }
}