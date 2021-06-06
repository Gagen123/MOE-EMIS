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
    public function getTaskList(Request $request){
        $data =[
            'access_level'          =>  $request->access_level,
            'work_status'           =>  $request->work_status,
            'org'                   =>  $request->org,
            'dzongkhag'             =>  $request->dzongkhag,
            'user_id'               =>  $request->user_id,
            'type'                  =>  $request->type,
        ];
        $access_level=$data['access_level'];
        $dzo_id=$data['dzongkhag'];
        $org_id=$data['org'];
        $screen_status=$data['work_status'];
        $type=$data['type'];
        $user_id=$data['user_id'];
        $response_data=[];
        // dd($screen_status);
        $result_data='SELECT t.access_level,t.application_number,t.claimed_by,t.remarks,t.name,t.screen_id,t.service_name,t.status_id,t.table_name,t.user_dzo_id,t.working_agency_id,t.created_by,t.applied_on,t.last_action_by,t.last_action_date FROM task_details t WHERE ';
        
        if($type=="common" || $type=="commonLeaveOthers"){
            if(strtolower($access_level)=="dzongkhag"){
                $result_data.=' t.user_dzo_id='.$dzo_id.' AND ';
            }
            if(strtolower($access_level)=="org"){
                $result_data.='t.working_agency_id="'.$org_id.'" AND ';
            }
            $result_data.=' t.claimed_by IS NULL'; 
            // for($i=0;$i<sizeof($param)-1;$i++){
            //     if($type=="commonLeaveOthers"){
            //         if(sizeof($param)-2==$i){
            //             $result_data.='( t.application_number like "L%" AND t.record_type_id="'.explode('SSS',$param[$i])[2].'" AND t.app_role_id="'.explode('SSS',$param[$i])[3].'" AND t.status_id='.explode('SSS',$param[$i])[1].'))';  
            //         } 
            //         else{ 
            //             $result_data.='( t.application_number like "L%" AND t.record_type_id="'.explode('SSS',$param[$i])[2].'" AND t.app_role_id="'.explode('SSS',$param[$i])[3].'" AND t.status_id='.explode('SSS',$param[$i])[1].') OR '; 
            //         } 
            //     }else{
            //         if(sizeof($param)-2==$i){
            //             $result_data.='( t.screen_id="'.explode('SSS',$param[$i])[0].'" AND t.status_id='.explode('SSS',$param[$i])[1].'))'; 
            //         } 
            //         else{ 
            //             $result_data.='( t.screen_id="'.explode('SSS',$param[$i])[0].'" AND t.status_id='.explode('SSS',$param[$i])[1].') OR '; 
            //         } 
            //     }
            // }
            if($screen_status!="" && sizeof($screen_status)>0){
                $result_data.=' AND ('; 
                if($type=="commonLeaveOthers"){
                    foreach($screen_status as $i => $srcn){
                        $result_data.='( t.application_number like "L%" AND t.record_type_id="'.$srcn['leave_type_id'].'" AND t.app_role_id="'.$srcn['submitter_role_id'].'" AND t.status_id='.$srcn['sequence'].')';  
                        if(sizeof($screen_status)-1==$i){
                            $result_data.=')'; 
                        } 
                        else{ 
                            $result_data.=' OR '; 
                        } 
                    }
                    $response_data=DB::select($result_data);;
                }else{
                    foreach($screen_status as $i => $srcn){
                        return $srcn['Establishment_type'];
                        if(isset($srcn['Establishment_type'])){
                            $result_data.='( t.screen_id="'.$srcn['SysSubModuleId'].'"  AND t.status_id='.($srcn['Sequence']-1).') '; 
                            // $result_data.='( t.screen_id="'.$srcn['SysSubModuleId'].'" AND LOWER(t.service_name)="'.str_replace('_',' ',$srcn['Establishment_type']).'" AND t.status_id='.($srcn['Sequence']-1).') OR '; 
                            // $result_data.='( t.screen_id="'.$srcn['SysSubModuleId'].'" AND LOWER(t.service_name)="'.$srcn['Establishment_type'].'" AND t.name IN ("Change in Name","Upgrade Downgrade","Expansion","Change in Feeding Details","Change in Location Type","Change in SEN details","Change in Autonomous","Closure","Merger","Bifurcation","Re-Opening","Change in Fees","Change in Stream") AND t.status_id='.($srcn['Sequence']-1).')'; 
                            if(sizeof($screen_status)-1==$i){
                                $result_data.=')'; 
                            } 
                            else{ 
                                $result_data.=' OR '; 
                            } 
                        }
                    }
                    return $result_data;
                    $response_data=DB::select($result_data);
                }
            }
            return $response_data;
        }
        
        if($type=="own"){
            $result_data.='t.claimed_by="'.$user_id.'"'; 
            if(strtolower($access_level)=="dzongkhag"){
                $result_data.=' AND t.user_dzo_id="'.$dzo_id.'"';
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
