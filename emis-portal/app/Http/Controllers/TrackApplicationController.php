<?php

namespace App\Http\Controllers;
use App\Helper\EmisService;
use Illuminate\Http\Request;

class TrackApplicationController extends Controller
{
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    

    public function applicationListsbyCid($cid=""){
        $response_data= $this->apiService->listData('emis/students/admission/applicationListsbyCid/' .$cid);
        return $response_data;
    }

    public function acceptApplication(Request $request){
        $request_data=[
                'id' =>$request->id,
                'type'=>$request->type,
            ];
            // dd($request->id);
        $response_data= $this->apiService->createData('emis/students/admission/acceptApplication', $request_data);
        return $response_data;
    }
    
    /**
     * Get the application details by id
     * Checks the std_admissions table if type is new admission
     * Checks std_student table if the type is student
     */

    public function getApplicationDetails($type="", $id=""){
        $application_data = $this->apiService->listData('emis/students/admission/getApplicationDetails/'.$type.'/'.$id);
        return $application_data;
    }

}
