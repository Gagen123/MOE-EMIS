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
    public function getTaskList($type="",$user_id="",$param=""){
        $result_data='SELECT t.access_level,t.application_number,t.claimed_by,t.remarks,t.screen_id,t.service_name,t.status_id,t.table_name,t.user_dzo_id,t.working_agency_id,t.last_action_by,t.last_action_date FROM task_details t WHERE ';
        $param=explode('OUTSEP',$param);
        if($type=="common"){
            $result_data.=' t.claimed_by IS NULL AND '; 
            for($i=0;$i<sizeof($param)-1;$i++){
                if(sizeof($param)-2==$i){
                    $result_data.='t.screen_id="'.explode('SSS',$param[$i])[0].'" AND t.status_id='.explode('SSS',$param[$i])[1]; 
                } 
                else{ 
                    $result_data.='t.screen_id="'.explode('SSS',$param[$i])[0].'" AND t.status_id='.explode('SSS',$param[$i])[1].' OR '; 
                }  
            }
            return DB::select($result_data);
        }
        if($type=="own"){
            $result_data.='t.claimed_by="'.$user_id.'"'; 
            return DB::select($result_data);
        }
    }

    public function getDzoNameById($id=""){
        return Dzongkhag::where('id',$id)->first();
    }
    public function getGewogNameById($id=""){
        return Gewog::where('id',$id)->first();
    }
    
    
    
}
