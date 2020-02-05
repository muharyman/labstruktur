<?php 
 namespace App\http\controllers\API;

 trait CRUD
 {
     /**
     * return all object as json
     *
     * @return Json
     */
    public function index()
    {
        $modelIndex = $this->modelClassName::all();
        return $this->resourceCollectionClassName ? new $this->resourceCollectionClassName($modelIndex) : 
        new $this->resourceClassName::collection($modelIndex);
    }

    /**
     * create a new object.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // validate request
        $validator = $this->validateRequest();
        if ($validator->fails()){
            return $this->respondRequestError($validator->errors());
        }

        // process request
        $input = $this->processRequest($request);

        // create
        $createdObject = $this->modelClassName::create($input);

        return $this->respondSuccess($createdObject);
    }

    /**
     * return spesific object
     *
     * @param  int  $id
     * @return Json
     */
    public function show($id)
    {      
        return new $this->resourceClassName($this->modelClassName::find($id));
    }

    /**
     * update spesific object
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id,Request $request)
    {
        // validate request
        $validator = $this->validateRequest($request);
        if ($validator->fails()){
            return $this->respondRequestError($validator->errors());
        }

        // validate id
        $object = $this->modelClassName::find($id);
        if (!$object){
            return $this->respondError('Object not found');
        }

        // process request
        $input = $this->processRequest($request);

        // update
        $updatedObject = $object->update($input);

        return $this->respondSuccess($updatedObject);
    }

    /**
     * remove spesified object
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id)
    {
        // validate id
        $object = $this->modelClassName::find($id);
        if (!$object){
            return $this->respondError('Object not found');
        }

        // delete
        $deletedObject = $object->delete();

        return $this->respondSuccess($deletedObject);
    }
}