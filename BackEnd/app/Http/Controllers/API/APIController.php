<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class APIController extends Controller
{
    /**
     * @var int response status
     */
    protected $statusCode = 200;

    /**
     * Getter method to return status code
     *
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Setter method to set status code.
     * Return current object for chaining purpose
     *
     * @param mixed $statusCode
     * @return current object.
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * return response with message and current status code
     * 
     * @param string
     * @return json
     */
    public function respondWithMessage($message = '')
    {
        return response()->json(['message'=>$message], $this->statusCode);
    }

    /**
     * return response with data and current status code
     * 
     * @param mixed
     * @return json
     */
    public function respondWithData($data)
    {
        return response()->json($data, $this->statusCode);
    }

    /**
     * return response success
     * 
     * @param mixed
     * @return json
     */
    public function respondSuccess($data='success', $statusCode=200)
    {
        return response()->json(['success'=>$data], $statusCode);
    }

    /**
     * return response error
     * 
     * @param mixed
     * @return json
     */
    public function respondError($data='error', $statusCode=400){
        return response()->json(['error'=>$data], $statusCode);
    }

    /**
     * return unauthorized error
     * 
     * @param mixed
     * @return json
     */
    public function respondUnauthorized(){
        return $this->respondError('Unauthorized', 401);
    }

    /**
     * return validator error
     * 
     * @param validator error
     * @return json
     */
    public function respondRequestError($error='RequestError'){
        return $this->respondError($error, 417);
    }
}
