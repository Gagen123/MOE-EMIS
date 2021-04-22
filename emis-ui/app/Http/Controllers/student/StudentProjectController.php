<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StudentProjectController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveStudentProject(Request $request){

        $rules = [
            'name'            => 'required',
            'place'            => 'required',
            'project_type_id'            => 'required',
            'program_id'            => 'required',
            'from_date'            => 'required',
            'to_date'               => 'required'
        ];

        $customMessages = [
            'name.required'  => 'This field is required',
            'place.required'     => 'This field is required',
            'project_type_id.required'  => 'This field is required',
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
            'project_type_id'            => $request->project_type_id,
            'program_id'           => $request->program_id,
            'from_date'                => $request->from_date,
            'to_date'          => $request->to_date,
            'description'          => $request->description,

            //'user_id'        => $this->user_id() 
        ];


        try{
            $response_data= $this->apiService->createData('emis/students/saveStudentProject', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    /*
    * Function is to list projects for drop down
    */

    public function listStudentProjects($param=""){
        $student_records = $this->apiService->listData('emis/students/listStudentProjects/'.$param);
        return $student_records;
    }

    /*
    * Save Project Members
    */

    public function saveProjectMembers(Request $request){

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
            'project'             => $request->project,
            'task'             => $request->task

            //'user_id'        => $this->user_id() 
        ];


        try{
            $response_data= $this->apiService->createData('emis/students/saveProjectMembers', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
    }

    public function listProjectMembers($param=""){
        $student_records = $this->apiService->listData('emis/students/listProjectMembers/'.$param);
        return $student_records;
    }
}
