<?php

namespace App\Http\Controllers\API\Pembayaran;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\CRUD;
use App\Http\Resources\PembayaranResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Validator;

class CRUDController extends APIController
{
    use CRUD;

    protected $modelClassName = Pembayaran::class;
    protected $resourceClassName = PembayaranResource::class;
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