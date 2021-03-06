<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StudentAwardController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveStudentAward(Request $request){
        
        $rules = [
            'student'       => 'required',
            'award_given_by'=> 'required',
            'award_type_id' => 'required',
            'place'         => 'required',
            'date'          => 'required'
        ];
        $customMessages = [
            'student.required'          => 'This field is required',
            'award_given_by.required'   => 'This field is required',
            'award_type_id.required'    => 'This field is required',
            'place.required'            => 'This field is required',
            'date.required'             => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        
        $data =[
            'id'                => $request->id,
            'student'           =>  $request->student,
            'award_given_by'    =>  $request->award_given_by,
            'award_type_id'     =>  $request->award_type_id,
            'place'             =>  $request->place,
            'date'              =>  $request->date,
            'remarks'           =>  $request->remarks,
            'actiontype'        =>  $request->action_type,
            'recordtype'        =>  $request->record_type, 
            'user_id'           => $this->userId(),
            'working_agency_id' => $this->getWrkingAgencyId()
        ];
    //  dd(  $data );
      //  try{

        // try{
            $response_data= $this->apiService->createData('emis/students/saveStudentAward', $data);
            return $response_data;
        // }
        // catch(GuzzleHttp\Exception\ClientException $e){
        //     return $e;
        // }
        
    }
    
    public function loadStudentAwards($param=""){
        $orgId = $this->getWrkingAgencyId();
        $staffId = $this->staffId();
        $class_teacher_class =  $this->apiService->listData('emis/academics/getClassTeacherClasss/'.$orgId.'/'.$staffId);
        $data_parameters = [];
        foreach(json_decode($class_teacher_class) as $details){
            foreach($details as $value){
                $data_parameters['org_class_stream_id'][] = $value->org_class_stream_id;
                $data_parameters['stream_id'][] =  $value->org_stream_id;
                $data_parameters['section_id'][] = $value->org_section_id;
            }
        }
        $param = http_build_query($data_parameters);
        $student_awards = $this->apiService->listData('emis/students/loadStudentAwards/'.$param);
        return $student_awards;
    }
}
