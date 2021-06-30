<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Workflow;
use App\Models\TaskDetails;

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
                'access_level'          =>$request->access_level,
                'user_dzo_id'           =>$request->user_dzo_id,
                'working_agency_id'     =>$request->working_agency_id,
                'created_by'            =>$request->action_by,
                'applied_on'            =>date('Y-m-d h:i:s'),
                'last_action_by'        =>$request->action_by,
                'last_action_date'      =>date('Y-m-d h:i:s'),
                'app_role_id'           => $request->app_role_id,
                'record_type_id'        => $request->record_type_id,
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
                'remarks'               =>$request->remarks,
                'last_action_by'        =>$request->action_by,
                'last_action_date'      =>date('Y-m-d h:i:s'),
                'claimed_by'            =>null,
                'claimed_date'          =>null,
            ];

            if($request->service_name=="Hr Development"){
                TaskDetails::where('screen_id', $request->screen_id)->update($task_data);
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
}
