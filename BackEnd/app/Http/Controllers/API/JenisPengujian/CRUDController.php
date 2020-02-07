<?php

namespace App\Http\Controllers\API\JenisPengujian;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\CRUD;
use App\Http\Resources\JenisPengujianResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\JenisPengujian;
use Carbon\Carbon;
use Validator;

class CRUDController extends APIController
{
    use CRUD;

    protected $modelClassName = JenisPengujian::class;
    protected $resourceClassName = JenisPengujianResource::class;
    protected $resourceCollectionClassName;
    /**
     * @var define request rules for create
     */
    protected $rules = [
        'idkategori_pengujian' => ['required', 'integer', 'exists:kategori_pengujian,idkategori_pengujian'],
        'nama_pengujian' => ['required', 'string'],
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