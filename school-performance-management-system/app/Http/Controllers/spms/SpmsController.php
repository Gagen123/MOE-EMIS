<?php

namespace App\Http\Controllers\spms;

use App\Http\Controllers\Controller;
use App\Models\spms\AcknowledgementAgencyInformForm;
use App\Models\spms\ActionAgencyInformForm;
use App\Models\spms\AgencyInputForm;
use App\Models\spms\Evaluation;
use App\Models\spms\EvaluationDetails;
use App\Models\spms\ObservationAgencyInputForm;
use App\Models\spms\SchoolPlan;
use App\Models\spms\SchoolPlanHistory;
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

    public function schoolPerformaceDashboard(Request $request){
        try{
        if($request['dzongkhag_ids'] == "ALL"){
            $evaluated_school_performances = DB::table('spm_evaluation')
            ->selectRaw('dzon_id,evaluation_year AS year,COUNT(IF(status=1,1,null)) AS under_process,COUNT(IF(status=2,2,null)) AS completed')
            ->where('evaluation_year',$request['year'])
            ->groupBy(['dzon_id','evaluation_year'])
            ->get();
        }else{
            $evaluated_school_performances = DB::table('spm_evaluation')
            ->selectRaw('dzon_id,evaluation_year AS year,COUNT(IF(status=1,1,null)) AS under_process,COUNT(IF(status=2,2,null)) AS completed')
            ->where('evaluation_year',$request['year'])
            ->whereIn('dzon_id',explode(",",$request['dzongkhag_ids']))
            ->groupBy(['dzon_id','evaluation_year'])
            ->get();
        }
       return $this->successResponse($evaluated_school_performances);
    }catch(Exception $e){
        dd($e);
    }
    }
    public function getSchoolPerformaceList($year,$dzon_id,$status){
        $query = "SELECT id,org_id FROM spm_evaluation WHERE evaluation_year = ? AND dzon_id = ?";
        $params = [$year,$dzon_id];
        if($status !=0){
            $query .= " AND status = ?";
            array_push($params,$status);
        }
        return $this->successResponse(DB::select($query,$params));
    }
    public function getEvaluation($org_id,$year){
        $evaluationId = "";
      try{  $evaluation = DB::select('SELECT id,status,remarks AS overall_remarks FROM spm_evaluation WHERE org_id = ? AND evaluation_year = ?',[$org_id,$year]);
        if(count($evaluation)){
            $evaluationId = $evaluation[0]->id;
        }
        $evaluationDetails = DB::select("SELECT t5.id,t1.id AS spm_indicator_id,t1.spm_parameter_id,
                t2.spm_area_id,t3.spm_domain_id,concat(t4.sequence_no,'. ',t4.name) AS domain,
                concat(t4.sequence_no,'.',t3.sequence_no,' ',t3.name) AS area,t2.name As parameter,t1.name AS indicator,t1.mov,t5.score,
                t5.remarks,t6.description AS score_description,
                COUNT(t2.id) OVER (PARTITION BY t2.id) AS rows_per_paramater
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
            try{
            if($request['evaluation_id']){
                $parent_table = Evaluation::find($request['evaluation_id']);
                $parent_table->status = $request['status'];
                $parent_table->update();
                foreach($request['data'] as $evaluation_detail){
                    if(array_key_exists("id",$evaluation_detail) && $evaluation_detail['id']){
                        $child_table = EvaluationDetails::find($evaluation_detail['id']);
                        $child_table->score = $evaluation_detail['score'];
                        if(array_key_exists('remarks',$evaluation_detail)){
                            $child_table->remarks = $evaluation_detail['remarks'];
                        }   
                        $child_table->update();
                    }else{
                        $child_table['spm_indicator_id'] = $evaluation_detail['spm_indicator_id'];
                        $child_table['spm_indicator_id'] = $evaluation_detail['spm_indicator_id'];
                        $child_table['spm_evaluation_id'] = $request['evaluation_id'];
                        $child_table['score'] = $evaluation_detail['score'];
                        if(array_key_exists('remarks',$evaluation_detail)){
                            $child_table['remarks'] = $evaluation_detail['remarks'];
                        }
                        $child_table['created_by'] =  $request['user_id'];
                        $child_table['created_at'] =   date('Y-m-d h:i:s');
                        EvaluationDetails::create($child_table);
                    }
                } 
            }else{
                $parent_table = [];
                $child_table = [];
                $parent_table['dzon_id'] = $request['dzon_id'];
                $parent_table['org_id'] = $request['org_id'];
                $parent_table['evaluation_year'] = $request['year'];
                $parent_table['status'] = $request['status'];
                $parent_table['spm_domain_subcat_id'] = $request['spm_domain_subcat_id'];
                $parent_table['created_by'] =  $request['user_id'];
                $parent_table['created_at'] =   date('Y-m-d h:i:s');
                $e = Evaluation::create($parent_table);
                foreach($request['data'] as $evaluation_detail){
                    $child_table['spm_indicator_id'] = $evaluation_detail['spm_indicator_id'];
                    $child_table['spm_indicator_id'] = $evaluation_detail['spm_indicator_id'];
                    $child_table['spm_evaluation_id'] = $e->id;
                    $child_table['score'] = $evaluation_detail['score'];
                    if(array_key_exists('remarks',$evaluation_detail)){
                        $child_table['remarks'] = $evaluation_detail['remarks'];
                    }
                    $child_table['created_by'] =  $request['user_id'];
                    $child_table['created_at'] =   date('Y-m-d h:i:s');
                    EvaluationDetails::create($child_table);
                }
            }
        }catch(Exception $e){
            dd($e);
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
    public function saveSchoolPlan(Request $request){
        DB::transaction(function() use($request) {
            if($request['action'] == 'add'){
                $parent_data = [
                    'dzon_id' => $request['dzon_id'],
                    'org_id' => $request['org_id'],
                    'spm_domain_id' => $request['spm_domain_id'],
                    'year' => $request['year'],
                    'activity' => $request['activity'],
                    'objective' => $request['objective'],
                    'strategy' => $request['strategy'],
                    'start_date' => $request['start_date'],
                    'end_date' => $request['end_date'],
                    'person_responsible' => $request['person_responsible'],
                    'implementation_status_id' => $request['implementation_status_id'],
                    'school_plan_status' => $request['school_plan_status'],
                    'remarks' => $request['remarks'],
                    'created_by' =>  $request['user_id'],
                    'created_at' =>   date('Y-m-d h:i:s'),
                ];
                $response = SchoolPlan::create($parent_data);

                if($request['school_plan_status'] == '1'){
                    $this->insertHistory($request,$response->id);
                }
            }
            if($request['action'] == 'edit'){
                $rules = [
                    'spm_domain_id' => 'required',
                    'activity' => 'required',
                    'objective' => 'required',
                    'strategy' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required|after_or_equal:start_date',
                    'person_responsible' => 'required',
                    'implementation_status_id' => 'required',
                    'remarks' => 'required',
                ];
                $customMessages = [
                    'spm_domain_id.required' => 'This field is required',
                    'activity.required' => 'This field is required',
                    'objective.required' => 'This field is required',
                    'strategy.required' => 'This field is required',
                    'start_date.required' => 'This field is required',
                    'end_date.required' => 'This field is required',
                    'person_responsible.required' => 'This field is required',
                    'implementation_status_id.required' => 'This field is required',
                    'remarks.required' => 'This field is required',
                ];
                $this->validate($request, $rules, $customMessages);
                $data = SchoolPlan::find($request['spm_school_plan_id']);
                $messs_det='org_id:'.$data->org_id.'; spm_domain_id'.$data->spm_domain_id.'; year:'.$data->year.'; activity'.$data->activity.'; objective:'.$data->objective.'; strategy:'.$data->strategy.'; start_date:'.$data->start_date.'; end_date:'.$data->end_date.'; person_responsible:'.$data->person_responsible.'; implementation_status_id:'.$data->implementation_status_id.'; school_plan_status:'.$data->school_plan_status.'; remarks:'.$data->remarks;
                $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','spm_school_plan','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
                $data->spm_domain_id = $request['spm_domain_id'];
                $data->activity = $request['activity'];
                $data->objective = $request['objective'];
                $data->strategy = $request['strategy'];
                $data->start_date = $request['start_date'];
                $data->end_date = $request['end_date'];
                $data->person_responsible = $request['person_responsible'];
                $data->implementation_status_id = $request['implementation_status_id'];
                $data->school_plan_status = $request['school_plan_status'];
                $data->remarks = $request['remarks'];
                $data->update();
                $response = $data;

                if($request['school_plan_status']=='1'){
                    $this->insertHistory($request,$request['spm_school_plan_id']);
                }
                
            }
            return $this->successResponse($response, Response::HTTP_CREATED);
        });
    }
    private function insertHistory($request,$school_plan_id){
        $child_data = [
            'user_id' => $request['user_id'],
            'spm_school_plan_id' => $school_plan_id,
            'name' => $request['full_name'],
            'role' => $request['roles'],
            'status_id' =>$request['implementation_status_id'] ,
            'organization' =>$request['organization'] ,
            'status_date' => date('Y-m-d h:i:s'),
            'remarks' => $request['remarks'],
        ];
         SchoolPlanHistory::create($child_data);
    }
    public function getSchoolPlan($school_id){
        $response = DB::select("SELECT DISTINCT t1.implementation_status_id,t1.id,t1.spm_domain_id,t2.name AS domain,t1.activity,t1.start_date,t1.end_date,t3.name AS implementation_status,t1.school_plan_status 
        FROM spm_school_plan t1 
            JOIN spm_domain t2 ON t1.spm_domain_id = t2.id 
            JOIN spm_school_plan_status t3 ON t1.implementation_status_id = t3.id 
         WHERE t1.org_id = ?",[$school_id]);
        return $this->successResponse($response);
    }
    public function saveImplementtationStatus(Request $request){
        $rules = [
            'comment' => 'required',
            'implementation_status_id' => 'required',
            'full_name' => 'required',
            'organization' => 'required',
            'roles' => 'required',
            'spm_school_plan_id' => 'required',
        ];
        $customMessages = [
            'comment.required' => 'This field is required',
            'implementation_status_id.required' => 'This field is required',
            'full_name.required' => 'This field is required',
            'organization.required' => 'This field is required',
            'roles.required' => 'This field is required',
            'spm_school_plan_id.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $parent_data = SchoolPlan::find($request['spm_school_plan_id']);
        $parent_data->implementation_status_id = $request['implementation_status_id'];
        $parent_data->update();
         
        $child_data = [
            'user_id' => $request['user_id'],
            'spm_school_plan_id' => $parent_data->id,
            'name' => $request['full_name'],
            'role' => $request['roles'],
            'status_id' =>$request['implementation_status_id'] ,
            'organization' =>$request['organization'] ,
            'status_date' => date('Y-m-d h:i:s'),
            'remarks' => $request['comment'],
        ];
        $response = SchoolPlanHistory::create($child_data);
        
        return $this->successResponse($response);
    }
    public function getSchoolPlanDetails($spm_school_plan_id){
        $schoolPlanDetail = DB::select("SELECT t1.id,t1.org_id,t1.spm_domain_id,t2.name AS domain,t1.activity,t1.objective,t1.strategy,t1.person_responsible,t1.start_date,t1.end_date,t3.name AS implementation_status,t1.remarks FROM spm_school_plan t1 
        JOIN spm_domain t2 ON t1.spm_domain_id = t2.id 
        JOIN spm_school_plan_status t3 ON t1.implementation_status_id = t3.id WHERE t1.id = ?",[$spm_school_plan_id]);
        return $this->successResponse($schoolPlanDetail);
    }
    public function getSchoolPlanHistory($spm_school_plan_id){
        $schoolPlanHistory = DB::select("SELECT t1.user_id,t1.name,t1.role,t1.organization,t1.status_id,t2.name AS status,t1.status_date,t1.remarks FROM spm_school_plan_history
             t1 JOIN spm_school_plan_status t2 ON t1.status_id = t2.id WHERE t1.spm_school_plan_id = ? ORDER BY t1.created_at",[$spm_school_plan_id]);
        return $this->successResponse($schoolPlanHistory);
    }
    public function getDzoEMO($emo_id){
        return $this->successResponse(DB::select('SELECT dzon_id,staff_id FROM spm_dzo_emo WHERE staff_id = ?',[$emo_id]));
    }
    public function getSchoolPlans(Request $request){
        if($request->dzongkhag_ids !="" || $request->dzongkhag_ids != null){
            $response_data = DB::table('spm_school_plan')
            ->select('org_id','dzon_id')
            ->distinct()
            ->whereIn('dzon_id',explode(",",$request['dzongkhag_ids']))
            ->get();
        }else{
            $response_data = DB::table('spm_school_plan')
            ->select('org_id','dzon_id')
            ->distinct()
            ->get();
        }
        return $response_data;
    }
    public function saveAgencyInputForm(Request $request){
        $rules = [
            'name' => 'required',
            'org_division_id' => 'required',
            'year' => 'required',
            'input' => 'required',
            'activity' => 'required',
            'output' => 'required',
        ];
        $customMessages = [
            'name.required' => 'This field is required',
            'org_division_id.required' => 'This field is required',
            'year.required' => 'This field is required',
            'input.required' => 'This field is required',
            'activity.required' => 'This field is required',
            'output.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        if($request['action_type']=="add"){
            $data = [
                'org_division_id' => $request['org_division_id'],
                'input'  => $request['input'],
                'input_year'  => $request['year'],
                'activity'  => $request['activity'],
                'output'  => $request['output'],
                'created_by'  => $request['user_id']
            ];
           try{ $response = AgencyInputForm::create($data);} catch(Exception $e){
               dd($e);
           }
        }
       try{ if($request['action_type']=="edit"){
            $data = AgencyInputForm::find($request['agency_input_id']);
            $messs_det='input_year:'.$data->input_year.'; input'.$data->input.'; activity:'.$data->activity.'; output'.$data->output;
            $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','spm_agency_input','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
            $data->input_year = $request['year'];
            $data->input = $request['input'];
            $data->activity = $request['activity'];
            $data->output = $request['output'];
            $data->update();
            $response = $data;
        }}catch(Exception $e){
            dd($e);
        }
        return $this->successResponse($response);
    }
    public function getAgencyInputForm($orgId){
        $emd_id = env('EMD_ID');
        return $this->successResponse(
          DB::select("SELECT t1.id,t1.org_division_id,t2.id AS observation_id,t3.id AS action_id, t4.id AS ack_id,t1.input_year,t1.input,t2.observation,t3.action_taken,t4.acknowledgement,
                    (t2.id IS NULL AND t1.org_division_id = ?) AS can_edit_input,
                    (t3.id IS NULL AND ? = ?) AS can_edit_observation,
                    (t4.id IS NULL AND t1.org_division_id = ?) AS can_edit_action_taken,
                    (t2.id IS NULL AND ? = ?) AS can_add_observation,
                    (t2.id IS NOT NULL AND t3.id IS NULL AND t1.org_division_id = ?) AS can_add_action_taken,
                    (t3.id IS NOT NULL AND t4.id IS NULL AND t2.org_id = ?) AS can_add_acknowledgement
                FROM spm_agency_input t1 
                LEFT JOIN spm_agency_input_observation t2 ON t1.id = t2.agency_input_id 
                LEFT JOIN spm_agency_input_revision t3 ON t1.id = t3.agency_input_id AND t2.id = t3.agency_input_obs_id 
                LEFT JOIN spm_agency_input_acknowlegement t4 ON t1.id = t4.agency_input_id 
            WHERE  ? = ? OR t1.org_division_id = ? OR t2.org_id = ?",[$orgId,$emd_id,$orgId,$orgId,$emd_id,$orgId,$orgId,$orgId,$emd_id,$orgId,$orgId,$orgId])
        );
    }
    public function getAgencyInputFormDetail($agencyInputFormId,$orgId){
       try{
        $emd_id = env('EMD_ID');
        return $this->successResponse(
          DB::select("SELECT t1.id AS agency_input_id,t1.org_division_id,t2.id AS observation_id,t3.id AS action_id,t4.id AS acknowlegement_id,t2.dzon_id,t2.org_id AS school_id,t1.input_year,t1.input,t1.activity,t1.output,t2.observation,t2.recommendation,t2.recommendation_date,t3.action_taken,
            t3.action_taken_date,t4.acknowledgement
                FROM spm_agency_input t1 
                LEFT JOIN spm_agency_input_observation t2 ON t1.id = t2.agency_input_id 
                LEFT JOIN spm_agency_input_revision t3 ON t1.id = t3.agency_input_id AND t2.id = t3.agency_input_obs_id 
                LEFT JOIN spm_agency_input_acknowlegement t4 ON t1.id = t4.agency_input_id 
            WHERE t1.id = ? AND (? = ? OR t1.org_division_id = ? OR t2.org_id = ?)",[$agencyInputFormId,$emd_id,$orgId,$orgId,$orgId])
        );
    }catch(Exception $e){
        dd($e);
    }
    }
    public function saveObservationAgencyInputForm(Request $request){
        $rules = [
            'dzon_id' => 'required',
            'school_id' => 'required',
            'agency_input_id' => 'required',
            'observation' => 'required',
            'recommendation' => 'required',
            'recommendation_date' => 'required'
        ];
        $customMessages = [
            'dzon_id.required' => 'This field is required',
            'school_id.required' => 'This field is required',
            'agency_input_id.required' => 'This field is required',
            'observation.required' => 'This field is required',
            'recommendation.required' => 'This field is required',
            'recommendation_date.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        if($request['action_type']=="add"){
            $data = [
                'dzon_id' => $request['dzon_id'],
                'org_id'  => $request['school_id'],
                'agency_input_id'  => $request['agency_input_id'],
                'observation'  => $request['observation'],
                'recommendation'  => $request['recommendation'],
                'recommendation_date' => $request['recommendation_date'],
                'created_by'  => $request['user_id']
            ];
        $response = ObservationAgencyInputForm::create($data);
        } 
        if($request['action_type']=="edit"){
            $data = ObservationAgencyInputForm::find($request['observation_id']);
            $messs_det='dzon_id:'.$data->dzon_id.'; org_id'.$data->org_id.'; agency_input_id:'.$data->agency_input_id.'; observation'.$data->observation.'; recommendation'.$data->recommendation.'; recommendation_date'.$data->recommendation_date;
            $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','spm_agency_input_observation','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
            $data->dzon_id = $request['dzon_id'];
            $data->org_id = $request['school_id'];
            $data->agency_input_id = $request['agency_input_id'];
            $data->observation = $request['observation'];
            $data->recommendation = $request['recommendation'];
            $data->recommendation_date = $request['recommendation_date'];
            $data->update();
            $response = $data;
        }
        return $this->successResponse($response);
       
    }
    public function saveActionAgencyInputForm(Request $request){
        $rules = [
            'agency_input_id' => 'required',
            'agency_input_obs_id' => 'required',
            'action' => 'required',
            'action_date' => 'required',
        ];
        $customMessages = [
            'agency_input_id.required' => 'This field is required',
            'agency_input_obs_id.required' => 'This field is required',
            'action.required' => 'This field is required',
            'action_date.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        if($request['action_type']=="add"){
            $data = [
                'agency_input_id' => $request['agency_input_id'],
                'agency_input_obs_id'  => $request['agency_input_obs_id'],
                'action_taken'  => $request['action'],
                'action_taken_date'  => $request['action_date'],
                'created_by'  => $request['user_id']
            ];
        try{$response = ActionAgencyInformForm::create($data);}catch(Exception $e){
            dd($e);
        }
        } 
        if($request['action_type']=="edit"){
            $data = ActionAgencyInformForm::find($request['action_id']);
            $messs_det='agency_input_id:'.$data->agency_input_id.'; agency_input_obs_id'.$data->agency_input_obs_id.'; action_taken'.$data->action_taken.'; action_taken_date'.$data->action_taken_date;
            $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','spm_agency_input_revision','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
            $data->agency_input_id = $request['agency_input_id'];
            $data->agency_input_obs_id = $request['agency_input_obs_id'];
            $data->action_taken = $request['action'];
            $data->action_taken_date = $request['action_date'];
            $data->update();
            $response = $data;
        }
        return $this->successResponse($response);
    }
    public function saveAcknowlegeAgencyInputForm(Request $request){
        $rules = [
            'agency_input_id' => 'required',
            'school_id' => 'required',
            'acknowledgement' => 'required',
        ];
        $customMessages = [
            'agency_input_id.required' => 'This field is required',
            'school_id.required' => 'This field is required',
            'acknowledgement.required' => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        if($request['action_type']=="add"){
            $data = [
                'agency_input_id' => $request['agency_input_id'],
                'org_id'  => $request['school_id'],
                'acknowledgement'  => $request['acknowledgement'],
                'created_by'  => $request['user_id']
            ];
        try{$response = AcknowledgementAgencyInformForm::create($data);}catch(Exception $e){
            dd($e);
        }
        } 
        if($request['action_type']=="edit"){
            $data = AcknowledgementAgencyInformForm::find($request['acknowlegement_id']);
            $messs_det='agency_input_id:'.$data->agency_input_id.'; org_id'.$data->org_id.'; acknowledgement'.$data->acknowledgement;
            $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','spm_agency_input_acknowlegement','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
            $data->agency_input_id = $request['agency_input_id'];
            $data->org_id = $request['school_id'];
            $data->acknowledgement = $request['acknowledgement'];
            $data->update();
            $response = $data;
        }
        return $this->successResponse($response);
    }

}
