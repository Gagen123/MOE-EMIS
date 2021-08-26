<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Workflow;
use App\Models\TaskDetails;
use  App\Models\Notification;
use App\Models\NotificationAudit;
use  App\Models\NotificationTo;
use App\Models\NotificationToAudit;
use App\Models\NotificationVisited;

class WorkflowController extends Controller{
    use ApiResponser;
    public $database="emis_system_admin";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function insertWorkflow(Request $request) {
        $rules =[
            'table_name'            => 'required',
            'application_number'    => 'required',
            'screen_id'             => 'required',
            'status_id'             => 'required',
            'action_by'             => 'required',
        ];
        $this->validate($request, $rules);
        $data=[
            'database_name'         =>$request->db_name,
            'table_name'            =>$request->table_name,
            'service_name'          =>$request->service_name,
            'application_number'    =>$request->application_number,
            'screen_id'             =>$request->screen_id,
            'status_id'             =>$request->status_id,
            'w_config_status'       =>$request->w_config_status,
            'remarks'               =>$request->remarks,
            'action_by'             =>$request->action_by,
            'action_date'           =>date('Y-m-d h:i:s'),
        ];
        $workflowdetails = Workflow::create($data);

        if($request->status_id==1 || strpos($request->status_id,'__submitterRejects')!==false){
            $status=$request->status_id;
            if(strpos($request->status_id,'__submitterRejects')!==false){
                $status=explode('__',$status)[0];
            }
            $task_data=[
                'table_name'            =>$request->table_name,
                'service_name'          =>$request->service_name,
                'name'                  =>$request->name,
                'screen_id'             =>$request->screen_id,
                'application_number'    =>$request->application_number,
                'status_id'             =>$status,
                'remarks'               =>$request->remarks,
                'w_config_status'       =>$request->w_config_status,
                'access_level'          =>$request->access_level,
                'user_dzo_id'           =>$request->user_dzo_id,
                'working_agency_id'     =>$request->working_agency_id,
                'created_by'            =>$request->action_by,
                'applied_on'            =>date('Y-m-d h:i:s'),
                'last_action_by'        =>$request->action_by,
                'last_action_date'      =>date('Y-m-d h:i:s'),
                'app_role_id'           => $request->app_role_id,
                'record_type_id'        => $request->record_type_id,
                'claimed_by'            =>null,
            ];
            try{
                return $workflowdetails = TaskDetails::create($task_data);
            }catch(\Illuminate\Database\QueryException $ex){
                dd($ex);

            }

        }
        else{
            $task_data=[
                'status_id'             =>$request->status_id,
                'w_config_status'       =>$request->w_config_status,
                'remarks'               =>$request->remarks,
                'last_action_by'        =>$request->action_by,
                'last_action_date'      =>date('Y-m-d h:i:s'),
                'claimed_by'            =>null,
                'claimed_date'          =>null,
            ];

            if($request->service_name=="Hr Development"){
                TaskDetails::where('screen_id', $request->screen_id)->update($task_data);
            }
            else if($request->status_id==10){
                $task_data=[
                    'table_name'            =>$request->table_name,
                    'service_name'          =>$request->service_name,
                    'name'                  =>$request->name,
                    'screen_id'             =>$request->screen_id,
                    'w_config_status'       =>$request->w_config_status,
                    'application_number'    =>$request->application_number,
                    'status_id'             =>$request->status_id,
                    'remarks'               =>$request->remarks,
                    'access_level'          =>$request->access_level,
                    'user_dzo_id'           =>$request->dzongkhagApproved,
                    'working_agency_id'     =>$request->working_agency_id,
                    'created_by'            =>$request->action_by,
                    'applied_on'            =>date('Y-m-d h:i:s'),
                    'last_action_by'        =>$request->action_by,
                    'last_action_date'      =>date('Y-m-d h:i:s'),
                    'app_role_id'           => $request->app_role_id,
                    'record_type_id'        => $request->record_type_id,
                    'claimed_by'            =>null,
                    'claimed_date'          =>null,
                ];
                TaskDetails::where('application_number', $request->application_number)->update($task_data);
            }
            else{
                TaskDetails::where('application_number', $request->application_number)->update($task_data);
            }

            $workflowdetails = TaskDetails::where('application_number', $request->application_number)->first();;
        }
        return $this->successResponse($workflowdetails, Response::HTTP_CREATED);
    }

