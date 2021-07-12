<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StudentDisciplinaryController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function addStudentRecord(Request $request){
        
        $rules = [
            'student'               => 'required',
            'offence_type'          => 'required',
            'date'                  => 'required',
            'severity'              => 'required',
            'action_taken'          => 'required',
            'offence_description'   => 'required',
            'remarks'               => 'required',
        ];

        $customMessages = [
            'student.required'                      => 'This field is required',
            'offence_type.required'                 => 'This field is required',
            'date.required'                         => 'This field is required',
            'severity.required'                     => 'This field is required',
            'action_taken.required'                 => 'This field is required',
            'offence_description.required'          => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'                    => $request->id,
            'student'               => $request->student,
            'offence_type'          => $request->offence_type,
            'date'                  => $request->date,
            'severity'              => $request->severity,
            'action_taken'          => $request->action_taken,
            'offence_description'   => $request->offence_description,
            'remarks'               => $request->remarks,
            'action_type'           => $request->action_type,
            'user_id'               => $this->userId(),
            'working_agency_id'     => $this->getWrkingAgencyId()
        ];

        try{
            $response_data= $this->apiService->createData('emis/students/addStudentRecord', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
        
    }

    public function loadStudentRecords($param=""){
        $param = $this->getWrkingAgencyId();
        $student_records = $this->apiService->listData('emis/students/loadStudentRecords/'.$param);
        return $student_records;
    }

    
}
