<?php

namespace App\Http\Controllers\API\Pengujian;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\CRUD;
use App\Http\Resources\PengujianResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use App\Notifications\StatusPengujian;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Pengujian;
use Carbon\Carbon;
use Validator;

class CRUDController extends APIController
{
    /**
     * get index with filter
     * 
     * @param Request
     * @return response
     */
    public function indexWithFilter(Request $request)
    {
        $filter = $request->input('filter');
        $modelIndex = null;
        switch ($filter) {
            case 1:
                // rutin
                $modelIndex = Pengujian::rutin();
                break;
            case 2:
                // tidak rutin
                $modelIndex = Pengujian::nonRutin();
                break;
            case 3:
                // lunas
                $modelIndex = Pengujian::lunas();
                break;
            case 4:
                // belum lunas
                $modelIndex = Pengujian::belumLunas();
                break;
            case 5:
                // laporan ada
                $modelIndex = Pengujian::laporanAvailable();
                break;
            case 6:
                // laporan tidak ada
                $modelIndex = Pengujian::laporanUnavailable();
                break;
            default:
                break;
        }
        $data = PengujianResource::collection($modelIndex);

        return $this->respondWithData($data); 
    }
}