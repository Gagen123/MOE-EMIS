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
            'id'             =>  $request->id,
            'name'           =>  $request->name,
            'description'    =>  $request->description,
            'status'         =>  $request->status,
            'actiontype'     =>  $request->action_type,
            'recordtype'     =>  $request->record_type, 
            'user_id'        => $this->userId() 
        ];
        if($request->record_type == 'student_awards'){
            $additional_data = [
                'award_type_id' => $request->award_type_id,
                'program_id' => $request->program_id
            ];
            $data = $data + $additional_data;
        }

        if($request->record_type == 'training'){
            $additional_data = [
                'training_type_id' => $request->training_type_id,
                'program_id'       => $request->program_id
            ];
            $data = $data + $additional_data;
        } 

        if($request->record_type == 'program_role'){
            $additional_data = [
                'program' => $request->program,
                'assigned_to' => $request->assigned_to
            ];
            $data = $data + $additional_data;
        }

        if($request->record_type == 'program_name'){
            $additional_data = [
                'program_type' => $request->program_type
            ];
            $data = $data + $additional_data;
        }

        if($request->record_type == 'scout_section_level' || $request->record_type == 'scout_badge'){
            $additional_data = [
                'scout_type' => $request->scout_type
            ];
            $data = $data + $additional_data;
        }

        if($request->record_type == 'vaccine_type'){
            $additional_data = [
                'vaccineFor' => $request->vaccineFor
            ];
            $data = $data + $additional_data;
        }
        
        try{
            $response_data= $this->apiService->createData('emis/masters/students/saveStudentMasters', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
        
    }

    public function loadStudentMasters($param=""){
      //  dd('m here');
        $student_masters = $this->apiService->listData('emis/masters/students/loadStudentMasters/'.$param);
        return $student_masters;
    }

    public function loadActiveStudentMasters($param=""){
      //  dd('m here');
        $student_masters = $this->apiService->listData('emis/masters/students/loadActiveStudentMasters/'.$param);
        return $student_masters;
    }

    public function allActiveStudentDropdowns($model="",$parent_id=""){
        $response_data = $this->apiService->listData('emis/masters/students/allActiveStudentDropdowns/'.$model."/".$parent_id);
        return $response_data;
    }
    
}
