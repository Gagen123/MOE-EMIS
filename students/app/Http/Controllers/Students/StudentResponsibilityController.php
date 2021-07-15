<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Traits\ApiResponser;
use App\Models\Students\StudentRole;
use App\Models\Students\Student;
use Carbon\Carbon;

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
        $id = $request->id;
        if( $id != null){
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
                'StdStudentId'      =>  $request->student,
                'StdRoleId'         =>  $request->role_id,
                'Remarks'           =>  $request->remarks,
                // 'user_id'           => $this->user_id()
            ];
            $response_data = StudentRole::where('id', $id)->update( $data);
        }else{
            $rules = [
                'student'       => 'required',
                'role_id'       => 'required'
            ];
            $customMessages = [
                'student.required'          => 'This field is required',
                'role_id.required'          => 'This field is required'
            ];
            $this->validate($request, $rules, $customMessages);

            // $record_type = $request['record_type'];
            $exist=false;
            $check_data=StudentRole::where('StdStudentId',$request->student)->where('StdRoleId',$request->role_id)->first();
            if( $check_data!=null &&  $check_data!=""){
                $getyear = $check_data->date;
                $year = Carbon::createFromFormat('d/m/Y', $getyear)->format('Y');
                if($year==date('Y')){
                    $exist=true;
                    return "exist";
                }
            }
            if(!$exist){
                $data =[
                    'StdStudentId'      =>  $request->student,
                    'StdRoleId'         =>  $request->role_id,
                    'Remarks'           =>  $request->remarks,
                    'created_by'        => $request->user_id,
                    'created_at'        => date('Y-m-d h:i:s')
                ];
                $response_data = StudentRole::create( $data);
            }
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
                ->select('std_role_student.*', 'std_student.Name','std_student.OrgOrganizationId','std_role.name AS role_name')
                ->where('std_student.OrgOrganizationId', $id)
                ->get();

        return $this->successResponse($roles);

    }

    public function getAssignedTeacherRoles($param=""){

        $roles = DB::table('std_role_staff')->where('CeaSchoolProgrammeId', $param)->get();

        return $this->successResponse($roles);
    }

}
