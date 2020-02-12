<?php

namespace App\Http\Controllers\API\FotoInventaris;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\CRUD;
use App\Http\Resources\FotoInventarisResource;
use Illuminate\Support\Facades\Auth;
use App\Utils\Logging;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\FotoInventaris;
use Carbon\Carbon;
use Validator;

class CRUDController extends APIController
{
    use CRUD;

    protected $modelClassName = FotoInventaris::class;
    protected $resourceClassName = FotoInventarisResource::class;
    protected $resourceCollectionClassName;
    /**
     * @var define request rules for create
     */
    protected $rules = [
        'idinventaris' => ['required', 'integer', 'exists:inventaris,idinventaris'],
        'foto' => ['required', 'image'],
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
        
        // store foto inventaris
        if ($request->hasFile('foto') && $request->file('foto')->isValid()){
            $request->file('foto')->store('FotoInventaris');
            $input['nama_foto'] = $request->file('foto')->hashName();
        }

        return $input;
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
        $input = $request->except('foto');
        
        // store foto inventaris
        if ($request->hasFile('foto') && $request->file('foto')->isValid()){
            if ($object->nama_foto) Storage::delete('FotoInventaris/'.$object->nama_foto);
            $request->file('foto')->store('FotoInventaris');
            $input['nama_foto'] = $request->file('foto')->hashName();
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