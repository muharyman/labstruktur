<?php

namespace App\Http\Controllers\API\Jabatan;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\CRUD;
use App\Http\Resources\JabatanResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Jabatan;
use Carbon\Carbon;
use Validator;

class CRUDController extends APIController
{
    use CRUD;

    protected $modelClassName = Jabatan::class;
    protected $resourceClassName = JabatanResource::class;
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