<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\CRUD;
use App\Http\Resources\UserResource;
use App\Utils\Logging;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Carbon\Carbon;
use Validator;

class GetController extends APIController
{
    /**
     * get user by its roles
     * 
     * @param Request
     * @return input
     */
    public function getByRoles(Request $request)
    {
        $validator = Validator::make($request->all(), is_array($request->input('roles')) ?
             [
                 'roles' => ['required'],
                 'roles.*' => ['required', 'integer']
             ]:
             [
                 'roles' => ['required', 'integer']
             ]
            );
        if ($validator->fails()){
            return $this->respondRequestError($validator->errors());
        }
        $idJabatan = $request->input('roles');
        $modelIndex = is_array($idJabatan) ? User::query()->jabatans($idJabatan)->get() : User::query()->jabatan($idJabatan)->get();
        $data = UserResource::collection($modelIndex);
        return $data;
    }
}