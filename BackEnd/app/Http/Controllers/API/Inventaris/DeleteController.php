<?php

namespace App\Http\Controllers\API\Inventaris;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\CRUD;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Utils\Logging;
use Illuminate\Validation\Rule;
use App\Models\Inventaris;
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
    public function deleteFile($id, Request $request)
    {
        // validate id
        $object = Inventaris::find($id);
        if (!$object){
            return $this->respondError('Object not found');
        }

        // delete laporan
        if ($object->nama_file){
            Storage::delete('FileInventaris/'.$object->nama_file);
            $object->nama_file = null;
            $object->save();
            Logging::action('Menghapus File Inventaris, id:'.$object->getKey());
        }

        return $this->respondWithData($object);
    }
}