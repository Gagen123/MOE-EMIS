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
            'student'           =>  $request->student,
            'role_id'           =>  $request->role_id,
            'remarks'           =>  $request->remarks,
            //'user_id'           => $this->user_id() 
        ];

        try{
            $response_data= $this->apiService->createData('emis/students/saveStudentResponsibility', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
        
    }

    public function loadStudentResponsibilities($param=""){
        $student_roles = $this->apiService->listData('emis/students/loadStudentResponsibilities/'.$param);
        return $student_roles;
    }
}
