<?php

namespace App\Http\Controllers\API\KategoriPengujian;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\CRUD;
use App\Http\Resources\KategoriPengujianResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\KategoriPengujian;
use Carbon\Carbon;
use Validator;

class CRUDController extends APIController
{
    use CRUD;

    protected $modelClassName = KategoriPengujian::class;
    protected $resourceClassName = KategoriPengujianResource::class;
    protected $resourceCollectionClassName;
    /**
     * @var define request rules for create
     */
    protected $rules = [
        'nama_kategori' => ['required', 'string'],
        'nama_lain' => ['required', 'string'],
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