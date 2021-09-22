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

    public $audit_table="system_admin";

    public $database="academic_db";

    public function getClassTeacher($orgId){
        return $this->successResponse (DB::select('SELECT org_id,org_class_id, org_stream_id, org_section_id, stf_staff_id FROM aca_class_teacher WHERE org_id = ?', [$orgId]));
    }
    public function getClassTeacherClasss($orgId,$staffId){
        return $this->successResponse (DB::select('SELECT org_id,org_class_id, org_class_stream_id,org_stream_id, org_section_id, stf_staff_id,class_stream_section FROM aca_class_teacher WHERE org_id = ? AND stf_staff_id = ?', [$orgId,$staffId]));
    }
    public function saveClassTeacher(Request $request){
        $rules = [
            'data.*.stf_staff_id' => 'required'
        ];
        $customMessages = [
            'data.*.stf_staff_id.required' => 'This field is required'
        ];

        $this->validate($request, $rules, $customMessages);
        DB::transaction(function() use($request) {
            $this->updateClassTeacher($request);
            $query = 'DELETE FROM aca_class_teacher WHERE org_id = ?';
            DB::delete($query, [$request['data'][0]['org_id']]);
            foreach($request['data'] as $classTeacher){
                $classTeacher['created_by'] =  $request['user_id'];
                $classTeacher['created_at'] =   date('Y-m-d h:i:s');
                ClassTeacher::create($classTeacher);
            }
        });
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    private function updateClassTeacher($request){
        foreach($request['data'] as $classTeacher){
            $classTeacher['created_by'] =  $request['user_id'];
            $classTeacher['created_at'] =   date('Y-m-d h:i:s');
            $classTeacher['updated_by'] =   $request['user_id'];
            $classTeacher['updated_at'] =   date('Y-m-d h:i:s');
            $classTeacher['recorded_for'] =  'Class Teacher Change'; 
            ClassTeacherHistory::create($classTeacher);
        }
    }
    public function saveSubjectTeacher(Request $request){
        $rules = [
            'data.*.stf_staff_id' => 'required'
        ];
        $customMessages = [
            'data.*.stf_staff_id.required' => 'This field is required'
        ];
        $this->validate($request, $rules, $customMessages);
        DB::transaction(function() use($request) {
            try{
            $this->updateSubjectTeacher($request);
            $query= "DELETE FROM aca_class_subject_teacher WHERE org_id = ? AND org_class_id = ?";
            $param = [$request['org_id'],$request['org_class_id']];
 
             if($request['org_stream_id']){
                 $query .= ' AND org_stream_id = ?';
                 array_push($param, $request['org_stream_id']);
             }
             if($request['org_section_id']){
                 $query .= ' AND org_section_id = ?';
                 array_push($param, $request['org_section_id']);
             }
            DB::delete($query, $param);
            foreach($request['data'] as $subjectTeacher){
                if(array_key_exists("stf_staff_id", $subjectTeacher) && array_key_exists("aca_sub_id", $subjectTeacher) && $subjectTeacher["stf_staff_id"] && $subjectTeacher["aca_sub_id"]){
                    $subjectTeacher['org_id'] =  $request['org_id'];
                    $subjectTeacher['class_stream_section'] =  $request['class_stream_section'];
                    $subjectTeacher['org_stream_id'] =  $request['org_stream_id'];
                    $subjectTeacher['org_section_id'] =  $request['org_section_id'];
                    $subjectTeacher['created_by'] =  $request['user_id'];
                    $subjectTeacher['created_at'] =  date('Y-m-d h:i:s');
                    SubjectTeacher::create($subjectTeacher);
                }
            }
        }catch(Exception $e){
           dd($e);
        }

        });
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    private function updateSubjectTeacher($request){
        foreach($request['data'] as $subjectTeacher){
            if(array_key_exists("stf_staff_id", $subjectTeacher) && array_key_exists("aca_sub_id", $subjectTeacher) && $subjectTeacher["stf_staff_id"] && $subjectTeacher["aca_sub_id"]){
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
    public function getSubjectTeacher(Request $request,$orgId){
        try{
        $query = "SELECT t1.org_class_id, t1.org_stream_id, t1.aca_sub_id,t2.name, t2.dzo_name,t3.aca_teacher_sub_id FROM aca_class_subject t1 JOIN aca_subject t2 ON t1.aca_sub_id = t2.id LEFT JOIN aca_subject_mapping_for_tre t3 ON t2.id=t3.aca_sub_id WHERE t2.assessed_by_class_teacher<>1 AND t1.org_class_id = ?";
        $query1 = "SELECT org_id, stf_staff_id, org_class_id, org_stream_id,org_section_id, aca_sub_id FROM aca_class_subject_teacher WHERE org_id = ? AND org_class_id = ?";
        $query2 = "SELECT org_class_id,org_stream_id,aca_sub_id,aca_teacher_sub_id,standard_hours,standard_minutes FROM aca_subject_mapping_for_tre WHERE org_class_id = ?";
        $param = [$request['org_class_id']];
        $param1 = [$orgId,$request['org_class_id']];

        if($request['org_stream_id']){
            $query .= ' AND t1.org_stream_id = ?';
            $query1 .= ' AND org_stream_id = ?';
            $query2 .= ' AND org_stream_id = ?';
            array_push($param, $request['org_stream_id']);
            array_push($param1, $request['org_stream_id']);

        }
        if($request['org_section_id']){
            $query1 .= ' AND org_section_id = ?';
            array_push($param1, $request['org_section_id']);
        }
        $classSubjects = DB::select($query." GROUP BY t1.org_class_id, t1.org_stream_id, t1.aca_sub_id,t2.name, t2.dzo_name,t3.aca_teacher_sub_id",$param);
        $classSubjectTeachers = DB::select($query1,$param1);
        $subjectMappingForTre = DB::select($query2,$param);
       
       return $this->successResponse(["classSubjects"=>$classSubjects, "classSubjectTeachers"=>$classSubjectTeachers, "subjectMappingForTre" =>$subjectMappingForTre]);
    }
    catch(Exception $e){
        dd($e);
    }
    }
    public function getStudentElectiveSubjects(){
        return $this->successResponse(
            DB::select('SELECT std_student_id, aca_sub_id FROM aca_student_elective_subject')
        );
    }
    public function getElectiveSubjects($classId, $streamId=""){
        $query = 'SELECT t1.aca_sub_id,t1.org_class_id,t1.org_stream_id,t2.name AS subject, t2.dzo_name FROM aca_class_subject t1 JOIN aca_subject t2 ON t1.aca_sub_id = t2.id WHERE t1.is_elective = 1 AND t1.org_class_id = ?';
        $params = [$classId];
        if($streamId){
          $query .= ' AND t1.org_stream_id = ?';
          array_push($params,$streamId);
        }

        return $this->successResponse (DB::select($query, $params));
    }
    public function getClassWithElectiveSubject(){
        $classWithElectiveSubject = DB::select('SELECT DISTINCT org_class_id, org_stream_id FROM aca_class_subject WHERE is_elective = 1');
        return $this->successResponse($classWithElectiveSubject);
    }
    public function saveStudentElectiveSubject(Request $request){
        $rules = [
            'data.*.std_student_id' => 'required'
        ];
        $customMessages = [
            'data.*.std_student_id.required' => 'This field is required'
        ];
        $this->validate($request, $rules, $customMessages);
        try{
            DB::transaction(function() use($request) {
                foreach($request['data'] as $electiveSubject){
                    $this->updateOptionalSubject($request,$electiveSubject);
                    DB::delete('DELETE FROM aca_student_elective_subject WHERE std_student_id = ?', [$electiveSubject['std_student_id']]);
                    foreach($electiveSubject as $key => $value){
                        if($key == $value && $value){
                            StudentElectiveSubject::create(
                                ['std_student_id' => $electiveSubject['std_student_id'],'aca_sub_id' => $value,'created_by' => $request['user_id'],'created_at' => date('Y-m-d h:i:s')]
                            );
                        }
                    }
                }
            });
        }catch(Exception $e){
            dd($e);
        }
     
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    private function updateOptionalSubject($request,$electiveSubject){
        foreach($electiveSubject as $key => $value){
            if($key == $value && $value){
                StudentElectiveSubjectHistory::create(
                    ['std_student_id' => $electiveSubject['std_student_id'],'aca_sub_id' => $value,'recorded_for'=>'Optional Subject Change','created_by' => $request['user_id'],'created_at' => date('Y-m-d h:i:s')]
                );
            }
        }
    }
    private function saveAttendance($request){
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
        try{
        foreach($request["data"] as $studentAttendance){
            if($studentAttendance['is_present']=="0"){
                StudentAttendanceDetail::create(
                    ['aca_std_attendance_id' => $stdAttendance->id,
                    'aca_absence_reason_id' => $studentAttendance['aca_absence_reason_id'],
                    'std_student_id' => $studentAttendance['std_student_id'],
                    'created_by' => $request['user_id'],
                    'created_at' => date('Y-m-d h:i:s')]
                );
            }
        }
    }catch(Exception $e){
        dd($e);
    }
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
            if($request['action']=="add"){
                $rules['attendance_date'] = ['required',Rule::unique('aca_student_attendance')->where('org_class_id',$request->org_class_id)];
                $this->validate($request, $rules, $customMessages);
                DB::transaction(function() use($request) {
                    $this->saveAttendance($request->all());
                });
            }else if($request['action']=="edit"){
                try{
                $this->validate($request, $rules, $customMessages);
                $query = 'DELETE FROM aca_student_attendance WHERE org_id = ? AND org_class_id = ? AND attendance_date = ?';
                $params = [$request->org_id,$request->org_class_id,$request->attendance_date];
                if($request->org_stream_id){
                    $query .= ' AND org_stream_id = ?';
                    array_push($params, $request->org_stream_id);
                }
                if($request->org_section_id){
                    $query .= ' AND org_section_id = ?';
                    array_push($params, $request->org_section_id);
                }
                DB::transaction(function() use($request,$query, $params) {
                    // $this->updateAttendance($request);
                    DB::delete($query, $params);
                    $this->saveAttendance($request->all());
                });
            }catch(Exception $e){
                dd($e);
            }

            }
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    private function updateAttendance($request){
        $org_stream_id = isset($request['org_stream_id']) ? $request['org_stream_id'] : null;
        $org_section_id = isset($request['org_section_id']) ? $request['org_section_id'] : null;
        foreach($request["data"] as $studentAttendance){
            if($studentAttendance['is_present']=="0"){
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
    public function getTermsByClass($classId,$streamId=""){
        $query = 'SELECT t1.id,t1.name,t1.dzo_name FROM aca_assessment_term t1 
                    JOIN aca_class_assessment_frequency t2 ON t1.aca_assmt_frequency_id = t2.aca_assmt_frequency_id 
                 WHERE t2.org_class_id = ?';
        $param = [$classId];
        if($streamId){
           $query.= ' AND t2.org_stream_id';
           array_push($param,$streamId);
        }
        $getTerms = $this->successResponse(DB::select("$query AND t1.status = 1",$param));
        return $getTerms;
    }
    public function saveInstrunctionalDays(Request $request){
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
       
        if($request['action']=='add'){
            $data = [
                'org_id' => $request['org_id'],
                'org_class_id' => $request['org_class_id'],
                'org_stream_id' => $request['org_stream_id'],
                'org_section_id' => $request['org_section_id'],
                'org_class_stream_id'=>$request['org_class_stream_id'],
                'class_stream_section' => $request['class_stream_section'],
                'std_student_id' => $request['std_student_id'],
                'aca_assmt_term_id' => $request['aca_assmt_term_id'],
                'instructional_days' => $request['instructional_days'],
                'remarks' => $request['remarks'],
                'created_by' => $request['user_id'],
                'created_at' => date('Y-m-d h:i:s'),
            ];
           try{ $response_data= InstructionalDaysForSpecialCase::create($data);} catch(Exception $e){
               dd($e);
           }
        }
        if($request['action']=='edit'){
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
    public function getInstrunctionalDays(){
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
    public function loadStudentAssessmentList(Request $request,$staffId, $orgId){
        $classTeacherSubjects = "SELECT t2.assessed_by_class_teacher,
                t6.id AS std_assmt_id,
                IFNULL(t3.org_class_id,t4.org_class_id) AS org_class_id,
                IF(t3.org_class_id,t3.org_stream_id,t4.org_stream_id) AS org_stream_id,
                IF(t3.org_class_id,t3.org_section_id,t4.org_section_id) AS org_section_id,
                t1.aca_sub_id,
                x2.id AS aca_assmt_term_id,
                t2.name AS sub_name,
                t2.dzo_name AS sub_dzo_name,
                x2.name AS term_name,
                x2.dzo_name AS term_dzo_name,
                (t4.id IS NOT NULL) AS is_class_teacher,
                (t3.stf_staff_id IS NOT NULL OR (t4.id IS NOT NULL AND t2.assessed_by_class_teacher=1)) AS is_subject_teacher,
                t6.finalized,
                DATE_FORMAT(t6.finalized_date,'%d-%m-%Y %H:%i %p') AS finalized_date
            FROM aca_class_subject t1 JOIN aca_subject t2 ON t1.aca_sub_id=t2.id
                JOIN (aca_class_assessment_frequency x1 JOIN aca_assessment_term x2 ON x1.aca_assmt_frequency_id=x2.aca_assmt_frequency_id) ON t1.org_class_id = x1.org_class_id AND (t1.org_stream_id = x1.org_stream_id OR (t1.org_stream_id IS NULL AND x1.org_stream_id IS NULL))
                LEFT JOIN aca_class_subject_teacher t3 ON t3.stf_staff_id = ? AND t3.org_id = ? AND t1.aca_sub_id = t3.aca_sub_id AND t1.org_class_id = t3.org_class_id AND (t1.org_stream_id = t3.org_stream_id OR (t1.org_stream_id IS NULL AND t3.org_stream_id IS NULL))
                LEFT JOIN aca_class_teacher t4 ON t4.stf_staff_id = ? AND t4.org_id = ? AND t1.org_class_id = t4.org_class_id AND (t1.org_stream_id = t4.org_stream_id OR (t1.org_stream_id IS NULL AND t4.org_stream_id IS NULL)) AND (t2.assessed_by_class_teacher=1 OR (t3.org_section_id=t4.org_section_id OR (t3.org_section_id IS NULL AND t4.org_section_id IS NULL)))
                LEFT JOIN aca_student_assessment t6 ON t6.org_id = ? AND x2.id=t6.aca_assmt_term_id AND t1.org_class_id = t6.org_class_id AND (t1.org_stream_id = t6.org_stream_id OR (t1.org_stream_id IS NULL AND t6.org_stream_id IS NULL)) AND t1.aca_sub_id = t6.aca_sub_id AND (IFNULL(t3.org_section_id,t4.org_section_id)=t6.org_section_id OR (IFNULL(t3.org_section_id,t4.org_section_id) IS NULL AND t6.org_section_id IS NULL))
            WHERE (t3.id IS NOT NULL OR t4.id IS NOT NULL) AND x2.id = ? AND t1.org_class_id = ?";
            $param=[$staffId, $orgId, $staffId, $orgId, $orgId,$request->aca_assmt_term_id,$request->org_class_id];

            if($request->org_stream_id !== null){
                $classTeacherSubjects .= " AND t1.org_stream_id = ?";
                array_push($param,$request->org_stream_id);
            }
            if($request->org_section_id !== null){
                $classTeacherSubjects .= " AND IFNULL(t3.org_section_id,t4.org_section_id) = ?";
                array_push($param,$request->org_section_id);
            }
        try{
            return $this->successResponse(DB::select($classTeacherSubjects,$param));
        }catch(Exception $e){
            dd($e);
        }
    }

    public function loadAssessmentAreas($term_id,$sub_id,$class_id, $stream_id=""){
        $areaFormat = DB::table("aca_setting")->where("id",1)->value("value");
        $query = "SELECT t1.aca_assmt_area_id,IF($areaFormat=2,t2.name,IFNUll(t2.code,t2.name)) AS assessment_area,IF($areaFormat=1,(t2.name),'') AS name,
         IF($areaFormat=1,(t2.code),'') AS code ,t2.dzo_name AS assmt_area_dzo_name, TRIM(t1.weightage)+0 AS weightage,
         IFNULL(t2.aca_rating_type_id,t3.aca_rating_type_id) AS aca_rating_type_id,t4.input_type, t1.display_order
        FROM aca_class_subject_assessment t1
            JOIN aca_assessment_area t2 ON t1.aca_sub_id = t2.aca_sub_id AND t1.aca_assmt_area_id=t2.id
            JOIN aca_class_subject t3 on t1.aca_sub_id=t3.aca_sub_id AND t1.org_class_id = t3.org_class_id AND (t1.org_stream_id = t3.org_stream_id OR (t1.org_stream_id is null AND t3.org_stream_id IS NULL))
            JOIN aca_rating_type t4 ON IFNULL(t2.aca_rating_type_id,t3.aca_rating_type_id)=t4.id
        WHERE t1.aca_assmt_term_id = ? AND t1.aca_sub_id = ? AND t1.org_class_id =?";
        $params = [$term_id,$sub_id,$class_id];
        if($stream_id){
          $query .= ' AND t1.org_stream_id = ?';
          array_push($params,$stream_id);
        }
        $assessmentAreas = DB::select($query." ORDER BY IFNULL(t1.display_order,t2.display_order)",$params);
        $ratings = DB::select('SELECT id, aca_rating_type_id, name, score FROM aca_rating WHERE status=1 ORDER BY score');
        return $this->successResponse (["assessmentAreas" =>$assessmentAreas, "ratings"=>$ratings]);
    }

    public function loadStudentAssessments($org_id,Request $request){
        $studentsTakingElective = false;
        if($this->isElectiveSubject($request->aca_sub_id,$request->org_class_id,$request->org_stream_id)){
            $studentsTakingElective = DB::table("aca_student_elective_subject")->where("aca_sub_id",$request->aca_sub_id)->pluck("std_student_id");
        }
        $query = "SELECT t1.id,t2.std_student_id,t2.aca_assmt_area_id, t2.aca_rating_type_id, t2.descriptive_score, IF(t4.input_type=2,t2.descriptive_score,NULLIF(TRIM(t2.score)+0,0)) AS score, IF(t4.input_type=2,t2.descriptive_score,IFNULL(t3.name,NULLIF(TRIM(t2.score)+0,0))) AS score_text, t2.remarks FROM aca_student_assessment t1 JOIN aca_student_assessment_detail t2 ON t1.id=t2.aca_student_assmt_id JOIN aca_rating_type t4 ON t2.aca_rating_type_id=t4.id LEFT JOIN aca_rating t3 ON t2.aca_rating_type_id = t3.aca_rating_type_id AND ifnull((TRIM(t2.score)+0),0) = t3.score WHERE t1.org_id = ? AND t1.aca_assmt_term_id =? AND t1.aca_sub_id =? AND t1.org_class_id = ? ";
        $param = [$org_id,$request->aca_assmt_term_id,$request->aca_sub_id,$request->org_class_id];
        if($request->org_stream_id){
            $query .= ' AND t1.org_stream_id = ?';
            array_push($param, $request->org_stream_id);
        }
        if($request->org_section_id){
            $query .= ' AND t1.org_section_id = ?';
            array_push($param, $request->org_section_id);
        }
        $studentAssessments = DB::select($query,$param);
        return $this->successResponse(['studentAssessments'=>$studentAssessments,'studentsTakingElective'=> $studentsTakingElective]);
    }

    private function isElectiveSubject($subId, $classId, $streamId=""){
        $query = "SELECT is_elective FROM aca_class_subject WHERE aca_sub_id = ? and org_class_id = ? ";
        $param = [$subId, $classId];
        if($streamId){
            $query .= ' AND org_stream_id = ?';
            array_push($param, $streamId);
        }
        $isElectiveQ = DB::select($query, $param);
        return $isElectiveQ[0]->is_elective;
    }
    public function loadStudentAttendance($orgId,$staffId){
        $studentAttendance =  DB::select("SELECT t1.org_id,t1.org_class_id, t1.org_stream_id, t1.org_section_id,t1.attendance_date
                FROM aca_student_attendance t1
            LEFT JOIN aca_class_teacher t2 ON t1.org_id = t2.org_id AND t1.org_class_id = t2.org_class_id AND (t1.org_stream_id = t2.org_stream_id OR (t1.org_stream_id IS NULL AND t2.org_stream_id IS NULL)) AND (t1.org_section_id = t2.org_section_id OR (t1.org_section_id IS NULL AND t2.org_section_id IS NULL)) AND t2.stf_staff_id = ?
            WHERE t1.org_id = ? AND t2.stf_staff_id = ? ORDER BY t1.attendance_date DESC",[$staffId, $orgId, $staffId]);

        return $this->successResponse($studentAttendance);
    }
    public function loadStudentAttendanceDetail($orgId,Request $request){
        $query = "SELECT (t2.id IS NOT NULL) AS absent, t1.org_id,t1.org_class_id, t1.org_stream_id, t1.org_section_id,t1.attendance_date,t2.std_student_id,t2.aca_absence_reason_id
                        FROM aca_student_attendance t1
                   LEFT JOIN aca_student_attendance_detail t2 ON t1.id = t2.aca_std_attendance_id WHERE t1.attendance_date = ? AND t1.org_id = ? AND t1.org_class_id = ?";
        $params = [$request->attendance_date,$orgId,$request->org_class_id];

        if($request->org_stream_id){
            $query .= ' AND t1.org_stream_id = ?';
            array_push($params, $request->org_stream_id);
        }
        if($request->org_section_id){
            $query .= ' AND t1.org_section_id = ?';
            array_push($params, $request->org_section_id);
        }
        $query1 = "SELECT attendance_date FROM  aca_student_attendance WHERE org_id = ? AND org_class_id = ?";
        $params1 = [$orgId,$request->org_class_id];
        if($request->org_stream_id){
        $query1 .= ' AND org_stream_id = ?';
        array_push($params1, $request->org_stream_id);
        }
        if($request->org_section_id){
        $query1 .= ' AND org_section_id = ?';
        array_push($params1, $request->org_section_id);
        }

        $studentAttendanceDetail = DB::select($query,$params);
        $hasAttendance = DB::select($query1,$params1);

        return $this->successResponse(["studentAttendanceDetail"=>$studentAttendanceDetail,"hasAttendance"=>$hasAttendance]);
    }
    public function getAttendanceData($orgId,Request $request){
        $query = "SELECT COUNT(t1.id) AS no_instructional_days,(COUNT(t1.id)-COUNT(t2.id)) AS no_days_present
            FROM aca_student_attendance t1 
                JOIN aca_assessment_term t2 ON t1.attendance_date BETWEEN CONCAT(YEAR(CURDATE()),'-',LPAD(t2.from_month,2,'0'),'-',LPAD(t2.from_date,2,'0')) 
                    AND CONCAT(YEAR(CURDATE()),'-',LPAD(t2.to_month,2,'0'),'-',LPAD(t2.to_date,2,'0')) 
                LEFT JOIN aca_student_attendance_detail t3 ON t1.id = t3.aca_std_attendance_id AND t3.std_student_id = ?
            WHERE t1.org_id = ? AND t2.id = ? AND t1.org_class_id = ? ";
            $params = [$request->std_id,$orgId,$request->aca_assmt_term_id,$request->org_class_id];
            if($request->org_stream_id){
                $query.= ' AND t1.org_stream_id = ?';
                array_push($params, $request->org_stream_id);
            }
            if($request->org_section_id){
            $query .= ' AND t1.org_section_id = ?';
                array_push($params, $request->org_section_id);
            }
            $absentee = DB::select($query,$params);
        return $this->successResponse($absentee);
    }
    public function saveStudentAssessment(Request $request,$userId){
        $rules = [
            'data.*.std_student_id' => 'required',
        ];
        $customMessages = [
            'data.*.std_student_id.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        try{
        DB::transaction(function() use($request,$userId) {
            $query= "DELETE FROM aca_student_assessment WHERE org_id = ? AND aca_assmt_term_id = ? AND org_class_id = ? AND aca_sub_id = ? ";
           $param = [$request['data'][0]['org_id'],$request['aca_assmt_term_id'],$request['org_class_id'],$request['aca_sub_id']];

            if($request['org_stream_id']){
                $query .= ' AND org_stream_id = ?';
                array_push($param, $request['org_stream_id']);
            }
            if($request['org_section_id']){
                $query .= ' AND org_section_id = ?';
                array_push($param, $request['org_section_id']);
            }
            // $this->updateStudentAssessment($request,$userId);
            DB::delete($query,$param);

            $result = [
                'org_id' => $request['data'][0]['org_id'],
                'org_class_id' => $request['org_class_id'],
                'org_stream_id'  =>  $request['org_stream_id'],
                'org_section_id'=> $request['org_section_id'],
                'aca_sub_id'=>$request['aca_sub_id'],
                'aca_assmt_term_id' =>  $request['aca_assmt_term_id'],
                'class_stream_section' =>  $request['class_stream_section'],
                'created_by' =>  $userId,
                'created_at'=>   date('Y-m-d h:i:s'),
            ];
            if($request['finalize']){
                $result['finalized'] = 1;
                $result['finalized_date'] = date('Y-m-d h:i:s');
            }
            $studentAssessment = StudentAssessment::create($result);
            foreach($request['data'] as $studentAssessmentDetail){
                foreach($studentAssessmentDetail as $value){
                    if(gettype($value)=="array"){
                        $data = [
                            'aca_student_assmt_id' => $studentAssessment->id,
                            'std_student_id' => $studentAssessmentDetail['std_student_id'],
                            'aca_assmt_area_id'=>$value['aca_assmt_area_id'],
                            'aca_rating_type_id'=>$value['aca_rating_type_id'],
                            'created_by' => $userId,
                            'created_at' => date('Y-m-d h:i:s')
                        ];
                        if(array_key_exists("descriptive_score", $value)){
                            $data['descriptive_score'] = $value['descriptive_score'];
                        }else if(array_key_exists("score", $value)){
                            $data['score'] = $value['score'];
                        }
                        StudentAssessmentDetail::create($data);
                    }
                }
            }
        });
    }catch(Exception $e){
        dd($e);
    }
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    private function updateStudentAssessment($request,$userId){
        foreach($request['data'] as $studentAssessmentDetail){
            foreach($studentAssessmentDetail as $value){
                if(gettype($value)=="array"){
                    $data = [
                        'org_id' => $request['data'][0]['org_id'],
                        'org_class_id' => $request['org_class_id'],
                        'org_stream_id'  =>  $request['org_stream_id'],
                        'org_section_id'=> $request['org_section_id'],
                        'aca_sub_id'=>$request['aca_sub_id'],
                        'aca_assmt_term_id' =>  $request['aca_assmt_term_id'],
                        'class_stream_section' =>  $request['class_stream_section'],
                        'std_student_id' => $studentAssessmentDetail['std_student_id'],
                        'aca_assmt_area_id'=>$value['aca_assmt_area_id'],
                        'aca_rating_type_id'=>$value['aca_rating_type_id'],
                        'recorded_for'=> 'Student Assessment Changes',
                        'created_by' => $userId,
                        'created_at' => date('Y-m-d h:i:s')
                    ];
                    if($request['finalize']){
                        $result['finalized'] = 1;
                        $result['finalized_date'] = date('Y-m-d h:i:s');
                    }
                    if(array_key_exists("descriptive_score", $value)){
                        $data['descriptive_score'] = $value['descriptive_score'];
                    }else if(array_key_exists("score", $value)){
                        $data['score'] = $value['score'];
                    }
                    StudentAssessmentHistory::create($data);
                }
            }
        }
    }
    public function unlockForEdit($Id){
     DB::update('UPDATE aca_student_assessment SET finalized = 0, finalized_date = NULL WHERE id = ?', [$Id]);
       return $this->successResponse(1, Response::HTTP_CREATED);
    }
    public function loadConsolidatedResultList(Request $request,$staffId, $orgId){
        $termResultCondition = "";
        $finalResultCondition = "";
        $termResultParams = [$staffId, $orgId, $orgId, $staffId,$request->org_class_id];
        $finalResultParams = [$staffId, $orgId, $orgId, $orgId, $request->org_class_id];
        $extraParams = [];
        if($request->org_stream_id !== null){
            $termResultCondition = " AND t1.org_stream_id = ?";
            $finalResultCondition = " AND t1.org_stream_id = ?";
            array_push($extraParams,$request->org_stream_id);
        }
        if($request->org_section_id !== null){
            $termResultCondition .= " AND t1.org_section_id = ?";
            $finalResultCondition .= " AND t2.org_section_id = ?";
            array_push($extraParams,$request->org_section_id);

        }
        $termResult = "SELECT t5.id AS aca_result_consolidated_id,(t4.stf_staff_id=?) AS is_class_teacher,
                        t1.org_class_id,t1.org_stream_id,t1.org_section_id,t2.aca_assmt_term_id,t3.name AS term,
                        IF(COUNT(IF(t2.finalized,1,NULL))>=t1.no_of_subjects,1,0) AS subject_teachers_finalized,
                        DATE_FORMAT(MAX(t2.finalized_date),'%d-%m-%Y %H:%i %p') AS subject_teachers_finalized_date,
                        IF(t5.finalized,1,0) AS class_teacher_finalized,
                        DATE_FORMAT(t5.finalized_date,'%d-%m-%Y %H:%i %p') AS class_teacher_finalized_date,
                        t5.published,DATE_FORMAT(t5.published_date,'%d-%m-%Y %H:%i %p') AS published_date
            FROM (SELECT org_id,org_class_id,org_stream_id,org_section_id,COUNT(aca_sub_id) AS no_of_subjects FROM aca_class_subject_teacher 
                WHERE org_id = ? GROUP BY org_id,org_class_id,org_stream_id,org_section_id) t1
                JOIN aca_student_assessment t2 ON t1.org_id = t2.org_id AND t1.org_class_id = t2.org_class_id AND (t1.org_stream_id = t2.org_stream_id OR (t1.org_stream_id IS NULL 
                    AND t2.org_stream_id IS NULL)) AND (t1.org_section_id = t2.org_section_id OR (t1.org_section_id IS NULL AND t2.org_section_id IS NULL)) AND t1.org_id = ?
                JOIN aca_assessment_term t3 ON t2.aca_assmt_term_id = t3.id
                LEFT JOIN aca_class_teacher t4 ON t1.org_id = t4.org_id AND t1.org_class_id = t4.org_class_id AND (t1.org_stream_id = t4.org_stream_id OR (t1.org_stream_id IS NULL AND t4.org_stream_id IS NULL)) AND (t1.org_section_id = t4.org_section_id OR (t1.org_section_id IS NULL AND t4.org_section_id IS NULL)) AND t4.stf_staff_id = ?
                LEFT JOIN aca_result_consolidated t5 ON t1.org_id = t5.org_id AND t1.org_class_id = t5.org_class_id AND (t1.org_stream_id = t5.org_stream_id OR (t1.org_stream_id IS NULL AND t5.org_stream_id IS NULL)) AND (t1.org_section_id = t5.org_section_id OR (t1.org_section_id IS NULL AND t5.org_section_id IS NULL)) AND t2.aca_assmt_term_id= t5.aca_assmt_term_id
                WHERE t1.org_class_id = ? $termResultCondition
            GROUP BY t5.id,t4.stf_staff_id,t1.org_class_id,t1.org_stream_id,t1.org_section_id,t2.aca_assmt_term_id,t3.name,t5.published,t5.published_date,t1.no_of_subjects,t5.finalized,t5.finalized_date";

        $finalResult = "SELECT t4.id AS aca_result_consolidated_id,(t3.stf_staff_id=?) AS is_class_teacher,t1.org_class_id,t1.org_stream_id,t2.org_section_id,NULL AS aca_assmt_term_id,'Final Result' AS term,1 AS subject_teachers_finalized,t4.finalized AS class_teacher_finalized,NULL AS subject_teachers_finalized_date,DATE_FORMAT(t4.finalized_date,'%d-%m-%Y %H:%i %p') AS subject_teachers_finalized_date,t4.published, DATE_FORMAT(t4.published_date,'%d-%m-%Y %H:%i %p') AS published_date
            FROM (SELECT aa.org_class_id,aa.org_stream_id,COUNT(bb.id) AS no_of_terms FROM aca_class_assessment_frequency aa JOIN aca_assessment_term bb ON aa.aca_assmt_frequency_id = bb.aca_assmt_frequency_id GROUP BY aa.org_class_id,aa.org_stream_id) t1
                LEFT JOIN (SELECT org_class_id,org_stream_id,org_section_id,COUNT(id) AS no_of_terms_finalized FROM aca_result_consolidated WHERE finalized=1 AND org_id = ? GROUP BY org_class_id,org_stream_id,org_section_id) t2 ON t1.org_class_id = t2.org_class_id AND (t1.org_stream_id = t2.org_stream_id OR (t1.org_stream_id IS NULL AND t2.org_stream_id IS NULL))
                LEFT JOIN aca_class_teacher t3 ON t1.org_class_id = t3.org_class_id AND (t1.org_stream_id = t3.org_stream_id OR (t1.org_stream_id IS NULL AND t3.org_stream_id IS NULL)) AND (t2.org_class_id IS NULL OR (t2.org_section_id = t3.org_section_id OR (t2.org_section_id IS NULL AND t3.org_section_id IS NULL))) AND t3.org_id = ?
                LEFT JOIN aca_result_consolidated t4 ON t1.org_class_id = t4.org_class_id AND (t1.org_stream_id = t4.org_stream_id OR (t1.org_stream_id IS NULL AND t4.org_stream_id IS NULL)) AND (t2.org_class_id IS NULL OR (t2.org_section_id = t4.org_section_id OR (t2.org_section_id IS NULL AND t4.org_section_id IS NULL))) AND t4.aca_assmt_term_id IS NULL AND t4.org_id = ?
            WHERE (t4.id IS NOT NULL OR t2.no_of_terms_finalized >= t1.no_of_terms) AND t1.org_class_id = ? $finalResultCondition";

      try{  $result_consolidated = DB::select("$termResult UNION $finalResult", array_merge($termResultParams, $extraParams, $finalResultParams, $extraParams));}catch(Exception $e){
          dd($e);
      }
        return $this->successResponse ($result_consolidated);
    }

    public function loadConsolidatedResult($orgId,Request $request){
    try{   
        // $ratings = null;
        $areaFormat = DB::table("aca_setting")->where("id",1)->value("value");
        
        $condition = "";
        $param = [$orgId,$request->org_class_id];
        // $params1 = [];
        if($request->org_stream_id){
            $condition .= ' AND t1.org_stream_id = ?';
            array_push($param, $request->org_stream_id);
        }
        if($request->org_section_id){
            $condition .= ' AND t1.org_section_id = ?';
            array_push($param, $request->org_section_id);
        }
        if($request->aca_assmt_term_id){
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
                IF(t4.input_type=2,t2.descriptive_score,
                IFNULL(t3.name,NULLIF(TRIM(t2.score)+0,0))) AS score,
                t2.remarks
            FROM (aca_student_assessment t1 JOIN aca_assessment_term t11 ON t1.aca_assmt_term_id = t11.id JOIN aca_subject t12 ON t1.aca_sub_id=t12.id)
                JOIN (aca_student_assessment_detail t2 JOIN aca_assessment_area t21 ON t2.aca_assmt_area_id = t21.id) ON t1.id=t2.aca_student_assmt_id
                JOIN aca_class_subject_assessment t13 ON t1.aca_assmt_term_id=t13.aca_assmt_term_id AND t1.aca_sub_id=t13.aca_sub_id
                    AND t2.aca_assmt_area_id=t13.aca_assmt_area_id
                    AND t1.org_class_id = t13.org_class_id AND (t1.org_stream_id = t13.org_stream_id OR (t1.org_stream_id IS NULL AND t13.org_stream_id IS NULL))
                JOIN aca_rating_type t4 ON t2.aca_rating_type_id=t4.id
                LEFT JOIN aca_rating t3 ON t2.aca_rating_type_id = t3.aca_rating_type_id AND IFNULL((TRIM(t2.score)+0),0) = t3.score
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
            WHERE t1.org_id = ? AND t1.org_class_id = ? $condition AND t2.id = ? GROUP BY t2.id",$param);

            $absent_days = DB::select("SELECT t2.id AS aca_assmt_term_id,t3.std_student_id,COUNT(t3.id) AS absent_days
            FROM aca_student_attendance t1
            JOIN aca_student_attendance_detail t3 ON t1.id = t3.aca_std_attendance_id
                JOIN aca_assessment_term t2 ON t1.attendance_date BETWEEN CONCAT(YEAR(CURDATE()),'-',LPAD(t2.from_month,2,'0'),'-',LPAD(t2.from_date,2,'0')) 
                    AND CONCAT(YEAR(CURDATE()),'-',LPAD(t2.to_month,2,'0'),'-',LPAD(t2.to_date,2,'0')) 
            WHERE t1.org_id = ? AND t1.org_class_id = ? $condition AND t2.id = ? GROUP BY t2.id, t3.std_student_id",$param);

            $instructional_days_special_case = $this->specialInstructionalDays($orgId,$request->org_class_id,$request->org_stream_id,$request->org_section_id,$request->aca_assmt_term_id);
            // $params1 = $param;
        }else{
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
					 t2.remarks
				 FROM (aca_student_assessment t1 JOIN aca_subject t12 ON t1.aca_sub_id=t12.id)
					 JOIN (aca_student_assessment_detail t2 JOIN aca_assessment_area t21 ON t2.aca_assmt_area_id = t21.id) ON t1.id=t2.aca_student_assmt_id
					 JOIN aca_class_subject_assessment t13 ON t1.aca_assmt_term_id=t13.aca_assmt_term_id AND t1.aca_sub_id=t13.aca_sub_id AND t2.aca_assmt_area_id=t13.aca_assmt_area_id AND t1.org_class_id = t13.org_class_id AND (t1.org_stream_id = t13.org_stream_id OR (t1.org_stream_id is null AND t13.org_stream_id IS NULL))
					 JOIN aca_rating_type t4 ON t2.aca_rating_type_id=t4.id
					 LEFT JOIN aca_rating t3 ON t2.aca_rating_type_id = t3.aca_rating_type_id AND IFNULL((TRIM(t2.score)+0),0) = t3.score
				 WHERE t1.org_id = ? AND t1.org_class_id = ?";

            $query = "$queryFinalResult $condition GROUP BY t12.display_order,
					IFNULL(t13.display_order,t21.display_order),
					t2.std_student_id,t1.aca_sub_id, t2.aca_assmt_area_id,
					t2.aca_rating_type_id,t12.dzo_name,t21.dzo_name,t12.name,IF($areaFormat=2,t21.name,IFNULL(t21.code,t21.name)),
					IF($areaFormat=2,'',t21.name),t4.input_type,t2.remarks";

            $studentRank = DB::select("SELECT t2.std_student_id,'final-result' AS aca_assmt_term_id,RANK() OVER (ORDER BY SUM(if(t4.input_type=1,t2.score,0)) DESC) AS rank,t6.remarks
                FROM aca_student_assessment t1 JOIN aca_student_assessment_detail t2 ON t1.id=t2.aca_student_assmt_id
                JOIN aca_rating_type t4 ON t2.aca_rating_type_id=t4.id
                LEFT JOIN (aca_result_consolidated t5 
                JOIN aca_result_consolidated_detail t6 ON t5.id=t6.aca_result_consolidated_id) ON t2.std_student_id=t6.std_student_id AND t5.aca_assmt_term_id IS NULL
                WHERE t1.org_id = ? AND t1.org_class_id = ? $condition
                GROUP BY t2.std_student_id,t6.remarks", $param);

            $instructional_days = DB::select("SELECT 'final-result' AS aca_assmt_term_id, COUNT(t1.id) AS instructional_days
                FROM aca_student_attendance t1
                WHERE t1.org_id = ? AND t1.org_class_id = ? $condition",$param);

            $absent_days = DB::select("SELECT 'final-result' AS aca_assmt_term_id,t3.std_student_id,COUNT(t3.id) AS absent_days
                FROM aca_student_attendance t1
                    JOIN aca_student_attendance_detail t3 ON t1.id = t3.aca_std_attendance_id
                WHERE t1.org_id = ? AND t1.org_class_id = ? $condition GROUP BY t3.std_student_id",$param);

            $instructional_days_special_case = $this->specialInstructionalDays($orgId,$request->org_class_id,$request->org_stream_id,$request->org_section_id);

                    // $ratings = DB::select('SELECT aca_rating_type_id, name, score FROM aca_rating WHERE status=1 ORDER BY score');
        }
      try{
            $consolidatedResult = DB::select("$query ORDER BY term_display_order,subject_display_order,area_display_order", $param);
      }catch(Exception $e){
          dd($e);
      }
        
                if($areaFormat==2){
                    $abbreviations = [];
                }else{
                    $abbreviations = $this->getAssessmentAreaCode();
                }
                $pass_fail = null;
                if(!($request->aca_assmt_term_id)){
                    $pass_fail_query= "SELECT t0.std_student_id, MIN(t0.passed) AS passed
                        FROM (
                            SELECT t1.std_student_id,t1.aca_promotion_sub_group_id,SUM(t1.passed)>=IF(t1.aca_promotion_sub_group_id=0,COUNT(t1.aca_sub_id),t1.aca_promotion_sub_group_id) as passed
                            FROM (
                                SELECT t4.std_student_id,t6.aca_sub_id,t8.aca_promotion_sub_group_id,IF(t7.input_type=1,(SUM(IF(t5.aca_assmnt_type=0,t4.score,0))/SUM(IF(t5.aca_assmnt_type=0,t51.weightage,0)))*100>=t6.pass_score AND (SUM(IF(t5.aca_assmnt_type=1,t4.score,0))/SUM(IF(t5.aca_assmnt_type=1,t51.weightage,0)))*100>=t6.pass_score,ROUND(AVG(t4.score))>=t6.pass_score) AS passed
                                FROM (aca_student_assessment t3 
                                    JOIN aca_student_assessment_detail t4 ON t3.id = t4.aca_student_assmt_id 
                                    JOIN aca_assessment_area t5 ON t4.aca_assmt_area_id=t5.id)
                                    JOIN (SELECT aca_assmt_area_id,SUM(weightage) AS weightage  FROM aca_class_subject_assessment WHERE org_class_id = ? AND (org_stream_id IS NULL OR org_stream_id = ?) GROUP BY aca_assmt_area_id) t51 ON t5.id = t51.aca_assmt_area_id
                                    JOIN aca_class_subject t6 ON t5.aca_sub_id = t6.aca_sub_id AND t3.org_class_id = t6.org_class_id AND (t3.org_stream_id = t6.org_stream_id OR (t3.org_stream_id is null AND t6.org_stream_id IS NULL))
                                    JOIN aca_rating_type t7 ON t6.aca_rating_type_id=t7.id
                                    JOIN aca_promotion_rule t8 ON t5.aca_sub_id = t8.aca_sub_id AND t3.org_class_id = t8.org_class_id AND (t3.org_stream_id = t8.org_stream_id OR (t3.org_stream_id is null AND t8.org_stream_id IS NULL))
                                WHERE t3.org_id = ? AND t6.org_class_id = ?
                                GROUP BY t4.std_student_id,t6.aca_sub_id,t8.aca_promotion_sub_group_id,t7.input_type,t6.pass_score
                            ) t1
                            GROUP BY t1.std_student_id,t1.aca_promotion_sub_group_id
                        ) t0
                        GROUP BY t0.std_student_id";

                    $pass_fail_param = [$request->org_class_id,$request->org_stream_id,$orgId,$request->org_class_id];
                    if($request->org_stream_id){
                        $pass_fail_query .= ' AND t6.org_stream_id = ?';
                        array_push($pass_fail_param, $request->org_stream_id);
                    }
                    $pass_fail = DB::select($pass_fail_query,$pass_fail_param);
                }

                return $this->successResponse(["consolidatedResult"=>$consolidatedResult,"studentRank"=> $studentRank,"passFail"=>$pass_fail,"instructionalDaysForSpecialCase"=> $instructional_days_special_case, "instructionalDays"=>$instructional_days,"absentDays"=>$absent_days,'abbreviations'=>$abbreviations]);
            }catch(Exception $e){
                dd($e);
            }

    }
    public function saveConsolidatedResut(Request $request){
        try{

        DB::transaction(function() use($request) {
           $query= "DELETE FROM aca_result_consolidated WHERE org_id = ? AND org_class_id = ?";
           $param = [$request['org_id'],$request['org_class_id']];

            if($request['org_stream_id']){
                $query .= ' AND org_stream_id = ?';
                array_push($param, $request['org_stream_id']);
            }
            if($request['org_section_id']){
                $query .= ' AND org_section_id = ?';
                array_push($param, $request['org_section_id']);
            }
            if($request['aca_assmt_term_id']){
                $query .= ' AND aca_assmt_term_id = ?';
                array_push($param, $request['aca_assmt_term_id']);
            }
            // dd($query,$param);
            // $this->updateConsolidatedResut($request);
            DB::delete($query,$param);

          $result = [
                'org_id' => $request['org_id'],
                'class_stream_section' => $request['class_stream_section'],
                'org_class_id' => $request['org_class_id'],
                'org_stream_id'  =>  $request['org_stream_id'],
                'org_section_id'=> $request['org_section_id'],
                'aca_assmt_term_id' =>  $request['aca_assmt_term_id'],
                'created_by' =>  $request['user_id'],
                'created_at'=>   date('Y-m-d h:i:s'),
            ];

            if($request['finalize']){
                $result['finalized'] = 1;
                $result['finalized_date'] = date('Y-m-d h:i:s');
            }
            if($request['publish']){
                $result['publish'] = 1;
                $result['published_date'] = date('Y-m-d h:i:s');
            }
            $resultConsolidated = ResultConsolidated::create($result);
            if($request['remarks']){
                foreach($request['remarks'] as $key=>$value){
                    ResultConsolidatedDetail::create(
                    ['aca_result_consolidated_id' => $resultConsolidated->id,
                    'std_student_id' => $key,
                    // 'result'=>$request['result'][$key],
                    'remarks'=>$value,
                    'created_by' => $request['user_id'],
                    'created_at' => date('Y-m-d h:i:s')]
                    );
                }
            }
        });
    }catch(Exception $e){
        dd($e);
    }
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    public function loadClassBySubjectTeacher($orgId,$staffId) {
      return $this->successResponse(
          DB::select('SELECT DISTINCT org_class_id, org_stream_id, org_section_id 
                FROM aca_class_subject_teacher WHERE org_id = ? AND stf_staff_id = ? ',[$orgId,$staffId])
            );
    }
    public function getTermsByFrequency($frequencyId){
        return $this->successResponse(
            DB::select('SELECT id,name,dzo_name FROM aca_assessment_term WHERE aca_assmt_frequency_id = ?',[$frequencyId]));
    }
    public function unlockForEditForConsolidated($Id){
       $unlockForConsolidated = DB::update('UPDATE aca_result_consolidated SET finalized = 0, finalized_date = NULL WHERE aca_assmt_term_id = ?', [$Id]);
       return $this->successResponse($unlockForConsolidated, Response::HTTP_CREATED);
    }
    private function updateConsolidatedResut($request){
        foreach($request['data'] as $resultConsolidatedDetail){
            $data = [
                'org_id' => $request['org_id'],
                'org_class_id' => $request['org_class_id'],
                'org_stream_id'  =>  $request['org_stream_id'],
                'org_section_id'=> $request['org_section_id'],
                'aca_assmt_term_id' =>  $request['aca_assmt_term_id'],
                'std_student_id' => $resultConsolidatedDetail['std_student_id'],
                'result'=>$resultConsolidatedDetail['result'],
                'recorded_for'=> 'Student Assessment Changes',
                'created_by' =>  $request['user_id'],
                'created_at'=>   date('Y-m-d h:i:s'),
            ];
            if($request['finalize']){
                $data['finalized'] = 1;
                $data['finalized_date'] = date('Y-m-d h:i:s');
            }
            if($request['publish']){
                $data['publish'] = 1;
                $data['published_date'] = date('Y-m-d h:i:s');
            }
            ResultConsolidatedDetail::create($data);
        }
    }
    private function getAssessmentAreaCode(){
       $code = DB::select('SELECT DISTINCT name,code,dzo_name FROM aca_assessment_area ORDER BY code');
        return $code;
    }
    private function specialInstructionalDays($orgId,$classId,$streamId,$sectionId,$termId=""){
        $condition ="";
        $param = [$orgId,$classId];

        if($streamId){
            $condition .=" AND org_stream_id = ?";
            array_push($param,$streamId);
        }
        if($sectionId){
            $condition .=" AND org_section_id = ?";
            array_push($param,$sectionId);
        }
        if($termId){
            array_push($param,$termId);
            $query = "SELECT std_student_id,aca_assmt_term_id,MAX(instructional_days) AS instructional_days
                        FROM aca_instructional_days_special_case 
                    WHERE org_id = ? AND org_class_id = ? $condition AND aca_assmt_term_id = ? GROUP BY std_student_id,aca_assmt_term_id";
            return DB::select($query, $param);
        }else{
            $instructional_days = DB::select("SELECT t2.id AS aca_assmt_term_id, COUNT(t1.id) AS instructional_days
            FROM aca_student_attendance t1
                JOIN aca_class_assessment_frequency t3 ON t1.org_class_id=t3.org_class_id AND (t1.org_stream_id=t3.org_stream_id OR (t1.org_stream_id IS NULL AND t3.org_stream_id IS NULL))
                JOIN aca_assessment_term t2 ON t3.aca_assmt_frequency_id=t2.aca_assmt_frequency_id AND t1.attendance_date BETWEEN CONCAT(YEAR(CURDATE()),'-',LPAD(t2.from_month,2,'0'),'-',LPAD(t2.from_date,2,'0')) 
                        AND CONCAT(YEAR(CURDATE()),'-',LPAD(t2.to_month,2,'0'),'-',LPAD(t2.to_date,2,'0')) 
            WHERE t1.org_id = ? AND t1.org_class_id = ? $condition GROUP BY t2.id",$param);

            $instructional_days_special = DB::select("SELECT std_student_id,aca_assmt_term_id,MAX(instructional_days) AS instructional_days
                        FROM aca_instructional_days_special_case 
                    WHERE org_id = ? AND org_class_id = ? $condition GROUP BY std_student_id,aca_assmt_term_id", $param);
//   dd($instructional_days,$instructional_days_special);
            $instructional_days_final = [];
            foreach($instructional_days_special as $instructional_day_special){
                if(!array_key_exists($instructional_day_special->std_student_id,$instructional_days_final)){
                    $instructional_days_final[$instructional_day_special->std_student_id] = 0;
                }
                foreach($instructional_days as $instructional_day){
                    if($instructional_day->aca_assmt_term_id == $instructional_day_special->aca_assmt_term_id){
                        $instructional_days_final[$instructional_day_special->std_student_id] += $instructional_day_special->instructional_days;
                    }else{
                        $instructional_days_final[$instructional_day_special->std_student_id] += $instructional_day->instructional_days;
                    }
                }
            }
            $instructional_days_1 = [];
            foreach($instructional_days_final as $key=>$value){
                array_push($instructional_days_1, ["std_student_id"=>$key, "aca_assmt_term_id"=>"final-result", "instructional_days"=>$value]); 
            }
            return $instructional_days_1;
        }
    }
    public function getResult($std_student_id){
        $result = DB::select('SELECT result,remarks  FROM aca_result_consolidated_detail WHERE std_student_id = ?',[$std_student_id]);
        return $this->successResponse($result);
    }
    public function getSubjectByClass($class_id,$stream_id=""){
        $query = 'SELECT t1.id AS aca_sub_id,t1.aca_sub_category_id, t1.name AS subject,t1.dzo_name AS sub_dzo_name FROM aca_subject t1 JOIN aca_class_subject t2 ON t1.id=t2.aca_sub_id AND t2.org_class_id = ?' ;
        $params = [$class_id];
        if($stream_id){
          $query .= ' AND t2.org_stream_id = ?';
          array_push($params,$stream_id);
        }  
        return $this->successResponse (DB::select("$query", $params)); 
    }
    public function getSubjectTeacherBySubId($aca_sub_id){
        return $this->successResponse(DB::select('SELECT aca_sub_id,stf_staff_id FROM aca_class_subject_teacher WHERE aca_sub_id = ? GROUP BY aca_sub_id,stf_staff_id ',[$aca_sub_id]));
    }
    public function saveRemedialClass(Request $request){
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
    $params =[$request['org_class_id']];
    if($request['org_stream_id']){
        $query .= ' AND org_stream_id = ?';
        array_push($params,$request['org_stream_id']);
    } 
    if($request['org_section_id']){
        $query .= ' AND org_section_id = ?';
        array_push($params,$request['org_section_id']);
    } 
    DB::transaction(function() use($request, $query, $params) {
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
            'created_at'=>   date('Y-m-d h:i:s'),
        ];
        $RemedialClass = RemedialClass::create($parent);
        foreach($request['data']['std_student_id'] as $key => $value){
            $child = [
                'aca_remedial_class_id' => $RemedialClass->id,
                'std_student_id' => $value,
                'created_by' => $request['user_id'],
                'created_at'=>   date('Y-m-d h:i:s'),
            ];
            RemedialClassDetail::create($child);
        }
   
    });
    return $this->successResponse(1, Response::HTTP_CREATED);
    }
    public function getSubCategNonAcademic(){
        $sub_categ_non_academic = env('SUB_CATEG_NON_ACADEMIC');
        return $this->successResponse(DB::select('SELECT t2.name,t2.description FROM aca_rating_type t1 JOIN aca_rating t2 ON t1.id = t2.aca_rating_type_id WHERE t1.aca_sub_category_id = ?',[$sub_categ_non_academic]));
    }
    public function getRemedialClass($orgId){
        return $this->successResponse(DB::select('SELECT t1.id,t1.org_class_id,t1.org_stream_id,t1.org_section_id,t1.aca_sub_id,t1.stf_staff_id,t1.from_date,t1.to_date,t1.total_no_of_hours,t1.time,t2.name AS subject 
            FROM aca_remedial_classes t1 
                JOIN aca_subject t2 ON t1.aca_sub_id = t2.id WHERE t1.org_id = ?',[$orgId])
            );
    }
    public function getRemedialClassDetail($orgId,$Id){
       try{ return $this->successResponse(DB::select('SELECT t1.aca_remedial_class_id,t1.std_student_id FROM aca_remedial_classes_detail t1 JOIN aca_remedial_classes t2 ON t1.aca_remedial_class_id = t2.id  WHERE t2.org_id = ? AND t1.aca_remedial_class_id = ? ',[$orgId,$Id]));
       }catch(Exception $e){
           dd($e);
       }
    }
}
