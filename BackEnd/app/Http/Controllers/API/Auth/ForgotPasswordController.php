<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\APIController;
use Illuminate\Http\Request;
use App\Notifications\PasswordResetRequest;
use App\Models\PasswordReset;
use App\Models\User;
use Carbon\Carbon;
use Validator;

class ForgotPasswordController extends APIController
{

    public function create(Request $request)
    {
        // Validate Request
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'string'],
        ]);
        if ($validator->fails()){
            return $this->respondRequestError($validator->errors());
        }

        // Check email exist and verified
        $email = $request['email'];
        $user = User::email($email)->first();
        if (!$user){
            return $this->respondError('Email user not Found');
        }
        if (!$user->email_verified_at){
            return $this->respondError('Please verify your email');
        }

        // Generate Token
        do{
            $token = str_random(60);
        }while(PasswordReset::token($token)->first() instanceof User);

        $passwordReset = PasswordReset::updateOrCreate(
            ['email'=>$email],
            ['token'=>$token]
        );

        // sends email
        if ($passwordReset){
            $user->notify(
                new PasswordResetRequest($token)
            );
            return $this->respondSuccess('Reset password email has been sent');
        } else {
            return $this->respondError('Error Generating Token');
        }
    }

    public function check($token)
    {
        $passwordReset = PasswordReset::token($token)->first();
        
        // validate token
        if(!$passwordReset){
            return $this->respondError('Token is invalid');
        }

        // validate token expiry time
        if(Carbon::parse($passwordReset->updated_at)->addHour(env('PASSWORD_RESET_TOKEN_EXPIRY_TIME', 6))->isPast()){
            $passwordReset->delete();
            return $this->respondError('Token expired');
        }

        return $this->respondSuccess($passwordReset);
    }

    public function reset(Request $request)
    {
        // validate request
        $validator = Validator::make($request->all(),[
            'email' => ['required', 'string', 'email'],
            'password'=> ['required', 'string', 'confirmed'],
            'token'=> ['required', 'string'],
        ]);
        
        if ($validator->fails()){
            return $this->respondRequestError($validator->errors());
        }

        // validate token
        $token = $request['token'];
        $passwordReset = passwordReset::token($token)->first();
        if (!$passwordReset){
            return $this->respondError('Token is invalid');
        }
        
        // validate user
        $email = $request['email'];
        $user = User::email($email)->first();
        if(!$user){
            return $this->respondError('Email user not found');
        }

        // update user password + delete token
        $user->password = bcrypt($request['password']);
        $user->last_change_password = Carbon::now();
        $user->save();
        $passwordReset->delete();

        return $this->respondSuccess($user);
    }
}