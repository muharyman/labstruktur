<?php

namespace App\Http\Controllers\API\Pengujian;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\CRUD;
use App\Http\Resources\PengujianResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\StatusPengujian;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Pengujian;
use Carbon\Carbon;
use Validator;

class CRUDController extends APIController
{
    use CRUD;

    protected $modelClassName = Pengujian::class;
    protected $resourceClassName = PengujianResource::class;
    protected $resourceCollectionClassName;
    /**
     * @var define request rules for create
     */
    protected $rules = [
        'email' => ['required', 'string', 'email', 'max:255'],
        'iduser_teknisi' => ['required', 'integer', 'exists:users,iduser'],
        'iduser_engineer' => ['required', 'integer', 'exists:users,iduser'],
        'pemberi_tugas' => ['required', 'string'],
        'npwp' => ['required', 'string', 'max:20'],
        'proyek' => ['required', 'string'],
        'nomor_laporan' => ['required', 'string'],
        'tanggal_terima' => ['required', 'date'],
    ];



    // /**
    //  * preprocess input attributes for create and update
    //  * 
    //  * @param Request
    //  * @return input
    //  */
    // public function processRequest($request)
    // {
    // }

    /**
     * Override standarad update
     * 
     * @param id, request
     * @return response
     */

    public function update($id, Request $request)
    {
        // validate request
        $changedRules = [
            'tanggal_pengujian' => ['nullable', 'date'],
            'nama_laporan' => ['nullable', 'date'],
            'status_pengujian' => ['nullable', 'boolean'],
            'status_pengambilan' => ['nullable', 'boolean'],
            'status_pembayaran' => ['nullable', 'boolean'],
        ];
        $rules = array_replace($this->rules, $changedRules);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return $this->respondRequestError($validator->errors());
        }

        // validate id
        $object = $this->modelClassName::find($id);
        if (!$object){
            return $this->respondError('Object not found');
        }

        // process request
        $input = $request->all();
        if ($input['status_pengujian'] != $object->status_pengujian){
            if ($input['status_pengujian'] == true){
                $input['tanggal_buka'] = Carbon::now();
                $input['id_pembuka'] = Auth::user()->getKey();
            } else if ($input['status_pengujian'] == false){
                $input['tanggal _tutup'] = Carbon::now();
                $input['id_penutup'] = Auth::user()->getKey();
            }
        }

        // update
        if($object->update($input)){
            if ($input['status_pengujian'] != $object->status_pengujian){
                // email notification
                Notification::route('mail', $input['email'])->notify(new StatusPengujian($input['proyek'], $input['status']));
            }
            return $this->respondWithData($object);
        } else {
            return $this->respondError('update failed');
        }
    }

}