<?php

namespace App\Http\Controllers\academic;

use Exception;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\academics\ClassTeacher;
use App\Models\academics\ClassTeacherHistory;
use App\Models\academics\InstructionalDaysForSpecialCase;
use App\Models\academics\RemedialClass;
use App\Models\academics\RemedialClassDetail;
use App\Models\academics\SubjectTeacher;
use App\Models\academics\StudentAssessment;
use App\Models\academics\ResultConsolidated;
use App\Models\academics\StudentElectiveSubject;
use App\Models\academics\StudentAssessmentDetail;
use App\Models\academics\ResultConsolidatedDetail;
use App\Models\academics\StudentAssessmentHistory;
use App\Models\academics\StudentAttendance;
use App\Models\academics\StudentAttendanceDetail;
use App\Models\academics\StudentAttendanceHistory;
use App\Models\academics\StudentElectiveSubjectHistory;
use App\Models\academics\SubjectTeacherHistory;

class AcademicController extends Controller
{
    use ApiResponser;

    public $audit_table = "system_admin";

    public $database = "academic_db";

    public function getClassTeacher($orgId)
    {
        return $this->successResponse(DB::select('SELECT org_id,org_class_id, org_stream_id, org_section_id, stf_staff_id FROM aca_class_teacher WHERE org_id = ?', [$orgId]));
    }
    public function getClassTeacherClasss($orgId, $staffId)
    {
        return $this->successResponse(DB::select('SELECT org_id,org_class_id, org_class_stream_id,org_stream_id, org_section_id, stf_staff_id,class_stream_section FROM aca_class_teacher WHERE org_id = ? AND stf_staff_id = ?', [$orgId, $staffId]));
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
        DB::transaction(function () use ($request) {
            $this->updateClassTeacher($request);
            $query = 'DELETE FROM aca_class_teacher WHERE org_id = ?';
            DB::delete($query, [$request['data'][0]['org_id']]);
            foreach ($request['data'] as $classTeacher) {
                $classTeacher['created_by'] =  $request['user_id'];
                $classTeacher['created_at'] =   date('Y-m-d h:i:s');
                ClassTeacher::create($classTeacher);
            }
        });
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    private function updateClassTeacher($request)
    {
        foreach ($request['data'] as $classTeacher) {
            $classTeacher['created_by'] =  $request['user_id'];
            $classTeacher['created_at'] =   date('Y-m-d h:i:s');
            $classTeacher['updated_by'] =   $request['user_id'];
            $classTeacher['updated_at'] =   date('Y-m-d h:i:s');
            $classTeacher['recorded_for'] =  'Class Teacher Change';
            ClassTeacherHistory::create($classTeacher);
        }
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
        DB::transaction(function () use ($request) {
            try {
                $this->updateSubjectTeacher($request);
                $query = "DELETE FROM aca_class_subject_teacher WHERE org_id = ? AND org_class_id = ?";
                $param = [$request['org_id'], $request['org_class_id']];

                if ($request['org_stream_id']) {
                    $query .= ' AND org_stream_id = ?';
                    array_push($param, $request['org_stream_id']);
                }
                if ($request['org_section_id']) {
                    $query .= ' AND org_section_id = ?';
                    array_push($param, $request['org_section_id']);
                }
                DB::delete($query, $param);
                foreach ($request['data'] as $subjectTeacher) {
                    if (array_key_exists("stf_staff_id", $subjectTeacher) && array_key_exists("aca_sub_id", $subjectTeacher) && $subjectTeacher["stf_staff_id"] && $subjectTeacher["aca_sub_id"]) {
                        $subjectTeacher['org_id'] =  $request['org_id'];
                        $subjectTeacher['class_stream_section'] =  $request['class_stream_section'];
                        $subjectTeacher['org_stream_id'] =  $request['org_stream_id'];
                        $subjectTeacher['org_section_id'] =  $request['org_section_id'];
                        $subjectTeacher['created_by'] =  $request['user_id'];
                        $subjectTeacher['created_at'] =  date('Y-m-d h:i:s');
                        SubjectTeacher::create($subjectTeacher);
                    }
                }
            } catch (Exception $e) {
                dd($e);
            }
        });
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    private function updateSubjectTeacher($request)
    {
        foreach ($request['data'] as $subjectTeacher) {
            if (array_key_exists("stf_staff_id", $subjectTeacher) && array_key_exists("aca_sub_id", $subjectTeacher) && $subjectTeacher["stf_staff_id"] && $subjectTeacher["aca_sub_id"]) {
                $subjectTeacher['org_id'] =  $request['org_id'];
                $subjectTeacher['org_stream_id'] =  $request['org_stream_id'];
                $subjectTeacher['org_section_id'] =  $request['org_section_id'];
                $subjectTeacher['class_stream_section'] =  $request['class_stream_section'];
                $subjectTeacher['created_by'] =  $request['user_id'];
                $subjectTeacher['created_at'] =   date('Y-m-d h:i:s');
                $subjectTeacher['updated_at'] =   date('Y-m-d h:i:s');
                $subjectTeacher['recorded_for'] =  'Subject Teacher Change';
                SubjectTeacherHistory::create($subjectTeacher);
            }
        }
    }
    public function getSubjectTeacher(Request $request, $orgId)
    {
        try {
            $query = "SELECT t1.org_class_id, t1.org_stream_id, t1.aca_sub_id,t2.name,t1.is_elective, t2.dzo_name,t3.aca_teacher_sub_id FROM aca_class_subject t1 JOIN aca_subject t2 ON t1.aca_sub_id = t2.id LEFT JOIN aca_subject_mapping_for_tre t3 ON t2.id=t3.aca_sub_id AND t1.org_class_id = t3.org_class_id  WHERE t2.assessed_by_class_teacher<>1 AND t1.org_class_id = ?";
            $query1 = "SELECT org_id, stf_staff_id, org_class_id, org_stream_id,org_section_id, aca_sub_id FROM aca_class_subject_teacher WHERE org_id = ? AND org_class_id = ?";
            $query2 = "SELECT org_class_id,org_stream_id,aca_sub_id,aca_teacher_sub_id,standard_hours,standard_minutes FROM aca_subject_mapping_for_tre WHERE org_class_id = ?";
            $param = [$request['org_class_id']];
            $param1 = [$orgId, $request['org_class_id']];

            if ($request['org_stream_id']) {
                $query .= ' AND t1.org_stream_id = ?';
                $query1 .= ' AND org_stream_id = ?';
                $query2 .= ' AND org_stream_id = ?';
                array_push($param, $request['org_stream_id']);
                array_push($param1, $request['org_stream_id']);
            }
            if ($request['org_section_id']) {
                $query1 .= ' AND org_section_id = ?';
                array_push($param1, $request['org_section_id']);
            }
            $classSubjects = DB::select($query . " GROUP BY t1.org_class_id,t1.is_elective, t1.org_stream_id, t1.aca_sub_id,t2.name, t2.dzo_name,t3.aca_teacher_sub_id", $param);
            $classSubjectTeachers = DB::select($query1, $param1);
            $subjectMappingForTre = DB::select($query2, $param);

            return $this->successResponse(["classSubjects" => $classSubjects, "classSubjectTeachers" => $classSubjectTeachers, "subjectMappingForTre" => $subjectMappingForTre]);
        } catch (Exception $e) {
            dd($e);
        }
    }
    public function getStudentElectiveSubjects()
    {
        return $this->successResponse(
            DB::select('SELECT std_student_id, aca_sub_id FROM aca_student_elective_subject')
        );
    }
    public function getElectiveSubjects($classId, $streamId = "")
    {
        $query = 'SELECT t1.aca_sub_id,t1.org_class_id,t1.org_stream_id,t2.name AS subject, t2.dzo_name FROM aca_class_subject t1 JOIN aca_subject t2 ON t1.aca_sub_id = t2.id WHERE t1.is_elective = 1 AND t1.org_class_id = ?';
        $params = [$classId];
        if ($streamId) {
            $query .= ' AND t1.org_stream_id = ?';
            array_push($params, $streamId);
        }

        return $this->successResponse(DB::select($query, $params));
    }
    public function getClassWithElectiveSubject()
    {
        $classWithElectiveSubject = DB::select('SELECT DISTINCT org_class_id, org_stream_id FROM aca_class_subject WHERE is_elective = 1');
        return $this->successResponse($classWithElectiveSubject);
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
        try {
            DB::transaction(function () use ($request) {
                foreach ($request['data'] as $electiveSubject) {
                    $this->updateOptionalSubject($request, $electiveSubject);
                    DB::delete('DELETE FROM aca_student_elective_subject WHERE std_student_id = ?', [$electiveSubject['std_student_id']]);
                    foreach ($electiveSubject as $key => $value) {
                        if ($key == $value && $value) {
                            StudentElectiveSubject::create(
                                ['std_student_id' => $electiveSubject['std_student_id'], 'aca_sub_id' => $value, 'created_by' => $request['user_id'], 'created_at' => date('Y-m-d h:i:s')]
                            );
                        }
                    }
                }
            });
        } catch (Exception $e) {
            dd($e);
        }
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    private function updateOptionalSubject($request, $electiveSubject)
    {
        foreach ($electiveSubject as $key => $value) {
            if ($key == $value && $value) {
                StudentElectiveSubjectHistory::create(
                    ['std_student_id' => $electiveSubject['std_student_id'], 'aca_sub_id' => $value, 'recorded_for' => 'Optional Subject Change', 'created_by' => $request['user_id'], 'created_at' => date('Y-m-d h:i:s')]
                );
            }
        }
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
        if ($request['action'] == "add") {
            $rules['attendance_date'] = ['required', Rule::unique('aca_student_attendance')->where('org_class_id', $request->org_class_id)];
            $this->validate($request, $rules, $customMessages);
            DB::transaction(function () use ($request) {
                $this->saveAttendance($request->all());
            });
        } else if ($request['action'] == "edit") {
            try {
                $this->validate($request, $rules, $customMessages);
                $query = 'DELETE FROM aca_student_attendance WHERE org_id = ? AND org_class_id = ? AND attendance_date = ?';
                $params = [$request->org_id, $request->org_class_id, $request->attendance_date];
                if ($request->org_stream_id) {
                    $query .= ' AND org_stream_id = ?';
                    array_push($params, $request->org_stream_id);
                }
                if ($request->org_section_id) {
                    $query .= ' AND org_section_id = ?';
                    array_push($params, $request->org_section_id);
                }
                DB::transaction(function () use ($request, $query, $params) {
                    // $this->updateAttendance($request);
                    DB::delete($query, $params);
                    $this->saveAttendance($request->all());
                });
            } catch (Exception $e) {
                dd($e);
            }
        }
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    private function updateAttendance($request)
    {
        $org_stream_id = isset($request['org_stream_id']) ? $request['org_stream_id'] : null;
        $org_section_id = isset($request['org_section_id']) ? $request['org_section_id'] : null;
        foreach ($request["data"] as $studentAttendance) {
            if ($studentAttendance['is_present'] == "0") {
                $data = [
                    'org_id' => $request['org_id'],
                    'org_class_id' => $request['org_class_id'],
                    'org_stream_id' =>  $org_stream_id,
                    'org_section_id' =>  $org_section_id,
                    'class_stream_section' => $request['class_stream_section'],
                    'attendance_date' => $request['attendance_date'],
                    'std_student_id' => $studentAttendance['std_student_id'],
                    'aca_absence_reason_id' => $studentAttendance['aca_absence_reason_id'],
                    'recorded_for' => "Student Attendance Change",
                    'created_by' => $request['user_id'],
                    'created_at' => date('Y-m-d h:i:s')
                ];
                StudentAttendanceHistory::create($data);
            }
        }
    }
    public function getTermsByClass($classId, $streamId = "")
    {
        $query = 'SELECT t1.id,t1.name,t1.dzo_name FROM aca_assessment_term t1 
                    JOIN aca_class_assessment_frequency t2 ON t1.aca_assmt_frequency_id = t2.aca_assmt_frequency_id 
                 WHERE t2.org_class_id = ?';
        $param = [$classId];
        if ($streamId) {
            $query .= ' AND t2.org_stream_id';
            array_push($param, $streamId);
        }
        $getTerms = $this->successResponse(DB::select("$query AND t1.status = 1", $param));
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

        if ($request['action'] == 'add') {
            $data = [
                'org_id' => $request['org_id'],
                'org_class_id' => $request['org_class_id'],
                'org_stream_id' => $request['org_stream_id'],
                'org_section_id' => $request['org_section_id'],
                'org_class_stream_id' => $request['org_class_stream_id'],
                'class_stream_section' => $request['class_stream_section'],
                'std_student_id' => $request['std_student_id'],
                'aca_assmt_term_id' => $request['aca_assmt_term_id'],
                'instructional_days' => $request['instructional_days'],
                'remarks' => $request['remarks'],
                'created_by' => $request['user_id'],
                'created_at' => date('Y-m-d h:i:s'),
            ];
            try {
                $response_data = InstructionalDaysForSpecialCase::create($data);
            } catch (Exception $e) {
                dd($e);
            }
        }
        if ($request['action'] == 'edit') {
            $data = InstructionalDaysForSpecialCase::find($request['id']);
            // $messs_det='org_id:'.$data->org_id.'; org_class_id:'.$data->org_class_id.'; org_stream_id:'.$data->org_stream_id.'; org_class_stream_id:'.$data->org_class_stream_id.'; class_stream_section:'.$data->class_stream_section.'; std_student_id:'.$data->std_student_id.'; aca_assmt_term_id:'.$data->aca_assmt_term_id.'; instructional_days:'.$data->instructional_days.'; remarks:'.$data->remarks;
            // $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','aca_instructional_days_special_case','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
            $data->org_id = $request['org_id'];
            $data->org_class_id = $request['org_class_id'];
            $data->org_stream_id = $request['org_stream_id'];
            $data->org_class_stream_id = $request['org_class_stream_id'];
            $data->class_stream_section = $request['class_stream_section'];
            $data->std_student_id = $request['std_student_id'];
            $data->aca_assmt_term_id = $request['aca_assmt_term_id'];
            $data->instructional_days = $request['instructional_days'];
            $data->remarks = $request['remarks'];
            $data->update();
            $response_data = $data;
        }
        return $response_data;
    }
    public function getInstrunctionalDays()
    {
        $instructional_days_special_case = DB::select("SELECT t1.id,t1.org_id,t1.org_class_stream_id, t1.org_class_id,t1.org_stream_id,t1.org_section_id,t1.class_stream_section,t1.std_student_id,t1.aca_assmt_term_id,t2.name AS term,t1.instructional_days,t1.remarks,COUNT(t3.id) AS no_instructional_days_regular,COUNT(t4.id) AS no_days_absent
        FROM aca_instructional_days_special_case t1 JOIN aca_assessment_term t2 ON t1.aca_assmt_term_id = t2.id 
                JOIN aca_student_attendance t3 ON t1.org_class_id = t3.org_class_id AND (t1.org_stream_id = t3.org_stream_id OR (t1.org_stream_id IS NULL 
                AND t3.org_stream_id IS NULL)) AND (t1.org_section_id = t3.org_section_id OR (t1.org_section_id IS NULL AND t3.org_section_id IS NULL)) 
                AND t3.attendance_date BETWEEN CONCAT(YEAR(CURDATE()),'-',LPAD(t2.from_month,2,'0'),'-',LPAD(t2.from_date,2,'0')) 
         AND CONCAT(YEAR(CURDATE()),'-',LPAD(t2.to_month,2,'0'),'-',LPAD(t2.to_date,2,'0')) 
                LEFT JOIN aca_student_attendance_detail t4 ON t3.id = t4.aca_std_attendance_id AND t1.std_student_id = t4.std_student_id 
         GROUP BY t1.id,t1.org_id,t1.org_class_stream_id, t1.org_class_id,t1.org_stream_id,t1.org_section_id,t1.class_stream_section,t1.std_student_id,t1.aca_assmt_term_id,t2.name,t1.instructional_days,t1.remarks");
        return $this->successResponse($instructional_days_special_case);
    }
    public function loadStudentAssessmentList(Request $request, $staffId, $orgId)
    {
        try {
            $param = [$staffId, $orgId];
            $classTeacher = "SELECT COUNT(id)  AS is_class_teacher FROM aca_class_teacher WHERE org_id = ? AND stf_staff_id = ? AND org_class_id = ? ";
            $classTeacherParams = [$orgId, $staffId, $request->org_class_id];
            if ($request->org_stream_id !== null) {
                $classTeacher .= " AND org_stream_id = ?";
                array_push($classTeacherParams, $request->org_stream_id);
            }
            if ($request->org_section_id !== null) {
                $classTeacher .= " AND org_section_id = ?";
                array_push($classTeacherParams, $request->org_section_id);
                $sectionConditiont3 = " AND t3.org_section_id = ?";
                array_push($param, $request->org_section_id);
            }
            array_push($param, $orgId);
            if ($request->org_section_id !== null) {
                $sectionConditiont6 = " AND IF(t3.org_section_id IS NULL, t6.org_section_id = ?, t3.org_section_id=t6.org_section_id)";
                array_push($param, $request->org_section_id);
            }
            array_push($param, $request->aca_assmt_term_id);
            array_push($param, $request->org_class_id);

            $isClassTeacher = (DB::select($classTeacher, $classTeacherParams))[0]->is_class_teacher;
            $classTeacherSubjects = "SELECT t2.assessed_by_class_teacher,
            t6.id AS std_assmt_id,
            t1.aca_sub_id,
            x2.id AS aca_assmt_term_id,
            t2.name AS sub_name,
            t2.dzo_name AS sub_dzo_name,
            x2.name AS term_name,
            x2.dzo_name AS term_dzo_name,
            t1.is_elective,
            $isClassTeacher AS is_class_teacher,
            (t3.stf_staff_id IS NOT NULL OR ($isClassTeacher=1 AND t2.assessed_by_class_teacher=1)) AS is_subject_teacher,
            t6.finalized,
            DATE_FORMAT(t6.finalized_date,'%d-%m-%Y %H:%i %p') AS finalized_date
        FROM aca_class_subject t1 JOIN aca_subject t2 ON t1.aca_sub_id=t2.id
            JOIN (aca_class_assessment_frequency x1 JOIN aca_assessment_term x2 ON x1.aca_assmt_frequency_id=x2.aca_assmt_frequency_id) ON t1.org_class_id = x1.org_class_id AND (t1.org_stream_id = x1.org_stream_id OR (t1.org_stream_id IS NULL AND x1.org_stream_id IS NULL))
            LEFT JOIN aca_class_subject_teacher t3 ON t3.stf_staff_id = ? AND t3.org_id = ? AND t1.aca_sub_id = t3.aca_sub_id AND t1.org_class_id = t3.org_class_id AND (t1.org_stream_id = t3.org_stream_id OR (t1.org_stream_id IS NULL AND t3.org_stream_id IS NULL)) $sectionConditiont3
            LEFT JOIN aca_student_assessment t6 ON t6.org_id = ? AND t1.aca_sub_id = t6.aca_sub_id AND x2.id=t6.aca_assmt_term_id AND t1.org_class_id = t6.org_class_id AND (t1.org_stream_id = t6.org_stream_id OR (t1.org_stream_id IS NULL AND t6.org_stream_id IS NULL)) $sectionConditiont6
        WHERE x2.id = ? AND t1.org_class_id = ?";

            if ($request->org_stream_id !== null) {
                $classTeacherSubjects .= " AND t1.org_stream_id = ?";
                array_push($param, $request->org_stream_id);
            }
            if (!$isClassTeacher) {
                $classTeacherSubjects .= " AND t3.stf_staff_id IS NOT NULL";
            }
            return $this->successResponse(DB::select($classTeacherSubjects, $param));
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function loadAssessmentAreas($term_id, $sub_id, $class_id, $stream_id = "")
    {
        $areaFormat = DB::table("aca_setting")->where("id", 1)->value("value");
        $rating_type_descriptive_id = DB::table('aca_rating_type')->where('input_type', 2)->value('id');
        $query = "SELECT t1.aca_assmt_area_id,IF($areaFormat=2,t2.name,IFNUll(t2.code,t2.name)) AS assessment_area,IF($areaFormat=1,(t2.name),'') AS name,
         IF($areaFormat=1,(t2.code),'') AS code ,t2.dzo_name AS assmt_area_dzo_name, TRIM(t1.weightage)+0 AS weightage,
         IF(t2.is_descriptive = 1,'$rating_type_descriptive_id',t3.aca_rating_type_id) AS aca_rating_type_id,IF(t2.is_descriptive = 1,2,t4.input_type) AS input_type, t1.display_order
        FROM aca_class_subject_assessment t1
            JOIN aca_assessment_area t2 ON t1.aca_sub_id = t2.aca_sub_id AND t1.aca_assmt_area_id=t2.id
            JOIN aca_class_subject t3 on t1.aca_sub_id=t3.aca_sub_id AND t1.org_class_id = t3.org_class_id AND (t1.org_stream_id = t3.org_stream_id OR (t1.org_stream_id IS NULL AND t3.org_stream_id IS NULL))
            JOIN aca_rating_type t4 ON t3.aca_rating_type_id=t4.id
        WHERE t1.aca_assmt_term_id = ? AND t1.aca_sub_id = ? AND t1.org_class_id =?";
        $params = [$term_id, $sub_id, $class_id];
        if ($stream_id) {
            $query .= ' AND t1.org_stream_id = ?';
            array_push($params, $stream_id);
        }
        $assessmentAreas = DB::select($query . " ORDER BY IFNULL(t1.display_order,t2.display_order)", $params);
        $ratings = DB::select('SELECT id, aca_rating_type_id, name, score FROM aca_rating WHERE status=1 ORDER BY score');
        return $this->successResponse(["assessmentAreas" => $assessmentAreas, "ratings" => $ratings]);
    }

    public function loadStudentAssessments($org_id, Request $request)
    {
        $studentsTakingElective = false;
        if ($this->isElectiveSubject($request->aca_sub_id, $request->org_class_id, $request->org_stream_id)) {
            $studentsTakingElective = DB::table("aca_student_elective_subject")->where("aca_sub_id", $request->aca_sub_id)->pluck("std_student_id");
        }
        $query = "SELECT t1.id,t2.std_student_id,t2.aca_assmt_area_id, t2.aca_rating_type_id, t2.descriptive_score, IF(t4.input_type=2,t2.descriptive_score,NULLIF(TRIM(t2.score)+0,0)) AS score, IF(t4.input_type=2,t2.descriptive_score,IFNULL(t3.name,NULLIF(TRIM(t2.score)+0,0))) AS score_text, t2.remarks FROM aca_student_assessment t1 JOIN aca_student_assessment_detail t2 ON t1.id=t2.aca_student_assmt_id JOIN aca_rating_type t4 ON t2.aca_rating_type_id=t4.id LEFT JOIN aca_rating t3 ON t2.aca_rating_type_id = t3.aca_rating_type_id AND ifnull((TRIM(t2.score)+0),0) = t3.score WHERE t1.org_id = ? AND t1.aca_assmt_term_id =? AND t1.aca_sub_id =? AND t1.org_class_id = ? ";
        $param = [$org_id, $request->aca_assmt_term_id, $request->aca_sub_id, $request->org_class_id];
        if ($request->org_stream_id) {
            $query .= ' AND t1.org_stream_id = ?';
            array_push($param, $request->org_stream_id);
        }
        if ($request->org_section_id) {
            $query .= ' AND t1.org_section_id = ?';
            array_push($param, $request->org_section_id);
        }
        $studentAssessments = DB::select($query, $param);
        return $this->successResponse(['studentAssessments' => $studentAssessments, 'studentsTakingElective' => $studentsTakingElective]);
    }

    private function isElectiveSubject($subId, $classId, $streamId = "")
    {
        $query = "SELECT is_elective FROM aca_class_subject WHERE aca_sub_id = ? and org_class_id = ? ";
        $param = [$subId, $classId];
        if ($streamId) {
            $query .= ' AND org_stream_id = ?';
            array_push($param, $streamId);
        }
        $isElectiveQ = DB::select($query, $param);
        return $isElectiveQ[0]->is_elective;
    }
    public function loadStudentAttendance($orgId, $staffId)
    {
        $studentAttendance =  DB::select("SELECT t1.org_id,t1.org_class_id, t1.org_stream_id, t1.org_section_id,t1.attendance_date
                FROM aca_student_attendance t1
            LEFT JOIN aca_class_teacher t2 ON t1.org_id = t2.org_id AND t1.org_class_id = t2.org_class_id AND (t1.org_stream_id = t2.org_stream_id OR (t1.org_stream_id IS NULL AND t2.org_stream_id IS NULL)) AND (t1.org_section_id = t2.org_section_id OR (t1.org_section_id IS NULL AND t2.org_section_id IS NULL)) AND t2.stf_staff_id = ?
            WHERE t1.org_id = ? AND t2.stf_staff_id = ? ORDER BY t1.attendance_date DESC", [$staffId, $orgId, $staffId]);

        return $this->successResponse($studentAttendance);
    }
    public function loadStudentAttendanceDetail($orgId, Request $request)
    {
        $query = "SELECT (t2.id IS NOT NULL) AS absent, t1.org_id,t1.org_class_id, t1.org_stream_id, t1.org_section_id,t1.attendance_date,t2.std_student_id,t2.aca_absence_reason_id
                        FROM aca_student_attendance t1
                   LEFT JOIN aca_student_attendance_detail t2 ON t1.id = t2.aca_std_attendance_id WHERE t1.attendance_date = ? AND t1.org_id = ? AND t1.org_class_id = ?";
        $params = [$request->attendance_date, $orgId, $request->org_class_id];

        if ($request->org_stream_id) {
            $query .= ' AND t1.org_stream_id = ?';
            array_push($params, $request->org_stream_id);
        }
        if ($request->org_section_id) {
            $query .= ' AND t1.org_section_id = ?';
            array_push($params, $request->org_section_id);
        }
        $query1 = "SELECT attendance_date FROM  aca_student_attendance WHERE org_id = ? AND org_class_id = ?";
        $params1 = [$orgId, $request->org_class_id];
        if ($request->org_stream_id) {
            $query1 .= ' AND org_stream_id = ?';
            array_push($params1, $request->org_stream_id);
        }
        if ($request->org_section_id) {
            $query1 .= ' AND org_section_id = ?';
            array_push($params1, $request->org_section_id);
        }

        $studentAttendanceDetail = DB::select($query, $params);
        $hasAttendance = DB::select($query1, $params1);

        return $this->successResponse(["studentAttendanceDetail" => $studentAttendanceDetail, "hasAttendance" => $hasAttendance]);
    }
    public function getAttendanceData($orgId, Request $request)
    {
        $query = "SELECT COUNT(t1.id) AS no_instructional_days,(COUNT(t1.id)-COUNT(t2.id)) AS no_days_present
            FROM aca_student_attendance t1 
                JOIN aca_assessment_term t2 ON t1.attendance_date BETWEEN CONCAT(YEAR(CURDATE()),'-',LPAD(t2.from_month,2,'0'),'-',LPAD(t2.from_date,2,'0')) 
                    AND CONCAT(YEAR(CURDATE()),'-',LPAD(t2.to_month,2,'0'),'-',LPAD(t2.to_date,2,'0')) 
                LEFT JOIN aca_student_attendance_detail t3 ON t1.id = t3.aca_std_attendance_id AND t3.std_student_id = ?
            WHERE t1.org_id = ? AND t2.id = ? AND t1.org_class_id = ? ";
        $params = [$request->std_id, $orgId, $request->aca_assmt_term_id, $request->org_class_id];
        if ($request->org_stream_id) {
            $query .= ' AND t1.org_stream_id = ?';
            array_push($params, $request->org_stream_id);
        }
        if ($request->org_section_id) {
            $query .= ' AND t1.org_section_id = ?';
            array_push($params, $request->org_section_id);
        }
        $absentee = DB::select($query, $params);
        return $this->successResponse($absentee);
    }
    public function saveStudentAssessment(Request $request, $userId)
    {
        $rules = [
            'data.*.std_student_id' => 'required',
        ];
        $customMessages = [
            'data.*.std_student_id.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        try {
            DB::transaction(function () use ($request, $userId) {
                $query = "DELETE FROM aca_student_assessment WHERE org_id = ? AND aca_assmt_term_id = ? AND org_class_id = ? AND aca_sub_id = ? ";
                $param = [$request['data'][0]['org_id'], $request['aca_assmt_term_id'], $request['org_class_id'], $request['aca_sub_id']];

                if ($request['org_stream_id']) {
                    $query .= ' AND org_stream_id = ?';
                    array_push($param, $request['org_stream_id']);
                }
                if ($request['org_section_id']) {
                    $query .= ' AND org_section_id = ?';
                    array_push($param, $request['org_section_id']);
                }
                // $this->updateStudentAssessment($request,$userId);
                DB::delete($query, $param);

                $result = [
                    'org_id' => $request['data'][0]['org_id'],
                    'org_class_id' => $request['org_class_id'],
                    'org_stream_id'  =>  $request['org_stream_id'],
                    'org_section_id' => $request['org_section_id'],
                    'aca_sub_id' => $request['aca_sub_id'],
                    'aca_assmt_term_id' =>  $request['aca_assmt_term_id'],
                    'class_stream_section' =>  $request['class_stream_section'],
                    'created_by' =>  $userId,
                    'created_at' =>   date('Y-m-d h:i:s'),
                ];
                if ($request['finalize']) {
                    $result['finalized'] = 1;
                    $result['finalized_date'] = date('Y-m-d h:i:s');
                }
                $studentAssessment = StudentAssessment::create($result);
                foreach ($request['data'] as $studentAssessmentDetail) {
                    foreach ($studentAssessmentDetail as $value) {
                        if (gettype($value) == "array") {
                            $data = [
                                'aca_student_assmt_id' => $studentAssessment->id,
                                'std_student_id' => $studentAssessmentDetail['std_student_id'],
                                'aca_assmt_area_id' => $value['aca_assmt_area_id'],
                                'aca_rating_type_id' => $value['aca_rating_type_id'],
                                'created_by' => $userId,
                                'created_at' => date('Y-m-d h:i:s')
                            ];
                            if (array_key_exists("descriptive_score", $value)) {
                                $data['descriptive_score'] = $value['descriptive_score'];
                            } else if (array_key_exists("score", $value)) {
                                $data['score'] = $value['score'];
                            }
                            StudentAssessmentDetail::create($data);
                        }
                    }
                }
            });
        } catch (Exception $e) {
            dd($e);
        }
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    private function updateStudentAssessment($request, $userId)
    {
        foreach ($request['data'] as $studentAssessmentDetail) {
            foreach ($studentAssessmentDetail as $value) {
                if (gettype($value) == "array") {
                    $data = [
                        'org_id' => $request['data'][0]['org_id'],
                        'org_class_id' => $request['org_class_id'],
                        'org_stream_id'  =>  $request['org_stream_id'],
                        'org_section_id' => $request['org_section_id'],
                        'aca_sub_id' => $request['aca_sub_id'],
                        'aca_assmt_term_id' =>  $request['aca_assmt_term_id'],
                        'class_stream_section' =>  $request['class_stream_section'],
                        'std_student_id' => $studentAssessmentDetail['std_student_id'],
                        'aca_assmt_area_id' => $value['aca_assmt_area_id'],
                        'aca_rating_type_id' => $value['aca_rating_type_id'],
                        'recorded_for' => 'Student Assessment Changes',
                        'created_by' => $userId,
                        'created_at' => date('Y-m-d h:i:s')
                    ];
                    if ($request['finalize']) {
                        $result['finalized'] = 1;
                        $result['finalized_date'] = date('Y-m-d h:i:s');
                    }
                    if (array_key_exists("descriptive_score", $value)) {
                        $data['descriptive_score'] = $value['descriptive_score'];
                    } else if (array_key_exists("score", $value)) {
                        $data['score'] = $value['score'];
                    }
                    StudentAssessmentHistory::create($data);
                }
            }
        }
    }
    public function unlockForEdit($Id)
    {
        DB::update('UPDATE aca_student_assessment SET finalized = 0, finalized_date = NULL WHERE id = ?', [$Id]);
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    public function loadConsolidatedResultList(Request $request, $staffId, $orgId)
    {
        $termResultCondition = "";
        $finalResultCondition = "";
        $termResultParams = [$staffId, $orgId, $orgId, $staffId, $request->org_class_id];
        $finalResultParams = [$staffId, $orgId, $orgId, $orgId, $request->org_class_id];
        $extraParams = [];
        if ($request->org_stream_id !== null) {
            $termResultCondition = " AND t1.org_stream_id = ?";
            $finalResultCondition = " AND t1.org_stream_id = ?";
            array_push($extraParams, $request->org_stream_id);
        }
        if ($request->org_section_id !== null) {
            $termResultCondition .= " AND t1.org_section_id = ?";
            $finalResultCondition .= " AND t2.org_section_id = ?";
            array_push($extraParams, $request->org_section_id);
        }
        $termResult = "SELECT t5.id AS aca_result_consolidated_id,(t4.stf_staff_id=?) AS is_class_teacher,
                        t1.org_class_id,t1.org_stream_id,t1.org_section_id,t2.aca_assmt_term_id,t3.name AS term,
                        IF(COUNT(IF(t2.finalized,1,NULL))>=t1.no_of_subjects,1,0) AS subject_teachers_finalized,
                        DATE_FORMAT(MAX(t2.finalized_date),'%d-%m-%Y %H:%i %p') AS subject_teachers_finalized_date,
                        IF(t5.finalized,1,0) AS class_teacher_finalized,
                        DATE_FORMAT(t5.finalized_date,'%d-%m-%Y %H:%i %p') AS class_teacher_finalized_date,
                        IF(t5.approved,1,0) AS approved,
                        DATE_FORMAT(t5.approved_date,'%d-%m-%Y %H:%i %p') AS approved_date,
                        IF(t5.published,1,0) AS published,
                        DATE_FORMAT(t5.published_date,'%d-%m-%Y %H:%i %p') AS published_date
            FROM (SELECT org_id,org_class_id,org_stream_id,org_section_id,COUNT(aca_sub_id) AS no_of_subjects FROM aca_class_subject_teacher 
                WHERE org_id = ? GROUP BY org_id,org_class_id,org_stream_id,org_section_id) t1
                JOIN aca_student_assessment t2 ON t1.org_id = t2.org_id AND t1.org_class_id = t2.org_class_id AND (t1.org_stream_id = t2.org_stream_id OR (t1.org_stream_id IS NULL 
                    AND t2.org_stream_id IS NULL)) AND (t1.org_section_id = t2.org_section_id OR (t1.org_section_id IS NULL AND t2.org_section_id IS NULL)) AND t1.org_id = ?
                JOIN aca_assessment_term t3 ON t2.aca_assmt_term_id = t3.id
                LEFT JOIN aca_class_teacher t4 ON t1.org_id = t4.org_id AND t1.org_class_id = t4.org_class_id AND (t1.org_stream_id = t4.org_stream_id OR (t1.org_stream_id IS NULL AND t4.org_stream_id IS NULL)) AND (t1.org_section_id = t4.org_section_id OR (t1.org_section_id IS NULL AND t4.org_section_id IS NULL)) AND t4.stf_staff_id = ?
                LEFT JOIN aca_result_consolidated t5 ON t1.org_id = t5.org_id AND t1.org_class_id = t5.org_class_id AND (t1.org_stream_id = t5.org_stream_id OR (t1.org_stream_id IS NULL AND t5.org_stream_id IS NULL)) AND (t1.org_section_id = t5.org_section_id OR (t1.org_section_id IS NULL AND t5.org_section_id IS NULL)) AND t2.aca_assmt_term_id= t5.aca_assmt_term_id
                WHERE t1.org_class_id = ? $termResultCondition
            GROUP BY t5.id,t4.stf_staff_id,t1.org_class_id,t1.org_stream_id,t1.org_section_id,t2.aca_assmt_term_id,t3.name,t5.approved,t5.approved_date,t5.published,t5.published_date,t1.no_of_subjects,t5.finalized,t5.finalized_date";

        $finalResult = "SELECT t4.id AS aca_result_consolidated_id,(t3.stf_staff_id=?) AS is_class_teacher,t1.org_class_id,t1.org_stream_id,t2.org_section_id,NULL AS aca_assmt_term_id,'Final Result' AS term,1 AS subject_teachers_finalized,DATE_FORMAT(t4.finalized_date,'%d-%m-%Y %H:%i %p') AS subject_teachers_finalized_date,IF(t4.finalized,1,0) AS class_teacher_finalized,DATE_FORMAT(t4.finalized_date,'%d-%m-%Y %H:%i %p') AS class_teacher_finalized_date,IF(t4.approved,1,0) AS approved,t4.approved_date,IF(t4.published,1,0) AS published, DATE_FORMAT(t4.published_date,'%d-%m-%Y %H:%i %p') AS published_date
            FROM (SELECT aa.org_class_id,aa.org_stream_id,COUNT(bb.id) AS no_of_terms FROM aca_class_assessment_frequency aa JOIN aca_assessment_term bb ON aa.aca_assmt_frequency_id = bb.aca_assmt_frequency_id GROUP BY aa.org_class_id,aa.org_stream_id) t1
                LEFT JOIN (SELECT org_class_id,org_stream_id,org_section_id,COUNT(id) AS no_of_terms_finalized FROM aca_result_consolidated WHERE finalized=1 AND org_id = ? GROUP BY org_class_id,org_stream_id,org_section_id) t2 ON t1.org_class_id = t2.org_class_id AND (t1.org_stream_id = t2.org_stream_id OR (t1.org_stream_id IS NULL AND t2.org_stream_id IS NULL))
                LEFT JOIN aca_class_teacher t3 ON t1.org_class_id = t3.org_class_id AND (t1.org_stream_id = t3.org_stream_id OR (t1.org_stream_id IS NULL AND t3.org_stream_id IS NULL)) AND (t2.org_class_id IS NULL OR (t2.org_section_id = t3.org_section_id OR (t2.org_section_id IS NULL AND t3.org_section_id IS NULL))) AND t3.org_id = ?
                LEFT JOIN aca_result_consolidated t4 ON t1.org_class_id = t4.org_class_id AND (t1.org_stream_id = t4.org_stream_id OR (t1.org_stream_id IS NULL AND t4.org_stream_id IS NULL)) AND (t2.org_class_id IS NULL OR (t2.org_section_id = t4.org_section_id OR (t2.org_section_id IS NULL AND t4.org_section_id IS NULL))) AND t4.aca_assmt_term_id IS NULL AND t4.org_id = ?
            WHERE (t4.id IS NOT NULL OR t2.no_of_terms_finalized >= t1.no_of_terms) AND t1.org_class_id = ? $finalResultCondition";

        try {
            $result_consolidated = DB::select("$termResult UNION $finalResult", array_merge($termResultParams, $extraParams, $finalResultParams, $extraParams));
        } catch (Exception $e) {
            dd($e);
        }
        return $this->successResponse($result_consolidated);
    }

    public function loadConsolidatedResult($orgId, Request $request)
    {
        try {
            $minimum_required_attendance = DB::table('aca_setting')->where('id', 3)->value('value');

            $areaFormat = DB::table("aca_setting")->where("id", 1)->value("value");

            $condition = "";
            $param = [$orgId, $request->org_class_id];
            if ($request->org_stream_id) {
                $condition .= ' AND t1.org_stream_id = ?';
                array_push($param, $request->org_stream_id);
            }
            if ($request->org_section_id) {
                $condition .= ' AND t1.org_section_id = ?';
                array_push($param, $request->org_section_id);
            }
            if ($request->aca_assmt_term_id) {
                array_push($param, $request->aca_assmt_term_id);

                $query = "SELECT t11.display_order AS term_display_order,
                t12.display_order AS subject_display_order,
                IFNULL(t13.display_order,t21.display_order) AS area_display_order,
                t1.id,
                t1.aca_assmt_term_id,
                t2.std_student_id,
                t1.aca_sub_id,
                t2.aca_assmt_area_id,
                t2.aca_rating_type_id,
                t11.name AS term,
                t11.dzo_name AS term_dzo_name,
                t12.name AS subject,
                t12.dzo_name AS sub_dzo_name,
                IF($areaFormat=2,t21.name,IFNULL(t21.code,t21.name)) AS assessment_area,
                IF($areaFormat=2,'',t21.name) AS assessment_area_hint,
                t21.dzo_name AS assmt_area_dzo_name,
                TRIM(t13.weightage)+0 AS weightage,
                t4.input_type,
                IF(t4.input_type=2,t2.descriptive_score,IFNULL(t3.score,NULLIF(TRIM(t2.score)+0,0))) AS score,
                t2.remarks,
                t14.pass_score
            FROM (aca_student_assessment t1 JOIN aca_assessment_term t11 ON t1.aca_assmt_term_id = t11.id JOIN aca_subject t12 ON t1.aca_sub_id=t12.id)
                JOIN (aca_student_assessment_detail t2 JOIN aca_assessment_area t21 ON t2.aca_assmt_area_id = t21.id) ON t1.id=t2.aca_student_assmt_id
                JOIN aca_class_subject_assessment t13 ON t1.aca_assmt_term_id=t13.aca_assmt_term_id AND t1.aca_sub_id=t13.aca_sub_id
                    AND t2.aca_assmt_area_id=t13.aca_assmt_area_id
                    AND t1.org_class_id = t13.org_class_id AND (t1.org_stream_id = t13.org_stream_id OR (t1.org_stream_id IS NULL AND t13.org_stream_id IS NULL))
                JOIN aca_rating_type t4 ON t2.aca_rating_type_id=t4.id
                LEFT JOIN aca_rating t3 ON t2.aca_rating_type_id = t3.aca_rating_type_id AND IFNULL((TRIM(t2.score)+0),0) = t3.score
                LEFT JOIN aca_class_subject t14 ON t1.aca_sub_id=t14.aca_sub_id
                    AND t1.org_class_id = t14.org_class_id AND (t1.org_stream_id = t14.org_stream_id OR (t1.org_stream_id IS NULL AND t14.org_stream_id IS NULL))
            WHERE t1.org_id = ? AND t1.org_class_id = ? $condition AND t1.aca_assmt_term_id = ?";

                $studentRank = DB::select("SELECT t2.std_student_id,t1.aca_assmt_term_id,DENSE_RANK() OVER (ORDER BY SUM(if(t4.input_type=1,t2.score,0)) DESC) AS rank,t6.remarks
            FROM aca_student_assessment t1 JOIN aca_student_assessment_detail t2 ON t1.id=t2.aca_student_assmt_id
            JOIN aca_rating_type t4 ON t2.aca_rating_type_id=t4.id
            LEFT JOIN (aca_result_consolidated t5 
            JOIN aca_result_consolidated_detail t6 ON t5.id=t6.aca_result_consolidated_id) ON t2.std_student_id=t6.std_student_id AND t1.aca_assmt_term_id=t5.aca_assmt_term_id
            WHERE t1.org_id = ? AND t1.org_class_id = ? $condition AND t1.aca_assmt_term_id = ?
            GROUP BY t2.std_student_id,t1.aca_assmt_term_id,t6.remarks", $param);

                $instructional_days = DB::select("SELECT t2.id AS aca_assmt_term_id, COUNT(t1.id) AS instructional_days
            FROM aca_student_attendance t1
                JOIN aca_class_assessment_frequency t3 ON t1.org_class_id=t3.org_class_id AND (t1.org_stream_id=t3.org_stream_id OR (t1.org_stream_id IS NULL AND t3.org_stream_id IS NULL))
                JOIN aca_assessment_term t2 ON t3.aca_assmt_frequency_id=t2.aca_assmt_frequency_id AND t1.attendance_date BETWEEN CONCAT(YEAR(CURDATE()),'-',LPAD(t2.from_month,2,'0'),'-',LPAD(t2.from_date,2,'0')) 
                        AND CONCAT(YEAR(CURDATE()),'-',LPAD(t2.to_month,2,'0'),'-',LPAD(t2.to_date,2,'0')) 
            WHERE t1.org_id = ? AND t1.org_class_id = ? $condition AND t2.id = ? GROUP BY t2.id", $param);

                $absent_days = DB::select("SELECT t2.id AS aca_assmt_term_id,t3.std_student_id,COUNT(t3.id) AS absent_days
            FROM aca_student_attendance t1
            JOIN aca_student_attendance_detail t3 ON t1.id = t3.aca_std_attendance_id
                JOIN aca_assessment_term t2 ON t1.attendance_date BETWEEN CONCAT(YEAR(CURDATE()),'-',LPAD(t2.from_month,2,'0'),'-',LPAD(t2.from_date,2,'0')) 
                    AND CONCAT(YEAR(CURDATE()),'-',LPAD(t2.to_month,2,'0'),'-',LPAD(t2.to_date,2,'0')) 
            WHERE t1.org_id = ? AND t1.org_class_id = ? $condition AND t2.id = ? GROUP BY t2.id, t3.std_student_id", $param);

                $instructional_days_special_case = $this->specialInstructionalDays($orgId, $request->org_class_id, $request->org_stream_id, $request->org_section_id, $request->aca_assmt_term_id);
                // $params1 = $param;
            } else {
                $queryFinalResult = "SELECT 1000 AS term_display_order,
					 t12.display_order AS subject_display_order,
					 IFNULL(t13.display_order,t21.display_order) AS area_display_order,
					 't1id' AS id,
					 'final-result' AS aca_assmt_term_id,
					 t2.std_student_id,
					 t1.aca_sub_id,
					 t2.aca_assmt_area_id,
					 t2.aca_rating_type_id,
					 'Final Result' AS term,
					 '' AS term_dzo_name,
					 t12.name AS subject,
					 t12.dzo_name AS sub_dzo_name,
					 IF($areaFormat=2,t21.name,IFNULL(t21.code,t21.name)) AS assessment_area,
					 IF($areaFormat=2,'',t21.name) AS assessment_area_hint,
					 t21.dzo_name AS assmt_area_dzo_name,
					 TRIM(SUM(t13.weightage))+0 AS weightage,
					 t4.input_type,
					 IF(t4.input_type=2,GROUP_CONCAT(t2.descriptive_score SEPARATOR ', '),CASE t4.input_type WHEN 0 THEN ROUND(AVG(t2.score)) WHEN 1 THEN TRIM(SUM(t2.score))+0 ELSE MAX(t2.score) END) AS score,
					 t2.remarks,
                     t14.pass_score
				 FROM (aca_student_assessment t1 JOIN aca_subject t12 ON t1.aca_sub_id=t12.id)
					 JOIN (aca_student_assessment_detail t2 JOIN aca_assessment_area t21 ON t2.aca_assmt_area_id = t21.id) ON t1.id=t2.aca_student_assmt_id
					 JOIN aca_class_subject_assessment t13 ON t1.aca_assmt_term_id=t13.aca_assmt_term_id AND t1.aca_sub_id=t13.aca_sub_id AND t2.aca_assmt_area_id=t13.aca_assmt_area_id AND t1.org_class_id = t13.org_class_id AND (t1.org_stream_id = t13.org_stream_id OR (t1.org_stream_id is null AND t13.org_stream_id IS NULL))
					 JOIN aca_rating_type t4 ON t2.aca_rating_type_id=t4.id
                     LEFT JOIN aca_class_subject t14 ON t1.aca_sub_id=t14.aca_sub_id
                    AND t1.org_class_id = t14.org_class_id AND (t1.org_stream_id = t14.org_stream_id OR (t1.org_stream_id IS NULL AND t14.org_stream_id IS NULL))
				 WHERE t1.org_id = ? AND t1.org_class_id = ?";

                $query = "$queryFinalResult $condition GROUP BY t12.display_order,
					IFNULL(t13.display_order,t21.display_order),
					t2.std_student_id,t1.aca_sub_id, t2.aca_assmt_area_id,
					t2.aca_rating_type_id,t12.dzo_name,t21.dzo_name,t12.name,IF($areaFormat=2,t21.name,IFNULL(t21.code,t21.name)),
					IF($areaFormat=2,'',t21.name),t4.input_type,t2.remarks,t14.pass_score";

                $studentRank = DB::select("SELECT t2.std_student_id,'final-result' AS aca_assmt_term_id,RANK() OVER (ORDER BY SUM(if(t4.input_type=1,t2.score,0)) DESC) AS rank,t6.remarks
                FROM aca_student_assessment t1 JOIN aca_student_assessment_detail t2 ON t1.id=t2.aca_student_assmt_id
                JOIN aca_rating_type t4 ON t2.aca_rating_type_id=t4.id
                LEFT JOIN (aca_result_consolidated t5 
                JOIN aca_result_consolidated_detail t6 ON t5.id=t6.aca_result_consolidated_id) ON t2.std_student_id=t6.std_student_id AND t5.aca_assmt_term_id IS NULL
                WHERE t1.org_id = ? AND t1.org_class_id = ? $condition
                GROUP BY t2.std_student_id,t6.remarks", $param);

                $instructional_days = DB::select("SELECT 'final-result' AS aca_assmt_term_id, COUNT(t1.id) AS instructional_days
                FROM aca_student_attendance t1
                WHERE t1.org_id = ? AND t1.org_class_id = ? $condition", $param);

                $absent_days = DB::select("SELECT 'final-result' AS aca_assmt_term_id,t3.std_student_id,COUNT(t3.id) AS absent_days
                FROM aca_student_attendance t1
                    JOIN aca_student_attendance_detail t3 ON t1.id = t3.aca_std_attendance_id
                WHERE t1.org_id = ? AND t1.org_class_id = ? $condition GROUP BY t3.std_student_id", $param);

                $instructional_days_special_case = $this->specialInstructionalDays($orgId, $request->org_class_id, $request->org_stream_id, $request->org_section_id);
            }
            $consolidatedResult = DB::select("$query ORDER BY term_display_order,subject_display_order,area_display_order", $param);
            if ($areaFormat == 2) {
                $abbreviations = [];
            } else {
                $abbreviations = $this->getAssessmentAreaCode();
            }
            $pass_fail = null;
            if (!($request->aca_assmt_term_id)) {
                $pass_fail = $this->passFail($orgId, $request->org_class_id, $request->org_stream_id, $request->org_section_id);
            }
            $ratings = $this->getRating();
            return $this->successResponse(["consolidatedResult" => $consolidatedResult, "studentRank" => $studentRank, "passFail" => $pass_fail, "instructionalDaysForSpecialCase" => $instructional_days_special_case, "instructionalDays" => $instructional_days, "absentDays" => $absent_days, 'minimum_required_attendance' => $minimum_required_attendance, 'ratings' => $ratings, 'abbreviations' => $abbreviations]);
        } catch (Exception $e) {
            dd($e);
        }
    }
    public function saveConsolidatedResut(Request $request)
    {
        try {

            DB::transaction(function () use ($request) {
                $query = "DELETE FROM aca_result_consolidated WHERE org_id = ? AND org_class_id = ?";
                $param = [$request['org_id'], $request['org_class_id']];

                if ($request['org_stream_id']) {
                    $query .= ' AND org_stream_id = ?';
                    array_push($param, $request['org_stream_id']);
                }
                if ($request['org_section_id']) {
                    $query .= ' AND org_section_id = ?';
                    array_push($param, $request['org_section_id']);
                }
                if ($request['aca_assmt_term_id']) {
                    $query .= ' AND aca_assmt_term_id = ?';
                    array_push($param, $request['aca_assmt_term_id']);
                } else {
                    $query .= ' AND aca_assmt_term_id IS NULL';
                }
                // dd($query,$param);
                // $this->updateConsolidatedResut($request);
                DB::delete($query, $param);

                $result = [
                    'org_id' => $request['org_id'],
                    'class_stream_section' => $request['class_stream_section'],
                    'org_class_id' => $request['org_class_id'],
                    'org_stream_id'  =>  $request['org_stream_id'],
                    'org_section_id' => $request['org_section_id'],
                    'aca_assmt_term_id' =>  $request['aca_assmt_term_id'],
                    'created_by' =>  $request['user_id'],
                    'created_at' =>   date('Y-m-d h:i:s'),
                ];

                if ($request['finalize']) {
                    $result['finalized'] = 1;
                    $result['finalized_date'] = date('Y-m-d h:i:s');
                }
                if ($request['publish']) {
                    $result['publish'] = 1;
                    $result['published_date'] = date('Y-m-d h:i:s');
                }
                $resultConsolidated = ResultConsolidated::create($result);
                if ($request['remarks']) {
                    foreach ($request['remarks'] as $key => $value) {
                        ResultConsolidatedDetail::create(
                            [
                                'aca_result_consolidated_id' => $resultConsolidated->id,
                                'std_student_id' => $key,
                                // 'result'=>$request['result'][$key],
                                'remarks' => $value,
                                'created_by' => $request['user_id'],
                                'created_at' => date('Y-m-d h:i:s')
                            ]
                        );
                    }
                }
            });
        } catch (Exception $e) {
            dd($e);
        }
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    public function loadClassBySubjectTeacher($orgId, $staffId)
    {
        return $this->successResponse(
            DB::select('SELECT DISTINCT org_class_id, org_stream_id, org_section_id 
                FROM aca_class_subject_teacher WHERE org_id = ? AND stf_staff_id = ? ', [$orgId, $staffId])
        );
    }
    public function getTermsByFrequency($frequencyId)
    {
        return $this->successResponse(
            DB::select('SELECT id,name,dzo_name FROM aca_assessment_term WHERE aca_assmt_frequency_id = ?', [$frequencyId])
        );
    }
    public function unlockForEditForConsolidated($Id)
    {
        $unlockForConsolidated = DB::update('UPDATE aca_result_consolidated SET finalized = 0, finalized_date = NULL WHERE id = ?', [$Id]);
        return $this->successResponse($unlockForConsolidated, Response::HTTP_CREATED);
    }
    private function updateConsolidatedResut($request)
    {
        foreach ($request['data'] as $resultConsolidatedDetail) {
            $data = [
                'org_id' => $request['org_id'],
                'org_class_id' => $request['org_class_id'],
                'org_stream_id'  =>  $request['org_stream_id'],
                'org_section_id' => $request['org_section_id'],
                'aca_assmt_term_id' =>  $request['aca_assmt_term_id'],
                'std_student_id' => $resultConsolidatedDetail['std_student_id'],
                'result' => $resultConsolidatedDetail['result'],
                'recorded_for' => 'Student Assessment Changes',
                'created_by' =>  $request['user_id'],
                'created_at' =>   date('Y-m-d h:i:s'),
            ];
            if ($request['finalize']) {
                $data['finalized'] = 1;
                $data['finalized_date'] = date('Y-m-d h:i:s');
            }
            if ($request['publish']) {
                $data['publish'] = 1;
                $data['published_date'] = date('Y-m-d h:i:s');
            }
            ResultConsolidatedDetail::create($data);
        }
    }
    public function getClassTeacherByclass($orgId, Request $request)
    {
        $query = "SELECT stf_staff_id FROM aca_class_teacher WHERE org_id = ? AND org_class_id = ?";
        $params = [$orgId, $request['org_class_id']];
        if ($request['org_stream_id'] != '') {
            $query .= " AND org_stream_id = ?";
            array_push($params, $request['org_stream_id']);
        }
        if ($request['org_section_id']) {
            $query .= " AND org_section_id = ?";
            array_push($params, $request['org_section_id']);
        }
        return $this->successResponse(DB::select($query, $params));
    }
    public function getSubjectTeacherByclass($orgId, Request $request)
    {
        $query = "SELECT aca_sub_id,stf_staff_id FROM aca_class_subject_teacher WHERE org_id = ? AND org_class_id = ?";
        $params = [$orgId, $request['org_class_id']];
        if ($request['org_stream_id'] != '') {
            $query .= " AND org_stream_id = ?";
            array_push($params, $request['org_stream_id']);
        }
        if ($request['org_section_id']) {
            $query .= " AND org_section_id = ?";
            array_push($params, $request['org_section_id']);
        }
        return $this->successResponse(DB::select($query, $params));
    }
    private function getAssessmentAreaCode()
    {
        $code = DB::select('SELECT DISTINCT t1.name,t1.code FROM aca_assessment_area t1 JOIN aca_student_assessment_detail t2 ON t2.aca_assmt_area_id = t1.id  ORDER BY code');
        return $code;
    }
    private function specialInstructionalDays($orgId, $classId, $streamId, $sectionId, $termId = "")
    {
        $condition = "";
        $param = [$orgId, $classId];

        if ($streamId) {
            $condition .= " AND org_stream_id = ?";
            array_push($param, $streamId);
        }
        if ($sectionId) {
            $condition .= " AND org_section_id = ?";
            array_push($param, $sectionId);
        }
        if ($termId) {
            array_push($param, $termId);
            $query = "SELECT std_student_id,aca_assmt_term_id,MAX(instructional_days) AS instructional_days
                        FROM aca_instructional_days_special_case 
                    WHERE org_id = ? AND org_class_id = ? $condition AND aca_assmt_term_id = ? GROUP BY std_student_id,aca_assmt_term_id";
            return DB::select($query, $param);
        } else {
            $instructional_days = DB::select("SELECT t2.id AS aca_assmt_term_id, COUNT(t1.id) AS instructional_days
            FROM aca_student_attendance t1
                JOIN aca_class_assessment_frequency t3 ON t1.org_class_id=t3.org_class_id AND (t1.org_stream_id=t3.org_stream_id OR (t1.org_stream_id IS NULL AND t3.org_stream_id IS NULL))
                JOIN aca_assessment_term t2 ON t3.aca_assmt_frequency_id=t2.aca_assmt_frequency_id AND t1.attendance_date BETWEEN CONCAT(YEAR(CURDATE()),'-',LPAD(t2.from_month,2,'0'),'-',LPAD(t2.from_date,2,'0')) 
                        AND CONCAT(YEAR(CURDATE()),'-',LPAD(t2.to_month,2,'0'),'-',LPAD(t2.to_date,2,'0')) 
            WHERE t1.org_id = ? AND t1.org_class_id = ? $condition GROUP BY t2.id", $param);

            $instructional_days_special = DB::select("SELECT std_student_id,aca_assmt_term_id,MAX(instructional_days) AS instructional_days
                        FROM aca_instructional_days_special_case 
                    WHERE org_id = ? AND org_class_id = ? $condition GROUP BY std_student_id,aca_assmt_term_id", $param);
            $instructional_days_final = [];
            foreach ($instructional_days_special as $instructional_day_special) {
                if (!array_key_exists($instructional_day_special->std_student_id, $instructional_days_final)) {
                    $instructional_days_final[$instructional_day_special->std_student_id] = 0;
                }
                foreach ($instructional_days as $instructional_day) {
                    if ($instructional_day->aca_assmt_term_id == $instructional_day_special->aca_assmt_term_id) {
                        $instructional_days_final[$instructional_day_special->std_student_id] += $instructional_day_special->instructional_days;
                    } else {
                        $instructional_days_final[$instructional_day_special->std_student_id] += $instructional_day->instructional_days;
                    }
                }
            }
            $instructional_days_1 = [];
            foreach ($instructional_days_final as $key => $value) {
                array_push($instructional_days_1, ["std_student_id" => $key, "aca_assmt_term_id" => "final-result", "instructional_days" => $value]);
            }
            return $instructional_days_1;
        }
    }
    public function getResult($std_student_id)
    {
        $result = DB::select('SELECT result,remarks  FROM aca_result_consolidated_detail WHERE std_student_id = ?', [$std_student_id]);
        return $this->successResponse($result);
    }
    public function getSubjectByClass($class_id, $stream_id = "")
    {
        $query = 'SELECT t1.id AS aca_sub_id,t1.aca_sub_category_id, t1.name AS subject,t1.dzo_name AS sub_dzo_name FROM aca_subject t1 JOIN aca_class_subject t2 ON t1.id=t2.aca_sub_id AND t2.org_class_id = ?';
        $params = [$class_id];
        if ($stream_id) {
            $query .= ' AND t2.org_stream_id = ?';
            array_push($params, $stream_id);
        }
        return $this->successResponse(DB::select("$query", $params));
    }
    public function getSubjectTeacherBySubId($aca_sub_id)
    {
        return $this->successResponse(DB::select('SELECT aca_sub_id,stf_staff_id FROM aca_class_subject_teacher WHERE aca_sub_id = ? GROUP BY aca_sub_id,stf_staff_id ', [$aca_sub_id]));
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

        $query = 'DELETE FROM aca_remedial_classes WHERE org_class_id = ?';
        $params = [$request['org_class_id']];
        if ($request['org_stream_id']) {
            $query .= ' AND org_stream_id = ?';
            array_push($params, $request['org_stream_id']);
        }
        if ($request['org_section_id']) {
            $query .= ' AND org_section_id = ?';
            array_push($params, $request['org_section_id']);
        }
        DB::transaction(function () use ($request, $query, $params) {
            DB::delete($query, $params);
            $remarks = isset($request['data']['remarks']) ? $request['data']['remarks'] : '';
            $parent = [
                'org_id' => $request['org_id'],
                'org_class_id' => $request['org_class_id'],
                'org_stream_id' => $request['org_stream_id'],
                'org_section_id' => $request['org_section_id'],
                'class_stream_section' => $request['class_stream_section'],
                'aca_sub_id' => $request['data']['aca_sub_id'],
                'stf_staff_id' => $request['data']['stf_staff_id'],
                'from_date' => $request['data']['from_date'],
                'to_date' => $request['data']['to_date'],
                'total_no_of_hours' => $request['data']['total_hrs'],
                'time' => $request['data']['time_description'],
                'remarks' => $remarks,
                'created_by' => $request['user_id'],
                'created_at' =>   date('Y-m-d h:i:s'),
            ];
            $RemedialClass = RemedialClass::create($parent);
            foreach ($request['data']['std_student_id'] as $key => $value) {
                $child = [
                    'aca_remedial_class_id' => $RemedialClass->id,
                    'std_student_id' => $value,
                    'created_by' => $request['user_id'],
                    'created_at' =>   date('Y-m-d h:i:s'),
                ];
                RemedialClassDetail::create($child);
            }
        });
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    public function getSubCategNonAcademic()
    {
        $sub_categ_non_academic = env('SUB_CATEG_NON_ACADEMIC');
        return [];
        // $this->successResponse(DB::select('SELECT t2.name,t2.description FROM aca_rating_type t1 JOIN aca_rating t2 ON t1.id = t2.aca_rating_type_id WHERE t1.aca_sub_category_id = ?', [$sub_categ_non_academic]));
    }
    public function getRemedialClass($orgId)
    {
        return $this->successResponse(
            DB::select('SELECT t1.id,t1.org_class_id,t1.org_stream_id,t1.org_section_id,t1.aca_sub_id,t1.stf_staff_id,t1.from_date,t1.to_date,t1.total_no_of_hours,t1.time,t2.name AS subject 
            FROM aca_remedial_classes t1 
                JOIN aca_subject t2 ON t1.aca_sub_id = t2.id WHERE t1.org_id = ?', [$orgId])
        );
    }
    public function getRemedialClassDetail($orgId, $Id)
    {
        try {
            return $this->successResponse(DB::select('SELECT t1.aca_remedial_class_id,t1.std_student_id FROM aca_remedial_classes_detail t1 JOIN aca_remedial_classes t2 ON t1.aca_remedial_class_id = t2.id  WHERE t2.org_id = ? AND t1.aca_remedial_class_id = ? ', [$orgId, $Id]));
        } catch (Exception $e) {
            dd($e);
        }
    }
    public function getTermsForPublish($orgId)
    {
        return $this->successResponse(DB::select("SELECT DISTINCT IFNULL(t2.id,'final-result') as id, IFNULL(t2.name,'Final Result') AS name FROM aca_result_consolidated t1 
                LEFT JOIN aca_assessment_term t2 ON t1.aca_assmt_term_id = t2.id 
                LEFT JOIN aca_assessment_frequency t3 ON t2.aca_assmt_frequency_id = t3.id 
            WHERE t1.finalized = 1 AND t1.org_id = ? ORDER BY t3.name,t2.name ", [$orgId]));
    }
    public function loadConsolidatedResultListForPublish($orgId, $termId)
    {
        return $this->successResponse(
            DB::select("SELECT t1.id AS aca_result_consolidated_id,
                t1.org_class_id,t1.org_stream_id,t1.org_section_id,t1.aca_assmt_term_id,
                IF(t1.finalized,1,0) AS class_teacher_finalized,
                DATE_FORMAT(t1.finalized_date,'%d-%m-%Y %H:%i %p') AS class_teacher_finalized_date,
                IF(t1.approved,1,0) AS approved,
                DATE_FORMAT(t1.approved_date,'%d-%m-%Y %H:%i %p') AS approved_date,
                IF(t1.published,1,0) AS published,
                DATE_FORMAT(t1.published_date,'%d-%m-%Y %H:%i %p') AS published_date,
                (DATEDIFF(CURRENT_TIMESTAMP,t1.approved_date)<=t2.value) AS can_edit_approved
        FROM aca_result_consolidated t1 JOIN aca_setting t2 ON t2.id = 4
        WHERE t1.org_id = ? AND IFNULL(t1.aca_assmt_term_id,'final-result') = ?", [$orgId, $termId])
        );
    }
    public function getConsolidatedResultForEdit($orgId, $stdId, $termId, $subId)
    {
        $result = DB::select("SELECT t2.id,t3.name AS assmnt_area,TRIM(t2.score)+0 AS score,t2.descriptive_score,t4.input_type,t2.aca_rating_type_id,TRIM(t5.weightage)+0 AS weightage
                FROM aca_student_assessment t1 JOIN aca_student_assessment_detail t2 ON t1.id = t2.aca_student_assmt_id 
                    JOIN aca_assessment_area t3 ON t2.aca_assmt_area_id = t3.id 
                    JOIN aca_rating_type t4 ON t2.aca_rating_type_id = t4.id
                    LEFT JOIN aca_class_subject_assessment t5 ON t1.aca_sub_id = t5.aca_sub_id AND t1.aca_assmt_term_id = t5.aca_assmt_term_id AND t2.aca_assmt_area_id = t5.aca_assmt_area_id
                    AND t1.org_class_id = t5.org_class_id AND (t1.org_stream_id = t5.org_stream_id OR (t1.org_stream_id IS NULL AND t5.org_stream_id IS NULL))
                WHERE t1.org_id = ? AND t2.std_student_id = ? AND t1.aca_assmt_term_id = ? AND t1.aca_sub_id = ? ORDER BY t5.display_order", [$orgId, $stdId, $termId, $subId]);
        $ratings = $this->getRating();
        return $this->successResponse(['result' => $result, 'ratings' => $ratings]);
    }
    public function updateStatus(Request $request)
    {
        $success = DB::transaction(function () use ($request) {
            if ($request['action'] == 'approve') {
                $finalized_result = $this->finalizedResult($request);
                if ($finalized_result) {
                    DB::update('UPDATE aca_result_consolidated SET approved = 1, approved_date = CURRENT_TIMESTAMP WHERE id = ?', [$request['aca_result_consolidated_id']]);
                } else {
                    return false;
                }
            } elseif ($request['action'] == 'publish') {
                foreach ($request['not_published'] as $key => $value) {
                    DB::update('UPDATE aca_result_consolidated SET published = 1, published_date = CURRENT_TIMESTAMP WHERE id = ?', [$value]);
                }
            };
            return true;
        });
        if ($success) {
            return $this->successResponse('Updated', Response::HTTP_CREATED);
        } else {
            return $this->errorResponse('Please approve all term results of the class before approving the final result.', Response::HTTP_NOT_FOUND);
        }
    }
    public function getSubjectOfTerm(Request $request)
    {
        $query = "SELECT DISTINCT t2.id, t2.name,t2.dzo_name FROM aca_student_assessment t1 JOIN aca_subject t2 ON t1.aca_sub_id = t2.id WHERE t1.org_id = ? AND t1.org_class_id = ?";
        $query1 = "SELECT t2.id,t2.remarks FROM aca_result_consolidated t1 
                    JOIN aca_result_consolidated_detail t2 ON t1.id = t2.aca_result_consolidated_id
            WHERE t1.org_id = ? AND t2.std_student_id = ? AND t1.org_class_id = ? ";
        $params = [$request['org_id'], $request['org_class_id']];
        $params1 = [$request['org_id'], $request['std_student_id'], $request['org_class_id']];
        if (isset($request['aca_term_id']) && $request['aca_term_id'] && $request['aca_term_id'] != "null" && $request['aca_term_id'] != "final-result") {
            $query .= " AND t1.aca_assmt_term_id = ? ";
            $query1 .= " AND t1.aca_assmt_term_id = ? ";
            array_push($params, $request['aca_term_id']);
            array_push($params1, $request['aca_term_id']);
        }
        if (isset($request['org_stream_id'])) {
            $query .= " AND t1.org_stream_id = ?";
            $query1 .= " AND t1.org_stream_id = ?";
            array_push($params, $request['org_stream_id']);
            array_push($params1, $request['org_stream_id']);
        }
        if (isset($request['org_section_id'])) {
            $query .= " AND t1.org_section_id = ?";
            $query1 .= " AND t1.org_section_id = ?";
            array_push($params, $request['org_section_id']);
            array_push($params1, $request['org_section_id']);
        }
        $subjects = DB::select($query, $params);
        $remarks = DB::select($query1, $params1);
        return $this->successResponse(['subjects' => $subjects, 'remarks' => $remarks]);
    }
    private function saveAttendance($request)
    {
        $org_stream_id = isset($request['org_stream_id']) ? $request['org_stream_id'] : null;
        $org_section_id = isset($request['org_section_id']) ? $request['org_section_id'] : null;
        $attendance = [
            'org_id' => $request['org_id'],
            'org_class_id' => $request['org_class_id'],
            'org_stream_id' =>  $org_stream_id,
            'org_section_id' =>  $org_section_id,
            'class_stream_section' => $request['class_stream_section'],
            'attendance_date' => $request['attendance_date'],
            'created_by' => $request['user_id'],
            'created_at' => date('Y-m-d h:i:s')
        ];
        $stdAttendance = StudentAttendance::create($attendance);
        foreach ($request["data"] as $studentAttendance) {
            if ($studentAttendance['is_present'] == "0") {
                StudentAttendanceDetail::create(
                    [
                        'aca_std_attendance_id' => $stdAttendance->id,
                        'aca_absence_reason_id' => $studentAttendance['aca_absence_reason_id'],
                        'std_student_id' => $studentAttendance['std_student_id'],
                        'created_by' => $request['user_id'],
                        'created_at' => date('Y-m-d h:i:s')
                    ]
                );
            }
        }
    }
    public function updateResult(Request $request)
    {
        foreach ($request['data'] as $result) {
            $data = StudentAssessmentDetail::find($result['id']);
            $data->score = $result['score'];
            if (array_key_exists("descriptive_score", $result)) {
                $data->descriptive_score = $result['descriptive_score'];
            } else if (array_key_exists("score", $result)) {
                $data->score = $result['score'];
            }
            $data->updated_at = date('Y-m-d h:i:s');
            $data->updated_by = $request['user_id'];
            $data->update();
        }
        $data1 = ResultConsolidatedDetail::find($request['remarks']["id"]);
        $data1->remarks = $request['remarks']['remarks'];
        $data1->updated_at = date('Y-m-d h:i:s');
        $data1->updated_by = $request['user_id'];
        $data1->update();
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    //Written by gagen to pull the result into the emis portal
    public function LoadFinalResultByStudentId($std_code){
            return $this->successResponse(DB::select('SELECT a.student_code ,a.roll_no, a.marks_percent, a.position, a.promoted, b.subject,b.ca_score,b.exam_score,b.score,b.t1_ca_score,b.t1_exam_score,b.t2_exam_score,b.t2_ca_score,b.sub_dzo_name,c.term_dzo_name,c.academic_year,c.term_name,d.published,a.marks_percent,a.position,a.t1_position,a.t2_position
            FROM aca_result_student AS a 
            JOIN aca_result_score_csa AS b ON a.id = b.aca_result_student_id 
            JOIN `aca_result` AS c ON c.id = a.aca_result_id
            LEFT JOIN `aca_result_consolidated` AS d ON c.aca_result_consolidated_id = d.id
            WHERE a.student_code = "'.$std_code.'" AND c.term_name="Final Result" AND d.published="1"
            GROUP BY a.student_code ,a.roll_no, a.marks_percent, a.position, a.promoted, b.subject,b.ca_score,b.exam_score,b.score,b.t1_ca_score,b.t1_exam_score,b.t2_exam_score,b.t2_ca_score,c.term_dzo_name,c.academic_year,c.term_name,b.sub_dzo_name,d.published,a.marks_percent,a.position,a.t1_position,a.t2_position'));
            
    }


    private function getRating()
    {
        return DB::select('SELECT aca_rating_type_id, name, score FROM aca_rating WHERE status=1 ORDER BY score');
    }
    private function finalizedResult($request)
    {
        try {
            $term_details = DB::select("SELECT IFNULL(t2.id,'final-result') AS aca_assmt_term_id,t1.academic_year,IFNULL(t2.term_number,0) AS term_number,
            IFNULL(t2.name,'Final Result') AS term_name, IFNULL(t2.dzo_name,'??????????????????????????? ??????????????????????????????') AS dzo_name
            FROM aca_result_consolidated t1 LEFT JOIN aca_assessment_term t2 ON t1.aca_assmt_term_id = t2.id 
            WHERE t1.id = ? ", [$request['aca_result_consolidated_id']]);

            if (count($term_details)) {
                $term_detail = $term_details[0];
                $stream_id = isset($request['class']['org_stream_id']) && trim($request['class']['org_stream_id']) != '' ? $request['class']['org_stream_id'] : null;
                $stream = isset($request['class']['stream']) && trim($request['class']['stream']) != '' ? $request['class']['stream'] : null;
                $section_id = isset($request['class']['org_section_id']) && trim($request['class']['org_section_id']) != '' ? $request['class']['org_section_id'] : null;
                $section = isset($request['class']['section']) && trim($request['class']['section']) != '' ? $request['class']['section'] : null;
                $lastTermResultId = "";
                if ($term_detail->term_number == 0) {
                    $lastTermQuery = "SELECT SUBSTRING(MAX(CONCAT(LPAD(term_number,3,'0'),id)),4) AS id_of_last_term FROM aca_result WHERE org_id = ? AND academic_year = ? AND org_class_id = ?";
                    $lastTermParams = [$request['orgnization']['id'], $term_detail->academic_year, $request['class']['org_class_id']];
                    if ($stream_id != null) {
                        $lastTermQuery .= " AND org_stream_id = ?";
                        array_push($lastTermParams, $stream_id);
                    }
                    if ($section_id != null) {
                        $lastTermQuery .= " AND org_section_id = ?";
                        array_push($lastTermParams, $section_id);
                    }
                    $lastTermIdQ = DB::select($lastTermQuery, $lastTermParams);
                    if (count($lastTermIdQ) > 0 && $lastTermIdQ[0]->id_of_last_term) {
                        $lastTermResultId = $lastTermIdQ[0]->id_of_last_term;
                    } else {
                        return false;
                        //return error ""
                    }
                }
                $id = (DB::select("SELECT UUID() AS id"))[0]->id;
                $transcript_format_query = "SELECT transcript_format FROM aca_class_assessment_frequency  WHERE org_class_id = ?";
                $transcript_format_params = [$request['class']['org_class_id']];
                if ($stream_id != null) {
                    $transcript_format_query .= " AND org_stream_id = ?";
                    array_push($transcript_format_params, $stream_id);
                }
                $transcript_format = (DB::select($transcript_format_query, $transcript_format_params))[0]->transcript_format;
                DB::statement(
                    "INSERT INTO aca_result(id,aca_result_consolidated_id,academic_year,transcript_format,term_number,term_name,term_dzo_name, org_id, school_name, gewog_id, gewog, dzon_id, dzongkhag, org_class_id, class,
                    org_stream_id, stream, org_section_id, section, stf_class_teacher_id, stf_class_tecaher_name, stf_principal_id, stf_principal_name, created_by, created_at)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?, ?)",
                    [
                        $id, $request['aca_result_consolidated_id'], $term_detail->academic_year, $transcript_format,
                        $term_detail->term_number, $term_detail->term_name, $term_detail->dzo_name, $request['orgnization']['id'],
                        $request['orgnization']['name'], $request['orgnization']['gewogId'], $request['orgnization']['gewog'],
                        $request['orgnization']['dzongkhagId'], $request['orgnization']['dzongkhag'], $request['class']['org_class_id'],
                        $request['class']['class'], $stream_id, $stream, $section_id, $section, $request['class_teacher'][0]['stf_staff_id'],
                        $request['class_teacher'][0]['name'], $request['pricipal'][0]['stf_staff_id'],
                        $request['pricipal'][0]['name'], $request['user_id'], date('Y-m-d h:i:s')
                    ]
                );

                $query = "SELECT DISTINCT t1.aca_sub_id, t2.name,t2.dzo_name,t21.id AS combined_sub_id,t21.name AS combined_subject,t21.dzo_name AS combd_sub_dzo_name,t3.code AS sub_category_code,t3.name AS sub_category,IFNULL(t4.show_in_result,1) AS show_in_result,t4.display_order
                FROM aca_student_assessment t1 JOIN (aca_subject t2 LEFT JOIN aca_subject t21 ON t2.aca_sub_id = t21.id) ON t1.aca_sub_id = t2.id
                JOIN aca_subject_category t3 ON t2.aca_sub_category_id = t3.id
                LEFT JOIN aca_class_subject t4 ON t1.aca_sub_id = t4.aca_sub_id AND t1.org_class_id = t4.org_class_id 
                    AND (t1.org_stream_id = t4.org_stream_id OR (t1.org_stream_id IS NULL AND t4.org_stream_id IS NULL))
                WHERE t1.org_id = ? AND t1.academic_year = ? AND t1.org_class_id = ?";
                $params = [$request['orgnization']['id'], $term_detail->academic_year, $request['class']['org_class_id']];
                if ($stream_id != null) {
                    $query .= " AND org_stream_id = ?";
                    array_push($params, $stream_id);
                }
                if ($section_id != null) {
                    $query .= " AND org_section_id = ?";
                    array_push($params, $section_id);
                }
                $classSubjects = DB::select($query, $params);

                foreach ($classSubjects as $classSubject) {
                    $result_sub_id = (DB::select("SELECT UUID() AS id"))[0]->id;
                    $key  = array_search($classSubject->aca_sub_id, array_column($request['subject_teachers'], 'aca_sub_id'));
                    $staff_id = $request['subject_teachers'][$key]['stf_staff_id'];
                    $staff_name = $request['subject_teachers'][$key]['name'];
                    DB::statement(
                        "INSERT INTO aca_result_subject(id, academic_year, aca_result_id, aca_sub_id, subject,sub_dzo_name,combined_sub_id,
                    combined_subject,combd_sub_dzo_name,sub_category_code,sub_category, teacher_id, teacher, show_in_result, display_order, created_by, created_at)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                        [
                            $result_sub_id, $term_detail->academic_year, $id, $classSubject->aca_sub_id,
                            $classSubject->name, $classSubject->dzo_name, $classSubject->combined_sub_id,
                            $classSubject->combined_subject, $classSubject->combd_sub_dzo_name,
                            $classSubject->sub_category_code, $classSubject->sub_category, $staff_id, $staff_name,
                            $classSubject->show_in_result, $classSubject->display_order, $request['user_id'], date('Y-m-d h:i:s')
                        ]
                    );
                }
                if ($term_detail->term_number == 0) {
                    $pass_fail = $this->passFail($request['orgnization']['id'],  $request['class']['org_class_id'], $stream_id, $stream, $section_id, $section);
                } else {
                    $pass_fail = [];
                }
                foreach ($request['stduents'] as $stduent) {
                    $result_std_id = (DB::select("SELECT UUID() AS id"))[0]->id;
                    // $key1  = array_search($stduent['std_student_id'], array_column($request['awards'], 'std_student_id'));
                    // $key2 = array_search($stduent['std_student_id'], array_column($request['responsilities'], 'std_student_id'));
                    $comments_query = DB::select('SELECT remarks FROM aca_result_consolidated_detail WHERE aca_result_consolidated_id = ? AND std_student_id = ?', [$request['aca_result_consolidated_id'], $stduent['std_student_id']]);
                    $comments = null;
                    if (count($comments_query) > 0) {
                        $comments = $comments_query[0]->remarks;
                    };
                    // if ($key1 >= 0) {
                    //     $awards = $pass_fail[$key1]['awards'];
                    // } else {
                    //     $awards = null;
                    // }
                    // if ($key2 >= 0) {
                    //     $responsilities = $pass_fail[$key2]['responsilities'];
                    // } else {
                    //     $responsilities = null;
                    // }
                    // dd($pass_fail);
                    $result = null;
                    if (count($pass_fail) > 0) {
                        $key3  = array_search($stduent['std_student_id'], array_column($pass_fail, 'std_student_id'));
                        if ($key3 !== false) {
                            $result = $pass_fail[$key3]->passed;
                        }
                    }
                    $cid = isset($stduent['CidNo']) ? $stduent['CidNo'] : null;
                    DB::statement(
                        "INSERT INTO aca_result_student(id, academic_year, aca_result_id, std_student_id, student_code, name, cid,
                        dob, roll_no, promoted, general_comment, created_by, created_at)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?)",
                        [
                            $result_std_id, $term_detail->academic_year, $id, $stduent['std_student_id'], $stduent['student_code'], $stduent['Name'],
                            $cid, $stduent['dob'], $stduent['roll_no'], $result, $comments, $request['user_id'], date('Y-m-d h:i:s')
                        ]
                    );
                }
                if ((int)$term_detail->term_number != 0) { //term result for both CFA and CSA
                    $query1 = "INSERT INTO aca_result_score(id, academic_year, aca_result_student_id, aca_sub_id, aca_assmt_area_id, assessment_area, 
                assmnt_area_dzo_name, aca_assmnt_type, aca_rating_type_id, score, score_description, score_descr_dzo_name, display_order, created_by, created_at)
                    SELECT UUID(),t0.academic_year,t5.id,t0.aca_sub_id,t3.id,t3.name,t3.dzo_name,t3.aca_assmnt_type,t1.aca_rating_type_id,t1.score,
                    IFNULL(t10.name,t1.descriptive_score),IFNULL(t10.dzo_name,null),t2.display_order, ? , ?
                    FROM aca_student_assessment t0
                        JOIN (aca_student_assessment_detail t1
                                LEFT JOIN aca_rating t10 ON t1.aca_rating_type_id = t10.aca_rating_type_id AND t1.score = t10.score
                             )  ON t0.id = t1.aca_student_assmt_id 
                        JOIN aca_class_subject_assessment t2 ON t1.aca_assmt_area_id = t2.aca_assmt_area_id 
                        AND t0.aca_assmt_term_id = t2.aca_assmt_term_id AND t0.org_class_id = t2.org_class_id 
                            AND (t0.org_stream_id = t2.org_stream_id OR (t0.org_stream_id IS NULL AND t2.org_stream_id IS NULL))
                        JOIN aca_assessment_area t3 ON t1.aca_assmt_area_id = t3.id
                        JOIN aca_result_student t5 ON t1.std_student_id = t5.std_student_id AND t5.aca_result_id = ? 
                    WHERE t0.academic_year = ? AND t0.aca_assmt_term_id = ? AND t0.org_id = ? AND t0.org_class_id = ?";
                    $params = [$request['user_id'], date('Y-m-d h:i:s'), $id, $term_detail->academic_year, $term_detail->aca_assmt_term_id, $request['orgnization']['id'], $request['class']['org_class_id']];
                    if ($stream_id != null) {
                        $query1 .= " AND t0.org_stream_id = ?";
                        array_push($params, $stream_id);
                    }
                    if ($section_id != null) {
                        $query1 .= " AND t0.org_section_id = ?";
                        array_push($params, $section_id);
                    }
                    DB::statement($query1, $params);
                    if ($transcript_format == 1) { //term result for CFA - (since subject name and subject teacher is required, sub_id is saved)
                        DB::statement("INSERT INTO aca_result_score_cfa(id, academic_year, aca_result_student_id, aca_sub_id,aca_rating_type_id,rating_type_code,aca_assmt_area_id,assessment_area, assmnt_area_dzo_name, 
                    score, score_description, score_descr_dzo_name, display_order, created_by, created_at)
                        SELECT UUID(), t1.academic_year, t1.aca_result_student_id,t1.aca_sub_id,t1.aca_rating_type_id,t3.code,t1.aca_assmt_area_id,t1.assessment_area,t1.assmnt_area_dzo_name, t1.score,
                        t1.score_description,t1.score_descr_dzo_name,t1.display_order,?, ?
                        FROM aca_result_score t1 JOIN aca_result_student t2 ON t1.aca_result_student_id = t2.id
                        JOIN aca_rating_type t3 ON t1.aca_rating_type_id = t3.id
                        WHERE t2.aca_result_id = ?", [$request['user_id'], date('Y-m-d h:i:s'), $id]);
                    } else { //term result for CSA (only subject name required - no subject teacher, so subject name is saved)
                        //Insert academic result (sub_category_code = 1)
                        DB::statement(
                            "INSERT INTO aca_result_score_csa(id, academic_year, aca_result_student_id, aca_rating_type_id, sub_category_code,
                         subject, sub_dzo_name,ca_score,exam_score, score_description,
                         score_descr_dzo_name, display_order, created_by, created_at) 
                        SELECT UUID(), t1.academic_year, t1.aca_result_student_id,MAX(t1.aca_rating_type_id),MAX(t3.sub_category_code), IFNULL(t3.combined_subject,t3.subject),
                        IFNULL(t3.combd_sub_dzo_name,t3.sub_dzo_name),SUM(IF(t1.aca_assmnt_type=0,t1.score,0)),SUM(IF(t1.aca_assmnt_type=1,t1.score,0)),MAX(t1.score_description),
                        t1.score_descr_dzo_name, MAX(t1.display_order),?, ?
                        FROM aca_result_score t1 JOIN aca_result_student t2 ON t1.aca_result_student_id = t2.id
                            JOIN aca_result_subject t3 ON t1.aca_sub_id=t3.aca_sub_id AND t2.aca_result_id=t3.aca_result_id
                        WHERE t2.aca_result_id = ? AND t3.sub_category_code = 1
                        GROUP BY t1.academic_year, t1.aca_result_student_id, IFNULL(t3.combined_subject,t3.subject),IFNULL(t3.combd_sub_dzo_name,t3.sub_dzo_name),t1.score_descr_dzo_name",
                            [$request['user_id'], date('Y-m-d h:i:s'), $id]
                        );
                        //Insert non-academic result and others (sub_category_code=2 and sub_category_code=3)
                        DB::statement("INSERT INTO aca_result_score_csa(id, academic_year, aca_result_student_id, aca_rating_type_id,sub_category_code, subject, sub_dzo_name,
                        aca_assmt_area_id,assessment_area, assmnt_area_dzo_name, score, score_description, score_descr_dzo_name, display_order, created_by, created_at)
                       SELECT UUID(), t1.academic_year, t1.aca_result_student_id, t1.aca_rating_type_id,t3.sub_category_code, IFNULL(t3.combined_subject,t3.subject),
                        IFNULL(t3.combd_sub_dzo_name,t3.sub_dzo_name),t1.aca_assmt_area_id,t1.assessment_area,t1.assmnt_area_dzo_name, t1.score, 
                           t1.score_description,t1.score_descr_dzo_name, t1.display_order,?, ?
                       FROM aca_result_score t1 JOIN aca_result_student t2 ON t1.aca_result_student_id = t2.id
                       JOIN aca_result_subject t3 ON t1.aca_sub_id=t3.aca_sub_id AND t2.aca_result_id=t3.aca_result_id
                       WHERE t2.aca_result_id = ? AND t3.sub_category_code <> 1", [$request['user_id'], date('Y-m-d h:i:s'), $id]);
                    }
                } else { //final result for both csa and cfa
                    if ($transcript_format == 1) { //final result for CFA
                        $query2 = "INSERT INTO aca_result_score_cfa(id, academic_year, aca_result_student_id, aca_sub_id,aca_rating_type_id,rating_type_code,
                            aca_assmt_area_id,assessment_area,assmnt_area_dzo_name, score,display_order, created_by, created_at)
                        SELECT UUID(),t1.academic_year,t4.id,t1.aca_sub_id,t1.aca_rating_type_id,t1.rating_type_code,t1.aca_assmt_area_id,t1.assessment_area,
                        t1.assmnt_area_dzo_name,ROUND(AVG(t1.score)),MAX(t1.display_order), ? , ?
                        FROM aca_result_score_cfa t1
                            JOIN aca_result_student t2 ON t1.aca_result_student_id = t2.id
                            JOIN aca_result t3 ON t2.aca_result_id = t3.id
                            JOIN (SELECT id,std_student_id FROM aca_result_student WHERE aca_result_id = ?) t4 ON t2.std_student_id = t4.std_student_id
                        WHERE t1.academic_year = ? AND t3.org_id = ? AND t3.org_class_id = ?";
                        $params = [$request['user_id'], date('Y-m-d h:i:s'), $id, $term_detail->academic_year, $request['orgnization']['id'], $request['class']['org_class_id']];
                        if ($stream_id != null) {
                            $query2 .= " AND t3.org_stream_id = ?";
                            array_push($params, $stream_id);
                        }
                        if ($section_id != null) {
                            $query2 .= " AND t3.org_section_id = ?";
                            array_push($params, $section_id);
                        }
                        DB::statement("$query2 GROUP BY t1.academic_year,t4.id,t1.aca_sub_id,t1.aca_rating_type_id,t1.rating_type_code,t1.aca_assmt_area_id,t1.assessment_area,t1.assmnt_area_dzo_name", $params);

                        //Update descriptive score with rating names and last term's descriptive score for input_type=2
                        DB::statement(
                            'UPDATE aca_result_student t0 JOIN aca_result_score_cfa t1 ON t0.id = t1.aca_result_student_id 
                                LEFT JOIN aca_rating t2 ON t1.aca_rating_type_id = t2.aca_rating_type_id AND t1.score = t2.score
                                LEFT JOIN (SELECT b.std_student_id,a.aca_assmt_area_id,a.score_description,a.score_descr_dzo_name
                                     FROM aca_result_score_cfa a JOIN aca_result_student b ON a.aca_result_student_id = b.id
                                    WHERE b.aca_result_id = ? AND a.score IS NULL) t3 ON t0.std_student_id = t3.std_student_id AND t1.aca_assmt_area_id = t3.aca_assmt_area_id
                            SET t1.score_description = IFNULL(t2.name,t3.score_description), t1.score_descr_dzo_name = IFNULL(t2.dzo_name,t3.score_descr_dzo_name)
                            WHERE t0.aca_result_id = ?',
                            [$lastTermResultId, $id]
                        );
                    } else { //final result for CSA
                        //Insert academic result (sub_category_code = 1) - Marks
                        $query2 = "INSERT INTO aca_result_score_csa(id, academic_year, aca_result_student_id, sub_category_code, subject,sub_dzo_name,
                      t1_ca_score, t1_exam_score, t2_ca_score, t2_exam_score,  display_order, created_by, created_at)
                    SELECT UUID(),t3.academic_year,t4.id,t1.sub_category_code,t1.subject,t1.sub_dzo_name,
                    SUM(IF(t3.term_number=1,t1.ca_score,0)), SUM(IF(t3.term_number=1,t1.exam_score,0)),
                    SUM(IF(t3.term_number<>1,t1.ca_score,0)), SUM(IF(t3.term_number<>1,t1.exam_score,0)),MAX(t1.display_order), ? , ?
                    FROM aca_result_score_csa t1
                        JOIN aca_result_student t2 ON t1.aca_result_student_id = t2.id
                        JOIN aca_result t3 ON t2.aca_result_id = t3.id
                        JOIN (SELECT id,std_student_id FROM aca_result_student WHERE aca_result_id = ?) t4 ON t2.std_student_id = t4.std_student_id
                    WHERE t1.sub_category_code=1 AND t1.academic_year = ? AND t3.org_id = ? AND t3.org_class_id = ?";
                        $params = [$request['user_id'], date('Y-m-d h:i:s'), $id, $term_detail->academic_year, $request['orgnization']['id'], $request['class']['org_class_id']];
                        if ($stream_id != null) {
                            $query2 .= " AND t3.org_stream_id = ?";
                            array_push($params, $stream_id);
                        }
                        if ($section_id != null) {
                            $query2 .= " AND t3.org_section_id = ?";
                            array_push($params, $section_id);
                        }
                        DB::statement("$query2 GROUP BY t3.academic_year,t4.id,t1.sub_category_code,t1.subject,t1.sub_dzo_name", $params);

                        //Insert non-academic result and others (sub_category_code=2 and sub_category_code=3) - Ratings
                        $query3 = "INSERT INTO aca_result_score_csa(id, academic_year, aca_result_student_id, aca_rating_type_id, sub_category_code, subject,
                     sub_dzo_name, aca_assmt_area_id,assessment_area, assmnt_area_dzo_name, score, display_order, created_by, created_at)
                        SELECT UUID(),t3.academic_year,t4.id,t1.aca_rating_type_id,t1.sub_category_code,t1.subject,sub_dzo_name,
                        t1.aca_assmt_area_id,t1.assessment_area,t1.assmnt_area_dzo_name,ROUND(AVG(t1.score)),MAX(t1.display_order), ? , ?
                        FROM aca_result_score_csa t1
                            JOIN aca_result_student t2 ON t1.aca_result_student_id = t2.id
                            JOIN aca_result t3 ON t2.aca_result_id = t3.id
                            JOIN (SELECT id,std_student_id FROM aca_result_student WHERE aca_result_id = ?) t4 ON t2.std_student_id = t4.std_student_id
                        WHERE t1.sub_category_code<>1 AND t1.academic_year = ? AND t3.org_id = ? AND t3.org_class_id = ?";
                        $paramater = [$request['user_id'], date('Y-m-d h:i:s'), $id, $term_detail->academic_year, $request['orgnization']['id'], $request['class']['org_class_id']];
                        if ($stream_id != null) {
                            $query3 .= " AND t3.org_stream_id = ?";
                            array_push($paramater, $stream_id);
                        }
                        if ($section_id != null) {
                            $query3 .= " AND t3.org_section_id = ?";
                            array_push($paramater, $section_id);
                        }
                        DB::statement("$query3 GROUP BY t3.academic_year,t4.id,t1.aca_rating_type_id,t1.sub_category_code,t1.subject,sub_dzo_name,
                        t1.aca_assmt_area_id,t1.assessment_area,t1.assmnt_area_dzo_name", $paramater);
                        //Update descriptive score with rating names and last term's descriptive score for input_type=2
                        DB::statement(
                            'UPDATE aca_result_student t0 JOIN aca_result_score_csa t1 ON t0.id = t1.aca_result_student_id 
                                LEFT JOIN aca_rating t2 ON t1.aca_rating_type_id = t2.aca_rating_type_id AND t1.score = t2.score
                                LEFT JOIN (SELECT b.std_student_id,a.aca_assmt_area_id,a.score_description,a.score_descr_dzo_name
                                     FROM aca_result_score_csa a JOIN aca_result_student b ON a.aca_result_student_id = b.id
                                    WHERE b.aca_result_id = ? AND a.score IS NULL) t3 ON t0.std_student_id = t3.std_student_id AND t1.aca_assmt_area_id = t3.aca_assmt_area_id
                            SET t1.score_description = IFNULL(t2.name,t3.score_description), t1.score_descr_dzo_name = IFNULL(t2.dzo_name,t3.score_descr_dzo_name)
                            WHERE t0.aca_result_id = ?',
                            [$lastTermResultId, $id]
                        );
                    }
                }
            }
        } catch (Exception $e) {
            dd($e);
        }
        return true;
    }
    public function getApprovedTerms(Request $request)
    {
        $query = "SELECT id,transcript_format,academic_year,CONCAT(class,IFNULL(CONCAT(' ',stream),''),IFNULL(CONCAT(' ',section),'')) AS class,term_name FROM aca_result WHERE academic_year = ? AND org_id = ? AND org_class_id = ?";
        // Have to put $request['academic_year'] instread of 0
        $params = [0, $request['org_id'], $request['org_class_id']];
        if ($request['org_stream_id']) {
            $query .= " AND org_stream_id = ?";
            array_push($params, $request['org_stream_id']);
        }
        if ($request['org_section_id']) {
            $query .= " AND org_section_id = ?";
            array_push($params, $request['org_section_id']);
        }
        return $this->successResponse(DB::select($query, $params));
    }
    public function getStudentsForProgressReport($Id)
    {
        return $this->successResponse(DB::select('SELECT id,aca_result_id,roll_no,name,student_code,cid FROM aca_result_student WHERE aca_result_id = ?', [$Id]));
    }
    public function getProgressReport($resultStdId, $resultId)
    {
        $org_and_class_details = DB::select("SELECT transcript_format,term_number,term_name,school_name,gewog,dzongkhag,CONCAT(class,IFNULL(CONCAT(' ',stream),'')) AS class,section,no_of_students,stf_class_tecaher_name,stf_principal_name FROM aca_result WHERE id = ?", [$resultId]);
        $student_details = DB::select('SELECT id,aca_result_id,roll_no,name,student_code,cid,admission_no,dob,t1_marks_percent,t1_position,t1_no_of_days_attended,
                t1_instructional_days,t1_attendance_percent,t2_marks_percent,t2_position,t2_no_of_days_attended,
                marks_percent,position,no_of_days_attended,instructional_days,attendance_percent,special_award,responsibility,promoted,general_comment 
            FROM aca_result_student WHERE id = ?', [$resultStdId]);
        $personal_characteristics = DB::select("SELECT t2.name AS rating, t2.dzo_name AS dzo_name_rating,t2.description FROM aca_rating_type t1 JOIN aca_rating t2 ON t1.id = t2.aca_rating_type_id WHERE t1.code = 1");
        $rating_type = DB::select('SELECT t2.name AS rating, t2.dzo_name AS dzo_name_rating,t2.description FROM aca_rating_type t1 JOIN aca_rating t2 ON t1.id = t2.aca_rating_type_id WHERE t1.code = 2');
        $org_and_class_details = count($org_and_class_details) > 0 ? $org_and_class_details[0] : false;
        $student_details = count($student_details) > 0 ? $student_details[0] : false;
        $academic_result = [];
        $academic_result_descriptive = [];
        $non_academic_result = [];
        $others_result = [];
        $maxNoOfAssessmentAreas = 0;
        $maxNoOfAssmntAreasDescriptive = 0;
        if ($org_and_class_details) {
            if ($org_and_class_details->transcript_format == 1) { //CFA
                $academic_result_raw = DB::select('SELECT t2.subject,t1.assessment_area,t1.score_description,t1.rating_type_code,t2.teacher
                    FROM aca_result_score_cfa t1 JOIN aca_result_subject t2 ON t1.aca_sub_id = t2.aca_sub_id AND t2.aca_result_id = ?
                    WHERE t1.aca_result_student_id = ? AND t2.sub_category_code = 1 ORDER BY t1.display_order', [$resultId, $resultStdId]);

                $non_academic_result = DB::select('SELECT t2.subject,t1.assessment_area,t1.score_description 
                    FROM aca_result_score_cfa t1 JOIN aca_result_subject t2 ON t1.aca_sub_id = t2.aca_sub_id AND t2.aca_result_id = ?
                    WHERE t1.aca_result_student_id = ? AND t2.sub_category_code = 2 ORDER BY t1.display_order', [$resultId, $resultStdId]);

                $others_result = DB::select('SELECT t2.subject,t1.assessment_area,t1.score_description 
                    FROM aca_result_score_cfa t1 JOIN aca_result_subject t2 ON t1.aca_sub_id = t2.aca_sub_id AND t2.aca_result_id = ?
                    WHERE t1.aca_result_student_id = ? AND t2.sub_category_code = 3 ORDER BY t1.display_order', [$resultId, $resultStdId]);


                foreach ($academic_result_raw as $result) {
                    $newItem = ['assessment_area' => $result->assessment_area, 'assmnt_area_dzo' => null, 'score_description' => $result->score_description, "score_dzo" => null];
                    if ($result->rating_type_code == 4) {
                        if (array_key_exists($result->subject, $academic_result_descriptive)) {
                            array_push($academic_result_descriptive[$result->subject]["scores"], $newItem,);
                        } else {
                            $academic_result_descriptive[$result->subject] = ["sub_dzo" => null, "scores" => [$newItem], "sub_teacher" => $result->teacher];
                        }
                    } else {
                        if (array_key_exists($result->subject, $academic_result)) {
                            array_push($academic_result[$result->subject]["scores"], $newItem);
                        } else {
                            $academic_result[$result->subject] = ["sub_dzo" => null, "scores" => [$newItem], "sub_teacher" => $result->teacher];
                        }
                    }
                }
                foreach ($academic_result_descriptive as $result1) {
                    $maxNoOfAssmntAreasDescriptive = max($maxNoOfAssmntAreasDescriptive, count($result1["scores"]));
                }
                foreach ($academic_result as $result2) {
                    $maxNoOfAssessmentAreas = max($maxNoOfAssessmentAreas, count($result2["scores"]));
                }
            } elseif ($org_and_class_details->transcript_format == 2) { //CSA
                if ($org_and_class_details->term_number == 0) { //Final result
                    $academic_result = DB::select('SELECT t1.subject,t1.sub_dzo_name,TRIM(t1_ca_score)+0 AS t1_ca_score,TRIM(t1_exam_score)+0 AS t1_exam_score, TRIM(t2_ca_score)+0 AS t2_ca_score, TRIM(t2_exam_score)+0 AS t2_exam_score
                        FROM aca_result_score_csa t1
                    WHERE t1.aca_result_student_id = ? AND t1.sub_category_code = 1 ORDER BY t1.display_order', [$resultStdId]);
                } else { //Term result
                    $academic_result = DB::select('SELECT t1.subject,t1.sub_dzo_name,ca_score, exam_score
                        FROM aca_result_score_csa t1
                    WHERE t1.aca_result_student_id = ? AND t1.sub_category_code = 1 ORDER BY t1.display_order', [$resultStdId]);
                }
                $non_academic_result = DB::select('SELECT t1.subject,t1.assessment_area,t1.score_description 
                     FROM aca_result_score_csa t1 
                    WHERE t1.aca_result_student_id = ? AND t1.sub_category_code = 2 ORDER BY t1.display_order',  [$resultStdId]);
                $others_result = DB::select('SELECT t1.subject,t1.assessment_area,t1.score_description 
                        FROM aca_result_score_csa t1 
                    WHERE t1.aca_result_student_id = ? AND t1.sub_category_code = 3 ORDER BY t1.display_order', [$resultStdId]);
            }
        } else {
            return $this->errorResponse('Result not found.', Response::HTTP_NOT_FOUND);
        }
        return $this->successResponse([
            'maxNoOfAssessmentAreas' => $maxNoOfAssessmentAreas,
            'maxNoOfAssmntAreasDescriptive' => $maxNoOfAssmntAreasDescriptive,
            'academic_result_descriptive' => $academic_result_descriptive,
            'org_and_class_details' => $org_and_class_details,
            'student_details' => $student_details,
            'academic_result' => $academic_result,
            'non_academic_result' => $non_academic_result,
            'others_result' => $others_result,
            'personal_characteristics' => $personal_characteristics,
            'rating_type' => $rating_type,
        ]);
    }

    private function passFail($orgId, $classId, $streamId, $sectionId)
    {
        $inner_pass_fail_query = "SELECT t4.std_student_id,t6.aca_sub_id,t8.aca_promotion_sub_group_id,IF(t7.input_type=1,(SUM(IF(t5.aca_assmnt_type=0,t4.score,0))/SUM(IF(t5.aca_assmnt_type=0,t51.weightage,0)))*100>=t6.pass_score AND (SUM(IF(t5.aca_assmnt_type=1,t4.score,0))/SUM(IF(t5.aca_assmnt_type=1,t51.weightage,0)))*100>=t6.pass_score,ROUND(AVG(t4.score))>=t6.pass_score) AS passed
            FROM (aca_student_assessment t3 
                JOIN aca_student_assessment_detail t4 ON t3.id = t4.aca_student_assmt_id 
                JOIN aca_assessment_area t5 ON t4.aca_assmt_area_id=t5.id)
                JOIN (SELECT aca_assmt_term_id,aca_assmt_area_id,SUM(weightage) AS weightage FROM aca_class_subject_assessment WHERE org_class_id = ? AND (org_stream_id IS NULL OR org_stream_id = ?) GROUP BY aca_assmt_term_id,aca_assmt_area_id) t51 ON t3.aca_assmt_term_id=t51.aca_assmt_term_id AND t5.id = t51.aca_assmt_area_id
                JOIN aca_class_subject t6 ON t5.aca_sub_id = t6.aca_sub_id AND t3.org_class_id = t6.org_class_id AND (t3.org_stream_id = t6.org_stream_id OR (t3.org_stream_id is null AND t6.org_stream_id IS NULL))
                JOIN aca_rating_type t7 ON t6.aca_rating_type_id=t7.id
                JOIN aca_promotion_rule t8 ON t5.aca_sub_id = t8.aca_sub_id AND t3.org_class_id = t8.org_class_id AND (t3.org_stream_id = t8.org_stream_id OR (t3.org_stream_id is null AND t8.org_stream_id IS NULL))
            WHERE t3.org_id = ? AND t6.org_class_id = ?";

        $pass_fail_param = [$classId, $streamId, $orgId, $classId];
        if ($streamId) {
            $inner_pass_fail_query .= ' AND t3.org_stream_id = ?';
            array_push($pass_fail_param, $streamId);
        }
        if ($sectionId) {
            $inner_pass_fail_query .= ' AND t3.org_section_id = ?';
            array_push($pass_fail_param, $sectionId);
        }

        $pass_fail_query = "SELECT t0.std_student_id, MIN(t0.passed) AS passed
        FROM (
            SELECT t1.std_student_id,t1.aca_promotion_sub_group_id,SUM(t1.passed)>=IF(t1.aca_promotion_sub_group_id=0,COUNT(t1.aca_sub_id),t1.aca_promotion_sub_group_id) as passed
            FROM (
                $inner_pass_fail_query GROUP BY t4.std_student_id,t6.aca_sub_id,t8.aca_promotion_sub_group_id,t7.input_type,t6.pass_score
            ) t1
            GROUP BY t1.std_student_id,t1.aca_promotion_sub_group_id
        ) t0
        GROUP BY t0.std_student_id";


        return DB::select($pass_fail_query, $pass_fail_param);
    }
    public function getScoresForSpms($year, $org_class_id, $previous_org_class_id)
    {
        try {

            $pass_percent = DB::select("SELECT t2.org_id,t2.school_name, ROUND(100*(COUNT(IF(t1.promoted,t1.id,null))/COUNT(t1.id)),2) AS pass_percent
            FROM aca_result_student t1 
                JOIN aca_result t2 ON t1.aca_result_id = t2.id 
            WHERE t2.academic_year = ? AND t2.org_class_id = ? AND t2.term_number = 0
            GROUP BY t2.org_id,t2.school_name", [$year, $org_class_id]);
            $pass_percent_previous_class = DB::select("SELECT t2.org_id,t2.school_name, ROUND(100*(COUNT(IF(t1.promoted,t1.id,null))/COUNT(t1.id)),2) AS pass_percent
            FROM aca_result_student t1 
                JOIN aca_result t2 ON t1.aca_result_id = t2.id 
            WHERE t2.academic_year = ? AND t2.org_class_id = ? AND t2.term_number = 0
            GROUP BY t2.org_id,t2.school_name", [$year, $previous_org_class_id]);

            $non_stem_national_mean = DB::select("SELECT 
            ROUND(SUM(IFNULL(t1.t1_ca_score,0.00)+IFNULL(t1.t1_exam_score,0.00)+IFNULL(t1.t2_ca_score,0.00)+IFNULL(t1.t2_exam_score,0.00))/(COUNT(DISTINCT t2.id) * COUNT(DISTINCT t1.subject)),2) AS national_mean
            FROM aca_result_score_csa t1 
                JOIN aca_result_student t2 ON t1.aca_result_student_id=t2.id 
                JOIN aca_result t3 ON t2.aca_result_id = t3.id 
            WHERE t3.academic_year = ? AND t3.org_class_id = ? AND t3.term_number = 0 AND t1.is_stem = 0", [$year, $org_class_id]);

            $non_stem_mean_inner_query = "SELECT t3.org_id,t1.subject,
            ROUND(SUM(IFNULL(t1.t1_ca_score,0.00)+IFNULL(t1.t1_exam_score,0.00)+IFNULL(t1.t2_ca_score,0.00)+IFNULL(t1.t2_exam_score,0.00))/COUNT(DISTINCT t2.id),2) AS subject_wise_mean
            FROM aca_result_score_csa t1 
                JOIN aca_result_student t2 ON t1.aca_result_student_id=t2.id 
                JOIN aca_result t3 ON t2.aca_result_id = t3.id 
            WHERE t3.academic_year = ? AND t3.org_class_id = ? AND t3.term_number = 0 AND t1.is_stem = 0
            GROUP BY t3.org_id,t1.subject";

            $non_stem_mean = DB::select("SELECT t1.org_id,ROUND(SUM(IFNULL(t1.subject_wise_mean,0.00))/COUNT(DISTINCT t1.subject),2) AS non_stem_mean
        FROM ($non_stem_mean_inner_query) t1
        GROUP BY t1.org_id", [$year, $org_class_id]);

            $stem_national_mean = DB::select("SELECT 
            ROUND(SUM(IFNULL(t1.t1_ca_score,0.00)+IFNULL(t1.t1_exam_score,0.00)+IFNULL(t1.t2_ca_score,0.00)+IFNULL(t1.t2_exam_score,0.00))/(COUNT(DISTINCT t2.id) * COUNT(DISTINCT t1.subject)),2) AS national_mean
            FROM aca_result_score_csa t1 
                JOIN aca_result_student t2 ON t1.aca_result_student_id=t2.id 
                JOIN aca_result t3 ON t2.aca_result_id = t3.id 
            WHERE t3.academic_year = ? AND t3.org_class_id = ? AND t3.term_number = 0 AND t1.is_stem = 1", [$year, $org_class_id]);

            $stem_mean_inner_query = "SELECT t3.org_id,t1.subject,
            ROUND(SUM(IFNULL(t1.t1_ca_score,0.00)+IFNULL(t1.t1_exam_score,0.00)+IFNULL(t1.t2_ca_score,0.00)+IFNULL(t1.t2_exam_score,0.00))/COUNT(DISTINCT t2.id),2) AS subject_wise_mean
            FROM aca_result_score_csa t1 
                JOIN aca_result_student t2 ON t1.aca_result_student_id=t2.id 
                JOIN aca_result t3 ON t2.aca_result_id = t3.id 
            WHERE t3.academic_year = ? AND t3.org_class_id = ? AND t3.term_number = 0 AND t1.is_stem = 1
            GROUP BY t3.org_id,t1.subject";

            $stem_mean = DB::select("SELECT t1.org_id,ROUND(SUM(IFNULL(t1.subject_wise_mean,0.00))/COUNT(DISTINCT t1.subject),2) AS stem_mean
        FROM ($stem_mean_inner_query) t1
        GROUP BY t1.org_id", [$year, $org_class_id]);

            //(count(*) * sum(x * y) - sum(x) * sum(y)) / 
            //(sqrt(count(*) * sum(x * x) - sum(x) * sum(x)) * sqrt(count(*) * sum(y * y) - sum(y) * sum(y))) 
            //AS correlation
            // x = (IFNULL(t1.t1_ca_score,0.00)+IFNULL(t1.t2_ca_score,0.00))
            // y = (IFNULL(t1.t1_exam_score,0.00)+IFNULL(t1.t2_exam_score,0.00))
            $correlation = DB::select("SELECT t3.org_id,
                (count(DISTINCT t2.id) * sum((IFNULL(t1.t1_ca_score,0.00)+IFNULL(t1.t2_ca_score,0.00)) * (IFNULL(t1.t1_exam_score,0.00)+IFNULL(t1.t2_exam_score,0.00))) - sum((IFNULL(t1.t1_ca_score,0.00)+IFNULL(t1.t2_ca_score,0.00))) * sum((IFNULL(t1.t1_exam_score,0.00)+IFNULL(t1.t2_exam_score,0.00)))) / 
                (sqrt(count(DISTINCT t2.id) * sum((IFNULL(t1.t1_ca_score,0.00)+IFNULL(t1.t2_ca_score,0.00)) * (IFNULL(t1.t1_ca_score,0.00)+IFNULL(t1.t2_ca_score,0.00))) - sum((IFNULL(t1.t1_ca_score,0.00)+IFNULL(t1.t2_ca_score,0.00))) * sum((IFNULL(t1.t1_ca_score,0.00)+IFNULL(t1.t2_ca_score,0.00)))) * sqrt(count(*) * sum((IFNULL(t1.t1_exam_score,0.00)+IFNULL(t1.t2_exam_score,0.00)) * (IFNULL(t1.t1_exam_score,0.00)+IFNULL(t1.t2_exam_score,0.00))) - sum((IFNULL(t1.t1_exam_score,0.00)+IFNULL(t1.t2_exam_score,0.00))) * sum((IFNULL(t1.t1_exam_score,0.00)+IFNULL(t1.t2_exam_score,0.00))))) 
                AS correlation
            FROM aca_result_score_csa t1 JOIN aca_result_student t2 ON t1.aca_result_student_id=t2.id 
                JOIN aca_result t3 ON t2.aca_result_id = t3.id 
            WHERE t3.academic_year = ? AND t3.org_class_id = ? AND t3.term_number = 0
            GROUP BY t3.org_id", [$year, $org_class_id]);
            return $this->successResponse(
                [
                    'pass_percent' => $pass_percent,
                    'pass_percent_previous_class' => $pass_percent_previous_class,
                    'non_stem_national_mean' => $non_stem_national_mean,
                    'non_stem_mean' => $non_stem_mean,
                    'stem_national_mean' => $stem_national_mean,
                    'non_stem_mean' => $non_stem_mean,
                    'stem_mean' => $stem_mean,
                    'correlation' => $correlation,
                ]
            );
        } catch (Exception $e) {
            dd($e);
        }
    }
}
