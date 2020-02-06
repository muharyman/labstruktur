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
    ];

    /**
     * preprocess input attributes for create and update
     * 
     * @param Request
     * @return input
     */
    public function processRequest($request)
    {
    }
}