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
            'visitor_information'          =>  'required',
            'date'          =>  'required',
            'remarks'      =>  'required',
        ];

        $customMessages = [
            'visitor_information.required'         => 'This is required',
            'date.required'         => 'Date is required',
            'remarks.required'     => 'Remarks is required',
        ];

        $this->validate($request, $rules, $customMessages);

        $data =[
            'organizationId'            =>  $this->getWrkingAgencyId(),
            'visitor_information'       =>  $request['visitor_information'],
            'date'                      =>  $request['date'],
            'remarks'                  =>  $request['remarks'],
            'user_id'                   =>  $this->userId()
        ];
    
            $response_data= $this->apiService->createData('emis/organization/visitor/saveVisitorInformation', $data);
            return $response_data;
    }

    public function loadVisitorInformation(){
        $orgId=$this->getWrkingAgencyId();
        $data = $this->apiService->listData('emis/organization/visitor/loadVisitorInformation/'.$orgId);
        return $data;
    }

}
