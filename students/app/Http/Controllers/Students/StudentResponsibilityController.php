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
        
        $data =[
            'id'                => $request->id,
            'StdStudentId'           =>  $request->student,
            'StdRoleId'     =>  $request->role_id,
            'Remarks'           =>  $request->remarks,
            //'user_id'           => $this->user_id() 
        ];
        
        $response_data = StudentRole::create($data);

        return $this->successResponse($response_data, Response::HTTP_CREATED);
        
    }

    /**
     * method to list students roles
    */

    public function loadStudentResponsibilities($param=""){

        $id ="2fea1ad2-824b-434a-a608-614a482e66c1";

        $roles = DB::table('std_role_student')
                ->join('std_student', 'std_role_student.StdStudentId', '=', 'std_student.id')
                ->join('std_role', 'std_role_student.StdRoleId', '=', 'std_role.id')
                ->select('std_role_student.*', 'std_student.Name','std_role.name AS role_name')
                ->get();
        
        return $this->successResponse($roles);

    }

    /**
     * Function to insert data into the respective tables
     */

    private function updateData($dataRequest, $databaseModel){

        $modelName = "App\\Models\\Masters\\"."$databaseModel"; 
        $model = new $modelName();

        $data = $model::find($dataRequest['id']);

        //Audit Trails
        // $msg_det='name:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
        // $procid=DB::select("CALL system_db.emis_audit_proc('".$this->database."','master_working_agency','".$request['id']."','".$msg_det."','".$request->input('user_id')."','Edit')");
        
        //data to be updated
        $data->name = $dataRequest['name'];
        $data->description = $dataRequest['description'];
        $data->status = $dataRequest['status'];
        $data->updated_by = $dataRequest['created_by'];
        $data->updated_at = date('Y-m-d h:i:s');
        $data->update();
        
        return $data;

    }    
}
