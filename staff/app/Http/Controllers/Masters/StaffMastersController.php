<?php

namespace App\Http\Controllers\Masters;
use App\Http\Controllers\Controller;

use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\StaffMasters\WorkingAgency;
use App\Models\StaffMasters\TransferReason;
use App\Models\StaffMasters\MgmnDesignation;
use App\Models\StaffMasters\StaffMajorGrop;
use App\Models\StaffMasters\StaffSubMajorGrop;
use App\Models\StaffMasters\PositionTitle;
use App\Models\StaffMasters\PositionLevel;
use App\Models\StaffMasters\QualificationType;
use App\Models\StaffMasters\QualificationLevel;
use App\Models\StaffMasters\Qualification;
use App\Models\StaffMasters\Relationship;
use App\Models\StaffMasters\MaritalStatus;

class StaffMastersController extends Controller{
    use ApiResponser;
    public $database="emis_staff_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function save_sfatt_masters(Request $request){
        $response_data=[];
        
        if($request['record_type']=="working_agency"){
            $rules = [
                'name'  =>  'required|unique:working_agency_master',
                'status'    =>  'required',
            ];

            $this->validate($request, $rules);
            if($request->actiontype=="add"){
                $data = [
                    'name'  =>  $request['name'],
                    'status'    =>  $request['status'],
                    'created_by'=>$request['user_id'],
                    'created_at'=>date('Y-m-d h:i:s'),
                ];
                $response_data = WorkingAgency::create($data);
            }
            if($request->actiontype=="edit"){
                $data = WorkingAgency::find($request['id']);
                $messs_det='name:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
                $procid=DB::select("CALL system_db.emis_audit_proc('".$this->database."','working_agency_master','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
                $data->name = $request['name'];
                $data->status = $request['status'];
                $data->updated_by = $request['user_id'];
                $data->updated_at = date('Y-m-d h:i:s');
                $data->update();
                $response_data = $data;
            }
        }
        if($request['record_type']=="sub_major_group" || $request['record_type']=="position_title"){
            if($request->actiontype=="add"){
                $table="";
                if($request['record_type']=="sub_major_group"){
                    $table="stf_sub_group";
                }
                if($request['record_type']=="position_title"){
                    $table="stf_position_title";
                }
                $rules = [
                    'parent_field'    =>  'required',
                    'name'  =>  'required|unique:'.$table,
                    'code'    =>  'required|unique:'.$table,
                    'status'    =>  'required',
                ];
                $customMessages = [
                    'parent_field.required' => 'This field is required',
                ];
    
                $this->validate($request, $rules,$customMessages);
                $data = [
                    'group_id'  =>  $request['parent_field'],
                    'sub_group_id'  =>  $request['parent_field'],
                    'name'  =>  $request['name'],
                    'code'    =>  $request['code'],
                    'status'    =>  $request['status'],
                    'created_by'=>$request['user_id'],
                    'created_at'=>date('Y-m-d h:i:s'),
                ];
                if($request['record_type']=="sub_major_group"){
                    $response_data = StaffSubMajorGrop::create($data);
                }
                if($request['record_type']=="position_title"){
                    $response_data = PositionTitle::create($data);
                }                
            }
            if($request->actiontype=="edit"){
                $data ="";
                $table="";
                if($request['record_type']=="sub_major_group"){
                    $data = StaffSubMajorGrop::find($request['id']);
                    $table="stf_sub_group";
                }
                if($request['record_type']=="position_title"){
                    $data = PositionTitle::find($request['id']);
                    $table="stf_position_title";
                }
                $messs_det='parent id:'.$data->group_id.'; name:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
                $procid=DB::select("CALL system_db.emis_audit_proc('".$this->database."','".$table."','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
                $data->name = $request['name'];
                $data->status = $request['status'];
                if($request['record_type']=="sub_major_group"){
                    $data->group_id = $request['parent_field'];
                }
                if($request['record_type']=="position_title"){
                    $data->sub_group_id = $request['parent_field'];
                }
                $data->updated_by = $request['user_id'];
                $data->updated_at = date('Y-m-d h:i:s');
                $data->update();
                $response_data = $data;
            }
        }
        
        if($request['record_type']=="staff_qualification"){
            if($request->actiontype=="add"){
                $table="";
                if($request['record_type']=="staff_qualification"){
                    $table="stf_qualification";
                }
                $rules = [
                    'parent_field'    =>  'required',
                    'parent_field1'    =>  'required',
                    'name'  =>  'required|unique:'.$table,
                    'code'    =>  'required|unique:'.$table,
                    'status'    =>  'required',
                ];
                $customMessages = [
                    'parent_field.required' => 'This field is required',
                    'parent_field1.required' => 'This field is required',
                ];
    
                $this->validate($request, $rules,$customMessages);
                $data = [
                    'q_type_id'  =>  $request['parent_field'],
                    'q_level_id'  =>  $request['parent_field1'],
                    'name'  =>  $request['name'],
                    'code'    =>  $request['code'],
                    'status'    =>  $request['status'],
                    'created_by'=>$request['user_id'],
                    'created_at'=>date('Y-m-d h:i:s'),
                ];
                if($request['record_type']=="staff_qualification"){
                    $response_data = Qualification::create($data);
                }
                               
            }
            if($request->actiontype=="edit"){
                $data ="";
                $table="";
                $messs_det="";
                if($request['record_type']=="staff_qualification"){
                    $data = Qualification::find($request['id']);
                    $table="stf_qualification";
                    $messs_det='qualification type id:'.$data->q_type_id.'; qualification level id: '.$data->q_level_id.'; qualification:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
                }
                
                $procid=DB::select("CALL system_db.emis_audit_proc('".$this->database."','".$table."','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
                
                if($request['record_type']=="staff_qualification"){
                    $data->q_type_id = $request['parent_field'];
                    $data->q_level_id = $request['parent_field1'];
                }
                $data->name = $request['name'];
                $data->status = $request['status'];
                $data->updated_by = $request['user_id'];
                $data->updated_at = date('Y-m-d h:i:s');
                $data->update();
                $response_data = $data;
            }
        }

        if($request['record_type']=="transfer_reason" || $request['record_type']=="mgmn_designation" || $request['record_type']=="major_group" || $request['record_type']=="position_level" ||  $request['record_type']=="qualificaiton_type" || $request['record_type']=="qualificaiton_level" || $request['record_type']=="relationship" || $request['record_type']=="marital_status"){
            if($request->actiontype=="add"){
                $table="";
                if($request['record_type']=="transfer_reason"){
                    $table="transfer_reason_master";
                }
                if($request['record_type']=="mgmn_designation"){
                    $table="mgmn_designation_master";
                }
                if($request['record_type']=="major_group"){
                    $table="stf_major_group";
                }
                if($request['record_type']=="position_level"){
                    $table="stf_position_level";
                }
                if($request['record_type']=="qualificaiton_type"){
                    $table="stf_qualification_type";
                }
                if($request['record_type']=="qualificaiton_level"){
                    $table="stf_qualification_level";
                }
                if($request['record_type']=="relationship"){
                    $table="stf_relationship";
                }
                if($request['record_type']=="marital_status"){
                    $table="stf_marital_status";
                }
                
                $rules = [
                    'name'  =>  'required|unique:'.$table,
                    'code'    =>  'required|unique:'.$table,
                    'status'    =>  'required',
                ];
                $this->validate($request, $rules);
                $data = [
                    'name'  =>  $request['name'],
                    'code'    =>  $request['code'],
                    'status'    =>  $request['status'],
                    'created_by'=>$request['user_id'],
                    'created_at'=>date('Y-m-d h:i:s'),
                ];
                if($request['record_type']=="transfer_reason"){
                    $response_data = TransferReason::create($data);
                }
                if($request['record_type']=="mgmn_designation"){
                    $response_data = MgmnDesignation::create($data);
                }
                if($request['record_type']=="major_group"){
                    $response_data = StaffMajorGrop::create($data);
                }
                if($request['record_type']=="position_level"){
                    $response_data = PositionLevel::create($data);
                }
                if($request['record_type']=="qualificaiton_type"){
                    $response_data = QualificationType::create($data);
                }
                if($request['record_type']=="qualificaiton_level"){
                    $response_data = QualificationLevel::create($data);
                }
                if($request['record_type']=="relationship"){
                    $response_data = Relationship::create($data);
                }
                if($request['record_type']=="marital_status"){
                    $response_data = MaritalStatus::create($data);
                }

            }
            if($request->actiontype=="edit"){
                $data ="";
                $table="";
                if($request['record_type']=="transfer_reason"){
                    $data = TransferReason::find($request['id']);
                    $table="transfer_reason_master";
                }
                if($request['record_type']=="mgmn_designation"){
                    $data = MgmnDesignation::find($request['id']);
                    $table="mgmn_designation_master";
                }
                if($request['record_type']=="major_group"){
                    $data = StaffMajorGrop::find($request['id']);
                    $table="stf_major_group";
                }
                if($request['record_type']=="position_level"){
                    $data = PositionLevel::find($request['id']);
                    $table="stf_position_level";
                }
                if($request['record_type']=="qualificaiton_type"){
                    $data = QualificationType::find($request['id']);
                    $table="stf_qualification_type";
                }
                if($request['record_type']=="qualificaiton_level"){
                    $data = QualificationLevel::find($request['id']);
                    $table="stf_qualification_level";
                }
                if($request['record_type']=="relationship"){
                    $data = Relationship::find($request['id']);
                    $table="stf_relationship";
                }
                if($request['record_type']=="marital_status"){
                    $data = MaritalStatus::find($request['id']);
                    $table="stf_marital_status";
                }
                $messs_det='name:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
                $procid=DB::select("CALL system_db.emis_audit_proc('".$this->database."','".$table."','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");

                $data->name = $request['name'];
                $data->status = $request['status'];
                $data->updated_by = $request['user_id'];
                $data->updated_at = date('Y-m-d h:i:s');
                $data->update();
                $response_data = $data;
            }
           
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    
    public function load_staff_masters($param=""){
        if($param=="all_workingagency"){
            return $this->successResponse(WorkingAgency::all());
        }
        if($param=="all_transfer"){
            return $this->successResponse(TransferReason::all());
        }
        if($param=="all_mgmn_desig"){
            return $this->successResponse(MgmnDesignation::all());
        }
        if($param=="all_staff_major_groupList"){
            return $this->successResponse(StaffMajorGrop::all());
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
            return $this->successResponse(PositionTitle::with('submajorgroup')->get());
        }
        
        if($param=="all_position_level_List"){
            return $this->successResponse(PositionLevel::all());
        }
        if($param=="all_qualification_tpe_List"){
            return $this->successResponse(QualificationType::all());
        }
        if($param=="active_qualification_type_List"){
            return $this->successResponse(QualificationType::where('status','1')->get());
        }
        
        if($param=="all_qualification_level_List"){
            return $this->successResponse(QualificationLevel::all());
        }
        if($param=="active_qualification_level_List"){
            return $this->successResponse(QualificationLevel::where('status','1')->get());
        }
        
        if($param=="all_qualification_List"){
            return $this->successResponse(Qualification::with('quialificationtype','quialificationlevel')->get());
            // return $this->successResponse(Qualification::all());
        }
        if($param=="all_relationship_list"){
            return $this->successResponse(Relationship::all());
        }
        if($param=="all_marital_list"){
            return $this->successResponse(MaritalStatus::all());
        }
    }
}
