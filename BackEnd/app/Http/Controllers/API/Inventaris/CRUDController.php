<?php

namespace App\Http\Controllers\API\Inventaris;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\CRUD;
use App\Http\Resources\InventarisResource;
use Illuminate\Support\Facades\Auth;
use App\Utils\Logging;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Inventaris;
use App\Models\FotoInventaris;
use Carbon\Carbon;
use Validator;

class CRUDController extends APIController
{
    use CRUD;

    protected $modelClassName = Inventaris::class;
    protected $resourceClassName = InventarisResource::class;
    protected $resourceCollectionClassName;
    /**
     * @var define request rules for create
     */
    protected $rules = [
        'nama' => ['nullable', 'string'],
        'deskripsi' => ['nullable', 'string'],
        'catatan' => ['nullable', 'string'],
        'foto' => ['required'],
        'foto.*' => ['image','mimes:jpeg,png,jpg,gif,svg'],
        'file' => ['nullable', 'file'],
    ];

    /**
     * override standard create
     * 
     * @param Request
     * @return Response
     */
    public function store(Request $request)
    {
        // validate request
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()){
            return $this->respondRequestError($validator->errors());
        }

        // process request
        $input = $request->except('foto','file');
        // store file
        if($request->hasFile('file') && $request->file('file')->isValid()){
            $request->file('file')->store('FileInventaris');
            $input['nama_file'] = $request->file('file')->hashName();
        }

        // create
        $createdObject = $this->modelClassName::create($input);

        // store foto inventaris
        if($request->hasFile('foto')){
            foreach($request->file('foto') as $foto){
                if ($foto->isValid()){
                    $foto->store('FotoInventaris');
                    FotoInventaris::create([
                        'idinventaris' => $createdObject->getKey(),
                        'nama_foto' => $foto->hashName(),
                    ]);
                }
            }
        }

        if ($createdObject){
            Logging::action('Menambahkan '.(new \ReflectionClass($this->modelClassName))->getShortName().' baru, id:'.$createdObject->getKey());
            return $this->respondWithData($createdObject);
        } else {
            return $this->respondError('create failed');
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
        if($request->hasFile('foto')){
            foreach($request->file('foto') as $foto){
                if ($foto->isValid()){
                    $foto->store('FotoInventaris');
                    FotoInventaris::create([
                        'idinventaris' => $object->getKey(),
                        'nama_foto' => $foto->hashName(),
                    ]);
                }
            }
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
}