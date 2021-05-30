<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OrganizationMasterController extends Controller{
    use ApiResponser;
    public $audit_database;
    public $database;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
        $this->audit_database = config('services.constant.auditdb');
        $this->database = config('services.constant.organizaitondb');
    }
    
    public function saveOrganizationMaster(Request $request){
        $modelName = "App\\Models\\Masters\\"."$request->model";
        $model = new $modelName();
        $response_data="";
        $rules = [
            'name'          =>  'required',
            'description'   =>  'required',
            'status'        =>  'required',
        ];
        $customMessages = [
            'name.required'         => 'This field is required',
            'description.required'  => 'This field is required',
            'status.required'       => 'This field is required',
        ];
        $this->validate($request, $rules, $customMessages);
        //name,description and status should be common to all models. respective model should be passed from ui.
        $master_data = [
            'name'              =>  $request->name,
            'description'       =>  $request->description,
            'status'            =>  $request->status,
        ];

        if($request->action_type=="add"){
            $master_data =$master_data+[
                'created_by'        =>  $request->user_id,
                'created_at'        =>  date('Y-m-d h:i:s'),
            ];
            $response_data = $model::create($master_data);
        }
        if($request->action_type=="edit"){
            $master_data =$master_data+[
                'updated_by'        =>  $request->user_id,
                'updated_at'        =>  date('Y-m-d h:i:s'),
            ];

            //Audit Trails
            $data = $model::find($request->id);
            $msg_det='name:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('".$this->database."','".$request->model."','".$request->id."','".$msg_det."','".$request->user_id."','Edit')");
            $model::where('id',$request->id)->update($master_data);
            $response_data = $model::where('id',$request->id)->first();
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    
    public function loadOrganizaitonmasters($type="",$model=""){
        $modelName = "App\\Models\\Masters\\"."$model"; 
        $model = new $modelName();
        if($type == 'all'){
            return $this->successResponse($model::get());
        } else if($type == 'active'){
            return $this->successResponse($model::where('status',1)->get());
        } 
    }
}