<?php

namespace App\Http\Controllers\academics;

use App\Traits\AuthUser;
use App\Helper\EmisService;
use Illuminate\Http\Request;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Barryvdh\Reflection\DocBlock\Tag\ReturnTag;

class AcademicController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;
    
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }
    // public function getclassSections(){
    //     $orgId=$this->getWrkingAgencyId();
    //     $class_section = $this->apiService->listData('emis/academics/getclassSections/'.$orgId);
    //     return $class_section;
    // }
    public function saveClassTeacher(Request $request){
        $rules = [
            'data.*.stf_staff_id' => 'required'
        ];
        $customMessages = [
            'data.*.stf_staff_id.required' => 'This field is required'
        ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/academics/saveClassTeacher', $data);
        return $response_data;
       
    }

    public function getClassTeacher(){
        $orgId = $this->getWrkingAgencyId();
        $class_teacher = $this->apiService->listData('emis/academics/getClassTeacher/'.$orgId);
        return $class_teacher;  
    }
    public function getClassTeacherClasss(){
        $orgId = $this->getWrkingAgencyId();
        $staffId = $this->staffId();
        $class_teacher_class =  $this->apiService->listData('emis/academics/getClassTeacherClasss/'.$orgId.'/'.$staffId);
        return  $class_teacher_class;
    }
    public function saveStudentAttendance(Request $request){
        $rules = [
            'org_class_id' => 'required',
            'class_stream_section' => 'required',
            'attendance_date' => 'required',
            'data.*.Name' => 'required',
            'data.*.std_student_id' => 'required',
        ];
        $customMessages = [
            'org_class_id.required' => 'This field is required',
            'class_stream_section.required' => 'This field is required',
            'attendance_date.required' => 'This field is required',
            'data.*.Name.required' => 'This field is required',
            'data.*.std_student_id.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $request['org_id'] = $this->getWrkingAgencyId();
        $data = $request->all();

        $response_data = $this->apiService->createData('emis/academics/saveStudentAttendance', $data);
        return $response_data;
       
    }
    public function getStudentsForAttendance(Request $request){
        $org_id = $this->getWrkingAgencyId();

        $uri = 'emis/academics/loadStudentAttendanceDetail/'.$org_id;

        $uri .= ('?&org_class_id='.$request->classId);

        if($request->streamId !== null){
            $uri .= (('&org_stream_id='.$request->streamId));
        }
        if($request->sectionId !== null){
            $uri .= (('&org_section_id='.$request->sectionId));
        }
        $studentAttendanceDetail = json_decode($this->apiService->listData($uri),true);        
        $students = $this->getStudents($org_id,$request->OrgClassStreamId,$request->sectionId);
        return json_encode([
            "student"=>$students,
            "studentAttendanceDetail"=>$studentAttendanceDetail["data"]
        ]);

    }


    // public function getTeacher(){
    //     $orgId = $this->getWrkingAgencyId();
    //     $teacher = $this->apiService->listData('emis/academics/getTeacher/'.$orgId);
    //     return $teacher;  
    // }
    public function saveSubjectTeacher(Request $request){
        $request['user_id'] = $this->userId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/academics/saveSubjectTeacher', $data);
        return $response_data;
       
    }
    public function getSubjectTeacher(){
        $orgId = $this->getWrkingAgencyId();
        $subjectTeacher = $this->apiService->listData('emis/academics/getSubjectTeacher/'.$orgId);
        return $subjectTeacher;  
    }
    public function saveStudentElectiveSubject(Request $request){
        $rules = [
            'data.*.std_student_id' => 'required'
        ];
        $customMessages = [
            'data.*.std_student_id.required' => 'This field is required'
        ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();

        $data = $request->all();
        $response_data = $this->apiService->createData('emis/academics/saveStudentElectiveSubject', $data);
        return $response_data;
       
    }
    private function getElectiveSubjects($classId, $streamId=""){
        $uri = 'emis/academics/getElectiveSubjects/'.$classId;
        if($streamId){
            $uri .= ('/'.$streamId);
        }  
        $response_data = $this->apiService->listData($uri); 
        return $response_data;
    } 
    public function getStudents($org_id,$OrgClassStreamId,$org_section_id=""){
        $uri = 'emis/students/getStudents/'.$org_id;
         
        $uri .= ('?OrgClassStreamId='.$OrgClassStreamId);

        if($org_section_id !== null){
            $uri .= (('&sectionId='.$org_section_id));
        }
        $students = json_decode($this->apiService->listData($uri),true);
        return $students['data'];
    }
    public function getStudentElectiveSubjects(Request $request){
    $org_id = $this->getWrkingAgencyId();
       $students = $this->getStudents($org_id,$request->OrgClassStreamId,$request->sectionId);
        $studentElectiveSubjects = json_decode($this->apiService->listData('emis/academics/getStudentElectiveSubjects'),true);        
        for($i=0;$i<count($students);$i++) {
            foreach ($studentElectiveSubjects["data"] as $studentElectiveSubject) {
                if ($studentElectiveSubject["std_student_id"] == $students[$i]["std_student_id"]) {
                    $students[$i][$studentElectiveSubject["aca_sub_id"]] = $studentElectiveSubject["aca_sub_id"];
                }
            }
        }
        return json_encode(["students"=>$students, "electiveSubjects"=>json_decode($this->getElectiveSubjects($request->classId, $request->streamId),true)]);
    } 
    public function loadStudentAttendance(){
        $orgId = $this->getWrkingAgencyId();
        $staffId = $this->staffId();

        $uri = 'emis/academics/loadStudentAttendance/'.$orgId.'/'. $staffId;
        $studentAssessments = $this->apiService->listData($uri);
        return $studentAssessments;

    }
    public function loadStudentAssessmentList(){
        $staffId = $this->staffId();
        $orgId=$this->getWrkingAgencyId();
        $class_subject_term= $this->apiService->listData('emis/academics/loadStudentAssessmentList/'.$staffId.'/'.$orgId);
        return $class_subject_term;   
    }
    private function loadAssessmentAreas($term_id, $sub_id, $class_id, $stream_id=""){
        $uri = 'emis/academics/loadAssessmentAreas/'.$term_id.'/'.$sub_id.'/'.$class_id;
        if($stream_id){
           $uri .= ('/'.$stream_id);
        }
        $response_data= $this->apiService->listData($uri);
        return $response_data;   
    }
     public function loadStudentAssessments(Request $request){

        $org_id = $this->getWrkingAgencyId();

        $uri = 'emis/academics/loadStudentAssessments/'.$org_id;

        $uri .= ('?aca_assmt_term_id='.$request->aca_assmt_term_id.'&aca_sub_id='.$request->aca_sub_id. '&org_class_id='.$request->classId);

        if($request->streamId !== null){
            $uri .= (('&org_stream_id='.$request->streamId));
        }
        if($request->sectionId !== null){
            $uri .= (('&org_section_id='.$request->sectionId));
        }

        $students = $this->getStudents($org_id,$request->OrgClassStreamId,$request->sectionId);
        $selectedStudents = [];
        $studentAssessments = json_decode($this->apiService->listData($uri),true);
        $assessmentAreasRatings = json_decode($this->loadAssessmentAreas($request->aca_assmt_term_id,$request->aca_sub_id,$request->classId, $request->streamId),true);
        if(gettype($studentAssessments["data"]["studentsTakingElective"])=="array"){
            for($i=0;$i<count($students);$i++) {
                if(in_array($students[$i]["std_student_id"], $studentAssessments["data"]["studentsTakingElective"])){
                    array_push($selectedStudents,$students[$i]);
                }
            }
        }
        for($i=0;$i<count($selectedStudents);$i++) {
            foreach ($assessmentAreasRatings["data"]["assessmentAreas"] as $area) {
                $selectedStudents[$i][$area["aca_assmt_area_id"]]["aca_assmt_area_id"] = $area["aca_assmt_area_id"];
                $selectedStudents[$i][$area["aca_assmt_area_id"]]["aca_rating_type_id"] = $area["aca_rating_type_id"];
                $selectedStudents[$i][$area["aca_assmt_area_id"]]["weightage"] = $area["weightage"];
                $selectedStudents[$i][$area["aca_assmt_area_id"]]["score"] = null;
                $selectedStudents[$i][$area["aca_assmt_area_id"]]["score_text"] = null;

            }
            foreach ($studentAssessments["data"]['studentAssessments'] as $studentAssessment) {
                if($studentAssessment["std_student_id"] == $selectedStudents[$i]["std_student_id"]){
                    $selectedStudents[$i][$studentAssessment["aca_assmt_area_id"]]["score"] = $studentAssessment["score"];
                    $selectedStudents[$i][$studentAssessment["aca_assmt_area_id"]]["score_text"] = $studentAssessment["score_text"];
                }
                // if(!array_key_exists($studentAssessment["aca_assmt_area_id"],$students[$i])){
                //     $students[$i][$studentAssessment["aca_assmt_area_id"]]["score"] = null;
                //     $students[$i][$studentAssessment["aca_assmt_area_id"]]["score_text"] = null;
                // }
            }
        }
        return json_encode(["studentAssessments"=>$selectedStudents, "assessmentAreas"=>$assessmentAreasRatings["data"]["assessmentAreas"],"ratings"=>$assessmentAreasRatings["data"]["ratings"]]);
    }
    public function saveStudentAssessment(Request $request){
        $rules = [
            'data.*.std_student_id' => 'required',
        ];
        $customMessages = [
            'data.*.std_student_id.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $request['org_id'] = $this->getWrkingAgencyId();

        $data = $request->all();
        $response_data = $this->apiService->createData('emis/academics/saveStudentAssessment', $data);
        return $response_data;
    }
    public function unlockForEdit($Id){
        $response_data = $this->apiService->createData('emis/academics/unlockForEdit/'.$Id,[]);
        return $response_data;
    }
    public function loadConsolidatedResultList(){
        $staffId = $this->staffId();
        $orgId= $this->getWrkingAgencyId();
        $class_term= $this->apiService->listData('emis/academics/loadConsolidatedResultList/'.$staffId.'/'.$orgId);
        return $class_term;  
    }

    //new 
    public function loadAssessmentAreasForConsolidated($class_id, $stream_id="",$term_id=""){
        $uri = 'emis/academics/loadAssessmentAreasForConsolidated';
     
        $uri .= ('?&org_class_id='.$class_id);

        if($stream_id!== null){
            $uri .= (('&org_stream_id='.$stream_id));
        }
        if($term_id!== null){
            $uri .= (('&aca_assmt_term_id='.$term_id));
        }
        $response_data= $this->apiService->listData($uri);
        return $response_data;   
    }

    public function loadConsolidatedResult(Request $request){
        $org_id = $this->getWrkingAgencyId();

        $uri = 'emis/academics/loadConsolidatedResult/'.$org_id;

        $uri .= ('?&org_class_id='.$request->classId);

        if($request->streamId !== null){
            $uri .= (('&org_stream_id='.$request->streamId));
        }
        if($request->sectionId !== null){
            $uri .= (('&org_section_id='.$request->sectionId));
        }
        if($request->aca_assmt_term_id){
            $uri .= (('&aca_assmt_term_id='.$request->aca_assmt_term_id));
        }
        $students = $this->getStudents($org_id,$request->OrgClassStreamId,$request->sectionId);

        $consolidatedResult = json_decode($this->apiService->listData($uri),true);
        $terms = [];
        $subjects = [];
        $areas = [];
        for($i=0;$i<count($students);$i++) {
            if(array_key_exists($i, $students)){
               foreach ($consolidatedResult["data"] as $consolidated) {
                   if($consolidated["std_student_id"] == $students[$i]["std_student_id"]){
                        if(!$this->hasTerm($consolidated,$terms)){
                            array_push($terms, ["aca_assmt_term_id"=>$consolidated["aca_assmt_term_id"], "term"=>$consolidated["term"],"term_dzo_name"=>$consolidated["term_dzo_name"]]);
                        }

                        if(!$this->hasSubject($consolidated, $subjects)){
                            array_push($subjects,["aca_assmt_term_id"=>$consolidated["aca_assmt_term_id"],"aca_sub_id"=>$consolidated["aca_sub_id"], "subject"=>$consolidated["subject"],"sub_dzo_name"=>$consolidated["sub_dzo_name"]]);
                        }

                        if(!$this->hasArea($consolidated, $areas)){
                            array_push($areas,["aca_assmt_term_id"=>$consolidated["aca_assmt_term_id"],"aca_sub_id"=>$consolidated["aca_sub_id"],"aca_assmt_area_id"=>$consolidated["aca_assmt_area_id"], "assessment_area"=>$consolidated["assessment_area"],"assmt_area_dzo_name"=>$consolidated["assmt_area_dzo_name"], "weightage"=>$consolidated["weightage"], "aca_rating_type_id"=>$consolidated["aca_rating_type_id"], "input_type"=>$consolidated["input_type"]]);
                        }

                        $students[$i][$consolidated["aca_assmt_term_id"]][$consolidated["aca_sub_id"]][$consolidated["aca_assmt_area_id"]]['score'] = $consolidated["score"];

                        if($consolidated["input_type"]==1){
                            if(array_key_exists("subject_total", $students[$i][$consolidated["aca_assmt_term_id"]])){
                                $students[$i][$consolidated["aca_assmt_term_id"]]["subject_total"]["area_total"]['score'] += $consolidated["score"];
                                if(array_key_exists("area_total", $students[$i][$consolidated["aca_assmt_term_id"]][$consolidated["aca_sub_id"]])){
                                    $students[$i][$consolidated["aca_assmt_term_id"]][$consolidated["aca_sub_id"]]["area_total"]['score'] += $consolidated["score"];
                                }else{
                                    $students[$i][$consolidated["aca_assmt_term_id"]][$consolidated["aca_sub_id"]]["area_total"]['score'] = $consolidated["score"];
                                }
                            }else{
                                $students[$i][$consolidated["aca_assmt_term_id"]]["subject_total"]["area_total"]['score'] = $consolidated["score"];
                                $students[$i][$consolidated["aca_assmt_term_id"]][$consolidated["aca_sub_id"]]["area_total"]['score'] = $consolidated["score"];
                            }
                        }
                   }
               }
           }
       }
       $lastTermId = "";
       $lastSubjectId = "";
       $totalWeightageTerm = 0;
       $totalWeightageSubject = 0;
       $originalAreas = $areas;
       $indexAddTerm = 0;
       $indexAddSubject = 0;
       
       //For coulmn headers
       foreach($areas as $key => $area){
            if($totalWeightageTerm>0 && $area["aca_assmt_term_id"] != $lastTermId && $lastTermId != ""){
                // array_splice($subjects, $key, 0, [["aca_assmt_term_id"=>$lastTermId,"aca_sub_id"=>"subject_total", "subject"=>"Total"]]);
                $indexAddTerm++;
                $totalWeightageTerm = 0;
            }
            if($totalWeightageSubject>0 && (($area["aca_assmt_term_id"] != $lastTermId && $lastTermId != "") || ($area["aca_sub_id"] != $lastSubjectId && $lastSubjectId != ""))){
                array_splice($originalAreas, $key + $indexAddSubject, 0, [["aca_assmt_term_id"=> $lastTermId,"aca_sub_id"=>$lastSubjectId,"aca_assmt_area_id"=>"area_total", "assessment_area"=>"Total", "weightage"=>$totalWeightageSubject, "aca_rating_type_id"=>"", "input_type"=>1]]);
                $indexAddSubject++;
                $totalWeightageSubject = 0;
            }
            if($area["input_type"]==1){
                $totalWeightageTerm += $area["weightage"];
                $totalWeightageSubject += $area["weightage"];
            }
            $lastTermId = $area["aca_assmt_term_id"];
            $lastSubjectId = $area["aca_sub_id"];
        }

        if($totalWeightageSubject>0){
            array_push($originalAreas,["aca_assmt_term_id"=> $lastTermId,"aca_sub_id"=>$lastSubjectId,"aca_assmt_area_id"=>"area_total", "assessment_area"=>"Total", "weightage"=>$totalWeightageSubject, "aca_rating_type_id"=>"", "input_type"=>1]);
        }
        if($totalWeightageTerm>0){
            // array_push($subjects,["aca_assmt_term_id"=>$lastTermId,"aca_sub_id"=>"subject_total", "subject"=>"Total"]);
        }
// dd($originalAreas);
       return json_encode(["results"=>$students,"terms"=>$terms,"subjects"=>$subjects,"areas"=>$originalAreas]);
    }

    private function hasTerm($row, $terms){
        return (in_array($row["aca_assmt_term_id"], array_column($terms, "aca_assmt_term_id")));
    }

    private function hasSubject($row, $subjects){
        return (in_array($row["aca_assmt_term_id"], array_column($subjects, "aca_assmt_term_id")) && in_array($row["aca_sub_id"], array_column($subjects, "aca_sub_id")));
    }

    private function hasArea($row, $areas){
        return (in_array($row["aca_assmt_term_id"], array_column($areas, "aca_assmt_term_id")) && in_array($row["aca_sub_id"], array_column($areas, "aca_sub_id")) && in_array($row["aca_assmt_area_id"], array_column($areas, "aca_assmt_area_id")));
    }
    public function saveConsolidatedResut(Request $request) {
        $request['user_id'] = $this->userId();
        $request['org_id'] = $this->getWrkingAgencyId();

        $data = $request->all();
        $response_data = $this->apiService->createData('emis/academics/saveConsolidatedResut', $data);
        return $response_data;
    }
  
}
