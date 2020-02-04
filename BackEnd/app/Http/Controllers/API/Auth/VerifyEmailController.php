<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\APIController;
use Illuminate\Http\Request;
use App\Notifications\VerifyEmailRequest;
use App\Models\User;
use Carbon\Carbon;
use Validator;

class VerifyEmailController extends APIController
{

    public function send(Request $request)
    {
        // Validate Request
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'string'],
        ]);
        if ($validator->fails()){
            return $this->respondRequestError($validator->errors());
        }

        // Check email exist
        $email = $request['email'];
        $user = User::email($email)->first();
        if (!$user){
            return $this->respondError('Email user not Found');
        }

        // check if email already verified
        if ($user->email_verified_at){
            return $this->respondError('email already verified');
        }
        
        // Send email
        $user->notify(new VerifyEmailRequest($user->verification_token));
        
        return $this->respondSuccess('verify email sent');
    }

    public function verify($token)
    {
        // check token valid
        $user = User::where('verification_token', $token)->first();
        if (!$user){
            return $this->respondError('Invalid token');
        }

        // update user
        $user->email_verified_at = Carbon::now();
        $user->verification_token = '';
        $user->save();

        return $this->respondSuccess($user);
    }
}