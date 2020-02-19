<?php

namespace App\Http\Controllers\API\FotoLandingPage;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\CRUD;
use App\Http\Resources\FotoLandingPageResource;
use Illuminate\Support\Facades\Auth;
use App\Utils\Logging;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\FotoLandingPage;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;
use Validator;

class CRUDController extends APIController
{
    use CRUD;

    protected $modelClassName = FotoLandingPage::class;
    protected $resourceClassName = FotoLandingPageResource::class;
    protected $resourceCollectionClassName;
    /**
     * @var define request rules for create
     */
    protected $rules = [
        'foto' => ['nullable', 'image'],
        'deskripsi' => ['nullable', 'string']
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
        // store foto LandingPage
        if ($request->hasFile('foto') && $request->file('foto')->isValid()){
            $request->file('foto')->store('public/FotoLandingPage');
            $input['nama_foto'] = $request->file('foto')->hashName();
        }

        if ($request->input('foto') instanceof UploadedFile){
            $request->input('foto')->store('public/FotoLandingPage');
            $input['nama_foto'] = $request->input('foto')->hashName();
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
        
        // store foto LandingPage
        if ($request->hasFile('foto') && $request->file('foto')->isValid()){
            if ($object->nama_foto) Storage::delete('public/FotoLandingPage/'.$object->nama_foto);
            $request->file('foto')->store('public/FotoLandingPage');
            $input['nama_foto'] = $request->file('foto')->hashName();
        }
        if ($request->input('foto') instanceof UploadedFile){
            if ($object->nama_foto) Storage::delete('public/FotoLandingPage/'.$object->nama_foto);
            $request->input('foto')->store('public/FotoLandingPage');
            $input['nama_foto'] = $request->input('foto')->hashName();
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