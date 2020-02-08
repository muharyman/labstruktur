<?php

namespace App\Utils;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Log as LogDB;
use Carbon\Carbon;
use Validator;

class Logging 
{
    /**
     * log action
     * 
     * @param string action
     * @return created log
     */
    public static function action($action)
    {
        $nama_user = Auth::user() ? Auth::user()->nama_user : 'Anonimous';
        $input['user'] = $nama_user;
        $input['ip'] = request()->ip();
        $input['time'] = Carbon::now();
        $input['action'] = $action;
        $log = LogDB::create($input);
        Log::info($action.' user:'. $nama_user);
        return $log;
    }
}