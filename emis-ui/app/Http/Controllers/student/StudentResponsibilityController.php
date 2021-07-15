<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StudentResponsibilityController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveStudentResponsibility(Request $request){
        //First - check the basic validation of the forms
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
            'id'                =>  $request->id,
            'student'           =>  $request->student,
            'role_id'           =>  $request->role_id,
            'remarks'           =>  $request->remarks,
            'action_type'       =>  $request->action_type,
            'data_type'         =>  'roles_responsibilities',
            'user_id'           =>  $this->userId(),
            'working_agency_id' =>  $this->getWrkingAgencyId()
        ];

        //Validate to ensure that there is no duplication of entries
        //Not creating but using the createData service as we are sending the $data
        $validate_data=null;
        if($request->action_type=='add'){
            $validate_data= $this->apiService->createData('emis/students/validateStudentData', $data);
        }
        // if($validate_data!=null && json_decode($validate_data)->data == 'exist'){
        //     //this is to offset the data and send it back to the view
        //     $request->offsetUnset('role_id');

        //     $rules = [
        //         'student'       => 'required',
        //         'role_id'       => 'required'
        //     ];
        //     $customMessages = [
        //         'student.required'          => 'This field is required',
        //         'role_id.required'          => 'Duplication of Roles for Student'
        //     ];

        //     $this->validate($request, $rules, $customMessages);
        // }
            $response_data= $this->apiService->createData('emis/students/saveStudentResponsibility', $data);
            return $response_data;
    }

    public function loadStudentResponsibilities($param=""){
        $param = $this->getWrkingAgencyId();
        $student_roles = $this->apiService->listData('emis/students/loadStudentResponsibilities/'.$param);
        return $student_roles;
    }

    public function getAssignedTeacherRoles($param=""){
        $assigned_roles = $this->apiService->listData('emis/students/getAssignedTeacherRoles/'.$param);
        return $assigned_roles;
    }
}
