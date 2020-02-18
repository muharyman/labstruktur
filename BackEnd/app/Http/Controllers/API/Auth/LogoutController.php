<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\API\APIController;
use App\Utils\Logging;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Validator;

class LogoutController extends APIController
{

    public function logout(Request $request)
    {
        if (Auth::check()){
            Auth::user()->token()->revoke();
            Logging::action('Berhasil Logout');
            return $this->respondSuccess('Berhasil Logout');
        } else {
            return $this->respondError('User not logged in');
        }
    }
}