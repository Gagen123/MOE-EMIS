<?php

namespace App\Http\Controllers\masters;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffMasterController extends Controller{
    use ApiResponser;
    public $database="staff_db";
    public $audit_database;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
        $this->audit_database = config('services.constant.auditdb');
    }

    public function saveStaffMasters(Request $request){
        $modelName = "App\\Models\\staff_masters\\"."$request->model";
        $model = new $modelName();
        $response_data="";
        $rules = [
            'name'          =>  'required',
            'status'        =>  'required',
        ];
        $customMessages = [
            'name.required'         => 'This field is required',
            'status.required'       => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        $master_data = [
            'name'              =>  $request->name,
            'description'       =>  $request->description,
            'status'            =>  $request->status,
        ];
        if(isset($request->code)){
            $master_data = $master_data+[
                'code'   =>  $request->code,
            ];
        }
        if(isset($request->qualification_type)){
            $master_data = $master_data+[
                'q_type_id'   =>  $request->qualification_type,
            ];
        }
        if(isset($request->qualification_level)){
            $master_data = $master_data+[
                'q_level_id'   =>  $request->qualification_level,
            ];
        }
        if($request->action_type=="add"){
            $master_data =$master_data+[
                'created_by'        =>  $request->user_id,
                'created_at'        =>  date('Y-m-d h:i:s'),
            ];
            // dd( $master_data);
            $response_data = $model::create($master_data);
        }

        if($request->action_type=="edit"){
            $master_data =$master_data+[
                'updated_by'        =>  $request->user_id,
                'updated_at'        =>  date('Y-m-d h:i:s'),
            ];
            //Audit Trails
            $data = $model::find($request->id);
            $msg_det='name:'.$data->name.'description:'.$data->description.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            DB::select("CALL ".$this->audit_database.".emis_audit_proc('".$this->database."','".$request->model."','".$request->id."','".$msg_det."','".$request->user_id."','Edit')");
            $model::where('id',$request->id)->update($master_data);
            $response_data = $model::where('id',$request->id)->first();
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadStaffMasters($type="",$model=""){
        $modelName = "App\\Models\\staff_masters\\"."$model";
        $model = new $modelName();
        if($type == 'all'){
            return $this->successResponse($model::get());
        }
        else if($type=="Qualification"){

            return $this->successResponse($model::with('quialificationtype','quialificationlevel')->get());
        } else if($type == 'active'){
            return $this->successResponse($model::where('status',1)->get());
        }
    }
}
