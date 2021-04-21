<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StudentProgramController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveStudentProgram(Request $request){

        $rules = [
            'name'            => 'required',
            'place'            => 'required',
            'program_type_id'            => 'required',
            'program_id'            => 'required',
            'from_date'            => 'required',
            'to_date'               => 'required'
        ];

        $customMessages = [
            'name.required'  => 'This field is required',
            'place.required'     => 'This field is required',
            'program_type_id.required'  => 'This field is required',
            'program_id.required'     => 'This field is required',
            'from_date.required'  => 'This field is required',
            'to_date.required'     => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'               => $request->id,
            'name'          => $request->name,
            'date'             => $request->date,
            'place'             => $request->place,
            'program_type_id'            => $request->Program_type_id,
            'program_id'           => $request->program_id,
            'from_date'                => $request->from_date,
            'to_date'          => $request->to_date,
            'description'          => $request->description,

            //'user_id'        => $this->user_id() 
        ];


        try{
            $response_data= $this->apiService->createData('emis/students/saveStudentProgram', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    /*
    * Function is to list Programs for drop down
    */

    public function listStudentPrograms($param=""){
        $student_records = $this->apiService->listData('emis/students/listStudentPrograms/'.$param);
        return $student_records;
    }

    /*
    * Save Program Members
    */

    public function saveProgramMembers(Request $request){

        $rules = [
            'student'            => 'required',
            'program'            => 'required',
            'task'            => 'required',
        ];

        $customMessages = [
            'student.required'  => 'This field is required',
            'program.required'     => 'This field is required',
            'task.required'  => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'               => $request->id,
            'student'          => $request->student,
            'program'             => $request->program,
            'task'             => $request->task

            //'user_id'        => $this->user_id() 
        ];


        try{
            $response_data= $this->apiService->createData('emis/students/saveProgramMembers', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }
}
