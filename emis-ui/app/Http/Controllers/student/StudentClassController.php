<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StudentClassController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveStudentClassAllocation(Request $request){
        //array validation is need
        
        $data =[
            'id'                            => $request->id,
            'class_section_stream'          =>  $request->class_section_stream,
            'user_id'                       => $this->userId(),
            'working_agency_id'             => $this->getWrkingAgencyId()
        ];

        try{
            $response_data= $this->apiService->createData('emis/students/saveStudentClassAllocation', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
        
    }

    public function loadStudentClassAllocations($param=""){
        $param = $this->getWrkingAgencyId();
        $student_class = $this->apiService->listData('emis/students/loadStudentClassAllocations/'.$param);
        return $student_class;
    }
}
