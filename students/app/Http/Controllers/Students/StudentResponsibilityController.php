<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\StudentRole;
use App\Models\Students\Student;

class StudentResponsibilityController extends Controller
{
    use ApiResponser;
    public $database="emis_student_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    /** 
     * method to save or update student awards
    */

    public function saveStudentResponsibility(Request $request){
        
        $rules = [
            'student'       => 'required',
            'role_id'       => 'required'
        ];
        $customMessages = [
            'student.required'          => 'This field is required',
            'role_id.required'          => 'This field is required'
        ];
        $this->validate($request, $rules, $customMessages);

        $record_type = $request['record_type'];
        
        $data =[
            'id'                => $request->id,
            'StdStudentId'           =>  $request->student,
            'StdRoleId'     =>  $request->role_id,
            'Remarks'           =>  $request->remarks,
            //'user_id'           => $this->user_id() 
        ];

        if($request->action_type=="add"){
            $response_data = StudentRole::create($data);

        } else if($request->action_type=="edit"){

            //Audit Trails
            // $msg_det='name:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            // $procid=DB::select("CALL system_db.emis_audit_proc('".$this->database."','master_working_agency','".$request['id']."','".$msg_det."','".$request->input('user_id')."','Edit')");

            $app_data = [
                'StdStudentId' => $request['student'],
                'StdRoleId' => $request['role_id'],
                'Remarks' => $request['remarks']
            ];

            StudentRole::where('Id', $request['id'])->update($app_data);
        }

        return $this->successResponse($response_data, Response::HTTP_CREATED);
        
    }

    /**
     * method to list students roles
    */

    public function loadStudentResponsibilities($param=""){

        $id =$param;

        $roles = DB::table('std_role_student')
                ->join('std_student', 'std_role_student.StdStudentId', '=', 'std_student.id')
                ->join('std_role', 'std_role_student.StdRoleId', '=', 'std_role.id')
                ->select('std_role_student.*', 'std_student.Name','std_role.name AS role_name')
                ->get();
        
        return $this->successResponse($roles);

    }

    public function getAssignedTeacherRoles($param=""){
        
        $roles = DB::table('std_role_staff')->where('CeaSchoolProgrammeId', $param)->get();
        
        return $this->successResponse($roles);
    }
    
}
