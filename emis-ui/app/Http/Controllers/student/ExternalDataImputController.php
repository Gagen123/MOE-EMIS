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
                    'remarks'                   => 'required',
                ];

                $customMessages = [
                    'collegeName.required'     => 'This field is required',
                    'dzongkhag.required'       => 'This field is required',
                    'institutes_type.required' => 'This field is required',
                    'remarks.required'         => 'This field is required',
                ];
                $this->validate($request, $rules, $customMessages);
                
                $data =[
                    'collegeName'           => $request->collegeName,
                    'dzongkhag'             => $request->dzongkhag,
                    'remarks'               => $request->remarks,
                    'action_type'           => $request->action_type,
                    'institutes_type'       => $request->institutes_type,
                    'type'                  => $request->type,
                    'user_id'               => $this->userId(),
                    'working_agency_id'     => $this->getWrkingAgencyId()
                ];
                $response_data= $this->apiService->createData('emis/students/ExternalDataImport/saveImported', $data);
                return $response_data;
            }
            if($request->type == "staff"){
                $data =[
                    'institutes_id'         => $request->institutes_id,
                    'type'                  => $request->type,
                    'action_type'           => $request->action_type,
                    'staff_form'            => $request->staff_form,
                    'user_id'               => $this->userId(),
                    'working_agency_id'     => $this->getWrkingAgencyId(),
                    'remarks'               => $request->remarks,
                ];
                $response_data= $this->apiService->createData('emis/students/ExternalDataImport/saveImported', $data);
                return $response_data;
            }
            if($request->type == "student"){
                $data =[
                    'institutes_id'         => $request->institutes_id,
                    'type'                  => $request->type,
                    'action_type'           => $request->action_type,
                    'student_form'          => $request->student_form,
                    'user_id'               => $this->userId(),
                    'working_agency_id'     => $this->getWrkingAgencyId(),
                    'remarks'               => $request->remarks,
                ];
                $response_data= $this->apiService->createData('emis/students/ExternalDataImport/saveImported', $data);
                return $response_data;
            }
            
    }
    public function loadInstitues($param=""){
        $loadData = $this->apiService->listData('emis/students/ExternalDataImport/loadInstitues/'.$param);
        return $loadData;

    }
}
