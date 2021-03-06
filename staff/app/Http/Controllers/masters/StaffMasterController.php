<?php

namespace App\Http\Controllers\masters;

use App\Http\Controllers\Controller;
use App\Models\staff_master_config\LeaveConfiguration;
use App\Models\staff_master_config\LeaveConfigurationDetials;
use App\Models\staff_masters\ChildGroup;
use App\Models\staff_masters\ChildGroupPosition;
use App\Models\staff_masters\SuperStructure;
use App\Models\staff_masters\TransferReason;
use App\Models\staff_masters\StaffMajorGrop;
use App\Models\staff_masters\StaffSubMajorGrop;
use App\Models\staff_masters\PositionTitle;
use App\Models\staff_masters\PositionLevel;
use App\Models\staff_masters\TransferType;
use App\Models\staff_masters\TransferUndertaking;
use App\Models\staff_masters\TransferConfig;
use App\Models\staff_masters\TransferConfigDetails;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use StfMajorGroup;

class StaffMasterController extends Controller{
    use ApiResponser;
    public $database="staff_db";
    public $audit_database;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
        $this->audit_database = config('services.constant.auditdb');
    }

    public function saveStaffMasters(Request $request){
        if(strpos($request->model,'___')!==false){
            $path=explode('___',$request->model)[0];
            $model=explode('___',$request->model)[1];
            $modelName = "App\\Models\\"."$path"."\\"."$model";
        }else{
            $modelName = "App\\Models\\staff_masters\\"."$request->model";
        }
        $model = new $modelName();
        $response_data="";

        //transfer configuration code is paste here for timebeing i will change later(Gagen)
        if($request->model=="TransferConfig"){
            $rules = [
                'transfer_type_id' =>  'required',
                'role_id'          =>  'required',
            ];
            $customMessages = [
                'transfer_type_id.required' => 'This field is required',
                'role_id.required'          => 'This field is required',
            ];
            $data = array(
                'transfer_type_id'          =>  $request['transfer_type_id'],
                'submitter_role_id'         =>  $request['role_id'],

            );
            $this->validate($request, $rules,$customMessages);
            if($request['action_type']=="add"){
                $data =$data +[
                    'created_by'                =>  $request['user_id'],
                    'created_at'                =>  date('Y-m-d h:i:s')
                ];
                // dd($data);
                $config_det= TransferConfig::create($data);
                // dd($config_det);
                foreach ($request->role_action_mapp as $rol){
                    $data = array(
                        'transfer_config_id'    =>  $config_det->id,
                        'sequence'              =>  $rol['sequence'],
                        'authority_type_id'     =>  $rol['authority'],
                        'role_id'               =>  $rol['role'],
                    );
                    $config_det= TransferConfigDetails::create($data);
                }
            }
        }
        $rules = [
            'name'          =>  'required',
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
                // 'name'          =>  'unique:'.$model->getTable().',name,id,'.$request->name.',code,'.$request->code,
            ];

            $rules = $rules+[
                //for create, unique:table,column
                'name'          =>  'unique:'.$model->getTable().',name,'.$request->name.',code,'.$request->code,
            ];
        }
        $customMessages = [
            'name.required'         => 'This field is required',
            'status.required'       => 'This field is required',
            'code.unique'           => 'This code is already taken. please choose another one',
            // 'name.unique'           => 'This code and name combination is already taken. please choose another one',
        ];
        $this->validate($request, $rules, $customMessages);
        $master_data = [
            'name'              =>  $request->name,
            'description'       =>  $request->description,
            'status'            =>  $request->status,
        ];
        if(isset($request->carryforward)){
            $master_data = $master_data+[
                'carryforward'   =>  $request->carryforward,
            ];
        }
        if(isset($request->code)){
            $master_data = $master_data+[
                'code'   =>  $request->code,
            ];
        }
        if(isset($request->type)){
            $master_data = $master_data+[
                'type'   =>  $request->type,
            ];
        }
        if(isset($request->group_id)){
            $master_data = $master_data+[
                'group_id'   =>  $request->group_id,
            ];
        }
        if(isset($request->sub_group_id)){
            $master_data = $master_data+[
                'sub_group_id'   =>  $request->sub_group_id,
            ];
        }
        if(isset($request->position_level_id)){
            $master_data = $master_data+[
                'position_level_id'   =>  $request->position_level_id,
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
        if(isset($request->country_id)){
            $master_data = $master_data+[
                'country_id'   =>  $request->country_id,
            ];
        }

        if(isset($request->child_group_id)){
            $master_data = $master_data+[
                'child_group_id'   =>  $request->child_group_id,
            ];
        }
        if(isset($request->position_title)){
            $master_data = $master_data+[
                'position_title_id'   =>  $request->position_title,
            ];
        }
        if(isset($request->superstructure_id)){
            $master_data = $master_data+[
                'superstructure_id'   =>  $request->superstructure_id,
            ];
        }

        if(isset($request->doner_agency)){
            $master_data = $master_data+[
                'doner_agency_id'   =>  $request->doner_agency,
            ];
        }
        if(isset($request->category)){
            $master_data = $master_data+[
                'category'   =>  $request->category,
            ];
        }
        if(isset($request->no_days)){
            $master_data = $master_data+[
                'no_days'   =>  $request->no_days,
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
            if($request->model=="PositionTitle" || $request->model=="ChildGroup"){
                unset($master_data['group_id']);
            }
            $master_data =$master_data+[
                'updated_by'        =>  $request->user_id,
                'updated_at'        =>  date('Y-m-d h:i:s'),
            ];
            //Audit Trails
            $data = $model::find($request->id);
            if($request->model=="ChildGroupPosition"){
                unset($master_data['name']);
                unset($master_data['group_id']);
                unset($master_data['sub_group_id']);
                $msg_det='description:'.$data->description.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            }else{
                $msg_det='name:'.$data->name.'description:'.$data->description.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
            }
            DB::select("CALL ".$this->audit_database.".emis_audit_proc('".$this->database."','".$request->model."','".$request->id."','".$msg_det."','".$request->user_id."','Edit')");
            $model::where('id',$request->id)->update($master_data);
            $response_data = $model::where('id',$request->id)->first();
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);

        if($request['action_type']=="edit"){
            $data =$data +[
                'updated_by'                =>  $request['user_id'],
                'updated_at'                =>  date('Y-m-d h:i:s')
            ];
            TransferConfig ::where('id',$request['id'])->update($data);
            TransferConfigDetails ::where('transfer_config_id',$request['id'])->delete();
            foreach ($request->role_action_mapp as $rol){
                $data = array(
                    'transfer_config_id'      =>  $request['id'],
                    'sequence'              =>  $rol['sequence'],
                    'authority_type_id'     =>  $rol['authority'],
                    'role_id'               =>  $rol['role'],
                );
                $config_det= TransferConfigDetails ::create($data);
            }
        }
        return $this->successResponse($config_det, Response::HTTP_CREATED);

    }

    public function loadStaffMasters($type="",$model=""){
        $mod=$model;
        if(strpos($model,'___')!==false){
            $path=explode('___',$model)[0];
            $model=explode('___',$model)[1];
            $modelName = "App\\Models\\"."$path"."\\"."$model";
            //staff_leadership
            // dd($modelName);
        }else{
            $modelName = "App\\Models\\staff_masters\\"."$model";
        }
        $model = new $modelName();
        if($type == 'all'){
            if($mod=="ChildGroupPosition"){
                $response_data=$model::get();
                if($response_data!=null && $response_data!="" && sizeof($response_data)>0){
                    foreach($response_data as $data){
                        $name=ChildGroup::with('submajorgroup')->where('id',$data->child_group_id)->first();
                        if($name!=null && $name!=""){
                            $data->childgroupname=$name->name;
                            $data->subgroupname=$name->submajorgroup->name;
                            $data->subgroupid=$name->submajorgroup->id;
                            $major=StaffMajorGrop::where('id',$name->submajorgroup->group_id)->first();
                            if($major!=null && $major!=""){
                                $data->groupname=$major->name;
                                $data->groupid=$major->id;
                            }
                        }
                        $position=PositionTitle::where('id',$data->position_title_id)->first();
                        if($position!=null && $position!=""){
                            $data->positionTitle=$position->name;
                        }
                        $super=SuperStructure::where('id',$data->superstructure_id)->first();
                        if($super!=null && $super!=""){
                            $data->superstructure=$super->name;
                        }
                    }
                }
                return $this->successResponse($response_data);
            }else{
                return $this->successResponse($model::get());
            }
        }
        else if(strpos($type,'joinall')!==false){
            $response_data=$model::get();
            if($response_data!=null && $response_data!="" && sizeof($response_data)>0){
                foreach($response_data as $data){
                    $submod=explode('__',$type)[1];
                    $sub_det="App\\Models\\staff_masters\\"."$submod";
                    $submodel = new $sub_det();
                    $data->sub_det=$submodel::where('id',$data[explode('__',$type)[2]])->first();
                }
            }
            return $this->successResponse($response_data);
        }
        else if($type == 'active'){
            return $this->successResponse($model::where('status',1)->get());
        }
        else if(strpos($type,'byparent')!==false){
            // dd(explode('__',$type)[1]);
            return $this->successResponse($model::where(explode('__',$type)[1],explode('__',$type)[2])->get());
        }
        else if(strpos($type,'withparent')!==false){
            return $this->successResponse($model::with(explode('__',$type)[1])->where(explode('__',$type)[2],explode('__',$type)[3])->get());
        }
        else if(strpos($type,'allwith')!==false){
            return $this->successResponse($model::with(explode('__',$type)[1])->get());
        }
        else if(strpos($type,'setconditions')!==false){
            $condition=explode('__',$type);
            $result=$model::query();
            foreach($condition as $con){
                if($con!="setconditions"){
                    $result->where(explode('!',$con)[0],explode('!',$con)[1]);
                }
            }
            return $this->successResponse($result->get());
        }
        else if(strpos($type,'byid')!==false){
            return $this->successResponse($model::where(explode('__',$type)[1],explode('__',$type)[2])->first());
        }
        else if($type=="Qualification"){
            return $this->successResponse($model::with('quialificationtype','quialificationlevel')->get());
        }
        else if($type=="StaffSubMajorGrop"){
            return $this->successResponse($model::with('majorgroup')->get());
        }
        else if($type=="all_active_position_title_with_level"){
            $childids=[];
            $edumajorgroup=StaffMajorGrop::where('name','Education & Training Services Group')->first();
            if($edumajorgroup!=null && $edumajorgroup!=""){
                $subgrp=StaffSubMajorGrop::where('status', 1)->where('group_id',$edumajorgroup->id)->get();
                if($subgrp!=null && $subgrp!="" && sizeof($subgrp)>0){
                    $subids=[];
                    foreach($subgrp as $sub){
                        array_push($subids,$sub->id);
                    }
                    $childgroup=ChildGroup::where('status', 1)->wherein('sub_group_id',$subids)->get();
                    if($childgroup!=null && $childgroup!="" && sizeof($childgroup)>0){
                        foreach($childgroup as $child){
                            array_push($childids,$child->id);
                        }
                    }
                }
            }
            $positions=ChildGroupPosition::where('status', 1)->wherein('child_group_id',$childids)->get();
            if($positions!=null && $positions!="" && sizeof($positions)>0){
                foreach($positions as $pos){
                    $posi=PositionTitle::where('id',$pos['position_title_id'])->first();
                    if($posi!=null && $posi!=""){
                        $posiLev=PositionLevel::where('id',$posi->position_level_id)->first();
                        $pos->positionTitle=$posi->name;
                        if($posiLev!=null && $posiLev!=""){
                            $pos->positionlevel=$posiLev->name;
                        }
                    }
                }
            }
            return $this->successResponse($positions);
        }
        else if($type=="PositionTitle"){
            $response_data=$model::with('submajorgroup')->get();
            if($response_data!=null && $response_data!="" && sizeof($response_data)>0){
                foreach($response_data as $data){
                    // $name=StaffMajorGrop::where('id',$data->submajorgroup->group_id)->first();
                    // if($name!=null && $name!=""){
                    //     $data->majorgroup=$name->name;
                    // }
                    $name=PositionLevel::where('id',$data->position_level_id)->first();
                    if($name!=null && $name!=""){
                        $data->p_level=$name->name;
                    }
                }
            }
            return $this->successResponse($response_data);
        }

        else if($type == 'active'){
            return $this->successResponse($model::where('status',1)->get());
        }

    }
    public function getTeacherPositionTitle(){
        $result_data = DB::select('SELECT
            A.id,
            B.name
            FROM master_child_group_position AS A
            JOIN master_stf_position_title AS B
            ON A.position_title_id = B.id
            WHERE B.status = 1
            AND (B.code = 0130 OR B.code = 0131 OR B.code = 0139 OR B.code = 0140 OR B.code = 0141)
            AND A.status = 1');
        return $result_data;
    }

    public function loadStaffMastersbyId($model="",$id=""){
        if($model=="PositionTitle"){
            $positions=ChildGroupPosition::where('id', $id)->first();
            if($positions!=null && $positions!=""){
                $posi=PositionTitle::where('id',$positions->position_title_id)->first();
                if($posi!=null && $posi!=""){
                    $posiLev=PositionLevel::where('id',$posi->position_level_id)->first();
                    $positions->positionTitle=$posi->name;
                    if($posiLev!=null && $posiLev!=""){
                        $positions->positionlevel=$posiLev->name;
                    }
                }
            }
            return $this->successResponse($positions);
        }else{
            $modelName = "App\\Models\\staff_masters\\"."$model";
            $model = new $modelName();
            $data=$model::where('id',$id)->first();
            return $this->successResponse($data);
        }
    }


    //save leave type configuration
    public function saveConfigMasters(Request $request){
        $modelName = "App\\Models\\staff_master_config\\"."$request->model";
        $model = new $modelName();
        if($request->model=="LeaveConfiguration"){
            $rules = [
                'leave_type_id' =>  'required',
                'role_id'       =>  'required',
            ];
            $customMessages = [
                'leave_type_id.required' => 'This field is required',
                'role_id.required' => 'This field is required',
            ];
            $this->validate($request, $rules,$customMessages);
        }

        $data = [];
        if(isset($request->leave_type_id)){
            $data = $data+[
                'leave_type_id'   =>  $request->leave_type_id,
            ];
        }
        if(isset($request->role_id)){
            $data = $data+[
                'submitter_role_id'   =>  $request->role_id,
            ];
        }
        if($request->action_type=="add"){
            $data =$data+[
                'created_by'        =>  $request->user_id,
                'created_at'        =>  date('Y-m-d h:i:s'),
            ];
            $config_det = $model::create($data);
            if($request->model=="LeaveConfiguration"){
                foreach ($request->role_action_mapp as $rol){
                    $data = array(
                        'leave_config_id'       =>  $config_det->id,
                        'sequence'              =>  $rol['sequence'],
                        'authority_type_id'     =>  $rol['authority'],
                        'role_id'               =>  $rol['role'],
                    );
                    LeaveConfigurationDetials::create($data);
                }
            }
        }

        if($request['action_type']=="edit"){
            $data =$data +[
                'updated_by'                =>  $request['user_id'],
                'updated_at'                =>  date('Y-m-d h:i:s')
            ];
            //Audit Trails
            $curr_data = $model::find($request->id);
            if($request->model=="LeaveConfiguration"){
                $msg_det='leave_type_id:'.$curr_data->leave_type_id.', submitter_role_id:'.$curr_data->submitter_role_id;
                $configdata = LeaveConfigurationDetials::where('leave_config_id',$request['id'])->get();
                foreach($configdata as $con){
                    $msg_det=$msg_det.'; configDeta: leave_config_id:'.$con['leave_config_id'].', sequence'.$con['sequence'].', authority_type_id'.$con['authority_type_id'].', role_id:'.$con['role_id'];
                }
            }
            DB::select("CALL ".$this->audit_database.".emis_audit_proc('".$this->database."','".$request->model."','".$request->id."','".$msg_det."','".$request->user_id."','Edit')");
            $model::where('id',$request->id)->update($data);
            $config_det = $model::where('id',$request->id)->first();
            if($request->model=="LeaveConfiguration"){
                LeaveConfigurationDetials::where('leave_config_id',$request->id)->delete();
                foreach ($request->role_action_mapp as $rol){
                    $data = array(
                        'leave_config_id'       =>  $request->id,
                        'sequence'              =>  $rol['sequence'],
                        'authority_type_id'     =>  $rol['authority'],
                        'role_id'               =>  $rol['role'],
                    );
                    LeaveConfigurationDetials::create($data);
                }
            }
        }
        return $this->successResponse($config_det, Response::HTTP_CREATED);
    }

    public function loadConfigMasters($type="",$model=""){
        $mod=$model;
        $modelName = "App\\Models\\staff_master_config\\"."$model";
        if($mod=="LeaveConfiguration"){
            $response_data=$modelName::with('leaveDetails')->get();
            return $this->successResponse($response_data);
        }
        if($mod=="loadLeaveConfigDetails"){
            $data=LeaveConfiguration::where('id',$type)->first();
            $data->conDetails= LeaveConfigurationDetials::where('leave_config_id',$type)->get();
            return $this->successResponse($data);
        }
        return $this->successResponse($modelName::get());
    }


    //copied from staffMastersController
    public function loadStaffTransferMasters($param=""){
        if($param=="all_transfer_type_list"){
            return $this->successResponse(TransferType::all());
        }
        if($param=="intra"){
            return $this->successResponse(TransferType::where ('name', 'LIKE', '%intra%')->get());
        }
        if($param=="inter"){
            return $this->successResponse(TransferType::where ('name', 'LIKE', '%inter%')->get());
        }
        if($param=="appeal"){
            return $this->successResponse(TransferType::where ('name', 'LIKE', '%appeal%')->get());
        }
        if($param=="all_transfer"){
            return $this->successResponse(TransferReason::all());
        }
        if($param=="active_transfer"){
            return $this->successResponse(TransferReason::where ('status', '1')->get());
        }
        if($param=="all_transfe_undertakingr"){
            return $this->successResponse(TransferUndertaking::all());
        }
        if($param=="active_transfer_undertakingr"){
            return $this->successResponse(TransferUndertaking::where ('status', '1')->get());
        }
        if($param=="all_active_staff_major_groupList"){
            return $this->successResponse(StaffMajorGrop::where ('status', '1')->get());
        }
        if($param=="all_sub_major_groupList"){
            return $this->successResponse(StaffSubMajorGrop::with('majorgroup')->get());
        }
        if($param=="all_active_sub_group_List"){
            return $this->successResponse(StaffSubMajorGrop::where('status','1')->get());
        }

        if($param=="all_position_title_List"){
            return $this->successResponse(PositionTitle::with('submajorgroup','level')->get());
        }
        if($param=="all_active_position_title"){
            return $this->successResponse(PositionTitle::where ('status', 1)->get());
        }
        if($param=="all_active_position_title_with_level"){
            $positions=PositionTitle::where('status', 1)->get();
            if($positions!=null && $positions!="" && sizeof($positions)>0){
                foreach($positions as $pos){
                    $pos->subgroup=StaffSubMajorGrop::where('id',$pos['sub_group_id'])->first()->name;
                    $level=PositionLevel::where('id',$pos['position_level_id'])->first();
                    if($level!=null && $level!=""){
                        $pos->level=$level->name;
                    }
                }
            }
            return $this->successResponse($positions);
        }

        if($param=="all_position_level_List"){
            return $this->successResponse(PositionLevel::all());
        }
        if($param=="all_active_position_level_List"){
            return $this->successResponse(PositionLevel::where ('status', 1)->get());
        }

    }
    public function loadStaffDropdownMasters($model="",$parent_id=""){
        if($model=="StaffSubMajorGrop"){
            return $this->successResponse(StaffSubMajorGrop::where('group_id',$parent_id)->get());
        }
    }


//transfer
    public function saveTransferConfigMasters(Request $request){
        $rules = [
            'transfer_type_id' =>  'required',
            'role_id'          =>  'required',
        ];
        $customMessages = [
            'transfer_type_id.required' => 'This field is required',
            'role_id.required'          => 'This field is required',
        ];
        // $data = array(
        //     'transfer_type_id'          =>  $request['transfer_type_id'],
        //     'submitter_role_id'         =>  $request['role_id'],

        // );
        $this->validate($request, $rules,$customMessages);
        $data = [];
        if(isset($request->transfer_type_id)){
            $data = $data+[
                'transfer_type_id'   =>  $request->transfer_type_id,
            ];
        }
        if(isset($request->role_id)){
            $data = $data+[
                'submitter_role_id'   =>  $request->role_id,
            ];
        }

        if($request['action_type']=="add"){
            $data =$data +[
                'created_by'                =>  $request['user_id'],
                'created_at'                =>  date('Y-m-d h:i:s')
            ];
            $config_det= TransferConfig::create($data);
            foreach ($request->role_action_mapp as $rol){
                $data = array(
                    'transfer_config_id'    =>  $config_det->id,
                    'sequence'              =>  $rol['sequence'],
                    'authority_type_id'     =>  $rol['authority'],
                    'role_id'               =>  $rol['role'],
                );
                $config_det= TransferConfigDetails::create($data);
            }
        }

        if($request['action_type']=="edit"){
            $data =$data +[
                'updated_by'                =>  $request['user_id'],
                'updated_at'                =>  date('Y-m-d h:i:s')
            ];
            TransferConfig ::where('id',$request['id'])->update($data);
            TransferConfigDetails ::where('transfer_config_id',$request['id'])->delete();
            foreach ($request->role_action_mapp as $rol){
                $data = array(
                    'transfer_config_id'      =>  $request['id'],
                    'sequence'              =>  $rol['sequence'],
                    'authority_type_id'     =>  $rol['authority'],
                    'role_id'               =>  $rol['role'],
                );
                $config_det= TransferConfigDetails ::create($data);
            }
        }
        return $this->successResponse($config_det, Response::HTTP_CREATED);
    }


    // public function loadLeaveConfigMasters($type="",$submitter=""){
    //     return $this->successResponse(TransferConfig ::where('submitter_role_id',$submitter)->where('leave_type_id',$type)->first());
    // }

    public function loadAllTransferConfigMasters(){
       $response_data=DB::table('master_transfer_type')->
        select('master_transfer_type.name','master_transfer_type.id','master_staff_transfer_config.submitter_role_id','master_staff_transfer_config.id')
        ->join('master_staff_transfer_config','master_staff_transfer_config.transfer_type_id','=','master_transfer_type.id')->get();
        return $response_data;
    }

    public function loadTransferConfigDetails($id=""){
        $data=TransferConfig::where('id',$id)->first();
        $data->conDetails= TransferConfigDetails::where('transfer_config_id',$id)->get();
        return $this->successResponse($data);
    }
}
