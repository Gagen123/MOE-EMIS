<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Traits\AuthUser;

class StudentCounsellingController extends Controller
{
    //
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    public function getCounsellingTypeDropdown(){
       // dd('from UI');
        $data = $this->apiService->listData('emis/students/getCounsellingTypeDropdown');
        return $data;
    }

    public function saveCounsellingInformation(Request $request){
        
        $rules = [
            'counselling_type'               => 'required',
            'number'                         => 'required',
           
        ];

        $customMessages = [
            'counselling_type.required'             => 'This field is required',
            'number.required'                       => 'This field is required',
           
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'                    => $request['id'],
            'counselling_type'      => $request['counselling_type'],
            'number'                => $request['number'],
            'remarks'               => $request['remarks'],
            'user_id'               => $this->userId(),
            'working_agency_id'     => $this->getWrkingAgencyId()
        ];
      //  dd($data);
        try{
            $response_data= $this->apiService->createData('emis/students/saveCounsellingInformation', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }
    public function loadCounsellingInformation(){ 
        $orgId=$this->getWrkingAgencyId();
       // dd('from UI');
        $data = $this->apiService->listData('emis/students/loadCounsellingInformation/'.$orgId);
        return $data;
    }

    public function getCounsellingDetails($couId=""){
        $data = $this->apiService->listData('emis/students/getCounsellingDetails/'.$couId);
        return $data;
    }
}
