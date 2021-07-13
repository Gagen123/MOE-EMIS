<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StudentTrainingController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveStudentTraining(Request $request){
        $rules = [
            'name'            => 'required',
            'training_type'   => 'required',
            'program'         => 'required',
            'place'           => 'required',
            'country'         => 'required',
            'from_date'       => 'required | date',
            'to_date'         =>  'required | date | after:from_date',
        ];
        $customMessages = [
            'name.required'             => 'This field is required',
            'place.required'            => 'This field is required',
            'training_type.required'    => 'This field is required',
            'program.required'          => 'This field is required',
            'country.required'          => 'This field is required',
            'from_date.required'        => 'This field is required',
            'to_date.required'          => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $data =[
            'id'                =>$request->id,
            'form_type'         =>$request->form_type,
            'name'              => $request->name,
            'place'             => $request->place,
            'training_type'     => $request->training_type,
            'program'           => $request->program,
            'country'           => $request->country,
            'from_date'         => $request->from_date,
            'to_date'           => $request->to_date,
            'details'           => $request->details,
            'user_id'           => $this->userId(),
            'org_id'            => $this->getWrkingAgencyId() 
        ];
            $response_data= $this->apiService->createData('emis/students/saveStudentTraining', $data);
            return $response_data;
    }
    /*
    * Function is to list Trainings for drop down
    */
    public function listStudentTrainings($param=""){
        $orgId = $this->getWrkingAgencyId();
        $student_records = $this->apiService->listData('emis/students/listStudentTrainings/'.$param.'/'.$orgId);
        return $student_records;
    }
    /*
    * Save Training Members
    */
    public function saveTrainingParticipants(Request $request){
        $rules = [
            'training_id' => 'required',
        ];

        $customMessages = [
            'training_id.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $data =[
            'id'          => $request->id,
            'form_type'   =>$request->form_type,
            'training_id' => $request->training_id,
            'student_id'  => $request->student_id,
            'participant' => $request->participant,
            'remarks'     => $request->remarks,
            'user_id'     => $this->userId(),
            'org_id'      => $this->getWrkingAgencyId() 
        ];
        try{
            $response_data= $this->apiService->createData('emis/students/saveTrainingParticipants', $data);
            return $response_data;
        }
        catch(\GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }
    public function listTrainingParticipants($param=""){
        $orgId = $this->getWrkingAgencyId();
        $student_records = $this->apiService->listData('emis/students/listTrainingParticipants/'.$param.'/'.$orgId);
        return $student_records;
    }
}
