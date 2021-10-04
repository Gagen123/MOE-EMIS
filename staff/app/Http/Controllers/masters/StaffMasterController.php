<?php

namespace App\Http\Controllers\masters;

use App\Http\Controllers\Controller;
use App\Models\staff_masters\ChildGroup;
use App\Models\staff_masters\ChildGroupPosition;
use App\Models\staff_masters\PositionLevel;
use App\Models\staff_masters\PositionTitle;
use App\Models\staff_masters\StaffMajorGrop;
use App\Models\staff_masters\StaffSubMajorGrop;
use App\Models\staff_masters\SuperStructure;
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
        if(isset($request->code)){
            $master_data = $master_data+[
                'code'   =>  $request->code,
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
    }

    public function loadStaffMasters($type="",$model=""){
        $mod=$model;
        $modelName = "App\\Models\\staff_masters\\"."$model";
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
        else if($type=="Qualification"){
            return $this->successResponse($model::with('quialificationtype','quialificationlevel')->get());
        }
        else if($type=="StaffSubMajorGrop"){
            return $this->successResponse($model::with('majorgroup')->get());
        }
        if($type=="all_active_position_title_with_level"){
            $positions=ChildGroupPosition::where('status', 1)->get();
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
                    $sup=SuperStructure::where('id',$pos['superstructure_id'])->first();
                    if($sup!=null && $sup!=""){
                        $pos->superstructure=$sup->name;
                    }
                    $child=ChildGroup::where('id',$pos['child_group_id'])->first();
                    if($child!=null && $child!=""){
                        $pos->childgroup=$child->name;
                        $submajorgrp=StaffSubMajorGrop::where('id', $child->sub_group_id)->first();
                        if($submajorgrp!=null && $submajorgrp!=""){
                            $pos->subgroup=$submajorgrp->name;
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
}
