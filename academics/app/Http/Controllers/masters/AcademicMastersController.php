<?php

namespace App\Http\Controllers\masters;


use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\masters\Subject;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\masters\AssessmentArea;
use App\Models\masters\AssessmentFrequency;
use App\Models\masters\ClassAssessmentFrequency;
use App\Models\masters\ClassSubjectAssessment;
use App\Models\masters\RatingType;
use App\Models\masters\SubjectAssessmentType;
use App\Models\masters\SubjectGroup;
use App\Models\masters\SubjectCategory;


class AcademicMastersController extends Controller
{
    use ApiResponser;

    public $audit_table="system_db";

    public $database="academic_db";

    public function saveAcademicMasters(Request $request) {

        if($request['record_type']=="subject_group"){
            if($request['action_type'] =="add"){
                $rules = [
                    'name'    =>  'required|unique:aca_subject_group',
                    'display_order' => 'required',
                    'status'    =>  'required',
                ];
                $customMessages = [
                    'display_order.required' => 'This field is required',
                    'name.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                $this->validate($request, $rules,  $customMessages);
                    $data = [
                        'name'  =>  $request['name'],
                        'dzo_name' => $request['dzo_name'],
                        'display_order'=> $request['display_order'],
                        'status'    =>  $request['status'],
                        'created_by' =>  $request['user_id'],
                        'created_at'=>   date('Y-m-d h:i:s'),
                    ];
                    $responsedata = SubjectGroup::create($data);
            } 
            if($request['action_type']=="edit"){
                $rules = [
                    'name'    =>  'required',
                    'display_order' => 'required',
                    'status'    =>  'required',
                ];
                $customMessages = [
                    'name.required' => 'This field is required',
                    'display_order.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                $this->validate($request, $rules,  $customMessages);
                $data = SubjectGroup::find($request['id']);
                $messs_det='name:'.$data->name.'; dzo_name:'.$data->dzo_name.'; display_order:'.$data->display_order.'; status:'.$data->status;
                $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','aca_subject_group','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
                $data->name = $request['name'];
                $data->dzo_name = $request['dzo_name'];
                $data->display_order = $request['display_order'];
                $data->status = $request['status'];
                $data->update();
                $responsedata = $data;
            }
        }
        
        if($request['record_type']=="subject"){
            if($request['action_type'] =="add"){
                $rules = [
                    'aca_sub_category_id' => 'required',
                    'name'    =>  'required|unique:aca_subject',
                    'display_order' => 'required',
                    'status'    =>  'required',
                    'assessed_by_class_teacher' => 'required'
                ];
                $customMessages = [
                    'aca_sub_category_id.required' => 'This field is required',
                    'name.required' => 'This field is required',
                    'display_order.required' => 'This field is required',
                    'status.required' => 'This field is required',
                    'assessed_by_class_teacher.required' => 'This field is required',

                ];
                $this->validate($request, $rules,  $customMessages);
                $data = [
                    'aca_sub_category_id' => $request['aca_sub_category_id'],
                    'aca_sub_group_id' => $request['aca_sub_group_id'],
                    'name'  =>  $request['name'],
                    'dzo_name' => $request['dzo_name'],
                    'display_order'=> $request['display_order'],
                    'status'    =>  $request['status'],
                    'created_by' =>  $request['user_id'],
                    'created_at'=>   date('Y-m-d h:i:s'),
                ];
                $responsedata= Subject::create($data);
            } 
            if($request['action_type']=="edit"){
                $rules = [
                    'aca_sub_category_id' => 'required',
                    'name'    =>  'required',
                    'display_order' => 'required',
                    'status'    =>  'required',
                    'assessed_by_class_teacher' => 'required'
                ];
                $customMessages = [
                    'aca_sub_category_id.required' => 'This field is required',
                    'name.required' => 'This field is required',
                    'display_order.required' => 'This field is required',
                    'status.required' => 'This field is required',
                    'assessed_by_class_teacher.required' => 'This field is required',

                ];
                
                $this->validate($request, $rules,  $customMessages);

                $data = Subject::find($request['id']);
                $messs_det='aca_sub_category_id:'.$data->aca_sub_category_id.'; aca_sub_group_id:'.$data->aca_sub_group_id.'; name:'.$data->name.'; dzo_name:'.$data->dzo_name.'; assessed_by_class_teacher:'.$data->assessed_by_class_teacher.'; display_order:'.$data->display_order.'; status:'.$data->status;
                $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','aca_subject','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
                $data->aca_sub_category_id = $request['aca_sub_category_id'];
                $data->aca_sub_group_id = $request['aca_sub_group_id'];
                $data->name = $request['name'];
                $data->dzo_name = $request['dzo_name'];
                $data->assessed_by_class_teacher = $request['assessed_by_class_teacher'];
                $data->display_order = $request['display_order'];
                $data->status = $request['status'];
                $data->update();
                $responsedata = $data;
            }
        }
        if($request['record_type']=="assessment_area"){
            if($request['action_type'] =="add"){
                $rules = [
                    'aca_sub_id' => 'required',
                    'name'  =>  'required|unique:aca_assessment_area',
                    'code' => 'required',
                    'display_order' => 'required',
                    'status'    =>  'required',
                ];
                $customMessages = [
                    'aca_sub_id.required' => 'This field is required',
                    'name.required' => 'This field is required',
                    'code.required' => 'This field is required',
                    'display_order.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                $this->validate($request, $rules,  $customMessages);
                $data = [
                    'aca_sub_id' => $request['aca_sub_id'],
                    'aca_rating_type_id' => $request['aca_rating_type_id'],
                    'name'  =>  $request['name'],
                    'dzo_name'  =>  $request['dzo_name'],
                    'code'  =>  $request['code'],
                    'display_order' => $request['display_order'],
                    'status'    =>  $request['status'],
                    'created_by' =>  $request['user_id'],
                    'created_at'=>   date('Y-m-d h:i:s'),
                ];
                $responsedata= AssessmentArea::create($data);
            } 
            if($request['action_type']=="edit"){
                $rules = [
                    'aca_sub_id' => 'required',
                    'name'  =>  'required',
                    'code' => 'required',
                    'display_order' => 'required',
                    'status'    =>  'required',
                ];
                $customMessages = [
                    'aca_sub_id.required' => 'This field is required',
                    'name.required' => 'This field is required',
                    'code.required' => 'This field is required',
                    'display_order.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                
                $this->validate($request, $rules,  $customMessages);

                $data = AssessmentArea::find($request['id']);
                $messs_det='aca_sub_id:'.$data->aca_sub_id.'; aca_rating_type_id:'.$data->aca_rating_type_id.'; display_order'.$data->display_order.'; name'.$data->name.'; dzo_name'.$data->dzo_name.'; code'.$data->code.'; status:'.$data->status;
                $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','aca_assessment_area','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
                $data->aca_rating_type_id = $request['aca_rating_type_id'];
                $data->name = $request['name'];
                $data->dzo_name = $request['dzo_name'];
                $data->code = $request['code'];
                $data->display_order = $request['display_order'];
                $data->status = $request['status'];
                $data->update();
                $responsedata = $data;
            }
        }
        return $this->successResponse($responsedata, Response::HTTP_CREATED);

    }
    public function loadAcademicMasters($param=""){
        if($param == "all_subject_group"){
            $subject = DB::select('SELECT * FROM aca_subject_group ORDER BY display_order');
            return $this->successResponse($subject);
        }
        if($param == "all_active_subject_group"){
            $active_subject = DB::select('SELECT * FROM aca_subject_group WHERE status = 1 ORDER BY display_order');
            return $this->successResponse($active_subject);
        }
        if($param == "all_active_subject_category"){
            $active_subject_category = DB::select('SELECT * FROM aca_subject_category WHERE status = 1 ORDER BY display_order');
            return $this->successResponse($active_subject_category);
        }
        if($param == "all_subject"){
            $subject = DB::select("SELECT t1.id, t1.display_order, t2.name AS sub_category_name, t1.aca_sub_category_id,t1.aca_sub_group_id, t3.name AS sub_group_name, t1.name AS sub_name, t1.dzo_name,t1.status, t1.assessed_by_class_teacher FROM aca_subject t1 JOIN aca_subject_category t2 ON t1.aca_sub_category_id = t2.id LEFT JOIN aca_subject_group t3 ON t1.aca_sub_group_id = t3.id ORDER BY display_order");
            return $this->successResponse($subject);
        }
        if($param == "all_active_subject"){
            $Activesubject = DB::select('SELECT * FROM aca_subject  WHERE status = 1 ORDER BY display_order');
            return $this->successResponse($Activesubject);
        }
        if($param == "all_active_rating_type"){
            return $this->successResponse(RatingType::where ('status', '1')->get(["id","name","input_type"]));
        }
        if($param == "all_assessment_area"){
            $assessment_area = DB::select('SELECT t1.id,t1.display_order, t2.name AS sub_name,t2.dzo_name AS sub_dzo_name, t1.aca_sub_id, t1.aca_rating_type_id, t3.name AS rating_type_name, t1.name AS assessment_area_name,t1.dzo_name AS area_dzo_name, t1.code,t1.status FROM aca_assessment_area t1 JOIN aca_subject t2 ON t1.aca_sub_id = t2.id LEFT JOIN aca_rating_type t3 ON t1.aca_rating_type_id = t3.id ORDER BY t1.display_order');
            return $this->successResponse($assessment_area);
        }
        if($param == "all_assessment_frequency"){
            $frequency = DB::select('SELECT id, name FROM aca_assessment_frequency WHERE status=1 order by name');
            return $this->successResponse($frequency);
        }
        if($param == "assessed_classes") {
            $class_assessment_frequency = DB::select('SELECT t1.org_class_id,t1.org_stream_id 
                                                    FROM aca_class_assessment_frequency t1 
                                                        JOIN aca_assessment_frequency t2 ON t1.aca_assmt_frequency_id = t2.id
                                                    WHERE IFNULL(t2.not_assessed,0) = 0');
            return $this->successResponse($class_assessment_frequency);
        }
    }
    public function loadClassSubject($class_id="",$stream_id=""){
        $query = 'SELECT (t2.id IS NOT NULL) AS sub_selected, trim(t2.pass_score)+0 AS pass_score, t1.id AS aca_sub_id, t1.name AS subject,t1.dzo_name AS sub_dzo_name,t2.aca_rating_type_id, t2.is_elective FROM aca_subject t1 LEFT JOIN aca_class_subject t2 ON t1.id=t2.aca_sub_id AND t2.org_class_id = ?';
        $params = [$class_id];
        if($stream_id){
          $query .= ' AND t2.org_stream_id = ?';
          array_push($params,$stream_id);
        }  
        return $this->successResponse (DB::select($query, $params)); 
    }
    public function saveClassSubject(Request $request){
        $rules = [
            'data.*.aca_sub_id' => 'required',
            'data.*.aca_rating_type_id'  => 'required',
        ];
        $customMessages = [
            'data.*.aca_sub_id.required' => 'This field is required',
            'data.*.aca_rating_type_id.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $query = 'DELETE FROM aca_class_subject WHERE org_class_id = ?';
        $params =[$request['org_class_id']];
        if($request['org_stream_id']){
            $query .= ' AND org_stream_id = ?';
            array_push($params,$request['org_stream_id']);
          } 
        DB::transaction(function() use($request, $query, $params) {
            DB::delete($query, $params);
            if($request['data']){
                foreach($request['data'] as $classSubject){
                    $classSubject['class_stream'] =  $request['class_stream'];
                    $classSubject['org_class_id'] =  $request['org_class_id'];
                    $classSubject['org_stream_id'] =  $request['org_stream_id'];
                    $classSubject['created_by'] =  $request['user_id'];
                    $classSubject['created_at'] =   date('Y-m-d h:i:s');

                    SubjectAssessmentType::create($classSubject);
                }
            }
        });
        return $this->successResponse(1, Response::HTTP_CREATED);

    }
    public function getClassAssessmentFrequency(){
        return $this->successResponse(DB::select('SELECT org_class_id,org_stream_id,aca_assmt_frequency_id FROM aca_class_assessment_frequency'));
    }
    public function saveAssessmentFrequency(Request $request){
        $rules = [
           'data.*.aca_assmt_frequency_id' => 'required',
        ];
        $customMessages = [
            'data.*.aca_assmt_frequency_id.required' => 'All the fields are required',
        ];
        $this->validate($request, $rules, $customMessages);
        DB::transaction(function() use($request) {
            DB::delete('DELETE FROM aca_class_assessment_frequency');
            foreach($request['data'] as $assessmentFrequency){
                $assessmentFrequency['created_by'] =  $request['user_id'];
                $assessmentFrequency['created_at'] =   date('Y-m-d h:i:s');
                ClassAssessmentFrequency::create($assessmentFrequency);
            }
        });
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    public function loadclassSubAssmtFrequency(){
        return $this->successResponse(DB::select('SELECT t1.org_class_id, t1.org_stream_id, t1.aca_sub_id, t4.id AS aca_assmt_term_id,t1.class_stream, t2.name AS sub_name,t2.dzo_name AS sub_dzo_name, t4.name AS term_name, t4.dzo_name AS term_dzo_name, t5.input_type
        FROM aca_class_subject t1 JOIN aca_subject t2 ON t1.aca_sub_id = t2.id JOIN aca_class_assessment_frequency t3 ON t1.org_class_id = t3.org_class_id AND (t1.org_stream_id = t3.org_stream_id OR (t1.org_stream_id is null AND t3.org_stream_id is null)) JOIN aca_assessment_term t4 ON t3.aca_assmt_frequency_id = t4.aca_assmt_frequency_id JOIN aca_rating_type t5 ON t1.aca_rating_type_id = t5.id WHERE t2.status = 1 AND t5.status = 1')); 
    }
    public function loadclassSubjectAssessment($term_id,$sub_id,$class_id, $stream_id=""){
        $query = 'SELECT (t2.id IS NOT NULL) AS assmt_area_selected,t1.id AS aca_assmt_area_id, t1.name AS assessment_area, t1.dzo_name, trim(t2.weightage)+0 AS weightage, t3.input_type, IFNULL(t2.display_order,t1.display_order) AS display_order
        FROM aca_assessment_area t1
            LEFT JOIN aca_rating_type t3 ON t1.aca_rating_type_id=t3.id
            LEFT JOIN aca_class_subject_assessment t2 ON t1.id=t2.aca_assmt_area_id AND t1.aca_sub_id = t2.aca_sub_id AND t2.aca_sub_id = ? AND t2.aca_assmt_term_id = ? AND t2.org_class_id =? ';
        $params = [$sub_id,$term_id,$class_id];
        if($stream_id){
          $query .= ' AND t2.org_stream_id = ?';
          array_push($params,$stream_id);
        } 
        array_push($params,$sub_id);
        return $this->successResponse(DB::select($query.' WHERE t1.aca_sub_id = ? ORDER BY display_order', $params)); 

    }
    public function saveclassSubjectAssessment(Request $request){ 
        $rules = [
           'aca_assmt_term_id' => 'required',
           'aca_sub_id' => 'required',
           'org_class_id' => 'required',
           'data.*.display_order' => 'required',
           'data.*.aca_assmt_area_id' => 'required',

        ];
        $customMessages = [
            'aca_assmt_term_id.required' => 'This field is required',
            'aca_sub_id.required' => 'This field is required',
            'org_class_id.required' => 'This field is required',
            'data.*.display_order.required' => 'This field is required',
            'data.*.aca_assmt_area_id.required' => 'This field is required',

        ];
        $this->validate($request, $rules, $customMessages);
        $query = 'DELETE FROM aca_class_subject_assessment WHERE aca_assmt_term_id = ? AND aca_sub_id = ? AND org_class_id = ?';
        $params = [$request['aca_assmt_term_id'],$request['aca_sub_id'],$request['org_class_id']];
        if($request['org_stream_id']){
          $query .= ' AND org_stream_id = ?';
          array_push($params,$request['org_stream_id']);
        } 
        DB::transaction(function() use($request, $query,  $params ) {
            DB::delete($query,$params);
            try{
                foreach($request['data'] as $classSubjectAssessment){
                    $classSubjectAssessment['class_stream'] = $request['class_stream'];
                    $classSubjectAssessment['org_class_id'] = $request['org_class_id'];
                    $classSubjectAssessment['org_stream_id'] = $request['org_stream_id'];
                    $classSubjectAssessment['aca_sub_id'] = $request['aca_sub_id'];
                    $classSubjectAssessment['aca_assmt_term_id'] = $request['aca_assmt_term_id'];
                    $classSubjectAssessment['created_by'] =  $request['user_id'];
                    $classSubjectAssessment['created_at'] =   date('Y-m-d h:i:s');
                    
                    ClassSubjectAssessment::create($classSubjectAssessment);
                    
                }
            }catch(Exception $e){
                dd($e);
            }
        });
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    
}
