<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\CRUD;
use App\Http\Resources\UserResource;
use App\Utils\Logging;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use Carbon\Carbon;
use Validator;

class CRUDController extends APIController
{
    use CRUD;

    protected $modelClassName = User::class;
    protected $resourceClassName = UserResource::class;
    protected $resourceCollectionClassName;
    /**
     * @var define request rules for create
     */
    protected $rules = [
        'nama_login' => ['required', 'string', 'max:255', 'unique:users'],
        'nama_user' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'idjabatan' => ['required', 'integer'],
        'status_user' => ['required', 'boolean'],
    ];

    /**
     * preprocess input attributes for create and update
     * 
     * @param Request
     * @return input
     */
    public function processRequest($request)
    {
        $input = $request->except('password_confirmation');
        $input['password'] = bcrypt($input['password']);
        $input['user_created'] = Carbon::now();
        $input['status_user'] = true;
        do{
            $input['verification_token'] = str_random(60);
        }while(User::where('verification_token', $input['verification_token'])->first() instanceof User);

        return $input;
    }

    /**
     * override standard update
     * 
     * @param request
     * @return response
     */

    public function update ($id, Request $request)
    {
        // validate id
        $object = $this->modelClassName::find($id);
        if (!$object){
            return $this->respondError('Object not found');
        }
        
        // validate request
        $changedRules = [
            'nama_login' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($object->getKey(),$object->getKeyName())],
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore($object->getKey(),$object->getKeyName())],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
        ];
        $rules = array_replace($this->rules, $changedRules);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return $this->respondRequestError($validator->errors());
        }
        // process request
        $input = $request->except('password_confirmation');
        if (array_key_exists('password', $input) && !is_null($input['password'])){
            $input['password'] = bcrypt($request['password']);
            $input['last_change_password'] = Carbon::now();
        }
        if (array_key_exists('email', $input) && $input['email'] != $object->email){
            do{
                $input['verification_token'] = str_random(60);
            }while(User::where('verification_token', $input['verification_token'])->first() instanceof User);
            $input['email_verified_at'] = null;
        }
        
        // update
        if ($object->update($input)) {
            Logging::action('Mengedit '.$this->modelClassName.', id:'.$object->getKey());
            return $this->respondWithData($object);
        } else {
            return $this->respondError('update failed');
        }

    }
}