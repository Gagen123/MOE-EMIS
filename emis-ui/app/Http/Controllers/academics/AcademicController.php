<?php

namespace App\Http\Controllers\academics;

use App\Traits\AuthUser;
use App\Helper\EmisService;
use Illuminate\Http\Request;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Barryvdh\Reflection\DocBlock\Tag\ReturnTag;
use Exception;

class AcademicController extends Controller
{
    use ServiceHelper;
    use AuthUser;
    public $apiService;

    public function __construct(EmisService $apiService)
    {
        $this->apiService = $apiService;
    }
    public function saveClassTeacher(Request $request)
    {
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
    public function getClassTeacher()
    {
        $orgId = $this->getWrkingAgencyId();
        $class_teacher = $this->apiService->listData('emis/academics/getClassTeacher/' . $orgId);
        return $class_teacher;
    }
    public function getClassTeacherClasss()
    {
        $orgId = $this->getWrkingAgencyId();
        $staffId = $this->staffId();
        $class_teacher_class =  $this->apiService->listData('emis/academics/getClassTeacherClasss/' . $orgId . '/' . $staffId);
        return  $class_teacher_class;
    }
    public function saveStudentAttendance(Request $request)
    {
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
    public function getStudentsForAttendance(Request $request)
    {
        $org_id = $this->getWrkingAgencyId();
        $uri = 'emis/academics/loadStudentAttendanceDetail/' . $org_id;
        $uri .= ('?org_class_id=' . $request->classId . '&attendance_date=' . $request->attendance_date);
        if ($request->streamId !== null) {
            $uri .= (('&org_stream_id=' . $request->streamId));
        }
        if ($request->sectionId !== null) {
            $uri .= (('&org_section_id=' . $request->sectionId));
        }
        $studentAttendanceDetail = json_decode($this->apiService->listData($uri), true);
        $students = $this->getStudents($org_id, $request->OrgClassStreamId, $request->sectionId);
        if (in_array($request->attendance_date, array_column($studentAttendanceDetail["data"]["hasAttendance"], 'attendance_date')) && $request->action == "add") {
            return [
                "error" => "Attendance of class " . $request->class_stream_section . " for " . $request->attendance_date . " is already taken.",
            ];
        } else {
            return json_encode([
                "student" => $students,
                "studentAttendanceDetail" => $studentAttendanceDetail["data"]["studentAttendanceDetail"],
            ]);
        }
    }
    public function getAttendanceData(Request $request)
    {
        $org_id = $this->getWrkingAgencyId();
        $uri = 'emis/academics/getAttendanceData/' . $org_id;
        $uri .= ('?org_class_id=' . $request->org_class_id . '&std_id=' . $request->std_id . '&aca_assmt_term_id=' . $request->aca_assmt_term_id);
        if ($request->streamId !== null) {
            $uri .= (('&org_stream_id=' . $request->org_stream_id));
        }
        if ($request->sectionId !== null) {
            $uri .= (('&org_section_id=' . $request->org_section_id));
        }
        return $this->apiService->listData($uri);
    }
    public function getTermsByClass($classId, $streamId = "")
    {

        $uri = 'emis/academics/getTermsByClass/' . $classId;
        if ($streamId) {
            $uri .= ('/' . $streamId);
        }
        $getTerms = $this->apiService->listData($uri);
        return $getTerms;
    }
    public function saveInstrunctionalDays(Request $request)
    {
        $rules = [
            'org_class_id' => 'required',
            'std_student_id' => 'required',
            'aca_assmt_term_id' => 'required',
            'instructional_days' => 'required',
            'remarks' => 'required',
        ];
        $customMessages = [
            'org_class_id.required' => 'This field is required',
            'std_student_id.required' => 'This field is required',
            'aca_assmt_term_id.required' => 'This field is required',
            'instructional_days.required' => 'This field is required',
            'remarks.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $request['org_id'] = $this->getWrkingAgencyId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/academics/saveInstrunctionalDays', $data);
        return $response_data;
    }
    public function getInstrunctionalDays()
    {
        $instructional_days_special_case = $this->apiService->listData('emis/academics/getInstrunctionalDays');
        return $instructional_days_special_case;
    }
    public function saveSubjectTeacher(Request $request)
    {
        $rules = [
            'data.*.stf_staff_id' => 'required'
        ];
        $customMessages = [
            'data.*.stf_staff_id.required' => 'This field is required'
        ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $request['org_id'] = $this->getWrkingAgencyId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/academics/saveSubjectTeacher', $data);
        return $response_data;
    }
    public function getSubjectTeacher(Request $request)
    {
        $orgId = $this->getWrkingAgencyId();
        $uri = 'emis/academics/getSubjectTeacher/' . $orgId;
        $uri .= ('?org_class_id=' . $request->org_class_id);
        if ($request->org_stream_id !== null) {
            $uri .= (('&org_stream_id=' . $request->org_stream_id));
        }
        if ($request->org_section_id !== null) {
            $uri .= (('&org_section_id=' . $request->org_section_id));
        }
        $selected_subjects = [];
        $subjectTeacher = json_decode($this->apiService->listData($uri), true)['data'];
        $optional_subject_org_wise = $this->getOptionalSubjectOrgWise($orgId, $request->org_class_id, $request->org_stream_id, $request->org_section_id);
        foreach ($subjectTeacher['classSubjects'] as $class_subject) {
            if ((!$class_subject['is_elective']) || ($class_subject['is_elective'] && in_array($class_subject['aca_sub_id'], array_column($optional_subject_org_wise, 'aca_sub_id')))) {
                array_push($selected_subjects, $class_subject);
            }
        }
        if (count($subjectTeacher['subjectMappingForTre']) > 0) {
            $aca_teacher_sub_ids = implode(",", array_column($subjectTeacher['subjectMappingForTre'], 'aca_teacher_sub_id'));
        } else {
            $aca_teacher_sub_ids = implode(",", array_column($selected_subjects, 'aca_teacher_sub_id'));
        }
        $staffs = json_decode($this->apiService->listData('emis/common_services/loadFewDetailsStaffListBySubject?aca_teacher_sub_ids=' . $aca_teacher_sub_ids . '&orgId=' . $orgId), true)['data'];
        return (["staffs" => $staffs, 'classSubjectTeachers' => $subjectTeacher['classSubjectTeachers'], 'classSubjects' => $selected_subjects, 'subjectMappingForTre' => $subjectTeacher['subjectMappingForTre'],]);
    }
    public function saveStudentElectiveSubject(Request $request)
    {
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
    public function getStudentElectiveSubjects(Request $request)
    {
        $org_id = $this->getWrkingAgencyId();
        $students = $this->getStudents($org_id, $request->OrgClassStreamId, $request->sectionId);
        $studentElectiveSubjects = json_decode($this->apiService->listData('emis/academics/getStudentElectiveSubjects'), true);
        for ($i = 0; $i < count($students); $i++) {
            foreach ($studentElectiveSubjects["data"] as $studentElectiveSubject) {
                if ($studentElectiveSubject["std_student_id"] == $students[$i]["std_student_id"]) {
                    $students[$i][$studentElectiveSubject["aca_sub_id"]] = $studentElectiveSubject["aca_sub_id"];
                }
            }
        }
        return json_encode(["students" => $students, "electiveSubjects" => json_decode($this->getElectiveSubjects($request->classId, $request->streamId), true)]);
    }
    public function getClassWithElectiveSubject()
    {
        $classWithElectiveSubject = $this->apiService->listData('emis/academics/getClassWithElectiveSubject');
        return $classWithElectiveSubject;
    }
    public function loadStudentAttendance()
    {
        $orgId = $this->getWrkingAgencyId();
        $staffId = $this->staffId();
        $uri = 'emis/academics/loadStudentAttendance/' . $orgId . '/' . $staffId;
        $studentAssessments = $this->apiService->listData($uri);
        return $studentAssessments;
    }
    public function loadStudentAssessmentList(Request $request)
    {
        $staffId = $this->staffId();
        $orgId = $this->getWrkingAgencyId();
        $uri = 'emis/academics/loadStudentAssessmentList/' . $staffId . '/' . $orgId;
        $uri .= ('?aca_assmt_term_id=' . $request->aca_assmt_term_id . '&org_class_id=' . $request->org_class_id);
        if ($request->org_stream_id !== null) {
            $uri .= (('&org_stream_id=' . $request->org_stream_id));
        }
        if ($request->org_section_id !== null) {
            $uri .= (('&org_section_id=' . $request->org_section_id));
        }
        $selected_subjects = [];
        $class_subject_term = json_decode($this->apiService->listData($uri), true)['data'];
        $optional_subject_org_wise = $this->getOptionalSubjectOrgWise($orgId, $request->org_class_id, $request->org_stream_id, $request->org_section_id);
        foreach ($class_subject_term as $class_subject) {
            if ((!$class_subject['is_elective']) || ($class_subject['is_elective'] && in_array($class_subject['aca_sub_id'], array_column($optional_subject_org_wise, 'aca_sub_id')))) {
                array_push($selected_subjects, $class_subject);
            }
        }
        return $selected_subjects;
    }
    public function loadStudentAssessments(Request $request)
    {
        $org_id = $this->getWrkingAgencyId();
        $uri = 'emis/academics/loadStudentAssessments/' . $org_id;
        $uri .= ('?aca_assmt_term_id=' . $request->aca_assmt_term_id . '&aca_sub_id=' . $request->aca_sub_id . '&org_class_id=' . $request->classId);
        if ($request->streamId !== null) {
            $uri .= (('&org_stream_id=' . $request->streamId));
        }
        if ($request->sectionId !== null) {
            $uri .= (('&org_section_id=' . $request->sectionId));
        }
        $students = $this->getStudents($org_id, $request->OrgClassStreamId, $request->sectionId);
        $selectedStudents = [];
        $studentAssessments = json_decode($this->apiService->listData($uri), true);
        $studentAssessments = json_decode($this->apiService->listData($uri), true);
        $assessmentAreasRatings = json_decode($this->loadAssessmentAreas($request->aca_assmt_term_id, $request->aca_sub_id, $request->classId, $request->streamId), true);
        if (gettype($studentAssessments["data"]["studentsTakingElective"]) == "array") {
            for ($i = 0; $i < count($students); $i++) {
                if (in_array($students[$i]["std_student_id"], $studentAssessments["data"]["studentsTakingElective"])) {
                    array_push($selectedStudents, $students[$i]);
                }
            }
        } else {
            $selectedStudents = $students;
        }
        for ($i = 0; $i < count($selectedStudents); $i++) {
            foreach ($assessmentAreasRatings["data"]["assessmentAreas"] as $area) {
                $selectedStudents[$i][$area["aca_assmt_area_id"]]["aca_assmt_area_id"] = $area["aca_assmt_area_id"];
                $selectedStudents[$i][$area["aca_assmt_area_id"]]["aca_rating_type_id"] = $area["aca_rating_type_id"];
                $selectedStudents[$i][$area["aca_assmt_area_id"]]["weightage"] = $area["weightage"];
                $selectedStudents[$i][$area["aca_assmt_area_id"]]["input_type"] = $area["input_type"];
                $selectedStudents[$i][$area["aca_assmt_area_id"]]["score"] = null;
                $selectedStudents[$i][$area["aca_assmt_area_id"]]["score_text"] = null;
                $selectedStudents[$i][$area["aca_assmt_area_id"]]["descriptive_score"] = null;
            }
            foreach ($studentAssessments["data"]['studentAssessments'] as $studentAssessment) {
                if ($studentAssessment["std_student_id"] == $selectedStudents[$i]["std_student_id"]) {
                    if ($selectedStudents[$i][$studentAssessment["aca_assmt_area_id"]]["input_type"] == 2) {
                        $selectedStudents[$i][$studentAssessment["aca_assmt_area_id"]]["descriptive_score"] = $studentAssessment["descriptive_score"];
                    } else {
                        $selectedStudents[$i][$studentAssessment["aca_assmt_area_id"]]["score"] = $studentAssessment["score"];
                    }
                    $selectedStudents[$i][$studentAssessment["aca_assmt_area_id"]]["score_text"] = $studentAssessment["score_text"];
                    // $selectedStudents[$i][$studentAssessment["aca_assmt_area_id"]]["score_text"] = $studentAssessment["score_text"];
                }
                // if(!array_key_exists($studentAssessment["aca_assmt_area_id"],$students[$i])){
                //     $students[$i][$studentAssessment["aca_assmt_area_id"]]["score"] = null;
                //     $students[$i][$studentAssessment["aca_assmt_area_id"]]["score_text"] = null;
                // }
            }
        }
        return json_encode(["studentAssessments" => $selectedStudents, "assessmentAreas" => $assessmentAreasRatings["data"]["assessmentAreas"], "ratings" => $assessmentAreasRatings["data"]["ratings"]]);
    }
    public function saveStudentAssessment(Request $request)
    {
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
        $response_data = $this->apiService->createData('emis/academics/saveStudentAssessment' . '/' . $this->userId(), $data);
        return $response_data;
    }
    public function unlockForEdit($Id)
    {
        $response_data = $this->apiService->createData('emis/academics/unlockForEdit/' . $Id, []);
        return $response_data;
    }
    public function loadConsolidatedResultList(Request $request)
    {
        $staffId = $this->staffId();
        $orgId = $this->getWrkingAgencyId();
        $uri = 'emis/academics/loadConsolidatedResultList/' . $staffId . '/' . $orgId;
        $uri .= ('?org_class_id=' . $request->org_class_id);
        if ($request->org_stream_id !== null) {
            $uri .= (('&org_stream_id=' . $request->org_stream_id));
        }
        if ($request->org_section_id !== null) {
            $uri .= (('&org_section_id=' . $request->org_section_id));
        }
        $consolidated = $this->apiService->listData($uri);
        return $consolidated;
    }
    public function loadAssessmentAreasForConsolidated($class_id, $stream_id = "", $term_id = "")
    {
        $uri = 'emis/academics/loadAssessmentAreasForConsolidated';
        $uri .= ('?org_class_id=' . $class_id);
        if ($stream_id !== null) {
            $uri .= (('&org_stream_id=' . $stream_id));
        }
        if ($term_id !== null) {
            $uri .= (('&aca_assmt_term_id=' . $term_id));
        }
        $response_data = $this->apiService->listData($uri);
        return $response_data;
    }
    public function loadConsolidatedResult(Request $request)
    {
        $org_id = $this->getWrkingAgencyId();
        $termId = "final-term";
        $uri = 'emis/academics/loadConsolidatedResult/' . $org_id;
        $uri .= ('?org_class_id=' . $request->classId);
        if ($request->streamId !== null) {
            $uri .= (('&org_stream_id=' . $request->streamId));
        }
        if ($request->sectionId !== null) {
            $uri .= (('&org_section_id=' . $request->sectionId));
        }
        if ($request->aca_assmt_term_id) {
            $uri .= (('&aca_assmt_term_id=' . $request->aca_assmt_term_id));
            $termId = $request->aca_assmt_term_id;
        }
        $students = $this->getStudents($org_id, $request->OrgClassStreamId, $request->sectionId);
        $consolidatedResult = json_decode($this->apiService->listData($uri), true);
        $minimum_required_attendance = $consolidatedResult["data"]['minimum_required_attendance'] + 0;
        $instructionalDaysPerYear = array_column($consolidatedResult["data"]['instructionalDays'], "instructional_days");
        $overAllInstructionalDays = array_sum($instructionalDaysPerYear);
        $terms = [];
        $subjects = [];
        $areas = [];
        for ($i = 0; $i < count($students); $i++) {
            if (array_key_exists($i, $students)) {
                foreach ($consolidatedResult["data"]['consolidatedResult'] as $consolidated) {
                    if ($consolidated["std_student_id"] == $students[$i]["std_student_id"]) {
                        //Prepare unique list of terms
                        if (!$this->hasTerm($consolidated, $terms)) {
                            array_push($terms, ["aca_assmt_term_id" => $consolidated["aca_assmt_term_id"], "term" => $consolidated["term"], "term_dzo_name" => $consolidated["term_dzo_name"]]);
                        }
                        //Prepare unique list of subjects
                        if (!$this->hasSubject($consolidated, $subjects)) {
                            array_push($subjects, ["aca_assmt_term_id" => $consolidated["aca_assmt_term_id"], "aca_sub_id" => $consolidated["aca_sub_id"], "subject" => $consolidated["subject"], "sub_dzo_name" => $consolidated["sub_dzo_name"]]);
                        }
                        //Prepare unique list of areas
                        if (!$this->hasArea($consolidated, $areas)) {
                            array_push($areas, ["aca_assmt_term_id" => $consolidated["aca_assmt_term_id"], "aca_sub_id" => $consolidated["aca_sub_id"], "aca_assmt_area_id" => $consolidated["aca_assmt_area_id"], "assessment_area" => $consolidated["assessment_area"], "assessment_area_hint" => $consolidated["assessment_area_hint"], "assmt_area_dzo_name" => $consolidated["assmt_area_dzo_name"], "weightage" => $consolidated["weightage"], "aca_rating_type_id" => $consolidated["aca_rating_type_id"], "input_type" => $consolidated["input_type"]]);
                        }
                        $students[$i][$consolidated["aca_assmt_term_id"]][$consolidated["aca_sub_id"]][$consolidated["aca_assmt_area_id"]]['score'] = $consolidated["score"];
                        $students[$i][$consolidated["aca_assmt_term_id"]][$consolidated["aca_sub_id"]][$consolidated["aca_assmt_area_id"]]['pass_score'] = $consolidated["pass_score"] + 0;
                        $students[$i][$consolidated["aca_assmt_term_id"]][$consolidated["aca_sub_id"]][$consolidated["aca_assmt_area_id"]]['aca_rating_type_id'] = $consolidated["aca_rating_type_id"];
                        //Calculate total for percentage based scores
                        if ($consolidated["input_type"] == 1) {
                            //If subject_total column is already there, add score to the subject_total (subject_total = total for a term)
                            if (array_key_exists("subject_total", $students[$i][$consolidated["aca_assmt_term_id"]])) {
                                $students[$i][$consolidated["aca_assmt_term_id"]]["subject_total"]["area_total"]['score'] += $consolidated["score"];
                                $students[$i][$consolidated["aca_assmt_term_id"]]["weightage_total"] += $consolidated["weightage"];
                                $students[$i][$consolidated["aca_assmt_term_id"]]["percentage"]["area_total"]['score'] = round(100 * ($students[$i][$consolidated["aca_assmt_term_id"]]["subject_total"]["area_total"]['score'] / $students[$i][$consolidated["aca_assmt_term_id"]]["weightage_total"]), 2);
                                //If area_total column is already there, add score to the area_total (area_total = total for a subject)
                                if (array_key_exists("area_total", $students[$i][$consolidated["aca_assmt_term_id"]][$consolidated["aca_sub_id"]])) {
                                    $students[$i][$consolidated["aca_assmt_term_id"]][$consolidated["aca_sub_id"]]["area_total"]['score'] += $consolidated["score"];
                                } else {
                                    //If area_total is not there, create area_total column (area_total = total for a subject)
                                    $students[$i][$consolidated["aca_assmt_term_id"]][$consolidated["aca_sub_id"]]["area_total"]['score'] = $consolidated["score"];
                                    $students[$i][$consolidated["aca_assmt_term_id"]][$consolidated["aca_sub_id"]]["area_total"]['pass_score'] = $consolidated["pass_score"] + 0;
                                    $students[$i][$consolidated["aca_assmt_term_id"]][$consolidated["aca_sub_id"]]["area_total"]['aca_rating_type_id'] = $consolidated["aca_rating_type_id"];
                                }
                            } else { //If subject_total is not there, create subject_total column
                                $students[$i][$consolidated["aca_assmt_term_id"]]["subject_total"]["area_total"]['score'] = $consolidated["score"];
                                $students[$i][$consolidated["aca_assmt_term_id"]]["weightage_total"] = $consolidated["weightage"];
                                $students[$i][$consolidated["aca_assmt_term_id"]][$consolidated["aca_sub_id"]]["area_total"]['score'] = $consolidated["score"];
                                $students[$i][$consolidated["aca_assmt_term_id"]][$consolidated["aca_sub_id"]]["area_total"]['pass_score'] = $consolidated["pass_score"] + 0;
                                $students[$i][$consolidated["aca_assmt_term_id"]][$consolidated["aca_sub_id"]]["area_total"]['aca_rating_type_id'] = $consolidated["aca_rating_type_id"];
                            }
                            $students[$i][$consolidated["aca_assmt_term_id"]][$consolidated["aca_sub_id"]]["area_total"]['score'] = round($students[$i][$consolidated["aca_assmt_term_id"]][$consolidated["aca_sub_id"]]["area_total"]['score'], 2);
                        }
                    }
                }
                foreach ($consolidatedResult["data"]['studentRank'] as $studentsRank) {
                    if ($studentsRank['std_student_id'] == $students[$i]["std_student_id"]) {
                        $students[$i][$studentsRank["aca_assmt_term_id"]]["position"]["area_total"]['score'] = $studentsRank['rank'];
                        $students[$i][$studentsRank["aca_assmt_term_id"]]["remarks"]["area_total"]['score'] = $studentsRank['remarks'];
                    }
                }
                if ($overAllInstructionalDays == 0) {
                    $students[$i][$consolidated["aca_assmt_term_id"]]["instructional_days"]["area_total"]["score"] = 0;
                    $students[$i][$consolidated["aca_assmt_term_id"]]["no_of_days_attended"]["area_total"]["score"] = 0;
                    $students[$i][$consolidated["aca_assmt_term_id"]]["attendance_in_percentage"]["area_total"]["score"] = "NA";
                } else {
                    $students[$i][$consolidated["aca_assmt_term_id"]]["instructional_days"]["area_total"]["score"] = $overAllInstructionalDays;
                    $students[$i][$consolidated["aca_assmt_term_id"]]["no_of_days_attended"]["area_total"]["score"] = $overAllInstructionalDays;
                    $students[$i][$consolidated["aca_assmt_term_id"]]["attendance_in_percentage"]["area_total"]["score"] = "100%";
                }
                foreach ($consolidatedResult["data"]['instructionalDaysForSpecialCase'] as $instructionalDay) {
                    if ($instructionalDay['std_student_id'] == $students[$i]["std_student_id"]) {
                        $students[$i][$instructionalDay["aca_assmt_term_id"]]["instructional_days"]["area_total"]["score"] = $instructionalDay['instructional_days'];
                    }
                }
                foreach ($consolidatedResult["data"]['absentDays'] as $absentDay) {
                    if ($absentDay['std_student_id'] == $students[$i]["std_student_id"]) {
                        $students[$i][$absentDay["aca_assmt_term_id"]]["no_of_days_attended"]["area_total"]["score"] = ($overAllInstructionalDays - $absentDay['absent_days']);
                        $students[$i][$absentDay["aca_assmt_term_id"]]["attendance_in_percentage"]["area_total"]["score"] = round(100 * ($students[$i][$absentDay["aca_assmt_term_id"]]["no_of_days_attended"]["area_total"]["score"] / $students[$i][$absentDay["aca_assmt_term_id"]]["instructional_days"]["area_total"]["score"]), 0) . "%";
                        // $students[$i][$absentDay["aca_assmt_term_id"]]["attendance_in_percentage"]["area_total"]["pass_score"] = $minimum_required_attendance;
                    }
                }
                if ($consolidatedResult["data"]['passFail'] !== null) {
                    foreach ($consolidatedResult["data"]['passFail'] as $passFail) {
                        if ($passFail['std_student_id'] == $students[$i]["std_student_id"]) {
                            $students[$i]["final-result"]["result"]["area_total"]['score'] = $passFail['passed'];
                        }
                    }
                    if (is_numeric(str_replace('%', '', $students[$i]["final-result"]["attendance_in_percentage"]["area_total"]['score']))) {
                        $attendance = str_replace('%', '', $students[$i]["final-result"]["attendance_in_percentage"]["area_total"]['score']) + 0;
                        if ($attendance < $minimum_required_attendance) {
                            $students[$i]["final-result"]["result"]["area_total"]['score'] = 0;
                        }
                    }
                }
                // $students[$i][$termId]["attendance_in_percentage"]["area_total"]["score"] = round(100*($students[$i][$termId]["no_of_days_attended"]["area_total"]["score"]/$students[$i][$termId]["instructional_days"]["area_total"]["score"]),0)."%";
                // dd($absentDay["aca_assmt_term_id"],$instructionalDay["aca_assmt_term_id"]);   
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
        foreach ($areas as $key => $area) {
            if ($area["aca_assmt_term_id"] != $lastTermId && $lastTermId != "") {
                if ($totalWeightageTerm > 0) {
                    //Insert Total column at the end of a term
                    array_splice($subjects, $key, 0, [["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "subject_total", "subject" => "Total", "sub_dzo_name" => ""]]);
                    array_splice($originalAreas, $key + $indexAddSubject, 0, [["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "subject_total", "aca_assmt_area_id" => "area_total", "assessment_area" => "", "weightage" => "", "aca_rating_type_id" => "", "input_type" => 1]]);
                    $indexAddTerm++; //To adjust the index after inserting subject_total column

                    //Insert Percentage column at the end of a term
                    array_splice($subjects, $key + 1, 0, [["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "percentage", "subject" => "Percentage", "sub_dzo_name" => ""]]);
                    array_splice($originalAreas, $key + 1 + $indexAddSubject, 0, [["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "percentage", "aca_assmt_area_id" => "area_total", "assessment_area" => "", "weightage" => "", "aca_rating_type_id" => "", "input_type" => 1]]);
                    $indexAddTerm++; //To adjust the index after inserting percentage column

                    //Insert Position column at the end of a term
                    array_splice($subjects, $key + 1, 0, [["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "position", "subject" => "Position", "sub_dzo_name" => ""]]);
                    array_splice($originalAreas, $key + 1 + $indexAddSubject, 0, [["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "position", "aca_assmt_area_id" => "area_total", "assessment_area" => "", "weightage" => "", "aca_rating_type_id" => "", "input_type" => 1]]);
                    $indexAddTerm++; //To adjust the index after inserting percentage column

                    //Insert Result (Pass/Fail) column at the end of a term
                    if ($area["aca_assmt_term_id"] == "final-result") {
                        array_splice($subjects, $key + 1, 0, [["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "result", "subject" => "Result", "sub_dzo_name" => ""]]);
                        array_splice($originalAreas, $key + 1 + $indexAddSubject, 0, [["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "result", "aca_assmt_area_id" => "area_total", "assessment_area" => "", "weightage" => "", "aca_rating_type_id" => "", "input_type" => 1]]);
                        $indexAddTerm++; //To adjust the index after inserting percentage column
                    }
                }
                // Insert Instructioanl Days column at the end of a term
                array_splice($subjects, $key + 1, 0, [["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "instructional_days", "subject" => "Instructional Days", "sub_dzo_name" => ""]]);
                array_splice($originalAreas, $key + 1 + $indexAddSubject, 0, [["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "instructional_days", "aca_assmt_area_id" => "area_total", "assessment_area" => "", "weightage" => "", "aca_rating_type_id" => "", "input_type" => 1]]);
                $indexAddTerm++; //To adjust the index after inserting percentage column

                //Insert No. of Days Attended column at the end of a term
                array_splice($subjects, $key, 0, [["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "no_of_days_attended", "subject" => "No. of Days Attended", "sub_dzo_name" => ""]]);
                array_splice($originalAreas, $key + $indexAddSubject, 0, [["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "no_of_days_attended", "aca_assmt_area_id" => "", "assessment_area" => "area_total", "weightage" => "", "aca_rating_type_id" => "", "input_type" => 1]]);
                $indexAddTerm++; //To adjust the index after inserting no. of days attended column

                //Insert attendance_in_percentage column at the end of  a term
                array_splice($subjects, $key, 0, [["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "attendance_in_percentage", "subject" => "Attendance in %", "sub_dzo_name" => ""]]);
                array_splice($originalAreas, $key + $indexAddSubject, 0, [["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "attendance_in_percentage", "aca_assmt_area_id" => "", "assessment_area" => "area_total", "weightage" => "", "aca_rating_type_id" => "", "input_type" => 1]]);
                $indexAddTerm++; //To adjust the index after inserting attendance_in_percentage column

                //Insert remarks column at the end of  a term
                array_splice($subjects, $key + 1, 0, [["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "remarks", "subject" => "Remarks", "sub_dzo_name" => ""]]);
                array_splice($originalAreas, $key + 1 + $indexAddSubject, 0, [["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "remarks", "aca_assmt_area_id" => "area_total", "assessment_area" => "", "weightage" => "", "aca_rating_type_id" => "", "input_type" => 2]]);
                $indexAddTerm++; //To adjust the index after inserting percentage column

                //Reset total to 0
                $totalWeightageTerm = 0;
            }
            if ($totalWeightageSubject > 0 && (($area["aca_assmt_term_id"] != $lastTermId && $lastTermId != "") || ($area["aca_sub_id"] != $lastSubjectId && $lastSubjectId != ""))) {
                //Insert Total column at the end of a subject
                array_splice($originalAreas, $key + $indexAddSubject, 0, [["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => $lastSubjectId, "aca_assmt_area_id" => "area_total", "assessment_area" => "Total", "weightage" => $totalWeightageSubject, "aca_rating_type_id" => "", "input_type" => 1]]);
                $indexAddSubject++; //To adjust the index after inserting area_total column
                $totalWeightageSubject = 0;
            }
            if ($area["input_type"] == 1) {
                $totalWeightageTerm += $area["weightage"];
                $totalWeightageSubject += $area["weightage"];
            }
            $lastTermId = $area["aca_assmt_term_id"];
            $lastSubjectId = $area["aca_sub_id"];
        }
        //Insert the last total column for subject
        if ($totalWeightageSubject > 0) {
            array_push($originalAreas, ["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => $lastSubjectId, "aca_assmt_area_id" => "area_total", "assessment_area" => "Total", "weightage" => $totalWeightageSubject, "aca_rating_type_id" => "", "input_type" => 1]);
        }
        //Insert the last total column for term
        if ($totalWeightageTerm > 0) {
            array_push($subjects, ["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "subject_total", "subject" => "Total", "sub_dzo_name" => "", "is_aggregate" => 1]);
            array_push($originalAreas, ["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "subject_total", "aca_assmt_area_id" => "area_total", "assessment_area" => "", "weightage" => "", "aca_rating_type_id" => "", "input_type" => 1]);

            array_push($subjects, ["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "percentage", "subject" => "Percentage", "sub_dzo_name" => "", "is_aggregate" => 1]);
            array_push($originalAreas, ["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "percentage", "aca_assmt_area_id" => "area_total", "assessment_area" => "", "weightage" => "", "aca_rating_type_id" => "", "input_type" => 1]);

            array_push($subjects, ["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "position", "subject" => "Position", "sub_dzo_name" => "", "is_aggregate" => 1]);
            array_push($originalAreas, ["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "position", "aca_assmt_area_id" => "area_total", "assessment_area" => "", "weightage" => "", "aca_rating_type_id" => "", "input_type" => 1]);
        }
        if ($area["aca_assmt_term_id"] == "final-result") {
            array_push($subjects, ["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "result", "subject" => "Result", "sub_dzo_name" => "", "is_aggregate" => 1]);
            array_push($originalAreas, ["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "result", "aca_assmt_area_id" => "area_total", "assessment_area" => "", "weightage" => "", "aca_rating_type_id" => "", "input_type" => 1]);
        }
        array_push($subjects, ["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "instructional_days", "subject" => "Instructional Days", "sub_dzo_name" => "", "is_aggregate" => 1]);
        array_push($originalAreas, ["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "instructional_days", "aca_assmt_area_id" => "area_total", "assessment_area" => "", "weightage" => "", "aca_rating_type_id" => "", "input_type" => 1]);

        array_push($subjects, ["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "no_of_days_attended", "subject" => "No. of Days Attended", "sub_dzo_name" => "", "is_aggregate" => 1]);
        array_push($originalAreas, ["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "no_of_days_attended", "aca_assmt_area_id" => "area_total", "assessment_area" => "", "weightage" => "", "aca_rating_type_id" => "", "input_type" => 1]);

        array_push($subjects, ["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "attendance_in_percentage", "subject" => "Attendance in %", "sub_dzo_name" => "", "is_aggregate" => 1]);
        array_push($originalAreas, ["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "attendance_in_percentage", "aca_assmt_area_id" => "area_total", "assessment_area" => "", "weightage" => "", "aca_rating_type_id" => "", "input_type" => 1]);

        array_push($subjects, ["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "remarks", "subject" => "Remarks", "sub_dzo_name" => "", "is_aggregate" => 1]);
        array_push($originalAreas, ["aca_assmt_term_id" => $lastTermId, "aca_sub_id" => "remarks", "aca_assmt_area_id" => "area_total", "assessment_area" => "", "weightage" => "", "aca_rating_type_id" => "", "input_type" => 2]);
        return json_encode(["results" => $students, "terms" => $terms, "subjects" => $subjects, "areas" => $originalAreas, "overAllInstructionalDays" => $overAllInstructionalDays, "abbreviations" => $consolidatedResult["data"]['abbreviations'], "ratings" => $consolidatedResult["data"]['ratings']]);
    }
    public function saveConsolidatedResut(Request $request)
    {
        $request['user_id'] = $this->userId();
        $request['org_id'] = $this->getWrkingAgencyId();

        $data = $request->all();
        $response_data = $this->apiService->createData('emis/academics/saveConsolidatedResut', $data);
        return $response_data;
    }
    public function loadClassBySubjectTeacher()
    {
        $staffId = $this->staffId();
        $orgId = $this->getWrkingAgencyId();
        $response_data = $this->apiService->listData('emis/academics/loadClassBySubjectTeacher/' . $orgId . '/' . $staffId);
        return $response_data;
    }
    public function getTermsByFrequency($frequencyId)
    {
        $response_data = $this->apiService->listData('emis/academics/getTermsByFrequency/' . $frequencyId);
        return $response_data;
    }
    public function unlockForEditForConsolidated($Id)
    {
        $response_data = $this->apiService->createData('emis/academics/unlockForEditForConsolidated/' . $Id, []);
        return $response_data;
    }
    public function getResult($std_student_id)
    {
        $response_data = $this->apiService->listData('emis/academics/getResult/' . $std_student_id);
        return $response_data;
    }
    public function getSubjectByClass($class_id, $stream_id = "")
    {
        $uri = 'emis/academics/getSubjectByClass/' . $class_id;
        if ($stream_id) {
            $uri .= ('/' . $stream_id);
        }
        $response_data = $this->apiService->listData($uri);
        return $response_data;
    }
    public function getSubjectTeacherBySubId($aca_sub_id)
    {
        $response_data = $this->apiService->listData('emis/academics/getSubjectTeacherBySubId/' . $aca_sub_id);
        return $response_data;
    }
    public function getSubCategNonAcademic()
    {
        return $this->apiService->listData('emis/academics/getSubCategNonAcademic');
    }
    public function saveRemedialClass(Request $request)
    {
        $rules = [
            'org_class_id' => 'required',
            'class_stream_section' => 'required',
            'data.aca_sub_id'  => 'required',
            'data.stf_staff_id'  => 'required',
            'data.from_date'  => 'required',
            'data.to_date'  => 'required|after_or_equal:data.from_date',
            'data.total_hrs'  => 'required',
            'data.time_description'  => 'required',
            'data.std_student_id.*'  => 'required',
        ];
        $customMessages = [
            'org_class_id.required' => 'This field is required',
            'class_stream_section.required' => 'This field is required',
            'data.aca_sub_id.required' => 'This field is required',
            'data.stf_staff_id.required' => 'This field is required',
            'data.from_date.required' => 'This field is required',
            'data.total_hrs.required' => 'This field is required',
            'data.time_description.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $request['user_id'] = $this->userId();
        $request['org_id'] = $this->getWrkingAgencyId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/academics/saveRemedialClass', $data);
        return $response_data;
    }
    public function getRemedialClass()
    {
        $orgId = $this->getWrkingAgencyId();
        return $this->apiService->listData('emis/academics/getRemedialClass/' . $orgId);
    }
    public function getRemedialClassDetail($Id)
    {
        $orgId = $this->getWrkingAgencyId();
        return $this->apiService->listData('emis/academics/getRemedialClassDetail/' . $orgId . '/' . $Id);
    }
    public function getTermsForPublish()
    {
        $orgId = $this->getWrkingAgencyId();
        return $this->apiService->listData('emis/academics/getTermsForPublish/' . $orgId);
    }
    public function loadConsolidatedResultListForPublish($termId)
    {
        $orgId = $this->getWrkingAgencyId();
        return $this->apiService->listData('emis/academics/loadConsolidatedResultListForPublish/' . $orgId . '/' . $termId);
    }
    public function getConsolidatedResultForEdit($stdId, $termId, $subId)
    {
        $orgId = $this->getWrkingAgencyId();
        return $this->apiService->listData('emis/academics/getConsolidatedResultForEdit/' . $orgId . '/' . $stdId . '/' . $termId . '/' . $subId);
    }
    public function updateStatus(Request $request)
    {
        if ($request['action'] == 'approve') {
            $orgId = $this->getWrkingAgencyId();
            $dzonId = '';
            $gewogId = '';
            $subject_teacher_ids = '';
            //school
            $organization = json_decode($this->apiService->getListData('emis/common_services/loadOrgList/userworkingagency' . '/' . $orgId), true)['data'];
            if (count($organization)) {
                $organization = $organization[0];
                $dzonId = $organization['dzongkhagId'];
                $gewogId = $organization['gewogId'];
                //dzongkhag
                $organization['dzongkhag'] = json_decode($this->apiService->getListData('emis/common/getDzoNameById/' . $dzonId), true)['name'];
                //gewog
                $organization['gewog'] = json_decode($this->apiService->getListData('emis/common/getGewogNameById/' . $gewogId), true)['name'];
            }
            //principal
            $pricipal = json_decode($this->apiService->listData('emis/staff/getPrincipal/' . $orgId), true)['data'];

            $stream_id = $request['item']['org_stream_id'] == null ? '' : $request['item']['org_stream_id'];
            $section_id = $request['item']['org_section_id'] == null ? '' : $request['item']['org_section_id'];

            //class_teacher
            $class_teacher_id = $this->getClassTeacherByclass($orgId, $request['item']['org_class_id'], $stream_id, $section_id);
            $class_teacher = json_decode($this->apiService->listData('emis/staff/getStaffName/' . $class_teacher_id[0]['stf_staff_id']), true)['data'];

            //subject_teacher
            $subject_teachers_id = $this->getSubjectTeacherByclass($orgId, $request['item']['org_class_id'], $stream_id, $section_id);
            if (count($subject_teachers_id) > 0) {
                $subject_teacher_ids = implode(",", array_column($subject_teachers_id, 'stf_staff_id'));
            }
            $subject_teachers = json_decode($this->apiService->listData('emis/staff/getStaffsName?stf_staff_ids=' . $subject_teacher_ids), true)['data'];
            foreach ($subject_teachers_id as $key => $subject_teacher_id) {
                $key1  = array_search($subject_teacher_id['stf_staff_id'], array_column($subject_teachers, 'stf_staff_id'));
                $subject_teachers_id[$key]['name'] = $subject_teachers[$key1]['name'];
            }
            //student
            $stduents = $this->getStudents($orgId, $request['item']['OrgClassStreamId'], $request['item']['org_section_id']);

            //award 
            $awards = ['std_student_id' => '2'];
            $responsilities = ['chimi' => '2'];
            $class = [
                'class' => $request['item']['class'],
                'org_class_id' => $request['item']['org_class_id'],
                'stream' => isset($request['item']['stream']) ? $request['item']['stream'] : null,
                'org_stream_id' => $request['item']['org_stream_id'],
                'section' => isset($request['item']['section']) ? $request['item']['section'] : null,
                'org_section_id' => $request['item']['org_section_id'],
            ];
            $data = [
                'orgnization' => $organization,
                'pricipal' => $pricipal,
                'class' => $class,
                'class_teacher' => $class_teacher,
                'subject_teachers' => $subject_teachers_id,
                'stduents' => $stduents,
                'aca_result_consolidated_id' => $request['item']['aca_result_consolidated_id'],
                'awards' => $awards,
                'responsilities' => $responsilities,
                'action' => 'approve',
                'user_id' => $this->userId()
            ];
        } else {
            $data = $request->all();
        }
        return $this->apiService->createData('emis/academics/updateStatus', $data);
    }
    public function getSubjectOfTerm(Request $request)
    {
        $orgId = $this->getWrkingAgencyId();
        $uri = 'emis/academics/getSubjectOfTerm?org_id=' . $orgId . '&aca_term_id=' . $request['aca_term_id'] . '&std_student_id=' . $request['std_student_id'] . '&org_class_id=' . $request['org_class_id'];
        if ($request['org_stream_id']) {
            $uri .= ('&org_stream_id=' . $request['org_stream_id']);
        }
        if ($request['org_section_id']) {
            $uri .= ('&org_section_id=' . $request['org_section_id']);
        }
        return $this->apiService->listData($uri);
    }
    public function updateResult(Request $request)
    {
        $request['user_id'] = $this->userId();
        $request['org_id'] = $this->getWrkingAgencyId();
        $data = $request->all();
        $response_data = $this->apiService->createData('emis/academics/updateResult', $data);
        return $response_data;
    }
    public function getApprovedTerms(Request $request)
    {
        $orgId = $this->getWrkingAgencyId();
        $uri = 'emis/academics/getApprovedTerms?academic_year=' . $request['academic_year'] . '&org_id=' . $orgId . '&org_class_id=' . $request['org_class_id'];
        if ($request['org_stream_id']) {
            $uri .= ('&org_stream_id=' . $request['org_stream_id']);
        }
        if ($request['org_section_id']) {
            $uri .= ('&org_section_id=' . $request['org_section_id']);
        }
        return $this->apiService->listData($uri);
    }
    public function getStudentsForProgressReport($Id)
    {
        return $this->apiService->listData('emis/academics/getStudentsForProgressReport/' . $Id);
    }
    public function getProgressReport($resultStdId, $resultId)
    {
        return $this->apiService->listData('emis/academics/getProgressReport/' . $resultStdId . '/' . $resultId);
    }
    private function getClassTeacherByclass($orgId, $class_id, $stream_id, $section_id)
    {
        $uri = "emis/academics/getClassTeacherByclass/" . $orgId . "?org_class_id=" . $class_id;
        if ($stream_id != '') {
            $uri .= "&org_stream_id=" . $stream_id;
        }
        if ($section_id != '') {
            $uri .= "&org_section_id=" . $section_id;
        }
        return json_decode($this->apiService->listData($uri), true)['data'];
    }
    private function getSubjectTeacherByclass($orgId, $class_id, $stream_id, $section_id)
    {
        $uri = "emis/academics/getSubjectTeacherByclass/" . $orgId . "?org_class_id=" . $class_id;
        if ($stream_id != '') {
            $uri .= "&org_stream_id=" . $stream_id;
        }
        if ($section_id != '') {
            $uri .= "&org_section_id=" . $section_id;
        }
        return json_decode($this->apiService->listData($uri), true)['data'];
    }
    private function getElectiveSubjects($classId, $streamId = "")
    {
        $uri = 'emis/academics/getElectiveSubjects/' . $classId;
        if ($streamId) {
            $uri .= ('/' . $streamId);
        }
        $response_data = $this->apiService->listData($uri);
        return $response_data;
    }
    private function getOptionalSubjectOrgWise($orgId, $classId, $streamId, $sectionId)
    {
        $uri = 'emis/organization/getOptionalSubjectOrgWise/' . $orgId . '?classId=' . $classId;
        $stream = $streamId == null ? "" : $streamId;
        $section = $sectionId == null ? "" : $sectionId;
        if ($stream != "") {
            $uri .= (('&streamId=' . $stream));
        }
        if ($section != "") {
            $uri .= (('&sectionId=' . $section));
        }
        $optionalSubjectOrgWise = json_decode($this->apiService->listData($uri), true);
        return $optionalSubjectOrgWise;
    }
    private function getStudents($org_id, $OrgClassStreamId, $org_section_id = "")
    {
        $uri = 'emis/students/getStudents/' . $org_id;
        $uri .= ('?OrgClassStreamId=' . $OrgClassStreamId);
        if ($org_section_id !== null) {
            $uri .= (('&sectionId=' . $org_section_id));
        }
        $students = json_decode($this->apiService->listData($uri), true);
        return $students['data'];
    }
    private function loadAssessmentAreas($term_id, $sub_id, $class_id, $stream_id = "")
    {
        $uri = 'emis/academics/loadAssessmentAreas/' . $term_id . '/' . $sub_id . '/' . $class_id;
        if ($stream_id) {
            $uri .= ('/' . $stream_id);
        }
        $response_data = $this->apiService->listData($uri);
        return $response_data;
    }
    private function hasTerm($row, $terms)
    {
        return (in_array($row["aca_assmt_term_id"], array_column($terms, "aca_assmt_term_id")));
    }
    private function hasSubject($row, $subjects)
    {
        return (in_array($row["aca_assmt_term_id"], array_column($subjects, "aca_assmt_term_id")) && in_array($row["aca_sub_id"], array_column($subjects, "aca_sub_id")));
    }
    private function hasArea($row, $areas)
    {
        return (in_array($row["aca_assmt_term_id"], array_column($areas, "aca_assmt_term_id")) && in_array($row["aca_sub_id"], array_column($areas, "aca_sub_id")) && in_array($row["aca_assmt_area_id"], array_column($areas, "aca_assmt_area_id")));
    }
}
