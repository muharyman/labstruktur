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
    protected $dataTextPath = 'public/LandingDataText.txt';

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
        $dataText = json_decode(Storage::get($this->dataTextPath), true);

        // get photo url
        $data['photos'] = FotoLandingPageResource::collection(FotoLandingPage::all());
        $data['foto_profil'] = route('getfile', ['filepath' => 'public/'.$dataText['nama_foto_profil']]);

        $data['visi_misi'] = $dataText['visi_misi'];
        $data['fungsi'] = $dataText['fungsi'];
        $data['kontak'] = $dataText['kontak'];
        $data['nama_kontak'] = $dataText['nama_kontak'];
        $data['alamat'] = $dataText['alamat'];
        $data['email'] = $dataText['email'];
        $data['profil'] = $dataText['profil'];

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
            'foto_profil' => ['nullable', 'image'],
            'visi_misi' => ['nullable', 'string'],
            'fungsi' => ['nullable', 'string'],
            'kontak' => ['nullable', 'string'],
            'nama_kontak' => ['nullable', 'string'],
            'alamat' => ['nullable', 'string'],
            'profil' => ['nullable', 'string'],
            'email' => ['nullable', 'email'],
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
        
        $dataText = json_decode(Storage::get($this->dataTextPath), true);
                
        $data = [];
        $data['nama_foto_profil'] = $dataText['nama_foto_profil'];
        if ($request->hasFile('foto_profil') && $request->file('foto_profil')->isValid()){
            if (Storage::exists('public/'. $data['nama_foto_profil'])) Storage::delete('public/'.$data['nama_foto_profil']);
            $request->file('foto_profil')->store('public');
            $data['nama_foto_profil'] = $request->file('foto_profil')->hashName();
        }
        
        $data['visi_misi'] = $request->input('visi_misi');
        $data['fungsi'] = $request->input('fungsi');
        $data['kontak'] = $request->input('kontak');
        $data['nama_kontak'] = $request->input('nama_kontak');
        $data['alamat'] = $request->input('alamat');
        $data['email'] = $request->input('email');
        $data['profil'] = $request->input('profil');
        Storage::put($this->dataTextPath, json_encode($data));
        return $this->get();
    }

}