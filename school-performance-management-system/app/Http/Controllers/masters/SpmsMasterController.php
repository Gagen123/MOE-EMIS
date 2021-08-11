<?php

namespace App\Http\Controllers\masters;

use App\Http\Controllers\Controller;
use App\Models\masters\Area;
use App\Models\masters\Domain;
use App\Models\masters\DzongkhagEMO;
use App\Models\masters\Indicator;
use App\Models\masters\Parameter;
use App\Models\masters\Rating;
use App\Models\masters\SchoolDEO;
use App\Traits\ApiResponser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SpmsMasterController extends Controller
{
    use ApiResponser;

    public $audit_table="system_db";

    public $database="spms_db";
    
    public function saveSpmMasters(Request $request){
        if($request['record_type'] == 'domain') {
            if($request['action_type'] =="add"){
                $rules = [
                    'spm_domain_category_id' =>'required',
                    'name' =>'required|unique:spm_domain',
                    'status' =>  'required',
                    'sequence_no' =>  'required'
                ];
                $customMessages = [
                    'spm_domain_category_id.required' => 'This field is required',
                    'name.required' => 'This field is required',
                    'status.required' => 'This field is required',
                    'sequence_no.required' => 'This field is required',
                ];
           
                $this->validate($request, $rules, $customMessages);
                $data = [
                    'spm_domain_category_id' => $request['spm_domain_category_id'],
                    'name' => $request['name'],
                    'sequence_no' => $request['sequence_no'],
                    'status'    =>  $request['status'],
                    'created_by' =>  $request['user_id'],
                ];
              $responsedata= Domain::create($data);
            }
            if($request['action_type']=="edit"){
                $rules = [
                    'spm_domain_category_id' =>'required',
                    'sequence_no' =>  'required',
                    'status' =>  'required',
                    'name' =>'required',
                    'status' =>  'required',
                ];
                $customMessages = [
                    'spm_domain_category_id.required' => 'This field is required',
                    'name.required' => 'This field is required',
                    'status.required' => 'This field is required',
                    'sequence_no.required' => 'This field is required',
                ];
                
                $this->validate($request, $rules,  $customMessages);
                $data = Domain::find($request['id']);
                $messs_det='sequence_no:'.$data->sequence_no.'spm_domain_category_id:'.$data->spm_domain_category_id.'name:'.$data->name.'; status'.$data->status;
                $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','spm_domain','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
                $data->sequence_no = $request['sequence_no'];
                $data->spm_domain_category_id = $request['spm_domain_category_id'];
                $data->name = $request['name'];
                $data->status = $request['status'];
                $data->update();
                $responsedata = $data;
            }
        }
        if($request['record_type'] == 'area') {
            if($request['action_type'] =="add"){
                $rules = [
                    'sequence_no' =>  'required',
                    'name' =>'required|unique:spm_area',
                    'spm_domain_id' =>'required',
                    'status' =>  'required',
                ];
                $customMessages = [
                    'sequence_no.required' => 'This field is required',
                    'spm_domain_id.required'   => 'This field is required',
                    'name.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                $this->validate($request, $rules, $customMessages);
                $data = [
                    'id' => $request['id'],
                    'name' => $request['name'],
                    'sequence_no' => $request['sequence_no'],
                    'spm_domain_id' => $request['spm_domain_id'],
                    'status'    =>  $request['status'],
                    'created_by' =>  $request['user_id'],
                ];
              $responsedata= Area::create($data);
            }
            if($request['action_type']=="edit"){
                $rules = [
                    'sequence_no' =>  'required',
                    'name' =>'required',
                    'spm_domain_id' =>'required',
                    'status' =>  'required',
                ];
                $customMessages = [
                    'sequence_no.required' => 'This field is required',
                    'spm_domain_id.required'   => 'This field is required',
                    'name.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                
                $this->validate($request, $rules,  $customMessages);
                $data = Area::find($request['id']);
                $messs_det='sequence_no:'.$data->sequence_no.'name:'.$data->name.'; spm_domain_id:'.$data->spm_domain_id.'; status'.$data->status;
                $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','spm_area','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
                $data->name = $request['name'];
                $data->sequence_no = $request['sequence_no'];
                $data->spm_domain_id = $request['spm_domain_id'];
                $data->status = $request['status'];
                $data->update();
                $responsedata = $data;
            }
        }
        if($request['record_type'] == 'parameter') {
            if($request['action_type'] =="add"){
                $rules = [
                    'sequence_no' =>  'required',
                    'name' =>'required|unique:spm_parameter',
                    'spm_area_id' =>'required',
                    'status' =>  'required',
                ];
                $customMessages = [
                    'sequence_no.required' => 'This field is required',
                    'spm_area_id.required'   => 'This field is required',
                    'name.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                $this->validate($request, $rules, $customMessages);
                $data = [
                    'sequence_no' => $request['sequence_no'],
                    'name' => $request['name'],
                    'spm_area_id' => $request['spm_area_id'],
                    'status'    =>  $request['status'],
                    'created_by' =>  $request['user_id'],
                ];
              $responsedata= Parameter::create($data);
            }
            if($request['action_type']=="edit"){
                $rules = [
                    'sequence_no' =>  'required',
                    'name' =>'required',
                    'spm_area_id' =>'required',
                    'status' =>  'required',
                ];
                $customMessages = [
                    'sequence_no.required' => 'This field is required',
                    'spm_area_id.required'   => 'This field is required',
                    'name.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                
                $this->validate($request, $rules,  $customMessages);
            try{    $data = Parameter::find($request['id']);
                $messs_det='sequence_no:'.$data->sequence_no.'name:'.$data->name.'; spm_area_id:'.$data->spm_area_id.'; status'.$data->status;
                $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','spm_parameter','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
                $data->sequence_no = $request['sequence_no'];
                $data->name = $request['name'];
                $data->spm_area_id = $request['spm_area_id'];
                $data->status = $request['status'];
                $data->update();
                $responsedata = $data;
            }catch(Exception $e){
                dd($e);
            }
            }
        }
        if($request['record_type'] == 'indicator') {
            if($request['action_type'] =="add"){
                $rules = [
                    'sequence_no' =>  'required',
                    'name' =>'required|unique:spm_indicator',
                    'spm_parameter_id' =>'required',
                    'status' =>  'required',
                ];
                $customMessages = [
                    'sequence_no.required' => 'This field is required',
                    'spm_parameter_id.required'   => 'This field is required',
                    'name.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                $this->validate($request, $rules, $customMessages);
                $data = [
                    'sequence_no' => $request['sequence_no'],
                    'name' => $request['name'],
                    'spm_parameter_id' => $request['spm_parameter_id'],
                    'status'    =>  $request['status'],
                    'created_by' =>  $request['user_id'],
                ];
              $responsedata= Indicator::create($data);
            }
            if($request['action_type']=="edit"){
                $rules = [
                    'sequence_no' =>  'required',
                    'name' =>'required',
                    'spm_parameter_id' =>'required',
                    'status' =>  'required',
                ];
                $customMessages = [
                    'sequence_no.required' => 'This field is required',
                    'spm_parameter_id.required'   => 'This field is required',
                    'name.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                
               $this->validate($request, $rules,  $customMessages);
                $data = Indicator::find($request['id']);
                $messs_det='sequence_no:'.$data->sequence_no.'name:'.$data->name.'; spm_parameter_id:'.$data->spm_parameter_id.'; status'.$data->status;
                $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','spm_indicator','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
                $data->sequence_no = $request['sequence_no'];
                $data->name = $request['name'];
                $data->spm_parameter_id = $request['spm_parameter_id'];
                $data->status = $request['status'];
                $data->update();
                $responsedata = $data;
            }
        }
        if($request['record_type'] == 'rating') {
            if($request['action_type'] =="add"){
                $rules = [
                    'score' =>'required',
                    'description' =>'required',
                    'spm_indicator_id' =>'required',
                    'status' =>  'required',
                ];
                $customMessages = [
                    'spm_indicator_id.required'   => 'This field is required',
                    'description.required'   => 'This field is required',
                    'score.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                $this->validate($request, $rules, $customMessages);
                $data = [
                    'score' => $request['score'],
                    'description' => $request['description'],
                    'spm_indicator_id' => $request['spm_indicator_id'],
                    'status'    =>  $request['status'],
                    'created_by' =>  $request['user_id'],
                ];
              $responsedata= Rating::create($data);
            }
            if($request['action_type']=="edit"){
                $rules = [
                    'score' =>'required',
                    'description' =>'required',
                    'spm_indicator_id' =>'required',
                    'status' =>  'required',
                ];
                $customMessages = [
                    'spm_indicator_id.required'   => 'This field is required',
                    'description.required'   => 'This field is required',
                    'score.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                
                $this->validate($request, $rules,  $customMessages);
                $data = Rating::find($request['id']);
                $messs_det='score:'.$data->score.'; description'.$data->description.'; spm_indicator_id:'.$data->spm_indicator_id.'; status'.$data->status;
                $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','spm_rating','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
                $data->score = $request['score'];
                $data->description = $request['description'];
                $data->spm_indicator_id = $request['spm_indicator_id'];
                $data->status = $request['status'];
                $data->update();
                $responsedata = $data;
            }
        }
        return $this->successResponse($responsedata, Response::HTTP_CREATED);
    }
    public function loadSpmMasters($param=""){
        if($param == "domain_category"){
            $domains_category = DB::select('SELECT id, name FROM spm_domain_category');
            return $this->successResponse($domains_category);
        }
        if($param == "all_domains"){
            $domains = DB::select('SELECT t1.sequence_no,t1.spm_domain_category_id,t1.id,t1.name,t2.name AS domain_category,t1.status FROM spm_domain t1 JOIN spm_domain_category t2 ON t1.spm_domain_category_id = t2.id');
            return $this->successResponse($domains);
        }
        if($param == "all_active_domains"){
            $domains = DB::select('SELECT sequence_no,id,name,status FROM spm_domain WHERE status = 1');
            return $this->successResponse($domains);
        }
        if($param == "all_areas"){
            $domains = DB::select("SELECT t1.sequence_no,CONCAT(t2.sequence_no,'.',t1.sequence_no) AS display_sequence_no,t1.id,t1.name,t1.status,t1.spm_domain_id,t2.name AS domain FROM spm_area t1 JOIN spm_domain t2 ON t1.spm_domain_id = t2.id");
            return $this->successResponse($domains);
        }
        if($param == "all_active_areas"){
            $domains = DB::select('SELECT sequence_no,id,spm_domain_id, name AS area,status FROM spm_area WHERE status = 1');
            return $this->successResponse($domains);
        }
        if(strpos($param,'all_active_areas_')!== false){
            $params=explode("_",$param);  
            $areas = DB::select('SELECT t1.sequence_no,t1.id,t1.name,t1.status,t1.spm_domain_id,t2.name AS domain FROM spm_area t1 JOIN spm_domain t2 ON t1.spm_domain_id = t2.id WHERE t1.status = 1 AND t1.spm_domain_id = ?',[$params[3]]);
            return $this->successResponse($areas);
        }
        if($param == "all_parameters"){
            $paramaters = DB::select("SELECT t1.sequence_no,CONCAT(t3.sequence_no,'.',t2.sequence_no,'.',t1.sequence_no) AS display_sequence_no,t1.id,t1.name,t1.status,t1.spm_area_id,t2.spm_domain_id,t3.name as domain,t2.name AS area FROM spm_parameter t1 JOIN spm_area t2 ON t1.spm_area_id = t2.id JOIN spm_domain t3 ON t2.spm_domain_id = t3.id");
            return $this->successResponse($paramaters);
        }
        if($param == "all_active_parameters"){
            $paramaters = DB::select('SELECT sequence_no,id,spm_area_id, name AS parameter,status FROM spm_parameter WHERE status = 1');
            return $this->successResponse($paramaters);
        }
        if(strpos($param,'all_active_parameters_')!== false){
            $params=explode("_",$param);  
            $paramaters = DB::select('SELECT t1.sequence_no,t1.id,t1.name,t1.status,t1.spm_area_id,t2.name AS area FROM spm_parameter t1 JOIN spm_area t2 ON t1.spm_area_id = t2.id WHERE t1.status = 1 AND t1.spm_area_id = ?',[$params[3]]);
            return $this->successResponse($paramaters);
        }
        if($param == "all_indicators"){
            $indicators = DB::select("SELECT t1.sequence_no,CONCAT(t4.sequence_no,'.',t3.sequence_no,'.',t2.sequence_no,'.',t1.sequence_no) AS display_sequence_no,t1.id,t3.spm_domain_id,t2.spm_area_id,t1.spm_parameter_id,t4.name AS domain,t3.name AS area,t2.name AS parameter,t1.name,t1.status FROM spm_indicator t1 
                    JOIN spm_parameter t2 ON t1.spm_parameter_id = t2.id 
                    JOIN spm_area t3 ON t2.spm_area_id = t3.id JOIN spm_domain t4 ON t3.spm_domain_id= t4.id");
            return $this->successResponse($indicators);
        }
        if(strpos($param,'all_active_indicators_')!== false){
            $params=explode("_",$param);  
            $indicators = DB::select('SELECT t1.sequence_no,t1.id,t3.spm_domain_id,t2.spm_area_id,t1.spm_parameter_id,t4.name AS domain,t3.name AS area,t2.name AS parameter,t1.name,t1.status FROM spm_indicator t1 
            JOIN spm_parameter t2 ON t1.spm_parameter_id = t2.id 
            JOIN spm_area t3 ON t2.spm_area_id = t3.id JOIN spm_domain t4 ON t3.spm_domain_id= t4.id WHERE t1.status = 1 AND t1.spm_parameter_id = ?',[$params[3]]);
            return $this->successResponse($indicators);
        }
        if($param == "all_ratings"){
                $ratings = DB::select('SELECT t1.id,t1.score,t1.description,t1.status,t1.spm_indicator_id,t2.spm_parameter_id,
                t3.spm_area_id,t4.spm_domain_id,t5.name AS domain,t4.name AS area, t3.name AS parameter,t2.name AS indicator FROM  spm_rating t1 
                JOIN spm_indicator t2 ON t1.spm_indicator_id = t2.id 
                JOIN spm_parameter t3 ON t2.spm_parameter_id = t3.id 
                JOIN spm_area t4 ON t3.spm_area_id = t4.id 
                JOIN spm_domain t5 ON t4.spm_domain_id = t5.id ORDER BY t1.score');
            return $this->successResponse($ratings);
        }
        if($param =='all_active_ratings'){
            $ratings = DB::select('SELECT t1.id,t1.score,t1.description,t1.status,t1.spm_indicator_id,t2.spm_parameter_id,
                    t3.spm_area_id,t4.spm_domain_id,t5.name AS domain,t4.name AS area, t3.name AS parameter,t2.name AS indicator FROM  spm_rating t1 
                    JOIN spm_indicator t2 ON t1.spm_indicator_id = t2.id 
                    JOIN spm_parameter t3 ON t2.spm_parameter_id = t3.id 
                    JOIN spm_area t4 ON t3.spm_area_id = t4.id JOIN spm_domain t5 ON t4.spm_domain_id = t5.id 
             WHERE t1.status = 1 ORDER BY t1.score');
            return $this->successResponse($ratings);
        }
    }
    public function saveDzoEMO(Request $request){
        $rules = [
            'data.*.staff_id' => 'required',
            'data.*.dzon_id' => 'required'

        ];
        $customMessages = [
            'data.*.staff_id.required' => 'This field is required',
            'data.*.dzon_id.required' => 'This field is required'
        ];
        $this->validate($request, $rules, $customMessages);
        DB::transaction(function() use($request) {
            $query = 'DELETE FROM spm_dzo_emo WHERE dzon_id = ?';
            DB::delete($query, [$request['data'][0]['dzon_id']]);
            $data = [];
            foreach($request['data'] as $dzoEMO){
                $data['dzon_id'] = $dzoEMO['dzon_id'];
                $data['staff_id'] = $dzoEMO['staff_id'];
                $data['created_by'] =  $request['user_id'];
                $data['created_at'] =   date('Y-m-d h:i:s');
                DzongkhagEMO::create($data);
            }
        });
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    public function getDzoEMO(){
        return $this->successResponse(DB::select('SELECT dzon_id,staff_id FROM spm_dzo_emo'));
    }
    public function saveSchoolDEO(Request $request){
        $rules = [
            'dzon_id' => 'required',
            'data.*.staff_id' => 'required',
            'data.*.school_id' => 'required'

        ];
        $customMessages = [
            'data.*.staff_id.required' => 'This field is required',
            'data.*.school_id.required' => 'This field is required',
            'dzon_id.required' => 'This field is required',

        ];
        $this->validate($request, $rules, $customMessages);
       try{ DB::transaction(function() use($request) {
            // $this->updateClassTeacher($request);
            $query = 'DELETE FROM spm_school_deo WHERE dzon_id = ?';
            DB::delete($query, [$request['dzon_id']]);
            $data = [];
            foreach($request['data'] as $dzoEMO){
                $data['org_id'] = $dzoEMO['school_id'];
                $data['staff_id'] = $dzoEMO['staff_id'];
                $data['dzon_id'] = $request['dzon_id'];
                $data['created_by'] =  $request['user_id'];
                $data['created_at'] =   date('Y-m-d h:i:s');
                SchoolDEO::create($data);
            }
        });
    }catch(Exception $e){
        dd($e);
    }
        return $this->successResponse(1, Response::HTTP_CREATED);
    }
    public function getSchoolDEO(){
        return $this->successResponse(DB::select('SELECT org_id,dzon_id,staff_id FROM spm_school_deo'));
    }
}
