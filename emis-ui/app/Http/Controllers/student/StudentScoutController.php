<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class StudentScoutController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function saveStudentScouts(Request $request){
        $rules = [
            'scout'       => 'required',
            'year'       => 'required'
        ];
        $customMessages = [
            'scout.required'          => 'This field is required',
            'year.required'          => 'This field is required'
        ];
        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'                => $request->id,
            'scout'           =>  $request->scout,
            'year'           =>  $request->year,
            'remarks'           =>  $request->remarks,
            'action_type'       => $request->action_type,
            'user_id'           => $this->userId(),
            'working_agency_id' => $this->getWrkingAgencyId()
        ];

        $response_data= $this->apiService->createData('emis/students/saveStudentScouts', $data);
        return $response_data;


    }

    public function loadStudentScouts($param=""){
        $param = $this->getWrkingAgencyId();
        $student_roles = $this->apiService->listData('emis/students/loadStudentScouts/'.$param);
        return $student_roles;
    }

    public function listStudentScouts($param=""){
        $param = $this->getWrkingAgencyId();
        $assigned_roles = $this->apiService->listData('emis/students/listStudentScouts/'.$param);
        return $assigned_roles;
    }

    public function saveScoutParticipants(Request $request){
        $rules = [
            'student'                   => 'required',
            'CeaScoutSectionId'         => 'required',
            'CeaScoutSectionLevelId'    => 'required',
            'date'                      => 'required'
        ];

        $customMessages = [
            'student.required'                  => 'This field is required',
            'CeaScoutSectionId.required'        => 'This field is required',
            'CeaScoutSectionLevelId.required'   => 'This field is required',
            'date.required'                     => 'This field is required'
        ];

        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'                        =>$request->id,
            'student'                   =>$request->student,
            'CeaScoutSectionId'         =>$request->CeaScoutSectionId,
            'CeaScoutSectionLevelId'    =>$request->CeaScoutSectionLevelId,
            'date'                      =>$request->date,
            'action_type'               =>$request->action_type,
            'user_id'                   =>$this->userId(),
            'working_agency_id'         =>$this->getWrkingAgencyId()
        ];
        $response_data= $this->apiService->createData('emis/students/saveScoutParticipants', $data);
        return $response_data;
    }

    public function loadScoutMembers($orgId){
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
        $scout_members = $this->apiService->listData('emis/students/loadScoutMembers/'.$param);
        return $scout_members;
    }

    /**
     * list the scout members (in drop down) to award badges
     */

    public function listScoutMembers(){
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
        if($param == ""){
            $param = 'NULL';
        }
        $scout_members = $this->apiService->listData('emis/students/listScoutMembers/'.$param);
        return $scout_members;
    }

    /**
     * Save Scout Badge
     */

    public function saveStudentScoutsBadge(Request $request){
        $rules = [
            'scout'             => 'required',
            'badgeEarned'       => 'required',
            'date'              => 'required'
        ];

        $customMessages = [
            'scout.required'                => 'This field is required',
            'badgeEarned.required'          => 'This field is required',
            'date.required'                 => 'This field is required'
        ];

        $this->validate($request, $rules, $customMessages);

        $data =[
            'id'                    =>$request->id,
            'scout'                 =>$request->scout,
            'badgeEarned'           =>$request->badgeEarned,
            'remarks'               =>$request->remarks,
            'date'                  =>$request->date,
            'action_type'           =>$request->action_type,
            'user_id'               =>$this->userId(),
            'working_agency_id'     =>$this->getWrkingAgencyId()
        ];

        $response_data= $this->apiService->createData('emis/students/saveStudentScoutsBadge', $data);
        return $response_data;
    }

    /**
     * load list of students and scouts badge
     */

    public function loadScoutsBadge(){
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
        $scout_members = $this->apiService->listData('emis/students/loadScoutsBadge/'.$param);
        return $scout_members;
    }
}
