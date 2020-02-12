<?php

namespace App\Http\Controllers\API\Pengujian;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\CRUD;
use App\Http\Resources\PengujianResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Utils\Logging;
use Illuminate\Support\Facades\Storage;
use App\Notifications\StatusPengujian;
use App\Notifications\StatusPersetujuan;
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
        'idteknisi' => ['required', 'integer', 'exists:users,iduser'],
        'idengineer' => ['required', 'integer', 'exists:users,iduser'],
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
            'status_persetujuan' => ['nullable', 'boolean'],
            'status_pengujian' => ['nullable', 'boolean'],
            'status_pengambilan' => ['nullable', 'boolean'],
            'status_pembayaran' => ['nullable', 'boolean'],
            'laporan' => ['nullable', 'file'],
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
        $input = $request->except('laporan');

        if ($input['status_pengujian'] != $object->status_pengujian){
            if ($input['status_pengujian'] == true){
                $input['tanggal_buka'] = Carbon::now();
                $input['iduser_pembuka'] = Auth::user()->getKey();
            } else if ($input['status_pengujian'] == false){
                $input['tanggal_tutup'] = Carbon::now();
                $input['iduser_penutup'] = Auth::user()->getKey();
            }
        }

        // store laporan
        if ($request->hasFile('laporan') && $request->file('laporan')->isValid()){
            if ($object->nama_laporan){
                Storage::delete('Laporan/'.$object->nama_laporan);
            }
            $request->file('laporan')->store('Laporan');
            $input['nama_laporan'] = $request->file('laporan')->hashName();
        }

        // update
        $status_pengujian = $object->status_pengujian;
        $status_persetujuan = $object->status_persetujuan;
        if($object->update($input)){
            // email notification
            if ($input['status_persetujuan'] != $status_persetujuan){
                Notification::route('mail', $input['email'])->notify(new StatusPersetujuan($input['proyek'], $input['status_persetujuan']));
            }
            if ($input['status_pengujian'] != $status_pengujian){
                Notification::route('mail', $input['email'])->notify(new StatusPengujian($input['proyek'], $input['status_pengujian']));
            }
            Logging::action('Mengedit '.$this->modelClassName.', id:'.$object->getKey());
            return $this->respondWithData($object);
        } else {
            return $this->respondError('update failed');
        }
    }

}