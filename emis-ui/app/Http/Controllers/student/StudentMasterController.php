<?php

namespace App\Http\Controllers\student;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StudentMasterController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveStudentMasters(Request $request){
        
        $rules = [
            'name'          =>  'required'
        ];
        $customMessages = [
            'name.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'             => $request->id,
            'name'           =>  $request->name,
            'description'    =>  $request->description,
            'status'         =>  $request->status,
            'actiontype'     =>  $request->action_type,
            'recordtype'     =>  $request->record_type, 
            'user_id'        => $this->user_id() 
        ];

        try{
            $response_data= $this->apiService->createData('emis/masters/students/saveStudentMasters', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
        
    }

    public function loadStudentMasters($param=""){
        $student_masters = $this->apiService->listData('emis/masters/students/loadStudentMasters/'.$param);
        return $student_masters;
    }

    public function allActiveStudentDropdowns($model="",$parent_id=""){
        $response_data = $this->apiService->listData('emis/masters/students/allActiveStudentDropdowns/'.$model."/".$parent_id);
        return $response_data;
    }
    
}
