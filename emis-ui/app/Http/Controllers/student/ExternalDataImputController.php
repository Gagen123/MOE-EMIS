<?php

namespace App\Http\Controllers\student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Traits\AuthUser;

class ExternalDataImputController extends Controller
{
    //
    use ServiceHelper;
    use AuthUser;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    public function saveImported(Request $request){
        if($request->type == "institutes"){
            $rules = [
                'collegeName'               => 'required',
                'dzongkhag'                 => 'required',
                'institutes_type'           => 'required',
                'own_by'                    => 'required',
            ];
            $customMessages = [
                'collegeName.required'     => 'This field is required',
                'dzongkhag.required'       => 'This field is required',
                'institutes_type.required' => 'This field is required',
                'remarks.required'         => 'This field is required',
                'own.required'             => 'This field is required',
            ];
            $this->validate($request, $rules, $customMessages);
        }
        $data = $request->all();
        $response_data= $this->apiService->createData('emis/students/ExternalDataImport/saveImported', $data);
        return $response_data;

    }
    public function loadInstitues($param="",$model=""){
        $loadData = $this->apiService->listData('emis/students/ExternalDataImport/loadInstitues/'.$param.'/'.$model);
        return $loadData;

    }
}
