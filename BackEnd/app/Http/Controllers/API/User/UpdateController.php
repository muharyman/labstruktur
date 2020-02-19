<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\User\CRUDController;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Carbon\Carbon;
use Validator;
use Exception;
use Arr;
use DB;

class UpdateController extends APIController
{
    /**
     * @var CRUDController
     */
    protected $crudController;

    /**
     * constructor
     * inject CRUD Controller
     * @param CRUDController
     */
    public function __construct(CRUDController $crudController)
    {
        $this->crudController = $crudController;
    }

    /**
     * multiple update or create
     * */ 
    public function multipleUpdateOrCreate(Request $request)
    {
        // validate request
        $validation = Validator::make($request->all(), [
            'data' => ['required', 'array'],
        ]);
        if ($validation->fails()){
            return $this->respondRequestError($validation->errors());
        }
        // begin transaction
        DB::beginTransaction();
        try{
            $data = $request->input('data');
            $updatedOrCreatedObjects=[];
            foreach($data as $key=>$object){
                $request = new Request();
                $request->replace(Arr::except($object, 'iduser'));
                if (array_key_exists('iduser',$object) && !is_null($object['iduser'])){
                    $request->setMethod('PUT');
                    $response = $this->crudController->update($object['iduser'], $request);
                } else {
                    $request->setMethod('POST');
                    $response = $this->crudController->store($request);
                }
                
                // error
                if ($response->status() >= 400){
                    throw new Exception(json_encode($response->getOriginalContent()['error'])." id: ".$key);
                } else {
                    array_push($updatedOrCreatedObjects, $response->getOriginalContent());
                }
            }
            DB::commit();
            return $this->respondWithData($updatedOrCreatedObjects);
        } catch (\Exception $e){
            DB::rollback();
            return $this->respondError($e->getMessage());
        }
    }
}