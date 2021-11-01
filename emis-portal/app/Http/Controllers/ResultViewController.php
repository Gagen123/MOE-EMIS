<?php

namespace App\Http\Controllers;
use App\Helper\EmisService;
use Illuminate\Http\Request;

class ResultViewController extends Controller
{
    public $apiService;
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    //
    public function loadClassStreamSection($type="",$id=""){
        if($type=="userworkingagency"){
            $id="4184f12c-a7fc-40c3-b038-013e242d8ef6";
        }
        return $this->apiService->getListData('emis/common_services/loadClassStreamSection/'.$type.'/'.$id);
    }
    public function loadClassBySubjectTeacher() {
        $staffId = '01b1cafc-0524-4be3-b913-a141d5804c79';
        $orgId = '4184f12c-a7fc-40c3-b038-013e242d8ef6';
        $response_data = $this->apiService->listData('emis/academics/loadClassBySubjectTeacher/'.$orgId.'/'.$staffId);
        return $response_data;
    }
    public function loadStudentAssessmentList(Request $request){
        $staffId = '01b1cafc-0524-4be3-b913-a141d5804c79';
        $orgId = '4184f12c-a7fc-40c3-b038-013e242d8ef6';
        $uri = 'emis/academics/loadStudentAssessmentList/'.$staffId.'/'.$orgId;
        $uri .= ('?aca_assmt_term_id='.$request->aca_assmt_term_id.'&org_class_id='.$request->org_class_id);
        if($request->org_stream_id !== null){
            $uri .= (('&org_stream_id='.$request->org_stream_id));
        }
        if($request->org_section_id !== null){
            $uri .= (('&org_section_id='.$request->org_section_id));
        }
        $selected_subjects = [];
        $class_subject_term= json_decode($this->apiService->listData($uri),true)['data'];
        $optional_subject_org_wise = $this->getOptionalSubjectOrgWise($orgId,$request->org_class_id,$request->org_stream_id,$request->org_section_id);
            foreach($class_subject_term as $class_subject){
                if((!$class_subject['is_elective']) || ($class_subject['is_elective'] && in_array($class_subject['aca_sub_id'], array_column($optional_subject_org_wise,'aca_sub_id')))){
                    array_push($selected_subjects,$class_subject);
                }

            }
        return $selected_subjects;
    }
    public function LoadFinalResultByStudentId($std_code){
        return $this->apiService->getListData('emis/academics/LoadFinalResultByStudentId/'.$std_code);
    }
    }
