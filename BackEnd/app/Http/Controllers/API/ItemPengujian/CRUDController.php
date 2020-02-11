<?php

namespace App\Http\Controllers\API\ItemPengujian;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\CRUD;
use App\Http\Resources\ItemPengujianResource;
use Illuminate\Support\Facades\Auth;
use App\Utils\Logging;
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
        'file' => ['nullable', 'file'],
    ];

    /**
     * preprocess input attributes for create and update
     * 
     * @param Request
     * @return input
     */
    public function processRequest($request)
    {
        $input = $request->except('foto', 'file');
        
        // store foto inventaris
        if ($request->hasFile('foto') && $request->file('foto')->isValid()){
            $request->file('foto')->store('FotoInventaris');
            $input['nama_foto'] = $request->file('foto')->hashName();
        }

        // store file
        if($request->hasFile('file') && $request->file('file')->isValid()){
            $request->file('file')->store('FileInventaris');
            $input['nama_file'] = $request->file('file')->hashName();
        }
    }

    /**
     * override standard update
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,Request $request)
    {
        // validate request
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()){
            return $this->respondRequestError($validator->errors());
        }

        // validate id
        $object = $this->modelClassName::find($id);
        if (!$object){
            return $this->respondError('Object not found');
        }

        // process request
        $input = $request->except('foto', 'file');
        
        // store foto inventaris
        if ($request->hasFile('foto') && $request->file('foto')->isValid()){
            if ($object->nama_foto) Storage::delete('FotoInventaris/'.$object->nama_foto);
            $request->file('foto')->store('FotoInventaris');
            $input['nama_foto'] = $request->file('foto')->hashName();
        }

        // store file
        if($request->hasFile('file') && $request->file('file')->isValid()){
            if ($object->nama_file) Storage::delete('FileInventaris/'.$object->nama_file);
            $request->file('file')->store('FileInventaris');
            $input['nama_file'] = $request->file('file')->hashName();
        }

        // update
        if($object->update($input)){
            Logging::action('Mengedit '.$this->modelClassName.', id:'.$object->getKey());
            return $this->respondWithData($object);
        } else {
            return $this->respondError('update failed');
        }

    }

    /**
     * override standard delete
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
            if ($object->nama_foto) Storage::delete('FotoInventaris/'.$object->nama_foto);
            if ($object->nama_file) Storage::delete('FileInventaris/'.$object->nama_file);
            Logging::action('Menghapus '.$this->modelClassName.', id:'.$object->getKey());
            return $this->respondWithData($object);
        } else {
            return $this->respondError('delete failed');
        }
        
    }
}