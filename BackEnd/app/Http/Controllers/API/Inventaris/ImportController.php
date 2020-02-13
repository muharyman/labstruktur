<?php

namespace App\Http\Controllers\API\Inventaris;

use App\Http\Controllers\API\APIController;
use App\Utils\Logging;
use Illuminate\Http\Request;
use App\Models\Inventaris;
use App\Imports\InventarisImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Validator;

class ImportController extends APIController
{
    /**
     * @var accepted file extension
     * 
     */
    protected $ext = ['xlsx', 'xls', 'csv'];

    /**
     * import from excel
     * 
     * @param Request
     * @return Response
     */
    public function import(Request $request)
    {
        // validate request
        $validator = Validator::make($request->all(), [
            'excel' => ['required', 'file'],
        ])->after(function($validator) use ($request){
            if (!in_array($request->file('excel')->getClientOriginalExtension(),$this->ext)){
                $validator->errors()->add('excel', 'The file type must be in: '. implode(", ", $this->ext));
            }
        });
        if ($validator->fails()){
            return $this->respondRequestError($validator->errors());
        }

        // import to inventaris
        if ($request->hasFile('excel') && $request->file('excel')->isValid()){
            try{
                Excel::import(new InventarisImport, $request->file('excel'));
                Logging::action('Melakukan import pada inventaris');
                return $this->respondSuccess('import success');
            }catch(ValidationException $e){
                $failures = $e->failures();
                $error_msg = [];
                foreach($failures as $failure){
                    array_push($error_msg, [
                        'row' => $failure->row(),
                        'column' => $failure->attribute(),
                        'error' => $failure->errors(),
                        'values' => $failure->values()
                    ]);
                }
                return $this->respondError($error_msg);
            }
        } else {
            return $this->respondError('file upload error');
        }
    }
}