<?php

namespace App\Http\Controllers\API\Pengujian;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\CRUD;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Utils\Logging;
use Illuminate\Validation\Rule;
use App\Models\Pengujian;
use Carbon\Carbon;
use Validator;

class DeleteController extends APIController
{
    /**
     * delete laporan
     * 
     * @param Request
     * @return response
     */
    public function deleteLaporan($id, Request $request)
    {
        // validate id
        $object = Pengujian::find($id);
        if (!$object){
            return $this->respondError('Object not found');
        }

        // delete laporan
        if ($object->nama_laporan){
            Storage::delete('Laporan/'.$object->nama_laporan);
            $object->nama_laporan = null;
            $object->save();
            Logging::action('Menghapus Laporan, id:'.$object->getKey());
        }

        return $this->respondWithData($object);
    }
}