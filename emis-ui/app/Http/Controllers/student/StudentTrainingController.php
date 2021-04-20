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
            'program_id'      => 'required',
            'place'           => 'required',
            'country'         => 'required',
            'from_date'       => 'required',
            'to_date'         => 'required'
        ];

        $customMessages = [
            'name.required'         => 'This field is required',
            'place.required'        => 'This field is required',
            'training_type.required'        => 'This field is required',
            'program_id.required'        => 'This field is required',
            'country.required'      => 'This field is required',
            'from_date.required'    => 'This field is required',
            'to_date.required'      => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'                => $request->id,
            'name'              => $request->name,
            'place'             => $request->place,
            'training_type'     => $request->training_type,
            'program_id'        => $request->program_id,
            'country'           => $request->country,
            'from_date'         => $request->from_date,
            'to_date'           => $request->to_date,
            'details'           => $request->details,

            //'user_id'        => $this->user_id() 
        ];
        
        $this->validate($request, $rules, $customMessages);

        try{
            $response_data= $this->apiService->createData('emis/students/saveStudentTraining', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    /*
    * Function is to list Trainings for drop down
    */

    public function listStudentTrainings($param=""){
        $student_records = $this->apiService->listData('emis/students/listStudentTrainings/'.$param);
        return $student_records;
    }

    /*
    * Save Training Members
    */

    public function saveTrainingParticipants(Request $request){

        $rules = [
            'student'            => 'required',
            'project'            => 'required',
            'task'            => 'required',
        ];

        $customMessages = [
            'student.required'  => 'This field is required',
            'project.required'     => 'This field is required',
            'task.required'  => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'               => $request->id,
            'student'          => $request->student,
            'project'          => $request->project,
            'task'             => $request->task

            //'user_id'        => $this->user_id() 
        ];


        try{
            $response_data= $this->apiService->createData('emis/students/saveTrainingParticipants', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }
}
