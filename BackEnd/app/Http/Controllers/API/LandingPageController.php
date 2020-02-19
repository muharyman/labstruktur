<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\APIController;
use App\Models\FotoLandingPage;
use App\Http\Controllers\API\FotoLandingPage\CRUDController;
use App\Http\Resources\FotoLandingPageResource;
use App\Utils\Logging;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Validator;
use DB;
use Arr;
use Exception;

class LandingPageController extends APIController
{
    protected $visi_misi_path = 'public/visi_misi.txt';
    protected $fungsi_path = 'public/fungsi.txt';

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
     * get data for landing_page
     * 
     */
    public function get()
    {
        // get photo url
        $data['photos'] = FotoLandingPageResource::collection(FotoLandingPage::all());
        // get visi misi
        $data['visi_misi'] = Storage::get($this->visi_misi_path); 
        // get fungsi
        $data['fungsi'] = Storage::get($this->fungsi_path);

        return $this->respondWithData($data);
    }

    /**
     * edit data for landing_page
     * 
     */
    public function edit(Request $request)
    {
        // validate request
        $validation = Validator::make($request->all(), [
            'photos' => ['nullable', 'array'],
            'visi_misi' => ['nullable', 'string'],
            'fungsi' => ['nullable', 'string'],
        ]);
        if ($validation->fails()){
            return $this->respondRequestError($validation->errors());
        }
        // update foto
        if ($request->has('photos')){
            // begin transaction
            DB::beginTransaction();
            try{
                $data = $request->all()['photos'];
                $updatedOrCreatedObjects=[];
                foreach($data as $key=>$object){
                    $req = new Request();
                    $req->replace(Arr::except($object, 'idfoto'));
                    $req->setMethod('POST');
                    if (array_key_exists('idfoto',$object) && !is_null($object['idfoto'])){
                        $response = $this->crudController->update($object['idfoto'], $req);
                    } else {
                        $response = $this->crudController->store($req);
                    }
                    
                    // error
                    if ($response->status() >= 400){
                        throw new Exception(json_encode($response->getOriginalContent()['error'])." id: ".$key);
                    } else {
                        array_push($updatedOrCreatedObjects, $response->getOriginalContent());
                    }
                }
                DB::commit();
            } catch (\Exception $e){
                DB::rollback();
                return $this->respondError($e->getMessage());
            }
        }

        // update visi_misi
        Storage::put($this->visi_misi_path, $request->input('visi_misi'));
        // update fungsi
        Storage::put($this->fungsi_path, $request->input('fungsi'));

        return $this->get();
    }
}