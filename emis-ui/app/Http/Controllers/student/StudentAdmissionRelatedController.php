<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StudentAdmissionRelatedController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function reportStudents(Request $request){
        
        $rules = [
            'date'               => 'required'
        ];

        $customMessages = [
            'date.required'     => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'               => $request->id,
            'date'             => $request->date,
            'std_class'             => $request->std_class,
            'std_stream'            => $request->std_stream,
            'std_section'           => $request->std_section,
            'std_id'                => $request->std_id,
            'std_reported'          => $request->std_reported,
            'user_id'           => $this->userId(),
            'working_agency_id' => $this->getWrkingAgencyId()
        ];

        try{
            $response_data= $this->apiService->createData('emis/students/reportStudents', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
        
    }

    public function saveStudentTransfer(Request $request){
        
        $rules = [
            'student'               => 'required',
            'last_class_attended'               => 'required',
            'date'               => 'required',
            'reasons'               => 'required'
        ];

        $customMessages = [
            'student.required'     => 'This field is required',
            'last_class_attended.required'     => 'This field is required',
            'date.required'     => 'This field is required',
            'reasons.required'     => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'               => $request->id,
            'date'             => $request->date,
            'student'             => $request->student,
            'last_class_attended'             => $request->last_class_attended,
            'action_type'       => $request->action_type,
            'reasons'            => $request->reasons,
            'user_id'           => $this->userId(),
            'working_agency_id' => $this->getWrkingAgencyId()
        ];

        try{
            $response_data= $this->apiService->createData('emis/students/saveStudentTransfer', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
        
    }

    public function loadStudentTransfers($param=""){
        $student_awards = $this->apiService->listData('emis/students/loadStudentTransfers/'.$param);
        return $student_awards;
    }

    public function saveStudentWhereabouts(Request $request){
        
        $rules = [
            'student'               => 'required',
            'last_class_attended'               => 'required',
            'date'               => 'required',
            'reasons'               => 'required',
            'current_engagement'    => 'required',
            'current_address'       => 'required'
        ];

        $customMessages = [
            'student.required'     => 'This field is required',
            'last_class_attended.required'     => 'This field is required',
            'date.required'     => 'This field is required',
            'reasons.required'     => 'This field is required',
            'current_engagement.required'     => 'This field is required',
            'current_address.required'     => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'               => $request->id,
            'date'             => $request->date,
            'student'             => $request->student,
            'last_class_attended'             => $request->last_class_attended,
            'action_type'       => $request->action_type,
            'reasons'            => $request->reasons,
            'current_engagement'    => $request->current_engagement,
            'current_address'       => $request->current_address,
            'user_id'           => $this->userId(),
            'working_agency_id' => $this->getWrkingAgencyId()
        ];

        try{
            $response_data= $this->apiService->createData('emis/students/saveStudentWhereabouts', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
        
    }

    public function loadStudentWhereabouts($param=""){
        $student_awards = $this->apiService->listData('emis/students/loadStudentWhereabouts/'.$param);
        return $student_awards;
    }
}
