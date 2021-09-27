<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\Student;
use App\Models\Students\CeaProject;
use App\Models\Students\CeaProjectMember;


class StudentProjectController extends Controller
{
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function saveStudentProject(Request $request){
        
        $id = $request->id;
        if( $id != null){
        $rules = [
            'name'                  => 'required',
            'place'                 => 'required',
            'project_type_id'       => 'required',
            'from_date'             => 'required',
            'to_date'               => 'required'
        ];
        $customMessages = [
            'name.required'                     => 'This field is required',
            'place.required'                    => 'This field is required',
            'project_type_id.required'          => 'This field is required',
            'from_date.required'                => 'This field is required',
            'to_date.required'                  => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'OrgOrganizationId'     => $request->organizationId,
            'CeaProjectTypeId'      => $request->project_type_id,
            'name'                  => $request->name,
            'CeaProgrammeId'        => $request->program_id,
            'FromDate'              => $request->from_date,
            'ToDate'                => $request->to_date,
            'Place'                 => $request->place,
            'Description'           => $request->description,
            'Status'                => 1
        ];
       
        $response_data = CeaProject::where('id', $id)->update($data);
        }else {
            $rules = [
                'name'            => 'required',
                'place'            => 'required',
                'project_type_id'            => 'required',
                'from_date'            => 'required',
                'to_date'               => 'required'
            ];
            $customMessages = [
                'name.required'  => 'This field is required',
                'place.required'     => 'This field is required',
                'project_type_id.required'  => 'This field is required',
                'from_date.required'  => 'This field is required',
                'to_date.required'     => 'This field is required',
            ];
            $this->validate($request, $rules, $customMessages);


            $data =[
                'OrgOrganizationId'     => $request->organizationId,
                'CeaProjectTypeId'      => $request->project_type_id,
                'name'                  => $request->name,
                'CeaProgrammeId'        => $request->program_id,
                'FromDate'              => $request->from_date,
                'ToDate'                => $request->to_date,
                'Place'                 => $request->place,
                'Description'           => $request->description,
                'Status'                => 1
            ];

            $response_data = CeaProject::create($data);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    /*
    * Function is to list projects for drop down
    */

    public function listStudentProjects($param=""){
        $org_id = $param;
        $records = DB::table('cea_project')
                ->join('cea_project_type', 'cea_project.CeaProjectTypeId', '=', 'cea_project_type.id')
                ->leftjoin('cea_programme', 'cea_project.CeaProgrammeId', '=', 'cea_programme.id')
                ->select('cea_project.*', 'cea_project_type.name AS project_type', 'cea_programme.name AS program_name')
                ->where('cea_project.OrgOrganizationId', $org_id)
                ->get();

        return $this->successResponse($records);
    }

    /*
    * Save Project Members
    */

    public function saveProjectMembers(Request $request){
        $id = $request->id;
        if( $id != null){
            $rules = [
             'student'            => 'required',
             'project'            => 'required',
             'task'               => 'required',
            ];

            $customMessages = [
             'student.required'      => 'This field is required',
             'project.required'      => 'This field is required',
             'task.required'         => 'This field is required',
            ];
         $this->validate($request, $rules, $customMessages);
         $data =[
             'id'                    => $request->id,
             'StdStudentId'          => $request->student,
             'CeaProjectId'          => $request->project,
             'Task'                  => $request->task,
             'updated_by'            => $request->user_id,
             'updated_at'            =>  date('Y-m-d h:i:s')
            ];
            $response_data = CeaProjectMember::where('id', $id)->update($data);
        }else{
            $rules = [
                'student'            => 'required',
                'project'            => 'required',
                'task'               => 'required',
            ];
    
            $customMessages = [
                'student.required'      => 'This field is required',
                'project.required'      => 'This field is required',
                'task.required'         => 'This field is required',
            ];
            $this->validate($request, $rules, $customMessages);
            
            $data =[
                'id'                    => $request->id,
                'StdStudentId'          => $request->student,
                'CeaProjectId'          => $request->project,
                'Task'                  => $request->task,
                'created_by'            => $request->user_id,
                'created_at'            =>  date('Y-m-d h:i:s')
    
                //'user_id'        => $this->user_id() 
            ];
            $response_data = CeaProjectMember::create($data);
           
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    /**
     * List the Project Members
     */

    public function listProjectMembers($param){
        parse_str($param, $class_details);

        $records = DB::table('cea_project_membership')
                ->join('cea_project', 'cea_project.id', '=', 'cea_project_membership.CeaProjectId')
                ->join('std_student', 'cea_project_membership.StdStudentId', '=', 'std_student.id')
                ->join('std_student_class_stream', 'std_student.id', '=', 'std_student_class_stream.StdStudentId') 
                ->select('cea_project.name AS project_name', 'cea_project_membership.*','std_student.Name AS student_name',
                            'std_student.student_code AS student_code', 'cea_project_membership.Task AS Task')
                ->whereIn('std_student_class_stream.OrgClassStreamId',$class_details['org_class_stream_id']) 
                ->whereIn('std_student_class_stream.SectionDetailsId',$class_details['section_id']) 
                ->get();

        return $this->successResponse($records);
    }
}
