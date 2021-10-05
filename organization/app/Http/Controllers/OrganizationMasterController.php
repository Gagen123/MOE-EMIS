<?php

namespace App\Http\Controllers;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Models\Masters\IncomeType;
use App\Models\Masters\FinancialInformation;
use App\Models\Masters\NotificationConfig;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Masters\Service;

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
         //   'code'          =>  'required',
            'status'        =>  'required',
        ];
        if($request->action_type=="edit"){
            $rules = $rules+[
                                    //for update, unique:table,column,idColumn
                'code'          =>  'unique:'.$model->getTable().',code,'.$request->id,
                'name'          =>  'unique:'.$model->getTable().',name,id,'.$request->name.',code,'.$request->code,
            ];
        }else{
            $rules = $rules+[
                                //for create, unique:table,column
                'code'          =>  'unique:'.$model->getTable().',code',
            ];
            $rules = $rules+[
                //for create, unique:table,column
                'name'          =>  'unique:'.$model->getTable().',name,'.$request->name.',code,'.$request->code,
            ];
        }
        $customMessages = [
            'name.required'         => 'This field is required',
            'code.required'         => 'This code is already taken. please choose another one',
            // 'description.required'  => 'This field is required',
            'status.required'       => 'This field is required',
        ];

        $this->validate($request, $rules, $customMessages);
        //name,description and status should be common to all models. respective model should be passed from ui.
        $master_data = [
            'name'              =>  $request->name,
          //  'code'              =>  $request->code,       
            'description'       =>  $request->description,
            'status'            =>  $request->status,
        ];
        //  dd( $master_data);
        if(isset($request->code)){
            $master_data = $master_data+[
                'code'   =>  $request->code,
            ];
        }
        if($request->model=="DocumentType"){
            $master_data =$master_data+[
                'applicableTo'              =>  implode(', ', $request->addfield_1),
            ];
        }
        if($request->model=="DepartmentMaster"){
            $master_data =$master_data+[
                'dzo_id'            =>  $request->dzo_id,
                'type'              =>  $request->type,
            ];
        }
        if($request->model=="FinancialInformation"){
            $master_data =$master_data+[
                'applicableTo'              =>  $request->addfield_1,
            ];
        }
        if($request->model=="StructureSubCategory"){
            $master_data =$master_data+[
                'structureCategory'              =>  $request->structureCategory,
            ];
        }
        if($request->model=="ECCDFacilities"){
            $master_data =$master_data+[
                'structuretype'              =>  $request->structuretype,
            ];
        }
        if($request->model=="SportFacilitySubtype"){  
            $master_data =$master_data+[
                'sportFacilityId'              =>  $request->sportFacility,
            ];
        }
        if($request->model=="FurnitureItem"){  
            $master_data =$master_data+[
                'furnitureType'              =>  $request->furnitureType,
            ];
        }
        if($request->model=="EquipmentItem"){  
            $master_data =$master_data+[
                'equipmentType'              =>  $request->equipmentType,
            ];
        }
        if($request->model=="serviceType"){  
            $master_data =$master_data+[
                'serviceType'              =>  $request->serviceType,
            ];
        }

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
            $msg_det='name:'.$data->name.'; status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
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
        }else if ($type == 'active_notification_type'){
            return $this->successResponse($model::where('status',1)->whereNotNull('service_type')->get());
        }
        else if(strpos($type,'ForTransaction')!==false){
            // return str_replace('_',' ',explode('__',$type)[1]);
            $response_data="";
            $service=Service::where('name','like','%'.str_replace('_',' ',explode('__',$type)[1]).'%')->first();//get service name
            if($service!=null && $service!=""){
                $response_data=$model::where('status',1)->where('applicableTo','like','%'.$service->id.'%')->get();
            }
            return $response_data;
        }
        else{
            return $this->successResponse($model::where('status',1)->get());
        }
    }
    public function loadFinacialtype(){
        $response_data = FinancialInformation::all();
        return $this->successResponse($response_data);
    }
    public function loadincomeList(){
        $response_data = IncomeType::all();
        return $response_data;
    }
    public function saveNotificationConfigMasters(Request $request){
        $rules = [
            'service_id' => 'required',
            'submitter_role_id' => 'required',
            'notification_to_role_id' =>  'required',
        ];
        $customMessages = [
            'service_id.required' => 'This field is required',
            'submitter_role_id.required' => 'This field is required',
            'notification_to_role_id.required' => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $master_data =[
            'id'                      =>  $request['id'],
            'service_id'              =>  $request['service_id'],
            'submitter_role_id'       =>  $request['submitter_role_id'],
            'notification_to_role_id' =>  $request['notification_to_role_id'],
            'user_id'                 =>  $request['user_id']
        ];

        if($request->action_type=="add"){
            $master_data =$master_data+[
                'created_by'        =>  $request->user_id,
                'created_at'        =>  date('Y-m-d h:i:s'),
            ];
            $response_data = NotificationConfig::create($master_data);
        }
        
        if($request->action_type=="edit"){
            $master_data =$master_data+[
                'updated_by'        =>  $request->user_id,
                'updated_at'        =>  date('Y-m-d h:i:s'),
            ];
         
            //Audit Trails
            $data = NotificationConfig::find($request->id);
            $msg_det='service_id:'.$data->service_id.'; submitter_role_id:'.$data->submitter_role_id.'; notification_to_role_id:'.$data->notification_to_role_id.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            $procid=DB::select("CALL ".$this->audit_database.".emis_audit_proc('".$this->database."','master_notification_config','".$request->id."','".$msg_det."','".$request->user_id."','Edit')");
            NotificationConfig::where('id',$request->id)->update($master_data);
            $response_data = NotificationConfig::where('id',$request->id)->first();
        }
        return $response_data;
    }
    // public function loadNotificationConfig(){
    //     return $this->successResponse(NotificationConfig::where('status',1))
    // }
}