    public function updateTaskDetails(Request $request){
        $update_data=[
            'claimed_by'     =>  $request->user_id,
            'claimed_date'      =>date('Y-m-d h:i:s'),
        ];
        if($request->type=="claim"){
            TaskDetails::where('application_number', $request->applicationNo)->update($update_data);
        }
        $response_data= TaskDetails::where('application_number', $request->applicationNo)->first();
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    public function insertNotification(Request $request) {
        $notification_data=[
            'notification_for'              =>  $request->notification_for,
            'notification_appNo'            =>  $request->notification_appNo,
            'notification_message'          =>  $request->notification_message,
            'notification_type'             =>  $request->notification_type,
            'notification_access_type'      =>  $request->notification_access_type,
            'call_back_link'                =>  $request->call_back_link,
            'action'                        =>  $request->action,
            'access_level'                  =>  $request->access_level,
            'created_by'                    =>$request->action_by,
            'created_at'                    =>date('Y-m-d h:i:s'),
        ];
        $notificationDetails = Notification::create($notification_data);
        if(strpos($request->user_role_id,',')!==false){
            $user_roles=explode(',', $request->user_role_id);
            foreach($user_roles as $usr){
                $notification_to_data=[
                    'notification_id'               =>  $notificationDetails->id,
                    'user_role_id'                  =>  $usr,
                    'dzo_id'                        =>  $request->dzo_id,
                    'access_level'                  =>  $request->access_level,
                    'working_agency_id'             =>  $request->working_agency_id,
                ];
                NotificationTo::create($notification_to_data);
            }
        }
        else{
            $notification_to_data=[
                'notification_id'               =>  $notificationDetails->id,
                'user_role_id'                  =>  $request->user_role_id,
                'dzo_id'                        =>  $request->dzo_id,
                'access_level'                  =>  $request->access_level,
                'working_agency_id'             =>  $request->working_agency_id,
            ];
            NotificationTo::create($notification_to_data);
        }

        return $this->successResponse($notificationDetails, Response::HTTP_CREATED);
    }

    public function updateNextNotification(Request $request){
        $notificationDetails = Notification::where('notification_appNo',$request->notification_appNo)->first();
        $record_id=$notificationDetails->id;
        $not_audit_data=[
            'id'                        =>  $request->id,
            'notification_for'          =>  $request->notification_for,
            'notification_appNo'        =>  $request->notification_appNo,
            'notification_message'      =>  $request->notification_message,
            'notification_type'         =>  $request->notification_type,
            'notification_access_type'  =>  $request->notification_access_type,
            'access_level'              =>  $request->access_level,
            'call_back_link'            =>  $request->call_back_link,
            'created_by'                =>  $request->created_by,
            'created_at'                =>  $request->created_at,
            'updated_by'                =>  $request->action_by,
            'updated_at'                =>  $request->udpated_on,
            'audited_by'                =>  $request->action_by,
            'audited_at'                =>  date('Y-m-d h:i:s'),
        ];
        NotificationAudit::create($not_audit_data);

        $notification_data=[
            'notification_message'               =>  $request->notification_message,
            'notification_type'                  =>  $request->notification_type,
            'notification_access_type'           =>  $request->notification_access_type,
            'access_level'                       =>  $request->access_level,
            'call_back_link'                     =>  $request->call_back_link,
            'updated_by'                         =>  $request->action_by,
            'updated_at'                         =>  date('Y-m-d h:i:s'),
        ];
        Notification::where('notification_appNo',$request->notification_appNo)->update($notification_data);
        $notification_to=NotificationTo::where('notification_id',$record_id)->get();
        if($notification_to!=null && $notification_to!="" && sizeof($notification_to)>0){
            foreach($notification_to as $noti){
                $not_to_audit_data=[
                    'id'                        =>  $noti['id'],
                    'notification_id'           =>  $noti['notification_id'],
                    'user_role_id'              =>  $noti['user_role_id'],
                    'access_level'              =>  $noti['access_level'],
                    'dzo_id'                    =>  $noti['dzo_id'],
                    'working_agency_id'         =>  $noti['working_agency_id'],
                    'audited_by'                =>  $request->action_by,
                    'audited_at'                =>  date('Y-m-d h:i:s'),
                ];
                NotificationToAudit::create($not_to_audit_data);
            }
        }

        NotificationTo::where('notification_id',$record_id)->delete();
        // $not_to_data=[
        //     'notification_id'           =>  $record_id,
        //     'user_role_id'              =>  $noti['user_role_id'],
        //     'access_level'              =>  $noti['access_level'],
        //     'dzo_id'                    =>  $noti['dzo_id'],
        //     'working_agency_id'         =>  $noti['working_agency_id'],
        // ];
        // NotificationTo::create($not_to_data);
        if(strpos($request->user_role_id,',')!==false){
            $user_roles=explode(',', $request->user_role_id);
            foreach($user_roles as $usr){
                if($usr!=""){
                    $notification_to_data=[
                        'notification_id'               =>  $notificationDetails->id,
                        'user_role_id'                  =>  $usr,
                        'dzo_id'                        =>  $request->dzo_id,
                        'access_level'                  =>  $request->access_level,
                        'working_agency_id'             =>  $request->working_agency_id,
                    ];
                    NotificationTo::create($notification_to_data);
                }
            }
        }
        else{
            $notification_to_data=[
                'notification_id'               =>  $notificationDetails->id,
                'user_role_id'                  =>  $request->user_role_id,
                'dzo_id'                        =>  $request->dzo_id,
                'access_level'                  =>  $request->access_level,
                'working_agency_id'             =>  $request->working_agency_id,
            ];
            NotificationTo::create($notification_to_data);
        }
        $not_visited=[
            'notification_id'           =>  $record_id,
            'user_id'                   =>  $request->action_by,
        ];
        NotificationVisited::create($not_visited);
    }

    public function visitedNotification(Request $request){
        $notificationDetails = Notification::where('notification_appNo',$request->notification_appNo)->first();
        $record_id=$notificationDetails->id;
        $not_visited=[
            'notification_id'           =>  $record_id,
            'user_id'                   =>  $request->action_by,
        ];
        NotificationVisited::create($not_visited);
    }
}

