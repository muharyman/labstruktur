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
        $modelIndex = Pengujian::query();
        $search = '%'.$request->input('search').'%';
        $search_attributes = ['status_pembayaran', 'idpengujian', 'tanggal_buka', 'tanggal_tutup', 'pemberi_tugas', 'npwp', 'status_pengambilan', 'proyek'];
        foreach ($search_attributes as $attribute){
            $modelIndex = $modelIndex->orWhere($attribute, 'like', $search);
        }
        /**
         * and (status_pembayaran like "'.$search.'"
						or idpengujian like "%'.$search.'%"
						or tanggal_buka like "%'.$search.'%"
						or tanggal_tutup like "%'.$search.'%"
						or pemberi_tugas like "%'.$search.'%"
						or npwp like "%'.$search.'%"
						or status_pengambilan like "%'.$search.'%"
						or proyek like "%'.$search.'%" '
         */
        $filter = $request->input('filter');
        switch ($filter) {
            case 1:
                // rutin
                $modelIndex = $modelIndex->rutin();
                break;
            case 2:
                // tidak rutin
                $modelIndex = $modelIndex->nonRutin();
                break;
            case 3:
                // lunas
                $modelIndex = $modelIndex->lunas();
                break;
            case 4:
                // belum lunas
                $modelIndex = $modelIndex->belumLunas();
                break;
            case 5:
                // laporan ada
                $modelIndex = $modelIndex->laporanAvailable();
                break;
            case 6:
                // laporan tidak ada
                $modelIndex = $modelIndex->laporanUnavailable();
                break;
            default:
                break;
        }
        $modelIndex->get();
        $data = PengujianResource::collection($modelIndex);

        return $this->respondWithData($data); 
    }
}