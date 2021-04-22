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
        dd($request);

        $rules = [
            'program'            => 'required',
            'supporter'            => 'required',
            'year'            => 'required',
        ];

        $customMessages = [
            'program.required'  => 'This field is required',
            'supporter.required'     => 'This field is required',
            'year.required'  => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'                => $request->id,
            'program'           => $request->program,
            'supporter'         => $request->supporter,
            'year'              => $request->year,
            'remarks'           => $request->remarks,
            'assigned_staff'    => $request->assigned_staff,
            'assigned_student'  => $request->assigned_student,

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


    /*
    * Save Program Inventory
    */

    public function saveProgramInventory(Request $request){

        dd($request);

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
