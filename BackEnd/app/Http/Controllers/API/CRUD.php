<?php 
namespace App\http\controllers\API;
use App\Utils\Logging;
use Illuminate\Http\Request;
use Validator;
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
        $data = $this->resourceCollectionClassName ?
            new $this->resourceCollectionClassName($modelIndex):
            $this->resourceClassName::collection($modelIndex);
        return $data;
        // return $this->respondWithData($data); 
    }

    /**
     * create a new object.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // validate request
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()){
            return $this->respondRequestError($validator->errors());
        }

        // process request
        $input = $this->processRequest($request);

        // create
        $createdObject = $this->modelClassName::create($input);

        Logging::action('Menambahkan '.(new \ReflectionClass($this->modelClassName))->getShortName().' baru, id:'.$createdObject->getKey());

        return $this->respondWithData($createdObject);
    }

    /**
     * return spesific object
     *
     * @param  int  $id
     * @return Json
     */
    public function show($id)
    {   
        // check object exist
        $object = $this->modelClassName::find($id);
        if (!$object){
            return $this->respondWithError('object not found');
        }

        $data = new $this->resourceClassName($object);
        return $data;
        // return $this->respondWithData($data);
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
        $validator = Validator::make($request->all(), $this->rules);
        if ($validator->fails()){
            return $this->respondRequestError($validator->errors());
        }

        // validate id
        $object = $this->modelClassName::find($id);
        if (!$object){
            return $this->respondError('Object not found');
        }

        // process request
        $input = $this->processProcess($request);

        // update
        if($object->update($input)){
            Logging::action('Mengedit '.$this->modelClassName.', id:'.$object->getKey());
            return $this->respondWithData($object);
        } else {
            return $this->respondError('update failed');
        }

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
        if ($object->delete()){
            Logging::action('Menghapus '.$this->modelClassName.', id:'.$object->getKey());
            return $this->respondWithData($object);
        } else {
            return $this->respondError('delete failed');
        }
        
    }

    /**
     * Default request process
     * 
     * @param Request
     * @return input
     */
    public function processRequest($request)
    {
        return $request->all();
    }
}
