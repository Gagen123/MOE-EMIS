<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        return Workflow::orderBy('action_date', 'ASC')->where('application_number',$applicationId)->get();
    }
    public function getTaskDetials($applicationId=""){
        return TaskDetails::where('application_number',$applicationId)->first();
    }
    public function getTaskList(Request $request){
        $data =[
            'access_level'              =>  $request->access_level,
            'work_status'               =>  $request->work_status,
            'org'                       =>  $request->org,
            'leave_config_data'         =>  $request->leave_config_data,
            'leadership_config_data'    =>  $request->leadership_config_data,
            'approved_transfer_data'    =>  $request->approved_transfer_data,
            'dzongkhag'                 =>  $request->dzongkhag,
            'user_id'                   =>  $request->user_id,
            'type'                      =>  $request->type,
        ];

        $access_level=$data['access_level'];
        $dzo_id=$data['dzongkhag'];
        $org_id=$data['org'];
        $work_flow_from_system_admin_status=$data['work_status'];
        $work_flow_for_leave=$data['leave_config_data'];
        $work_flow_for_leadership=$data['leadership_config_data'];
        $work_flow_for_transfer=$request->tr_config_data;
        // return $request->tr_config_data;
        $type=$data['type'];
        $user_id=$data['user_id'];
        $result_data='SELECT t.access_level,t.application_number,t.claimed_by,t.remarks,t.name,t.screen_id,t.service_name,t.status_id,t.table_name,t.user_dzo_id,t.working_agency_id,t.created_by,t.applied_on,t.last_action_by,t.last_action_date FROM task_details t WHERE ';

        if($type=="own"){
            $result_data.='t.claimed_by="'.$user_id.'"';
            if(strtolower($access_level)=="dzongkhag"){
                $result_data.=' AND t.user_dzo_id="'.$dzo_id.'"';
            }
            return DB::select($result_data);
        }
        else{
            $result_data.=' t.claimed_by IS NULL AND ';

            if(strtolower($access_level)=="dzongkhag"){
                $result_data.=' t.user_dzo_id='.$dzo_id.' AND ';
            }

            if(strtolower($access_level)=="org"){
                $result_data.='t.working_agency_id="'.$org_id.'" AND ';
            }

            //pulling workflow set up from system administration such as org approval and change detials etc..
            if($work_flow_from_system_admin_status!=""){
                $result_data.=' (';
                foreach($work_flow_from_system_admin_status as $i => $srcn){
                    $result_data.='( t.screen_id="'.$srcn['SysSubModuleId'].'"  AND t.status_id='.($srcn['Sequence']-1).') ';
                    if(sizeof($work_flow_from_system_admin_status)-1==$i){
                        $result_data.=')';
                    }
                    else{
                        $result_data.=' OR ';
                    }
                }
                //show to deo for notification, once updates at eccd
                if(strtolower($access_level)=="dzongkhag"){
                    $result_data.='OR (( t.service_name = "Establishment of New ECCD Centre" OR  t.service_name = "New Private School" OR  t.service_name = "New Public School")
                    AND t.status_id NOT IN(1,5) AND IFNULL(t.claimed_by IS NULL, t.claimed_by <> "'.$user_id.'") ) ';
                }
            }
            //pulling leave application
            if($work_flow_for_leave!=""){
                if($work_flow_from_system_admin_status==null || $work_flow_from_system_admin_status==""){
                    $result_data.='(';
                }
                else{
                    $result_data.=' OR (';
                }
                foreach($work_flow_for_leave as $i => $srcn){
                    $result_data.='( t.application_number like "L%" AND t.record_type_id="'.$srcn['leave_type_id'].'" AND t.app_role_id="'.$srcn['submitter_role_id'].'" AND t.status_id='.$srcn['sequence'].')';
                    if(sizeof($work_flow_for_leave)-1==$i){
                        $result_data.=')';
                    }
                    else{
                        $result_data.=' OR ';
                    }
                }
            }

            //pulling application for the leadership selection
            if($work_flow_for_leadership=="Valid"){
                if(Str::endsWith($result_data, 'AND ')){
                        $result_data.=' (t.application_number like "STF_REC%"  AND t.status_id=1 )';
                }else{
                        $result_data.=' OR (t.application_number like "STF_REC%"  AND t.status_id=1 )';
                }
            }

            // return $work_flow_for_transfer;
            //This query is for organization level during the transfer process
            if(strtolower($access_level)=="org"){
                if($work_flow_for_transfer!=""){
                    $result_data.='OR (';
                    foreach($work_flow_for_transfer as $i => $srcn){
                        $result_data.='((t.application_number like "TR%" OR t.application_number like "TRA%") AND t.record_type_id="'.$srcn['transfer_type_id'].'" AND t.app_role_id="'.$srcn['submitter_role_id'].'" AND t.status_id='.$srcn['sequence'].')';
                        if(sizeof($work_flow_for_transfer)-1==$i){
                            $result_data.=')';
                        }
                        else{
                            $result_data.='  OR ';
                        }
                    }
                }
            }
            //This query is for dzongkhag level during the transfer process
            else if(strtolower($access_level)=="dzongkhag"){
                if($work_flow_for_transfer!=""){
                    $result_data.='OR(';
                    foreach($work_flow_for_transfer as $i => $srcn){
                        $result_data.='((t.application_number like "TR%" OR t.application_number like "TRA%") AND t.record_type_id="'.$srcn['transfer_type_id'].'" AND t.app_role_id="'.$srcn['submitter_role_id'].'" AND t.status_id='.$srcn['sequence'].')';
                        if(sizeof($work_flow_for_transfer)-1==$i){
                            $result_data.=')';
                        }
                        else{
                            $result_data.='  OR ';
                        }
                    }
                }

            }
             //This query is for Ministry level during the transfer process
            else if(strtolower($access_level)=="ministry"){
                if($work_flow_for_transfer!=""){
                    $result_data.='(';
                    foreach($work_flow_for_transfer as $i => $srcn){
                        $result_data.='((t.application_number like "TR%" OR t.application_number like "TRA%") AND t.record_type_id="'.$srcn['transfer_type_id'].'" AND t.app_role_id="'.$srcn['submitter_role_id'].'" AND t.status_id='.$srcn['sequence'].')';
                        if(sizeof($work_flow_for_transfer)-1==$i){
                            $result_data.=')';
                        }
                        else{
                            $result_data.='  OR ';
                        }
                    }
                }

            }

            //pulling approved transfer Application for DEO
            if($request->approved_transfer_data=="Valid"){
                $result_data.=' OR (t.claimed_by IS NULL AND t.application_number like "TR%"  AND t.status_id=10 AND t.service_name = "Inter Transfer")';
            }
            //final query
            // return $result_data;
            return DB::select($result_data);
        }
    }

    public function getNotification($role_ids="",$user_id=""){
        $roles='"'.$role_ids.'"';
        if(strpos($role_ids,',')!==false){
            $roles='"'.str_replace(',','","',$role_ids).'"';
        }
        $result_data='SELECT d.id,d.call_back_link,d.notification_for,d.notification_appNo,d.notification_message,d.notification_type,d.created_at,t.id AS notification_to_id,t.user_role_id FROM notification_to t LEFT JOIN notification_details d ON t.notification_id=d.id LEFT JOIN notification_visited v ON v.notification_id=d.id WHERE ';
        $result_data.=' IF(v.user_id <> NULL,v.user_id <>"'.$user_id.'",v.user_id IS NULL) AND IF(d.notification_type="role", t.user_role_id IN('.$roles.'),t.user_role_id="'.$user_id.'") GROUP BY d.id';
        // return $result_data;
        return DB::select($result_data);
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
