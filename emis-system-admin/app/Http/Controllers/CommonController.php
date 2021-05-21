<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Workflow;
use App\Models\TaskDetails;
use App\Models\global_masters\Dzongkhag;
use App\Models\global_masters\Gewog;

class CommonController extends Controller{
    use ApiResponser;
    public $database="emis_system_admin";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function getApplicationDetials($applicationId=""){
        return Workflow::where('application_number',$applicationId)->get();
    }
    public function getTaskDetials($applicationId=""){
        return TaskDetails::where('application_number',$applicationId)->first();
    }
    public function getTaskList($type="",$user_id="",$param="",$param2=""){
        $result_data='SELECT t.access_level,t.application_number,t.claimed_by,t.remarks,t.screen_id,t.service_name,t.status_id,t.table_name,t.user_dzo_id,t.working_agency_id,t.created_by,t.applied_on,t.last_action_by,t.last_action_date FROM task_details t WHERE ';
        $param=explode('OUTSEP',$param);
        $access_level=explode('SSS',$param2)[0];
        if($type=="common" || $type=="commonLeaveOthers"){
            if(strtolower($access_level)=="dzongkhag"){
                $result_data.=' t.user_dzo_id='.explode('SSS',$param2)[1].' AND ';
            }
            if(strtolower($access_level)=="org"){
                $result_data.='t.working_agency_id="'.explode('SSS',$param2)[2].'" AND ';
            }
            $result_data.=' t.claimed_by IS NULL AND ('; 
            for($i=0;$i<sizeof($param)-1;$i++){
                if($type=="commonLeaveOthers"){
                    if(sizeof($param)-2==$i){
                        $result_data.='( t.application_number like "L%" AND t.record_type_id="'.explode('SSS',$param[$i])[2].'" AND t.app_role_id="'.explode('SSS',$param[$i])[3].'" AND t.status_id='.explode('SSS',$param[$i])[1].'))';  
                    } 
                    else{ 
                        $result_data.='( t.application_number like "L%" AND t.record_type_id="'.explode('SSS',$param[$i])[2].'" AND t.app_role_id="'.explode('SSS',$param[$i])[3].'" AND t.status_id='.explode('SSS',$param[$i])[1].') OR '; 
                    } 
                }else{
                    if(sizeof($param)-2==$i){
                        $result_data.='( t.screen_id="'.explode('SSS',$param[$i])[0].'" AND t.status_id='.explode('SSS',$param[$i])[1].'))'; 
                    } 
                    else{ 
                        $result_data.='( t.screen_id="'.explode('SSS',$param[$i])[0].'" AND t.status_id='.explode('SSS',$param[$i])[1].') OR '; 
                    } 
                }
            }
            // return $result_data;
            return DB::select($result_data);
        }
        
        if($type=="own"){
            $result_data.='t.claimed_by="'.$user_id.'"'; 
            if(strtolower($access_level)=="dzongkhag"){
                $result_data.=' AND t.user_dzo_id="'.explode('SSS',$param2)[1].'"';
            }
            return DB::select($result_data);
        }
    }
    
    public function releaseApplication($application_number=""){
        $update_data=[
            'claimed_by'     =>  null,
        ];
        $response_data=TaskDetails::where('application_number', $application_number)->update($update_data);
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function getDzoNameById($id=""){
        return Dzongkhag::where('id',$id)->first();
    }
    public function getGewogNameById($id=""){
        return Gewog::where('id',$id)->first();
    }
    
    public function checkPendingApplication($type="",$user_id=""){
        $response_data="";
        if($type=="establishment"){
            $response_data=TaskDetails::where('service_name', 'New Establishment')->where('created_by', $user_id)->whereNotIn('status_id', [0,3])->first();
        }
        if($type=="change"){
            $response_data=TaskDetails::where('service_name', 'Change Basic Details')->where('created_by', $user_id)->whereNotIn('status_id', [0,3])->where('created_by', $user_id)->first();
        }
        if($type=="closure"){
            $response_data=TaskDetails::where('service_name', 'Closure')->where('created_by', $user_id)->whereNotIn('status_id', [0,3])->where('created_by', $user_id)->first();
        }
        if($type=="bifurcation"){
            $response_data=TaskDetails::where('service_name', 'Bifurcation')->where('created_by', $user_id)->whereNotIn('status_id', [0,3])->where('created_by', $user_id)->first();
        }
        if($type=="merger"){
            $response_data=TaskDetails::where('service_name', 'Merger')->where('created_by', $user_id)->whereNotIn('status_id', [0,3])->where('created_by', $user_id)->first();
        }
        return $response_data;
    }
    
    
}
