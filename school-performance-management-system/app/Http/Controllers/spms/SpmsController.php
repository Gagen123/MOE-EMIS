<?php

namespace App\Http\Controllers\spms;

use App\Http\Controllers\Controller;
use App\Models\spms\Evaluation;
use App\Models\spms\EvaluationDetails;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SpmsController extends Controller
{
    use ApiResponser;

    public $audit_table="system_db";

    public $database="spms_db";

    public function getDeoDashboardData($dzon_id,$staff_id){
        $condition = "";
        $schools_assigned = DB::select("SELECT COUNT(id) AS schools_assigned FROM spm_school_deo WHERE staff_id = ?",[$staff_id]);
        $query = "SELECT t2.spm_domain_subcat_id,t21.name AS sub_category,t2.status,t3.name AS status_name,COUNT(t1.org_id) AS no_of_schools
                FROM spm_school_deo t1
                    JOIN (spm_evaluation t2 JOIN spm_domain_sub_category t21 ON t2.spm_domain_subcat_id = t21.id) ON t1.org_id = t2.org_id
                    JOIN spm_status t3 ON IFNULL(t2.status,0) = t3.id
                WHERE t1.dzon_id = ?";
        $params = [$dzon_id];
        if($schools_assigned[0]->schools_assigned > 0){
            $condition = " AND t1.staff_id = ?";
            array_push($params,$staff_id);
        }
        $evaluated_school_performances = DB::select("$query $condition GROUP BY t2.spm_domain_subcat_id,t21.name,t2.status,t3.name",$params);
        $assigned_org_ids = DB::select("SELECT DISTINCT t1.org_id FROM spm_school_deo t1 WHERE t1.dzon_id = ? $condition", $params);
        $sub_category_class_ids = DB::select("SELECT DISTINCT id AS spm_doamin_subcat_id,org_class_id,name FROM spm_domain_sub_category");

       return $this->successResponse(['evaluated_school_performances'=>$evaluated_school_performances,'assigned_org_ids'=>$assigned_org_ids,'sub_category_class_ids'=>$sub_category_class_ids]);
    }

    // public function getSchoolDoeDetails($dzon_id,$staff_id,$spm_domain_subcat_id,$status = 0){
    //     try {
    //     $condition = "";
    //     $schools_assigned = DB::select("SELECT COUNT(id) AS schools_assigned FROM spm_school_deo WHERE staff_id = ?",[$staff_id]);
    //     $deoField = "0";

    //     $query = "SELECT $deoField AS is_assigned_deo,t2.id AS evaluation_id,t3.id AS evaluation_detail_id,t3.spm_indicator_id,t1.org_id,t1.dzon_id,t2.spm_domain_subcat_id,t21.org_class_id,t21.name AS sub_category_name,t2.deo_remarks,t2.deo_review_remarks,SUM(t3.score) AS score,IFNULL(t2.status,0) AS status_id,t4.name AS status
    //             FROM spm_school_deo t1 
    //                 LEFT JOIN (spm_evaluation t2 JOIN spm_domain_sub_category t21 ON t2.spm_domain_subcat_id = t21.id JOIN spm_evaluation_detail t3 ON t2.id = t3.spm_evaluation_id) ON t1.org_id = t2.org_id 
    //                 LEFT JOIN spm_status t4 ON IFNULL(t2.status,0) = t4.id
    //             WHERE t1.dzon_id = ?";

    //     $params = [$dzon_id];

    //     if($schools_assigned[0]->schools_assigned > 0){
    //         $deoField = "1";
    //         $condition = " AND t1.staff_id = ?";
    //         array_push($params,$staff_id);
    //     }
    //     if($status > 0){
    //         $$condition .= " AND t2.status = ?";
    //         array_push($params,$status);
    //     }else{
    //         $assigned_org_ids = DB::select("SELECT DISTINCT t1.org_id FROM spm_school_deo t1 WHERE t1.dzon_id = ? $condition", $params);
    //         $sub_category_class_ids = DB::select("SELECT DISTINCT id AS spm_doamin_subcat_id,org_class_id,name FROM spm_domain_sub_category");
    //         $condition .= " AND t2.status IS NULL";
    //     }
    //     $condition .= " AND t2.spm_domain_subcat_id = ?";
    //     array_push($params,$spm_domain_subcat_idaff_id);
    //     $var = DB::select("$query $condition GROUP BY t2.id,t3.id,t3.spm_indicator_id,t1.org_id,t1.dzon_id,t2.spm_domain_subcat_id,t21.org_class_id,t21.name,t2.deo_remarks,t2.deo_review_remarks,IFNULL(t2.status,0),t4.name",$params)
    //     return $this->successResponse();

    //     }catch(Exception $e){
    //         dd($e);
    //     }
    // }

    public function getSchoolDoeDetails($dzon_id,$staff_id,$spm_domain_subcat_id,$status = 0){
        try {
            $condition = "";
            $params = [$dzon_id];
            $schools_assigned = DB::select("SELECT COUNT(id) AS schools_assigned FROM spm_school_deo WHERE staff_id = ?",[$staff_id]);
            $deoField = "0";
            if($schools_assigned[0]->schools_assigned > 0){
                $deoField = "1";
                $condition = " AND t1.staff_id = ?";
                array_push($params,$staff_id);
            }
            if($status == 0){
                $isAcademic = DB::table('spm_domain_sub_category')->where('id',$spm_domain_subcat_id)->value('spm_domain_category_id');
                if($isAcademic){
                    $assigned_org_ids = DB::select("SELECT DISTINCT t1.org_id FROM spm_school_deo t1 WHERE t1.dzon_id = ? $condition", $params);
                    $sub_category_class_ids = DB::select("SELECT id AS spm_doamin_subcat_id,org_class_id,name FROM spm_domain_sub_category WHERE id=?",[$spm_domain_subcat_id]);
                    return $this->successResponse(['school_performances'=>[],'assigned_org_ids'=>$assigned_org_ids,'sub_category_class_ids'=>$sub_category_class_ids]);
                }
            }

        $query = "SELECT $deoField AS is_assigned_deo,t2.id AS evaluation_id,t3.id AS evaluation_detail_id,t3.spm_indicator_id,t1.org_id,t1.dzon_id,t21.id AS spm_domain_subcat_id,t21.org_class_id,t21.name AS sub_category_name,t2.deo_remarks,t2.deo_review_remarks,SUM(t3.score) AS score,IFNULL(t2.status,0) AS status_id,t4.name AS status
                FROM spm_school_deo t1 
                    LEFT JOIN (spm_evaluation t2 JOIN spm_evaluation_detail t3 ON t2.id = t3.spm_evaluation_id) ON t1.org_id = t2.org_id 
                    LEFT JOIN spm_status t4 ON IFNULL(t2.status,0) = t4.id
                    LEFT JOIN spm_domain_sub_category t21 ON t2.spm_domain_subcat_id = t21.id OR t2.id IS NULL
                WHERE t1.dzon_id = ?";
        if($status > 0){
            $condition .= " AND t2.status = ?";
            array_push($params,$status);
        }else{
            $condition .= " AND t2.status IS NULL";
        }
        $condition .= " AND t21.id = ?";
        array_push($params,$spm_domain_subcat_id);
        $school_performances = DB::select("$query $condition GROUP BY t2.id,t3.id,t3.spm_indicator_id,t1.org_id,t1.dzon_id,t21.id,t21.org_class_id,t21.name,t2.deo_remarks,t2.deo_review_remarks,IFNULL(t2.status,0),t4.name",$params);
        return $this->successResponse(['school_performances'=>$school_performances,'assigned_org_ids'=>[],'sub_category_class_ids'=>[]]);
        }catch(Exception $e){
            dd($e);
        }
    }

    public function getEvaluation($org_id,$spm_domain_subcat_id){
        try{
            $evaluationId = "";
            $evaluation = DB::select('SELECT id,status,deo_remarks AS overall_remarks FROM spm_evaluation WHERE org_id = ? AND spm_domain_subcat_id = ?',[$org_id,$spm_domain_subcat_id]);
            if(count($evaluation)){
                $evaluationId = $evaluation[0]->id;
            }
            $evaluationDetails = DB::select("SELECT t5.id,t1.id AS spm_indicator_id,t1.spm_parameter_id,t2.spm_area_id,t3.spm_domain_id,t4.name AS domain,t3.name AS area,t2.name As parameter,t1.name AS indicator,t5.score,t5.deo_remarks,t6.description AS score_description,
            COUNT(t4.id) OVER (PARTITION BY t4.id) AS rows_per_domain,
            COUNT(t3.id) OVER (PARTITION BY t3.id) AS rows_per_area,
            COUNT(t2.id) OVER (PARTITION BY t2.id) AS rows_per_paramater,
            COUNT(t1.id) OVER (PARTITION BY t1.id) AS rows_per_indicator
                FROM (spm_indicator t1 
                    JOIN spm_parameter t2 ON t1.spm_parameter_id = t2.id 
                    JOIN spm_area t3 ON t2.spm_area_id = t3.id 
                    JOIN spm_domain t4 ON t3.spm_domain_id= t4.id) 
                    LEFT JOIN spm_evaluation_detail t5 ON t1.id = t5.spm_indicator_id AND t5.spm_evaluation_id = ? 
                    LEFT JOIN spm_rating t6 ON t5.score = t6.score AND t5.spm_indicator_id = t6.spm_indicator_id",[$evaluationId]);
            return $this->successResponse(['evaluation' => $evaluation,'evaluationDetails'=>$evaluationDetails]);
        }catch(Exception $e){
            dd($e);
        }
    }
    public function saveEvaluation(Request $request){
        $rules = [
            'data.*.spm_indicator_id' => 'required',
            'data.*.score' => 'required',
        ];
        $customMessages = [
            'data.*.spm_indicator_id.required' => 'This field is required',
            'data.*.score.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
      
        DB::transaction(function() use($request) {
            if($request['evaluation_id']){
                $data = Evaluation::find($request['evaluation_id']);
                $data->status = $request['status'];
                $data->update();
                foreach($request['data'] as $evaluation_detail){
                    $data2 = EvaluationDetails::find($evaluation_detail['id']);
                    $data2->score = $evaluation_detail['score'];
                    if(array_key_exists('deo_remarks',$evaluation_detail)){
                        $data2->deo_remarks = $evaluation_detail['deo_remarks'];
                    }   
                    $data2->update();
                } 
            }else{
                $data = [];
                $data2 = [];
                $data['org_id'] = $request['org_id'];
                $data['status'] = $request['status'];
                $data['spm_domain_subcat_id'] = $request['spm_domain_subcat_id'];
                $data['created_by'] =  $request['user_id'];
                $data['created_at'] =   date('Y-m-d h:i:s');
                $ev = Evaluation::create($data);
                foreach($request['data'] as $evaluation){
                    $data2['spm_indicator_id'] = $evaluation['spm_indicator_id'];
                    $data2['spm_indicator_id'] = $evaluation['spm_indicator_id'];
                    $data2['spm_evaluation_id'] = $ev->id;
                    $data2['score'] = $evaluation['score'];
                    if(array_key_exists('deo_remarks',$evaluation)){
                        $data2['deo_remarks'] = $evaluation['deo_remarks'];
                    }
                    $data2['created_by'] =  $request['user_id'];
                    $data2['created_at'] =   date('Y-m-d h:i:s');

                        EvaluationDetails::create($data2);

                }
            
            }
            return $this->successResponse(1, Response::HTTP_CREATED);
           
        });
  
          
    }
    public function getSchoolDashboardData($org_id){
        $data = DB::select('SELECT t1.name AS domain,SUM(t5.score) AS score FROM spm_domain t1 
            JOIN spm_area t2 ON t1.id = t2.spm_domain_id
            JOIN spm_parameter t3 ON t2.id = t3.spm_area_id 
            JOIN spm_indicator t4 ON t3.id = t4.spm_parameter_id 
            JOIN spm_evaluation_detail t5 ON t4.id = t5.spm_indicator_id  
            JOIN spm_evaluation t6 ON t5.spm_evaluation_id = t6.id 
        WHERE t6.status >= 2 AND t6.org_id = ?',[$org_id]);
        return $this->successResponse($data);
    }
}
