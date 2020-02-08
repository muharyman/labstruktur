<?php

namespace App\Http\Controllers\API\ItemPengujian;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\CRUD;
use App\Http\Resources\ItemPengujianResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\ItemPengujian;
use Carbon\Carbon;
use Validator;

class CRUDController extends APIController
{
    use CRUD;

    protected $modelClassName = ItemPengujian::class;
    protected $resourceClassName = ItemPengujianResource::class;
    protected $resourceCollectionClassName;
    /**
     * @var define request rules for create
     */
    protected $rules = [
        'idpengujian' => ['required', 'integer', 'exists:pengujian,idpengujian'],
        'idjenis_pengujian' => ['required', 'integer', 'exists:jenis_pengujian,idjenis_pengujian'],
        'jumlah_item' => ['required', 'integer'],
        'biaya_per_pengujian' => ['required', 'numeric'],
        'keterangan' => ['nullable', 'string'],
        'foto' => ['nullable', 'image'],
    ];

    /**
     * preprocess input attributes for create and update
     * 
     * @param Request
     * @return input
     */
    public function processRequest($request)
    {
        $input = $request->except('foto');

        // store laporan
        if ($request->has('foto') && !is_null($request->input('foto'))){
            if ($object->nama_foto){
                Storage::delete('FotoInventaris/'.$object->nama_foto);
            }
            $request->file('foto')->store('FotoInventaris');
            $input['nama_foto'] = $request->image->hashName();
        }
    }

    /**
     * override standard delte
     * 
     * @param id
     * @return response
     */
    public function delete($id)
    {
        // validate id
        $object = $this->modelClassName::find($id);
        if (!$object){
            return $this->respondError('Object not found');
        }

        // delete
        if ($object->delete()){
            Storage::delete('FotoInventaris/'.$object->nama_foto);
            return $this->respondWithData($object);
        } else {
            return $this->respondError('delete failed');
        }
        
    }
}