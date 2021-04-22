<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\Student;

class StudentProgramController extends Controller
{
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function saveStudentProgram(Request $request){
        $rules = [
            'program'            => 'required',
            'supporter'            => 'required',
            'year'            => 'required',
            'roles'            => 'required',
        ];

        $customMessages = [
            'program.required'  => 'This field is required',
            'supporter.required'     => 'This field is required',
            'year.required'  => 'This field is required',
            'roles.required'     => 'Assign a role',
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

        $response_data = CeaProgram::create($data);

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    /*
    * Function is to list Programs for drop down
    */

    public function listStudentPrograms($param=""){
        $id ="1";

        $records = DB::table('cea_project')
                ->join('cea_project_type', 'cea_project.CeaProjectTypeId', '=', 'cea_project_type.id')
                ->join('cea_programme', 'cea_project.CeaProgrammeId', '=', 'cea_programme.id')
                ->select('cea_project.*', 'cea_project_type.name AS project_type', 'cea_programme.name AS program_name')
                ->get();

        return $this->successResponse($records);
    }

    /*
    * Save Program Members
    */

    public function saveProgramMembers(Request $request){

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
            'StdStudentId'          => $request->student,
            'CeaProjectId'             => $request->project,
            'Task'             => $request->task

            //'user_id'        => $this->user_id() 
        ];

        $response_data = CeaProgramMembership::create($data);

        return $this->successResponse($response_data, Response::HTTP_CREATED);

        
    }

    /*
    * Function is to list Programs members
    */

    public function listProgramMembers($param=""){
        $id ="1";

        $records = DB::table('cea_project_membership')
                ->join('std_student', 'cea_project_membership.StdStudentId', '=', 'std_student.id')
                ->join('cea_project', 'cea_project_membership.CeaProjectId', '=', 'cea_project.id')
                ->join('cea_programme', 'cea_project.CeaProgrammeId', '=', 'cea_programme.id')
                ->select('cea_project_membership.*', 'cea_project.name AS project_name', 'std_student.Name AS student_name', 'cea_programme.name AS program_name')
                ->get();

        return $this->successResponse($records);
    }
}
