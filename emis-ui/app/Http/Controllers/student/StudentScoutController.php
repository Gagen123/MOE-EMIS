<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StudentScoutController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveStudentScouts(Request $request){
        
        $rules = [
            'scout'       => 'required',
            'year'       => 'required'
        ];
        $customMessages = [
            'scout.required'          => 'This field is required',
            'year.required'          => 'This field is required'
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'                => $request->id,
            'scout'           =>  $request->scout,
            'year'           =>  $request->year,
            'remarks'           =>  $request->remarks,
            'action_type'       => $request->action_type,
            'user_id'           => $this->userId(),
            'working_agency_id' => $this->getWrkingAgencyId()
        ];

        try{
            $response_data= $this->apiService->createData('emis/students/saveStudentScouts', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
        
    }

    public function loadStudentScouts($param=""){
        $param = $this->getWrkingAgencyId();
        
        $student_roles = $this->apiService->listData('emis/students/loadStudentScouts/'.$param);
        return $student_roles;
    }

    public function listStudentScouts($param=""){
        $param = $this->getWrkingAgencyId();
        $assigned_roles = $this->apiService->listData('emis/students/listStudentScouts/'.$param);
        return $assigned_roles;
    }

    public function saveScoutParticipants(Request $request){

        $rules = [
            'student'       => 'required',
            'scout'       => 'required',
            'date'          => 'required'
        ];
        
        $customMessages = [
            'student.required'          => 'This field is required',
            'scout.required'          => 'This field is required',
            'date.required'          => 'This field is required'
        ];

        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'                => $request->id,
            'student'           =>  $request->student,
            'scout'           =>  $request->scout,
            'date'           =>  $request->date,
            'action_type'       => $request->action_type,
            'user_id'           => $this->userId(),
            'working_agency_id' => $this->getWrkingAgencyId()
        ];

        try{
            $response_data= $this->apiService->createData('emis/students/saveScoutParticipants', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function loadScoutMembers($param=""){
        $param = $this->getWrkingAgencyId();
        $assigned_roles = $this->apiService->listData('emis/students/loadScoutMembers/'.$param);
        return $assigned_roles;
    }
}