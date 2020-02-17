<?php

namespace App\Http\Controllers\API\Pembayaran;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\CRUD;
use App\Http\Resources\PembayaranResource;
use App\Utils\Logging;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Pembayaran;
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
    public function getByPengujian(Request $request)
    {
        $validator = Validator::make($request->all(),[
                'id' => ['required', 'integer']
            ]);
        if ($validator->fails()){
            return $this->respondRequestError($validator->errors());
        }
        $idPengujian = $request->input('id');
        $modelIndex = Pembayaran::query()->pengujian($idPengujian)->get();
        $data = PembayaranResource::collection($modelIndex);
        return $data;
    }
}