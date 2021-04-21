<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\Student;
use App\Models\Students\CeaProject;
use App\Models\Students\CeaProjectMembership;


class StudentProjectController extends Controller
{
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
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
            'Place'             => $request->place,
            'CeaProjectTypeId'            => $request->project_type_id,
            'CeaProgrammeId'           => $request->program_id,
            'FromDate'                => $request->from_date,
            'ToDate'          => $request->to_date,
            'Description'          => $request->description,
            'Status' => '1',
            'OrgOrganizationId' => '1'

            //'user_id'        => $this->user_id() 
        ];

        $response_data = CeaProject::create($data);

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    /*
    * Function is to list projects for drop down
    */

    public function listStudentProjects($param=""){
        $id ="1";

        $records = DB::table('cea_project')
                ->join('cea_project_type', 'cea_project.CeaProjectTypeId', '=', 'cea_project_type.id')
                ->join('cea_programme', 'cea_project.CeaProgrammeId', '=', 'cea_programme.id')
                ->select('cea_project.*', 'cea_project_type.name AS project_type', 'cea_programme.name AS program_name')
                ->get();

        return $this->successResponse($records);
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
            'StdStudentId'          => $request->student,
            'CeaProjectId'             => $request->project,
            'Task'             => $request->task

            //'user_id'        => $this->user_id() 
        ];

        $response_data = CeaProjectMembership::create($data);

        return $this->successResponse($response_data, Response::HTTP_CREATED);

        
    }
}