<?php

namespace App\Http\Controllers\masters;


use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\masters\Subject;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\masters\AssessmentArea;
use App\Models\masters\ClassAssessmentFrequency;
use App\Models\masters\ClassAssessmentFrequencyHistory;
use App\Models\masters\ClassSubjectAssessment;
use App\Models\masters\ClassSubjectAssessmentHistory;
use App\Models\masters\MainSubject;
use App\Models\masters\PromotionRule;
use App\Models\masters\RatingType;
use App\Models\masters\ReasonsForAbsent;
use App\Models\masters\SubjectAssessmentType;
use App\Models\masters\SubjectAssessmentTypeHistory;
use App\Models\masters\SubjectMappingForTre;
use App\Models\masters\TeachingSubject;
use Exception;
use PhpParser\Node\Stmt\Continue_;

class AcademicMastersController extends Controller
{
    use ApiResponser;

    public $audit_table = "system_db";

    public $database = "academic_db";

    public function saveAcademicMasters(Request $request)
    {
        if ($request['record_type'] == 'main_subject') {
            $rules = [
                'status'    =>  'required',
            ];
            $customMessages = [
                'status.required' => 'This field is required',
            ];
            if ($request['action_type'] == 'add') {
                $new_rules = array('name' => 'required|unique:aca_main_subject', 'code' => 'required|unique:aca_main_subject');
                $final_rules = array_merge($rules, $new_rules);
                $new_customMessages = array('name.required' => 'This field is required', 'code' => 'This field is required');
                $final_customMessages = array_merge($customMessages, $new_customMessages);
                $this->validate($request, $final_rules, $final_customMessages);
                $data = [
                    'name' => $request['name'],
                    'code' => $request['code'],
                    'status' => $request['status'],
                    'created_by' =>  $request['user_id'],
                    'created_at' =>   date('Y-m-d h:i:s')
                ];
                $responsedata = MainSubject::create($data);
            }
            try {
                if ($request['action_type'] == "edit") {
                    $new_rules = array('name' => 'required', 'code' => 'required');
                    $final_rules = array_merge($rules, $new_rules);
                    $new_customMessages = array('name.required' => 'This field is required', 'code' => 'This field is required');
                    $final_customMessages = array_merge($customMessages, $new_customMessages);
                    $this->validate($request, $final_rules, $final_customMessages);

                    $data = MainSubject::find($request['id']);
                    $messs_det = 'name:' . $data->name . '; code:' . $data->code . '; status:' . $data->status;
                    $procid = DB::select("CALL " . $this->audit_table . ".emis_audit_proc('" . $this->database . "','aca_main_subject','" . $request['id'] . "','" . $messs_det . "','" . $request['user_id'] . "','Edit')");
                    $data->name = $request['name'];
                    $data->code = $request['code'];
                    $data->status = $request['status'];
                    $data->created_at = date('Y-m-d h:i:s');
                    $data->update();
                    $responsedata = $data;
                }
            } catch (Exception $e) {
                dd($e);
            }
        }
        // dd($request);
        if ($request['record_type'] == "subject") {
            if ($request['action_type'] == "add") {
                $rules = [
                    'name'    =>  'required|unique:aca_subject',
                    'code' => 'required|unique:aca_subject',
                    'aca_sub_category_id' => 'required',
                    'display_order' => 'required',
                    'status'    =>  'required',
                    'assessed_by_class_teacher' => 'required',
                ];
                $customMessages = [
                    'display_order.required' => 'This field is required',
                    'name.required' => 'This field is required',
                    'code.required' => 'This field is required',
                    'aca_sub_category_id.required' => 'This field is required',
                    'status.required' => 'This field is required',
                    'assessed_by_class_teacher' => 'required',
                ];
                $this->validate($request, $rules,  $customMessages);
                $data = [
                    'name'  =>  $request['name'],
                    'code'  =>  $request['code'],
                    'aca_sub_category_id' => $request['aca_sub_category_id'],
                    'assessed_by_class_teacher' =>  $request['assessed_by_class_teacher'],
                    'is_special_educational_needs' =>  $request['is_special_educational_needs'],
                    'dzo_name' => $request['dzo_name'],
                    'display_order' => $request['display_order'],
                    'status'    =>  $request['status'],
                    'created_by' =>  $request['user_id'],
                    'created_at' =>   date('Y-m-d h:i:s'),
                ];
                try {
                    $responsedata = Subject::create($data);
                } catch (Exception $e) {
                    dd($e);
                }
            }
            if ($request['action_type'] == "edit") {
                $rules = [
                    'name'    =>  'required',
                    'code' => 'required|unique:aca_subject',
                    'aca_sub_category_id' => 'required',
                    'display_order' => 'required',
                    'assessed_by_class_teacher' => 'required',
                    'status'    =>  'required',
                ];
                $customMessages = [
                    'name.required' => 'This field is required',
                    'code.required' => 'This field is required',
                    'display_order.required' => 'This field is required',
                    'status.required' => 'This field is required',
                    'assessed_by_class_teacher.required' => 'This field is required',
                ];
                $this->validate($request, $rules,  $customMessages);
                $data = Subject::find($request['id']);
                $messs_det = 'name:' . $data->name . '; code:' . $data->code . '; aca_sub_category_id:' . $data->aca_sub_category_id . '; assessed_by_class_teacher:' . $data->assessed_by_class_teacher . '; is_special_educational_needs:' . $data->is_special_educational_needs . '; display_order:' . $data->display_order . '; status:' . $data->status;
                $procid = DB::select("CALL " . $this->audit_table . ".emis_audit_proc('" . $this->database . "','aca_subject','" . $request['id'] . "','" . $messs_det . "','" . $request['user_id'] . "','Edit')");
                $data->name = $request['name'];
                $data->code = $request['code'];
                $data->aca_sub_category_id = $request['aca_sub_category_id'];
                $data->dzo_name = $request['dzo_name'];
                $data->assessed_by_class_teacher = $request['assessed_by_class_teacher'];
                $data->is_special_educational_needs = $request['is_special_educational_needs'];
                $data->display_order = $request['display_order'];
                $data->status = $request['status'];
                $data->update();
                $responsedata = $data;
            }
        }

        if ($request['record_type'] == "sub_subject") {
            if ($request['action_type'] == "add") {
                $rules = [
                    'aca_sub_id' => 'required',
                    'aca_sub_category_id' => 'required',
                    'name'    =>  'required',
                    'code' => 'required|unique:aca_subject',
                    'display_order' => 'required',
                    'status'    =>  'required',
                ];
                $customMessages = [
                    'aca_sub_id.required' => 'This field is required',
                    'aca_sub_category_id.required' => 'This field is required',
                    'name.required' => 'This field is required',
                    'display_order.required' => 'This field is required',
                    'status.required' => 'This field is required',

                ];
                $this->validate($request, $rules,  $customMessages);
                $data = [
                    'aca_sub_id' => $request['aca_sub_id'],
                    'aca_sub_category_id' => $request['aca_sub_category_id'],
                    'name'  =>  $request['name'],
                    'code'  =>  $request['code'],
                    'dzo_name' => $request['dzo_name'],
                    'display_order' => $request['display_order'],
                    'status'    =>  $request['status'],
                    'created_by' =>  $request['user_id'],
                    'created_at' =>   date('Y-m-d h:i:s'),
                ];
                $responsedata = Subject::create($data);
            }
            if ($request['action_type'] == "edit") {
                $rules = [
                    'aca_sub_id' => 'required',
                    'aca_sub_category_id' => 'required',
                    'name'    =>  'required',
                    'display_order' => 'required',
                    'status'    =>  'required',
                ];
                $customMessages = [
                    'aca_sub_id.required' => 'This field is required',
                    'aca_sub_category_id.required' => 'This field is required',
                    'name.required' => 'This field is required',
                    'code.required' => 'This field is required',
                    'display_order.required' => 'This field is required',
                    'status.required' => 'This field is required',

                ];
                $this->validate($request, $rules,  $customMessages);

                $data = Subject::find($request['id']);
                $messs_det = 'aca_sub_id:' . $data->aca_sub_id . 'aca_sub_category_id:' . $data->aca_sub_category_id . '; name:' . $data->name . '; code:' . $data->code . '; display_order:' . $data->display_order . '; status:' . $data->status;
                $procid = DB::select("CALL " . $this->audit_table . ".emis_audit_proc('" . $this->database . "','aca_subject','" . $request['id'] . "','" . $messs_det . "','" . $request['user_id'] . "','Edit')");
                $data->aca_sub_id = $request['aca_sub_id'];
                $data->aca_sub_category_id = $request['aca_sub_category_id'];
                $data->name = $request['name'];
                $data->code = $request['code'];
                $data->dzo_name = $request['dzo_name'];

                $data->display_order = $request['display_order'];
                $data->status = $request['status'];
                $data->update();

                $responsedata = $data;
            }
        }
        if ($request['record_type'] == "assessment_area") {
            if ($request['action_type'] == "add") {
                $rules = [
                    'aca_sub_id' => 'required',
                    'aca_assmnt_type' => 'required',
                    'name'  =>  'required',
                    'code' => 'required',
                    'display_order' => 'required',
                    'status'    =>  'required',
                ];
                $customMessages = [
                    'aca_sub_id.required' => 'This field is required',
                    'aca_assmnt_type.required' => 'This field is required',
                    'name.required' => 'This field is required',
                    'code.required' => 'This field is required',
                    'display_order.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                $this->validate($request, $rules,  $customMessages);
                $data = [
                    'aca_sub_id' => $request['aca_sub_id'],
                    'aca_rating_type_id' => $request['aca_rating_type_id'],
                    'aca_assmnt_type' => $request['aca_assmnt_type'],
                    'name'  =>  $request['name'],
                    'dzo_name'  =>  $request['dzo_name'],
                    'code'  =>  $request['code'],
                    'display_order' => $request['display_order'],
                    'status'    =>  $request['status'],
                    'created_by' =>  $request['user_id'],
                    'created_at' =>   date('Y-m-d h:i:s'),
                ];
                try {
                    $responsedata = AssessmentArea::create($data);
                } catch (Exception $e) {
                    dd($e);
                }
            }
            if ($request['action_type'] == "edit") {
                $rules = [
                    'aca_sub_id' => 'required',
                    'aca_assmnt_type' => 'required',
                    'name'  =>  'required',
                    'code' => 'required',
                    'display_order' => 'required',
                    'status'    =>  'required',
                ];
                $customMessages = [
                    'aca_sub_id.required' => 'This field is required',
                    'aca_assmnt_type.required' => 'This field is required',
                    'name.required' => 'This field is required',
                    'code.required' => 'This field is required',
                    'display_order.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];

                $this->validate($request, $rules,  $customMessages);

                $data = AssessmentArea::find($request['id']);
                $messs_det = 'aca_sub_id:' . $data->aca_sub_id . '; aca_assmnt_type:' . $data->aca_assmnt_type . '; aca_rating_type_id:' . $data->aca_rating_type_id . '; display_order' . $data->display_order . '; name' . $data->name . '; code' . $data->code . '; status:' . $data->status;
                $procid = DB::select("CALL " . $this->audit_table . ".emis_audit_proc('" . $this->database . "','aca_assessment_area','" . $request['id'] . "','" . $messs_det . "','" . $request['user_id'] . "','Edit')");
                $data->aca_rating_type_id = $request['aca_rating_type_id'];
                $data->aca_assmnt_type = $request['aca_assmnt_type'];
                $data->name = $request['name'];
                $data->dzo_name = $request['dzo_name'];
                $data->code = $request['code'];
                $data->display_order = $request['display_order'];
                $data->status = $request['status'];
                $data->update();
                $responsedata = $data;
            }
        }
        if ($request['record_type'] == 'reason_for_absent') {
            $rules = [
                'status'            =>  'required',
            ];
            $customMessages = [
                'status.required'               => 'This field is required',
            ];

            if ($request['action_type'] == "add") {
                $new_rules = array('name' => 'required|unique:aca_absence_reason');
                $final_rules = array_merge($rules, $new_rules);

                $new_customMessages = array('name.required' => 'This field is required');
                $final_customMessages = array_merge($customMessages, $new_customMessages);
                $this->validate($request, $final_rules, $final_customMessages);
                $data = [
                    'name'  =>  $request['name'],
                    'status'    =>  $request['status'],
                    'created_by' =>  $request['user_id'],
                    'created_at' =>   date('Y-m-d h:i:s'),
                ];
                $responsedata = ReasonsForAbsent::create($data);
            }
            if ($request['action_type'] == "edit") {
                $new_rules = array('name' => 'required');
                $final_rules = array_merge($rules, $new_rules);

                $new_customMessages = array('name.required' => 'This field is required');
                $final_customMessages = array_merge($customMessages, $new_customMessages);

                $this->validate($request, $final_rules,  $final_customMessages);

                $data = ReasonsForAbsent::find($request['id']);
                $messs_det = 'name' . $data->name . '; status:' . $data->status;
                $procid = DB::select("CALL " . $this->audit_table . ".emis_audit_proc('" . $this->database . "','aca_reasons_for_absent','" . $request['id'] . "','" . $messs_det . "','" . $request['user_id'] . "','Edit')");
                $data->name = $request['name'];
                $data->status = $request['status'];
                $data->update();
                $responsedata = $data;
            }
        }
        if ($request['record_type'] == "teaching_subject") {
            if ($request['action_type'] == "add") {
                $rules = [
                    'subjecttype'       => 'required',
                    'name'              =>  'required',
                    'code'              =>  'required',
                    'displayorder'      =>  'required',
                    'status'            =>  'required',
                ];
                $customMessages = [
                    'subjecttype.required'          => 'This field is required',
                    'name.required'                 => 'This field is required',
                    'code.required'                 => 'This field is required',
                    'displayorder.required'         => 'This field is required',
                    'status.required'               => 'This field is required',
                ];
                $this->validate($request, $rules,  $customMessages);
                $data = [
                    'subjecttype'       =>  $request['subjecttype'],
                    'name'              =>  $request['name'],
                    'code'              =>  $request['code'],
                    'displayorder'      =>  $request['displayorder'],
                    'description'       =>  $request['description'],
                    'status'            =>  $request['status'],
                    'created_by'        =>  $request['user_id'],
                    'created_at'        =>   date('Y-m-d h:i:s'),
                ];
                // dd($data);
                //  try{  
                $responsedata = TeachingSubject::create($data);
                //   }catch(Exception $e){
                //     dd($e);
                //  }
            }
            if ($request['action_type'] == "edit") {
                $rules = [
                    'subjecttype'       =>  'required',
                    'name'              =>  'required',
                    'code'              =>  'required',
                    'displayorder'      =>  'required',
                    'status'            =>  'required',
                ];
                $customMessages = [
                    'subjecttype.required'          => 'This field is required',
                    'name.required'                 => 'This field is required',
                    'code.required'                 => 'This field is required',
                    'displayorder.required'         => 'This field is required',
                    'status.required'               => 'This field is required',
                ];

                $this->validate($request, $rules,  $customMessages);

                $data = TeachingSubject::find($request['id']);
                $messs_det = 'name:' . $data->name . '; code:' . $data->code . ';subjecttype:' . $data->subjecttype . '; displayorder:' . $data->displayorder . ';  description' . $data->description . '; status:' . $data->status;
                //  $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','aca_teaching_subject','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
                $data->name = $request['name'];
                $data->description = $request['description'];
                $data->subjecttype = $request['subjecttype'];
                $data->code = $request['code'];
                $data->displayorder = $request['displayorder'];
                $data->status = $request['status'];
                $data->update();
                $responsedata = $data;
            }
        }
        return $this->successResponse($responsedata, Response::HTTP_CREATED);
    }
    //written by gagen
    public function subjectlist($id = "")
    {
        // if($id!="" && $id!=null){
        //     $loadclass_dropdown = DB::select('SELECT org_class_id,aca_sub_id,  FROM aca_class_subject WHERE (class_stream = "'.$id.'")');
        //     return $this->successResponse($loadclass_dropdown);
        // }
        $response_data = DB::table('aca_class_subject')
            ->join('aca_subject', 'aca_subject.id', '=', 'aca_class_subject.aca_sub_id')
            ->select('aca_class_subject.org_class_id', 'aca_class_subject.aca_sub_id', 'aca_subject.name')
            ->where('class_stream', $id)
            ->get();

        return $this->successResponse($response_data);
    }
    public function loadAcademicMasters($param = "")
    {
        if ($param == "all_main_subject") {
            $main_subject = DB::select('SELECT id,name,code,status FROM aca_main_subject');
            return $this->successResponse($main_subject);
        }
        if ($param == "all_active_main_subject") {
            $main_subject = DB::select('SELECT id,name,code,status FROM aca_main_subject WHERE status = 1');
            return $this->successResponse($main_subject);
        }
        if ($param == "all_subject") {
            $subject = DB::select('SELECT t1.id,t1.name,t1.code,t1.assessed_by_class_teacher,t1.is_special_educational_needs,t1.dzo_name,t1.status,t1.display_order,t2.name AS sub_category_name,t2.id AS aca_sub_category_id FROM aca_subject t1 JOIN aca_subject_category t2 ON t1.aca_sub_category_id = t2.id WHERE aca_sub_id IS NULL ORDER BY display_order');
            return $this->successResponse($subject);
        }
        // if($param == "subjectDropdown"){
        //     $subject = DB::select('SELECT t1.id,t1.name,t1.assessed_by_class_teacher,t1.is_special_educational_needs,t1.dzo_name,t1.status,t1.display_order,t2.name AS sub_category_name,t2.id AS aca_sub_category_id FROM aca_subject t1 JOIN aca_subject_category t2 ON t1.aca_sub_category_id = t2.id WHERE aca_sub_id IS NULL ORDER BY display_order');
        //     return $this->successResponse($subject);
        // }

        if ($param == "all_active_subject") {
            $active_subject = DB::select('SELECT id,aca_sub_category_id,name,dzo_name,status,is_special_educational_needs,display_order FROM aca_subject WHERE aca_sub_id IS NULL AND status = 1 ORDER BY display_order');
            return $this->successResponse($active_subject);
        }
        if ($param == "all_active_subject_category") {
            $active_subject_category = DB::select('SELECT id,name,status,display_order FROM aca_subject_category WHERE status = 1 ORDER BY display_order');
            return $this->successResponse($active_subject_category);
        }
        if ($param == "all_sub_subject") {
            $subject = DB::select("SELECT t1.id, t1.aca_sub_id, t2.id AS aca_sub_category_id,t1.status,t1.name AS sub_subeject_name,t1.code,t1.dzo_name,t3.dzo_name AS dzo_subject,t1.assessed_by_class_teacher,t1.is_special_educational_needs,t1.display_order, t3.name AS sub_name, t2.name AS sub_category_name
                  FROM aca_subject t1 JOIN aca_subject_category t2 ON t1.aca_sub_category_id = t2.id JOIN aca_subject t3 ON t1.aca_sub_id= t3.id ORDER BY display_order");
            return $this->successResponse($subject);
        }
        if ($param == "all_active_subject_and_sub_subject") {
            $Activesubject = DB::select('SELECT id,aca_sub_category_id,name FROM aca_subject  WHERE status = 1 ORDER BY display_order');
            return $this->successResponse($Activesubject);
        }

        if ($param == "all_active_rating_type") {
            return $this->successResponse(RatingType::where('status', '1')->get(["id", "name", "input_type", "aca_sub_category_id"]));
        }
        if ($param == "all_active_rating") {
            return $this->successResponse(DB::select('SELECT id,aca_rating_type_id, name,dzo_name, score FROM aca_rating WHERE status=1'));
        }
        if ($param == "all_assessment_area") {
            $assessment_area = DB::select("SELECT t1.id,t1.display_order,IF(t1.aca_assmnt_type=0,'Continuous Assessment','Term Examination') AS aca_assmnt_type_name,t1.aca_assmnt_type, t2.name AS sub_name,t2.dzo_name AS sub_dzo_name, t1.aca_sub_id, t1.aca_rating_type_id, t3.name AS rating_type_name, t1.name AS assessment_area_name,t1.dzo_name AS area_dzo_name, t1.code,t1.status FROM aca_assessment_area t1 JOIN aca_subject t2 ON t1.aca_sub_id = t2.id LEFT JOIN aca_rating_type t3 ON t1.aca_rating_type_id = t3.id ORDER BY t1.display_order");
            return $this->successResponse($assessment_area);
        }
        if ($param == "all_assessment_frequency") {
            $frequency = DB::select('SELECT id, name FROM aca_assessment_frequency WHERE status=1 order by name');
            return $this->successResponse($frequency);
        }
        if ($param == "all_reasons_for_absent") {
            $frequency = DB::select('SELECT id, name,status FROM aca_absence_reason');
            return $this->successResponse($frequency);
        }
        if ($param == "all_active_reasons_for_absent") {
            $frequency = DB::select('SELECT id, name,status FROM aca_absence_reason WHERE status=1');
            return $this->successResponse($frequency);
        }
        if ($param == "assessed_classes") {
            $class_assessment_frequency =
                DB::select('SELECT t1.org_class_id,t1.org_stream_id 
                    FROM aca_class_assessment_frequency t1 
                        JOIN aca_assessment_frequency t2 ON t1.aca_assmt_frequency_id = t2.id
                    WHERE IFNULL(t2.not_assessed,0) = 0');
            return $this->successResponse($class_assessment_frequency);
        }

        if (strpos($param, "optional_subject_") !== false) {
            $params = explode("_", $param);
            $query = "SELECT t1.id, t1.org_class_id, t1.org_stream_id, t1.aca_sub_id, t2.name, t2.dzo_name
                 FROM aca_class_subject t1 JOIN aca_subject t2 ON t1.aca_sub_id = t2.id WHERE  t1.is_elective = 1 AND t1.org_class_id = ?";
            $param = [$params[3]];
            if ($params[4] == "streamId" &&  $params[6] == "sectionId") {
                $query .= " AND t1.org_stream_id = ?";
                array_push($param, $params[5]);
                array_push($param, $params[7]);
            } else if ($params[4] == "streamId") {
                $query .= " AND t1.org_stream_id = ?";
                array_push($param, $params[5]);
            }
            $optional_subject = DB::select($query, $param);
            return $this->successResponse($optional_subject);
        }
        if ($param == "promotion_sub_group") {
            $promotion_sub_group = DB::select('SELECT id,description FROM aca_promotion_sub_group ORDER BY (id<0),id');
            return $this->successResponse($promotion_sub_group);
        }
        // if($param == "all_teaching_subject"){
        //     $teachingSub = DB::select('SELECT id, name, code, displayorder, description, status FROM aca_teaching_subject ORDER BY displayorder');
        //     return $this->successResponse($teachingSub);
        // }
    }
    public function loadClassSubject($class_id = "", $stream_id = "")
    {
        $query = 'SELECT (t2.id IS NOT NULL) AS sub_selected, trim(t2.pass_score)+0 AS pass_score, t1.id AS aca_sub_id,t1.aca_sub_category_id,t3.input_type, 
                t1.name AS subject,t1.dzo_name AS sub_dzo_name,t2.aca_rating_type_id, t2.is_elective,t2.show_in_result,t2.display_order
                FROM aca_subject t1
                    LEFT JOIN aca_class_subject t2 ON t1.id=t2.aca_sub_id AND t2.org_class_id = ? 
                    LEFT JOIN aca_rating_type t3 ON t2.aca_rating_type_id = t3.id';
        $params = [$class_id];
        if ($stream_id) {
            $query .= ' AND t2.org_stream_id = ?';
            array_push($params, $stream_id);
        }
        return $this->successResponse(DB::select("$query ORDER BY sub_selected DESC,subject", $params));
    }
    public function saveClassSubject(Request $request)
    {
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
        $params = [$request['org_class_id']];
        if ($request['org_stream_id']) {
            $query .= ' AND org_stream_id = ?';
            array_push($params, $request['org_stream_id']);
        }
        DB::transaction(function () use ($request, $query, $params) {
            // $this->updateClassSubject($request);
            DB::delete($query, $params);
            if ($request['data']) {
                foreach ($request['data'] as $classSubject) {
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
    public function getClassAssessmentFrequency()
    {
        return $this->successResponse(DB::select('SELECT id,org_class_id,transcript_format,org_stream_id,aca_assmt_frequency_id FROM aca_class_assessment_frequency'));
    }
    public function saveAssessmentFrequency(Request $request)
    {
        $rules = [
            'data.*.aca_assmt_frequency_id' => 'required',
            'data.*.transcript_format' => 'required',
        ];
        $customMessages = [
            'data.*.aca_assmt_frequency_id.required' => 'All the fields are required',
            'data.*.transcript_format.required' => 'All the fields are required',

        ];
        $this->validate($request, $rules, $customMessages);
        DB::transaction(function () use ($request) {
            $this->updateAssessmentFrequency($request);
            DB::delete('DELETE FROM aca_class_assessment_frequency');
            foreach ($request['data'] as $assessmentFrequency) {
                $assessmentFrequency['created_by'] =  $request['user_id'];
                $assessmentFrequency['created_at'] =   date('Y-m-d h:i:s');
                ClassAssessmentFrequency::create($assessmentFrequency);
            }
        });
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    public function loadclassSubAssmtFrequency()
    {
        return $this->successResponse(DB::select('SELECT t1.org_class_id, t1.org_stream_id, t1.aca_sub_id, t4.id AS aca_assmt_term_id,t1.class_stream, t2.name AS sub_name,t2.dzo_name AS sub_dzo_name, t4.name AS term_name, t4.dzo_name AS term_dzo_name, t5.input_type
        FROM aca_class_subject t1 JOIN aca_subject t2 ON t1.aca_sub_id = t2.id JOIN aca_class_assessment_frequency t3 ON t1.org_class_id = t3.org_class_id AND (t1.org_stream_id = t3.org_stream_id OR (t1.org_stream_id is null AND t3.org_stream_id is null)) JOIN aca_assessment_term t4 ON t3.aca_assmt_frequency_id = t4.aca_assmt_frequency_id JOIN aca_rating_type t5 ON t1.aca_rating_type_id = t5.id WHERE t2.status = 1 AND t5.status = 1'));
    }
    public function loadclassSubjectAssessment($term_id, $sub_id, $class_id, $stream_id = "")
    {
        $query = 'SELECT (t2.id IS NOT NULL) AS assmt_area_selected,t1.id AS aca_assmt_area_id, t1.name AS assessment_area, t1.dzo_name, trim(t2.weightage)+0 AS weightage, t3.input_type, IFNULL(t2.display_order,t1.display_order) AS display_order
        FROM aca_assessment_area t1 LEFT JOIN aca_subject tt ON (t1.aca_sub_id=tt.aca_sub_id or t1.aca_sub_id=tt.id)
            LEFT JOIN aca_rating_type t3 ON t1.aca_rating_type_id=t3.id
            LEFT JOIN aca_class_subject_assessment t2 ON t1.id=t2.aca_assmt_area_id AND t1.aca_sub_id = t2.aca_sub_id AND t2.aca_sub_id = ? AND t2.aca_assmt_term_id = ? AND t2.org_class_id =? ';
        $params = [$sub_id, $term_id, $class_id];
        if ($stream_id) {
            $query .= ' AND t2.org_stream_id = ?';
            array_push($params, $stream_id);
        }
        array_push($params, $sub_id);
        return $this->successResponse(DB::select($query . ' WHERE IFNULL(tt.id,t1.aca_sub_id) = ? ORDER BY assmt_area_selected DESC,display_order', $params));
    }
    public function saveclassSubjectAssessment(Request $request)
    {
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
        $params = [$request['aca_assmt_term_id'], $request['aca_sub_id'], $request['org_class_id']];
        if ($request['org_stream_id']) {
            $query .= ' AND org_stream_id = ?';
            array_push($params, $request['org_stream_id']);
        }
        DB::transaction(function () use ($request, $query,  $params) {
            $this->updateclassSubjectAssessment($request);
            DB::delete($query, $params);
            foreach ($request['data'] as $classSubjectAssessment) {
                $classSubjectAssessment['class_stream'] = $request['class_stream'];
                $classSubjectAssessment['org_class_id'] = $request['org_class_id'];
                $classSubjectAssessment['org_stream_id'] = $request['org_stream_id'];
                $classSubjectAssessment['aca_sub_id'] = $request['aca_sub_id'];
                $classSubjectAssessment['aca_assmt_term_id'] = $request['aca_assmt_term_id'];
                $classSubjectAssessment['created_by'] =  $request['user_id'];
                $classSubjectAssessment['created_at'] =   date('Y-m-d h:i:s');

                ClassSubjectAssessment::create($classSubjectAssessment);
            }
        });
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    public function loadPromotionRule($class_id, $stream_id = "")
    {
        $query = 'SELECT t1.aca_sub_id, t2.name AS subject,t2.dzo_name AS sub_dzo_name,t3.id AS promotion_rule_id,t3.aca_promotion_sub_group_id 
            FROM aca_class_subject t1 
            JOIN aca_subject t2 ON t1.aca_sub_id=t2.id 
            LEFT JOIN aca_promotion_rule t3 ON t2.id = t3.aca_sub_id AND t1.org_class_id=t3.org_class_id AND ((t1.org_stream_id IS NULL AND t3.org_stream_id IS NULL) OR t1.org_stream_id = t3.org_stream_id)
            WHERE t2.aca_sub_id IS NULL AND t1.org_class_id = ?';
        $params = [$class_id];
        if ($stream_id) {
            $query .= ' AND t1.org_stream_id = ?';
            array_push($params, $stream_id);
        }
        return $this->successResponse(DB::select("$query", $params));
    }

    public function savePromotionRule(Request $request)
    {
        $rules = [
            'data.*.aca_sub_id' => 'required',
            'data.*.aca_promotion_sub_group_id'  => 'required',
        ];
        $customMessages = [
            'data.*.aca_sub_id.required' => 'This field is required',
            'data.*.aca_promotion_sub_group_id.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $query = 'DELETE FROM aca_promotion_rule WHERE org_class_id = ?';
        $params = [$request['org_class_id']];
        if ($request['org_stream_id']) {
            $query .= ' AND org_stream_id = ?';
            array_push($params, $request['org_stream_id']);
        }
        DB::transaction(function () use ($request, $query, $params) {
            DB::delete($query, $params);
            if ($request['data']) {
                foreach ($request['data'] as $classSubject) {
                    $classSubject['class_stream'] =  $request['class_stream'];
                    $classSubject['org_class_id'] =  $request['org_class_id'];
                    $classSubject['org_stream_id'] =  $request['org_stream_id'];
                    $classSubject['created_by'] =  $request['user_id'];
                    $classSubject['created_at'] =   date('Y-m-d h:i:s');

                    PromotionRule::create($classSubject);
                }
            }
        });
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    public function saveSubjectMappingForTre(Request $request)
    {
        $rules = [
            'org_class_id' => 'required',
            'data.*.org_class_id' => 'required',
            'data.*.aca_sub_id' => 'required',
            'data.*.aca_teacher_sub_id' => 'required',
            'data.*.standard_hours' => 'required',
            'data.*.standard_minutes' => 'required',
        ];
        $customMessages = [
            'org_class_id.required' => 'All the fields are required',
            'data.*.org_class_id.required' => 'All the fields are required',
            'data.*.aca_sub_id.required' => 'All the fields are required',
            'data.*.aca_teacher_sub_id.required' => 'All the fields are required',
            'data.*.standard_hours.required' => 'All the fields are required',
            'data.*.standard_minutes.required' => 'All the fields are required',
        ];
        $this->validate($request, $rules, $customMessages);

        $query = 'DELETE FROM aca_subject_mapping_for_tre WHERE org_class_id = ?';
        $params = [$request['org_class_id']];
        if ($request['org_stream_id']) {
            $query .= ' AND org_stream_id = ?';
            array_push($params, $request['org_stream_id']);
        }
        DB::transaction(function () use ($request, $query, $params) {
            DB::delete($query, $params);
            foreach ($request['data'] as $subjectMapping) {
                $subjectMapping['class_stream'] =   $request['class_stream'];
                $subjectMapping['org_class_id'] =   $request['org_class_id'];
                $subjectMapping['org_stream_id'] =  $request['org_stream_id'];
                $subjectMapping['created_by'] =   $request['user_id'];
                $subjectMapping['created_at'] =   date('Y-m-d h:i:s');
                SubjectMappingForTre::create($subjectMapping);
            }
        });
    }
    private function updateAssessmentFrequency($request)
    {
        foreach ($request['data'] as $assessmentFrequency) {
            $assessmentFrequency['created_by'] =   $request['user_id'];
            $assessmentFrequency['created_at'] =   date('Y-m-d h:i:s');
            $assessmentFrequency['updated_by'] =   $request['user_id'];
            $assessmentFrequency['updated_at'] =   date('Y-m-d h:i:s');
            $assessmentFrequency['recorded_for'] =  'Class Assessment Frequency Change';

            ClassAssessmentFrequencyHistory::create($assessmentFrequency);
        }
    }
    private function updateClassSubject($request)
    {
        foreach ($request['data'] as $classSubject) {
            $classSubject['class_stream'] =  $request['class_stream'];
            $classSubject['org_class_id'] =  $request['org_class_id'];
            $classSubject['org_stream_id'] =  $request['org_stream_id'];
            $classSubject['created_by'] =  $request['user_id'];
            $classSubject['created_at'] =   date('Y-m-d h:i:s');
            $classSubject['updated_by'] =   $request['user_id'];
            $classSubject['updated_at'] =   date('Y-m-d h:i:s');
            $classSubject['recorded_for'] =  'Class Subject  Change';

            SubjectAssessmentTypeHistory::create($classSubject);
        }
    }
    private function updateclassSubjectAssessment($request)
    {
        foreach ($request['data'] as $classSubjectAssessment) {
            $classSubjectAssessment['class_stream'] = $request['class_stream'];
            $classSubjectAssessment['org_class_id'] = $request['org_class_id'];
            $classSubjectAssessment['org_stream_id'] = $request['org_stream_id'];
            $classSubjectAssessment['aca_sub_id'] = $request['aca_sub_id'];
            $classSubjectAssessment['aca_assmt_term_id'] = $request['aca_assmt_term_id'];
            $classSubjectAssessment['created_by'] =  $request['user_id'];
            $classSubjectAssessment['created_at'] =   date('Y-m-d h:i:s');
            $classSubjectAssessment['updated_by'] =   $request['user_id'];
            $classSuclassSubjectAssessmentbject['updated_at'] =   date('Y-m-d h:i:s');
            $classSubjectAssessment['recorded_for'] =  'Class Subject  Assessment Change';

            ClassSubjectAssessmentHistory::create($classSubjectAssessment);
        }
    }
}
