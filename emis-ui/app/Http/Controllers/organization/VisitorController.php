<?php

namespace App\Http\Controllers\organization;

use Session;
// use Redirect;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\AuthUser;
use Illuminate\Support\Facades\Storage;

class VisitorController extends Controller
{
    use AuthUser;
    use ServiceHelper;
    public $apiService;

    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveVisitorInformation(Request $request){
        $rules = [
            'visitorname'                   =>  'required',
            'designation'                   =>  'required',
            'contact'                       =>  'required',
            'minitsryOrAgency'              =>  'required',
            'noOfhours'                     =>  'required',
            'date'                          =>  'required',
            'targetgroup'                   =>  'required',
            'deptOrdivision'                =>  'required',
            'purposeOfvisit'                =>  'required',
        ];

        $customMessages = [
            'visitor_information.required'           => 'This is required',
            'visitorname.required'                   =>  'This is required',
            'designation.required'                   =>  'This is required',
            'contact.required'                       =>  'This is required',
            'minitsryOrAgency.required'              =>  'This is required',
            'noOfhours.required'                     =>  'This is required',
            'date.required'                          =>  'This is required',
            'targetgroup.required'                   =>  'This is required',
            'deptOrdivision.required'                =>  'This is required',
            'purposeOfvisit.required'                =>  'This is required',
        ];

        $this->validate($request, $rules, $customMessages);

        $data =[
            'organizationId'            =>  $this->getWrkingAgencyId(),
            'visitorname'               =>  $request['visitorname'],
            'designation'               =>  $request['designation'],
            'contact'                   =>  $request['contact'],
            'minitsryOrAgency'          =>  $request['minitsryOrAgency'],
            'noOfhours'                 =>  $request['noOfhours'],
            'targetgroup'               =>  $request['targetgroup'],
            'deptOrdivision'            =>  $request['deptOrdivision'],
            'purposeOfvisit'            =>  $request['purposeOfvisit'],
            'date'                      =>  $request['date'],
            'user_id'                   =>  $this->userId(),
            'id'                        =>  $request['id'],
        ];
       // dd($data);
    
            $response_data= $this->apiService->createData('emis/organization/visitor/saveVisitorInformation', $data);
            return $response_data;
    }

    public function loadVisitorInformation(){ 
        $orgId=$this->getWrkingAgencyId();
        $data = $this->apiService->listData('emis/organization/visitor/loadVisitorInformation/'.$orgId);
        return $data;
    }

    public function getVisitorTypeDropdown(){
     
        $data = $this->apiService->listData('emis/organization/visitor/getVisitorTypeDropdown');
        return $data;
    }

    public function getVisitorDetails($visId=""){
        $data = $this->apiService->listData('emis/organization/visitor/getVisitorDetails/'.$visId);
        return $data;
    }

}
