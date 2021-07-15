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
            'counselling_type'              => 'required',
            'age_range'                     => 'required',
            'class_range'                   => 'required',
            'female'                        => 'required',
            'male'                          => 'required',
           
        ];

        $customMessages = [
            'counselling_type.required'           => 'This field is required',
            'age_range.required'                  => 'This field is required',
            'class_range.required'                => 'This field is required',
            'female.required'                     => 'This field is required',
            'male.required'                       => 'This field is required',
           
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'                    => $request['id'],
            'counselling_type'      => $request['counselling_type'],
            'male'                  => $request['male'],
            'female'                => $request['female'],
            'age_range'             => $request['age_range'],
            'class_range'           => $request['class_range'],
            'remarks'               => $request['remarks'],
            'user_id'               => $this->userId(),
            'working_agency_id'     => $this->getWrkingAgencyId()
        ];
        
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
        $data = $this->apiService->listData('emis/students/loadCounsellingInformation/'.$orgId);
        return $data;
    }

    public function getCounsellingDetails($couId=""){
        $data = $this->apiService->listData('emis/students/getCounsellingDetails/'.$couId);
        return $data;
    }

    public function saveCounsellingProgram(Request $request){
        
        $rules = [
            'activities'              => 'required',
            'issues'                  => 'required'
           
        ];

        $customMessages = [
            'activities.required'           => 'This field is required',
            'issues.required'               => 'This field is required'
           
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'                    => $request['id'],
            'activities'            => $request['activities'],
            'issues'                => $request['issues'],
            'user_id'               => $this->userId(),
            'working_agency_id'     => $this->getWrkingAgencyId()
        ];
        
        try{
            $response_data= $this->apiService->createData('emis/students/saveCounsellingProgram', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadCounsellingProgram(){ 
        $orgId=$this->getWrkingAgencyId();
        $data = $this->apiService->listData('emis/students/loadCounsellingProgram/'.$orgId);
        return $data;
    }
}
