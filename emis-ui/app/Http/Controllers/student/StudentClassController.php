<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StudentClassController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveStudentClassAllocation(Request $request){
        
        // $rules = [
        //     'student'       => 'required',
        //     'class_given_by'=> 'required',
        //     'class_type_id' => 'required',
        //     'place'         => 'required',
        //     'date'          => 'required'
        // ];
        // $customMessages = [
        //     'student.required'          => 'This field is required',
        //     'class_given_by.required'   => 'This field is required',
        //     'class_type_id.required'    => 'This field is required',
        //     'place.required'            => 'This field is required',
        //     'date.required'             => 'This field is required',
        // ];
        // $this->validate($request, $rules, $customMessages);
        
        // $data =[
        //     'id'                => $request->id,
        //     'student'           =>  $request->student,
        //     'class_given_by'    =>  $request->class_given_by,
        //     'class_type_id'     =>  $request->class_type_id,
        //     'place'             =>  $request->place,
        //     'date'              =>  $request->date,
        //     'remarks'           =>  $request->remarks,
        //     'actiontype'        =>  $request->action_type,
        //     'recordtype'        =>  $request->record_type, 
        //     'user_id'           => $this->userId(),
        //     'working_agency_id' => $this->getWrkingAgencyId()
        //];
        $data = [];

        try{
            $response_data= $this->apiService->createData('emis/students/saveStudentClassAllocation', $data);
            return $response_data;
        }
        catch(GuzzleHttp\Exception\ClientException $e){
            return $e;
        }
        
    }

    public function loadStudentClassAllocations($param=""){
        $param = $this->getWrkingAgencyId();
        $student_class = $this->apiService->listData('emis/students/loadStudentClassAllocations/'.$param);
        return $student_class;
    }
}
