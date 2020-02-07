<?php

namespace App\Http\Controllers\API\Pengujian;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\CRUD;
use App\Http\Resources\PengujianResource;
use Illuminate\Support\Facades\Auth;
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
        'status_pembayaran' => ['required', 'boolean'],
        'tanggal_buka' => ['required', 'date'],
        'tanggal_pengujian' => ['required', 'date'],
        'tanggal_tutup' => ['required', 'date'],
        'iduser_pembuka' => ['required', 'integer', 'exists:users,iduser'],
        'iduser_teknisi' => ['required', 'integer', 'exists:users,iduser'],
        'iduser_enginerr' => ['required', 'integer', 'exists:users,iduser'],
        'iduser_penutup' => ['required', 'integer', 'exists:users,iduser'],
        'pemberi_tugas' => ['required', 'string'],
        'npwp' => ['required', 'string', 'max:20'],
        'proyek' => ['required', 'string'],
        'tanggal_terima' => ['required', 'date'],
        'status_pengujian' => ['required', 'boolean'],
        'nomor_laporan' => ['required', 'string'],
        'nama_laporan' => ['required', 'string'],
        'status_pengambilan' => ['required', 'boolean'],
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
}