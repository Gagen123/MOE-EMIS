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
use App\Models\academics\SubjectTeacher;
use App\Models\academics\StudentAssessment;
use App\Models\academics\ResultConsolidated;
use App\Models\academics\StudentElectiveSubject;
use App\Models\academics\StudentAssessmentDetail;
use App\Models\academics\ResultConsolidatedDetail;
use App\Models\academics\StudentAttendance;
use App\Models\academics\StudentAttendanceDetail;



class AcademicController extends Controller
{
    use ApiResponser;

    public $audit_table="system_admin";

    public $database="academic_db";

    public function getClassTeacher($orgId){
        return $this->successResponse (DB::select('SELECT org_id,org_class_id, org_stream_id, org_section_id, stf_staff_id FROM aca_class_teacher WHERE org_id = ?', [$orgId]));
    }
    public function getClassTeacherClasss($orgId,$staffId){
        return $this->successResponse (DB::select('SELECT org_id,org_class_id, org_stream_id, org_section_id, stf_staff_id,class_stream_section FROM aca_class_teacher WHERE org_id = ? AND stf_staff_id = ?', [$orgId,$staffId]));
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
    public function saveSubjectTeacher(Request $request){
        DB::transaction(function() use($request) {
            $query = 'DELETE FROM aca_class_subject_teacher WHERE org_id = ?';
            DB::delete($query, [$request['data'][0]['org_id']]);
            foreach($request['data'] as $subjectTeacher){
                if(array_key_exists("stf_staff_id", $subjectTeacher) && array_key_exists("aca_sub_id", $subjectTeacher) && $subjectTeacher["stf_staff_id"] && $subjectTeacher["aca_sub_id"]){
                    $subjectTeacher['created_by'] =  $request['user_id'];
                    $subjectTeacher['created_at'] =   date('Y-m-d h:i:s');

                    SubjectTeacher::create($subjectTeacher);
                }
            }
    
        });
        return $this->successResponse(1, Response::HTTP_CREATED);
       
    }
    public function getSubjectTeacher($orgId){
        $classSubjects = DB::select('SELECT t1.org_class_id, t1.org_stream_id, t1.aca_sub_id,t2.name, t2.dzo_name FROM aca_class_subject t1 JOIN aca_subject t2 ON t1.aca_sub_id = t2.id WHERE t2.assessed_by_class_teacher<>1');
        $classSubjectTeachers = DB::select('SELECT org_id, stf_staff_id, org_class_id, org_stream_id,org_section_id, aca_sub_id FROM aca_class_subject_teacher WHERE org_id = ?',[$orgId]);
        return $this->successResponse(["classSubjects"=>$classSubjects, "classSubjectTeachers"=>$classSubjectTeachers]);
    }
    public function getStudentElectiveSubjects(){
        return $this->successResponse(
            DB::select('SELECT std_student_id, aca_sub_id FROM aca_student_elective_subject')
        ); 
    }   
    public function getElectiveSubjects($classId, $streamId=""){
        $query = 'SELECT t1.aca_sub_id,t2.name AS subject, t2.dzo_name FROM aca_class_subject t1 JOIN aca_subject t2 ON t1.aca_sub_id = t2.id WHERE t1.is_elective = 1 AND t1.org_class_id = ?';
        $params = [$classId];
        if($streamId){
          $query .= ' AND t1.org_stream_id = ?';
          array_push($params,$streamId);
        }  

        return $this->successResponse (DB::select($query, $params)); 
    }
    public function saveStudentElectiveSubject(Request $request){
        $rules = [
            'data.*.std_student_id' => 'required'
        ];
        $customMessages = [
            'data.*.std_student_id.required' => 'This field is required'
        ];
        $this->validate($request, $rules, $customMessages);
        DB::transaction(function() use($request) {
            foreach($request['data'] as $electiveSubject){
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
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    private function saveAttendance($request){
        try{
        DB::transaction(function() use($request) {
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
            foreach($request["data"] as $studentAttendance){
                if($studentAttendance['is_present']=="0"){
                    StudentAttendanceDetail::create(
                        ['aca_std_attendance_id' => $stdAttendance->id,
                        'std_student_id' => $studentAttendance['std_student_id'],
                        'created_by' => $request['user_id'],
                        'created_at' => date('Y-m-d h:i:s')]
                    );
                }
            }
        });
    }catch(Exception $e){
        dd($e);
    }
    }
    public function saveStudentAttendance(Request $request){
        $rules = [
            'org_class_id' => 'required',
            'class_stream_section' => 'required',
            'attendance_date' => 'required|unique:aca_student_attendance,attendance_date,'. null .',id,class_stream_section,'. $request['class_stream_section'],
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

            if($request['action']=="add"){
                $this->saveAttendance($request->all());
            }
            if($request['action']=="edit"){
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
                DB::delete($query, $params);
                $this->saveAttendance($request->all());
            }
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    public function loadStudentAssessmentList($staffId, $orgId){
        $currentTerms = "SELECT SUBSTRING(MIN(CONCAT(LPAD(x2.display_order,5,'0'),x1.org_class_id)),6) AS org_class_id,
                SUBSTRING(MIN(CONCAT(LPAD(x2.display_order,5,'0'),x1.org_stream_id)),6) AS org_stream_id,
                SUBSTRING(MIN(CONCAT(LPAD(x2.display_order,5,'0'),x2.id)),6) AS aca_assmt_term_id,
                SUBSTRING(MIN(CONCAT(LPAD(x2.display_order,5,'0'),x2.name)),6) AS term_name
            FROM aca_class_assessment_frequency x1 JOIN aca_assessment_term x2 ON x1.aca_assmt_frequency_id=x2.aca_assmt_frequency_id
            where x2.id NOT IN (SELECT aa.aca_assmt_term_id FROM aca_result_consolidated aa WHERE aa.finalized=1 AND aa.org_id = ?)
            GROUP BY x1.org_class_id,x1.org_stream_id";

        $classTeacherSubjects = "SELECT t2.assessed_by_class_teacher,t6.id AS std_assmt_id,
                t1.org_class_id,
                t1.org_stream_id,
                t1.org_section_id,
                t1.aca_sub_id,
                t3.aca_assmt_term_id,
                t2.name AS sub_name,
                t3.term_name,
                (t4.id IS NOT NULL) AS is_class_teacher,
                (t1.stf_staff_id = ? OR (t4.id IS NOT NULL AND t2.assessed_by_class_teacher=1)) AS is_subject_teacher,
                t6.finalized,
                DATE_FORMAT(t6.finalized_date,'%d-%m-%Y %H:%i %p') AS finalized_date
            FROM aca_class_subject_teacher t1 JOIN aca_subject t2 ON t1.aca_sub_id = t2.id AND t1.org_id = ?
                JOIN ($currentTerms) t3 ON t1.org_class_id = t3.org_class_id AND (t1.org_stream_id = t3.org_stream_id OR (t1.org_stream_id IS NULL AND t3.org_stream_id IS NULL))
                LEFT JOIN aca_class_teacher t4 ON t1.org_class_id = t4.org_class_id AND (t1.org_stream_id = t4.org_stream_id OR (t1.org_stream_id IS NULL AND t4.org_stream_id IS NULL)) AND (t1.org_section_id = t4.org_section_id OR (t1.org_section_id IS NULL AND t4.org_section_id IS NULL)) AND IFNULL(t4.stf_staff_id,'') = ?
                LEFT JOIN aca_student_assessment t6 ON t1.org_class_id = t6.org_class_id AND (t1.org_stream_id = t6.org_stream_id OR (t1.org_stream_id IS NULL AND t6.org_stream_id IS NULL)) AND (t1.org_section_id = t6.org_section_id OR (t1.org_section_id IS NULL AND t6.org_section_id IS NULL)) AND t1.aca_sub_id = t6.aca_sub_id AND t6.org_id = ?
            WHERE t2.status = 1 AND (t1.stf_staff_id = ? OR IFNULL(t4.stf_staff_id,'') = ?)";

        return $this->successResponse(DB::select($classTeacherSubjects,[$staffId, $orgId, $orgId, $staffId, $orgId, $staffId, $staffId])); 
    }
 
    public function loadAssessmentAreas($term_id,$sub_id,$class_id, $stream_id=""){
        $query = "SELECT t1.aca_assmt_area_id, t2.name AS assessment_area, trim(t1.weightage)+0 AS weightage,IFNULL(t2.aca_rating_type_id,t3.aca_rating_type_id) AS aca_rating_type_id,t4.input_type, t1.display_order
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
        $query = "SELECT t1.id,t2.std_student_id, t2.aca_assmt_area_id, t2.aca_rating_type_id, IF(t4.input_type=2,t2.score,NULLIF(trim(t2.score)+0,0)) AS score, IF(t4.input_type=2,t2.score,IFNULL(t3.name,NULLIF(trim(t2.score)+0,0))) AS score_text, t2.remarks FROM aca_student_assessment t1 JOIN aca_student_assessment_detail t2 ON t1.id=t2.aca_student_assmt_id JOIN aca_rating_type t4 ON t2.aca_rating_type_id=t4.id LEFT JOIN aca_rating t3 ON t2.aca_rating_type_id = t3.aca_rating_type_id AND ifnull((trim(t2.score)+0),0) = t3.score WHERE t1.org_id = ? AND t1.aca_assmt_term_id =? AND t1.aca_sub_id =? AND t1.org_class_id = ? ";
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
        $query = "SELECT (t2.id IS NOT NULL) AS absent, t1.org_id,t1.org_class_id, t1.org_stream_id, t1.org_section_id,t1.attendance_date,t2.std_student_id
                        FROM aca_student_attendance t1 
                   LEFT JOIN aca_student_attendance_detail t2 ON t1.id = t2.aca_std_attendance_id WHERE t1.org_id = ? AND t1.org_class_id = ?";
        $params = [$orgId,$request->org_class_id];
        if($request->org_stream_id){
            $query .= ' AND t1.org_stream_id = ?';
            array_push($params, $request->org_stream_id);
        }
        if($request->org_section_id){
            $query .= ' AND t1.org_section_id = ?';
            array_push($params, $request->org_section_id);
        }
        return $this->successResponse(DB::select($query,$params));
    }
    public function saveStudentAssessment(Request $request){
        $rules = [
            'data.*.std_student_id' => 'required',
        ];
        $customMessages = [
            'data.*.std_student_id.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        DB::transaction(function() use($request) {
            $query= "DELETE FROM aca_student_assessment WHERE org_id = ? AND aca_assmt_term_id = ? AND org_class_id = ? AND aca_sub_id = ? ";
           $param = [$request['org_id'],$request['aca_assmt_term_id'],$request['org_class_id'],$request['aca_sub_id']];

            if($request['org_stream_id']){
                $query .= ' AND org_stream_id = ?';
                array_push($param, $request['org_stream_id']);
            }
            if($request['org_section_id']){
                $query .= ' AND org_section_id = ?';
                array_push($param, $request['org_section_id']);
            }
            DB::delete($query,$param);

            $result = [
                'org_id' => $request['org_id'],
                'org_class_id' => $request['org_class_id'],
                'org_stream_id'  =>  $request['org_stream_id'],
                'org_section_id'=> $request['org_section_id'],
                'aca_sub_id'=>$request['aca_sub_id'],
                'aca_assmt_term_id' =>  $request['aca_assmt_term_id'],
                'class_stream_section' =>  $request['class_stream_section'],
                'created_by' =>  $request['user_id'],
                'created_at'=>   date('Y-m-d h:i:s'),
            ];
            if($request['finalize']){
                $result['finalized'] = 1;
                $result['finalized_date'] = date('Y-m-d h:i:s');
            }
            try{
                $studentAssessment = StudentAssessment::create($result);
                foreach($request['data'] as $studentAssessmentDetail){
                    foreach($studentAssessmentDetail as $value){
                        if(gettype($value)=="array"){
                               StudentAssessmentDetail::create(
                               ['aca_student_assmt_id' => $studentAssessment->id,
                                'std_student_id' => $studentAssessmentDetail['std_student_id'],
                                'aca_assmt_area_id'=>$value['aca_assmt_area_id'],
                                'aca_rating_type_id'=>$value['aca_rating_type_id'],
                                'score'=> array_key_exists("score", $value) ? $value['score'] : 0,
                                'created_by' => $request['user_id'],
                                'created_at' => date('Y-m-d h:i:s')]
                            );
                        } 
                    }
                }
            }catch(Exception $e){
                dd($e);
            }
            // $studentAssessment = StudentAssessment::create($result);
            // foreach($request['data'] as $studentAssessmentDetail){
            //     foreach($studentAssessmentDetail as $value){
            //         if(gettype($value)=="array"){
            //                StudentAssessmentDetail::create(
            //                ['aca_student_assmt_id' => $studentAssessment->id,
            //                 'std_student_id' => $studentAssessmentDetail['std_student_id'],
            //                 'aca_assmt_area_id'=>$value['aca_assmt_area_id'],
            //                 'aca_rating_type_id'=>$value['aca_rating_type_id'],
            //                 'score'=> array_key_exists("score", $value) ? $value['score'] : 0,
            //                 'created_by' => $request['user_id'],
            //                 'created_at' => date('Y-m-d h:i:s')]
            //             );
            //         } 
            //     }
            // }
        });
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    public function unlockForEdit($Id){
     DB::update('UPDATE aca_student_assessment SET finalized = 0, finalized_date = NULL WHERE id = ?', [$Id]);
       return $this->successResponse(1, Response::HTTP_CREATED);
    }
    public function loadConsolidatedResultList($staffId, $orgId){
            $termResult = "SELECT t5.id AS aca_result_consolidated_id,(t4.stf_staff_id=?) AS is_class_teacher,t1.org_class_id,t1.org_stream_id,t1.org_section_id,t2.aca_assmt_term_id,t3.name AS term,IF(COUNT(IF(t2.finalized,1,NULL))>=t1.no_of_subjects,1,0) AS subject_teachers_finalized,DATE_FORMAT(MAX(t2.finalized_date),'%d-%m-%Y %H:%i %p') AS subject_teachers_finalized_date,t5.finalized AS class_teacher_finalized,DATE_FORMAT(t5.finalized_date,'%d-%m-%Y %H:%i %p') AS class_teacher_finalized_date,t5.published,DATE_FORMAT(t5.published_date,'%d-%m-%Y %H:%i %p') AS published_date 
            FROM (SELECT org_id,org_class_id,org_stream_id,org_section_id,COUNT(aca_sub_id) AS no_of_subjects FROM aca_class_subject_teacher WHERE org_id = ? GROUP BY org_id,org_class_id,org_stream_id,org_section_id) t1
                JOIN aca_student_assessment t2 ON t1.org_id = t2.org_id AND t1.org_class_id = t2.org_class_id AND (t1.org_stream_id = t2.org_stream_id OR (t1.org_stream_id IS NULL AND t2.org_stream_id IS NULL)) AND (t1.org_section_id = t2.org_section_id OR (t1.org_section_id IS NULL AND t2.org_section_id IS NULL)) AND t1.org_id = ?
                JOIN aca_assessment_term t3 ON t2.aca_assmt_term_id = t3.id
                LEFT JOIN aca_class_teacher t4 ON t1.org_id = t4.org_id AND t1.org_class_id = t4.org_class_id AND (t1.org_stream_id = t4.org_stream_id OR (t1.org_stream_id IS NULL AND t4.org_stream_id IS NULL)) AND (t1.org_section_id = t4.org_section_id OR (t1.org_section_id IS NULL AND t4.org_section_id IS NULL)) AND t4.stf_staff_id = ?
                LEFT JOIN aca_result_consolidated t5 ON t1.org_id = t5.org_id AND t1.org_class_id = t5.org_class_id AND (t1.org_stream_id = t5.org_stream_id OR (t1.org_stream_id IS NULL AND t5.org_stream_id IS NULL)) AND (t1.org_section_id = t5.org_section_id OR (t1.org_section_id IS NULL AND t5.org_section_id IS NULL)) AND t2.aca_assmt_term_id= t5.aca_assmt_term_id
            GROUP BY t5.id,t4.stf_staff_id,t1.org_class_id,t1.org_stream_id,t1.org_section_id,t2.aca_assmt_term_id,t3.name,t5.published,t5.published_date,t1.no_of_subjects,t5.finalized,t5.finalized_date";

        $finalResult = "SELECT t4.id AS aca_result_consolidated_id,(t3.stf_staff_id=?) AS is_class_teacher,t1.org_class_id,t1.org_stream_id,t2.org_section_id,NULL AS aca_assmt_term_id,'Final Result' AS term,1 AS subject_teachers_finalized,t4.finalized AS class_teacher_finalized,NULL AS subject_teachers_finalized_date,DATE_FORMAT(t4.finalized_date,'%d-%m-%Y %H:%i %p') AS subject_teachers_finalized_date,t4.published, DATE_FORMAT(t4.published_date,'%d-%m-%Y %H:%i %p') AS published_date
        FROM (SELECT aa.org_class_id,aa.org_stream_id,COUNT(bb.id) AS no_of_terms FROM aca_class_assessment_frequency aa JOIN aca_assessment_term bb ON aa.aca_assmt_frequency_id = bb.aca_assmt_frequency_id GROUP BY aa.org_class_id,aa.org_stream_id) t1
            LEFT JOIN (SELECT org_class_id,org_stream_id,org_section_id,COUNT(id) AS no_of_terms_finalized FROM aca_result_consolidated WHERE finalized=1 AND org_id = ? GROUP BY org_class_id,org_stream_id,org_section_id) t2 ON t1.org_class_id = t2.org_class_id AND (t1.org_stream_id = t2.org_stream_id OR (t1.org_stream_id IS NULL AND t2.org_stream_id IS NULL))
            LEFT JOIN aca_class_teacher t3 ON t1.org_class_id = t3.org_class_id AND (t1.org_stream_id = t3.org_stream_id OR (t1.org_stream_id IS NULL AND t3.org_stream_id IS NULL)) AND (t2.org_class_id IS NULL OR (t2.org_section_id = t3.org_section_id OR (t2.org_section_id IS NULL AND t3.org_section_id IS NULL))) AND t3.org_id = ?
            LEFT JOIN aca_result_consolidated t4 ON t1.org_class_id = t4.org_class_id AND (t1.org_stream_id = t4.org_stream_id OR (t1.org_stream_id IS NULL AND t4.org_stream_id IS NULL)) AND (t2.org_class_id IS NULL OR (t2.org_section_id = t4.org_section_id OR (t2.org_section_id IS NULL AND t4.org_section_id IS NULL))) AND t4.aca_assmt_term_id IS NULL AND t4.org_id = ?
        WHERE t4.id IS NOT NULL OR t2.no_of_terms_finalized >= t1.no_of_terms";
       try{ $result_consolidated = DB::select("$termResult UNION $finalResult", [$staffId, $orgId, $orgId, $staffId, $staffId, $orgId, $orgId, $orgId ]);}
       catch(Exception $e){
           dd($e);
       }

        return $this->successResponse ($result_consolidated);
    }

    public function loadConsolidatedResult($orgId,Request $request){
        $query = "SELECT t11.display_order AS term_display_order,t12.display_order AS subject_display_order,IFNULL(t13.display_order,t21.display_order) AS area_display_order,t1.id, t1.aca_assmt_term_id, t2.std_student_id, t1.aca_sub_id, t2.aca_assmt_area_id, t2.aca_rating_type_id, t11.name AS term, t12.name AS subject, t21.name AS assessment_area,trim(t13.weightage)+0 AS weightage,t4.input_type, IF(t4.input_type=2,t2.score,IFNULL(t3.name,NULLIF(trim(t2.score)+0,0))) AS score, t2.remarks
        FROM (aca_student_assessment t1 JOIN aca_assessment_term t11 ON t1.aca_assmt_term_id = t11.id JOIN aca_subject t12 ON t1.aca_sub_id=t12.id)
            JOIN (aca_student_assessment_detail t2 JOIN aca_assessment_area t21 ON t2.aca_assmt_area_id = t21.id) ON t1.id=t2.aca_student_assmt_id
            JOIN aca_class_subject_assessment t13 ON t1.aca_assmt_term_id=t13.aca_assmt_term_id AND t1.aca_sub_id=t13.aca_sub_id AND t2.aca_assmt_area_id=t13.aca_assmt_area_id AND t1.org_class_id = t13.org_class_id AND (t1.org_stream_id = t13.org_stream_id OR (t1.org_stream_id is null AND t13.org_stream_id IS NULL))
            JOIN aca_rating_type t4 ON t2.aca_rating_type_id=t4.id
            LEFT JOIN aca_rating t3 ON t2.aca_rating_type_id = t3.aca_rating_type_id AND IFNULL((trim(t2.score)+0),0) = t3.score
        WHERE t1.org_id = ? AND t1.org_class_id = ? ";
        $condition = "";
        $param = [$orgId,$request->org_class_id];
        if($request->org_stream_id){
            $condition .= ' AND t1.org_stream_id = ?';
            array_push($param, $request->org_stream_id);
        }
        if($request->org_section_id){
            $condition .= ' AND t1.org_section_id = ?';
            array_push($param, $request->org_section_id);
        }
        $query = $query . $condition;
        if($request->aca_assmt_term_id){
            $query .= ' AND t1.aca_assmt_term_id = ?';
            array_push($param, $request->aca_assmt_term_id);
        }else{
            $queryFinalResult = " UNION SELECT 1000 AS term_display_order,t12.display_order AS subject_display_order,IFNULL(t13.display_order,t21.display_order) AS area_display_order,
                't1id' AS id, 't1aca_assmt_term_id' AS aca_assmt_term_id, t2.std_student_id, t1.aca_sub_id, IF(t4.input_type=1,t1.aca_sub_id,t2.aca_assmt_area_id) AS aca_assmt_area_id,
                t2.aca_rating_type_id,'Final Result' AS term, t12.name AS subject, IF(t4.input_type=1,'',t21.name) AS assessment_area,trim(t13.weightage)+0 AS weightage,t4.input_type,
                CASE t4.input_type WHEN 0 THEN ROUND(AVG(t3.score)) WHEN 1 THEN trim(SUM(t2.score))+0 ELSE MAX(t2.score) END AS score,
                t2.remarks
            FROM (aca_student_assessment t1 JOIN aca_class_subject t11 ON t1.org_class_id = t11.org_class_id AND (t1.org_stream_id = t11.org_stream_id OR (t1.org_stream_id is null AND t11.org_stream_id IS NULL)) JOIN aca_subject t12 ON t1.aca_sub_id=t12.id)
                JOIN (aca_student_assessment_detail t2 JOIN aca_assessment_area t21 ON t2.aca_assmt_area_id = t21.id) ON t1.id=t2.aca_student_assmt_id
                JOIN aca_class_subject_assessment t13 ON t1.aca_assmt_term_id=t13.aca_assmt_term_id AND t1.aca_sub_id=t13.aca_sub_id AND t2.aca_assmt_area_id=t13.aca_assmt_area_id AND t1.org_class_id = t13.org_class_id AND (t1.org_stream_id = t13.org_stream_id OR (t1.org_stream_id is null AND t13.org_stream_id IS NULL))
                JOIN aca_rating_type t4 ON t2.aca_rating_type_id=t4.id
                LEFT JOIN aca_rating t3 ON t2.aca_rating_type_id = t3.aca_rating_type_id AND IFNULL((trim(t2.score)+0),0) = t3.score
            WHERE t1.org_id = ? AND t1.org_class_id = ?";

            $query = "$query $queryFinalResult $condition GROUP BY t12.display_order,IFNULL(t13.display_order,t21.display_order),
            t2.std_student_id,t1.aca_sub_id, IF(t4.input_type=1,t1.aca_sub_id,t2.aca_assmt_area_id),
            t2.aca_rating_type_id,t12.name,IF(t4.input_type=1,'',t21.name),t13.weightage,t4.input_type,t2.remarks";
            
            $param = array_merge($param,$param);
        }
       try{
           $consolidatedResult = DB::select("$query ORDER BY term_display_order,subject_display_order,area_display_order", $param);
        return $this->successResponse($consolidatedResult);
       }catch(Exception $e){
           return($e);
       }
    }
    public function saveConsolidatedResut(Request $request){
        DB::transaction(function() use($request) {
            $query= "DELETE FROM aca_result_consolidated WHERE org_id = ? AND org_class_id = ?";
           $param = [$request['org_id'],$request['org_class_id'],$request['aca_sub_id']];

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
            DB::delete($query,$param);

            $result = [
                'org_id' => $request['org_id'],
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
            foreach($request['data'] as $resultConsolidatedDetail){
                           ResultConsolidatedDetail::create(
                           ['aca_result_consolidated_id' => $resultConsolidated->id,
                            'std_student_id' => $resultConsolidatedDetail['std_student_id'],
                            'result'=>$resultConsolidatedDetail['result'],
                            'created_by' => $request['user_id'],
                            'created_at' => date('Y-m-d h:i:s')]
                        );
            }
        });
        return $this->successResponse(1, Response::HTTP_CREATED);
    }


}