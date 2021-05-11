<?php

namespace App\Http\Controllers\masters;
use App\Http\Controllers\Controller;

use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\staff_masters\TransferReason;
use App\Models\staff_masters\MgmnDesignation;
use App\Models\staff_masters\StaffMajorGrop;
use App\Models\staff_masters\StaffSubMajorGrop;
use App\Models\staff_masters\PositionTitle;
use App\Models\staff_masters\PositionLevel;
use App\Models\staff_masters\QualificationType;
use App\Models\staff_masters\QualificationLevel;
use App\Models\staff_masters\Qualification;
use App\Models\staff_masters\Relationship;
use App\Models\staff_masters\MaritalStatus;
use App\Models\staff_masters\StaffSubjectArea;
use App\Models\staff_masters\Subjects;
use App\Models\staff_masters\CureerStage;
use App\Models\staff_masters\QualificationDescription;
use App\Models\staff_masters\CourseMode;
use App\Models\staff_masters\TransferUndertaking;
use App\Models\staff_masters\MgmntBodyType;
use App\Models\staff_service_masters\StaffAwardCategory;
use App\Models\staff_service_masters\StaffAwardType;
use App\Models\staff_service_masters\StaResponsiblity;
use App\Models\staff_service_masters\StaffOffenceType;
use App\Models\staff_service_masters\StaffOffenceSeverity;
use App\Models\staff_service_masters\StaffOffenceAction;

class StaffMastersController extends Controller{
    use ApiResponser;
    public $database="emis_staff_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    public function saveStaffMasters(Request $request){
        $response_data=[];
        if($request['record_type']=="sub_major_group" || $request['record_type']=="position_title" || $request['record_type']=="staff_subject"){
            if($request->actiontype=="add"){
                $table="";
                if($request['record_type']=="sub_major_group"){
                    $table="master_stf_sub_group";
                }
                if($request['record_type']=="position_title"){
                    $table="master_stf_position_title";
                }
                if($request['record_type']=="staff_subject"){
                    $table="master_stf_subject";
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
                    'sub_area_id'  =>  $request['parent_field'],
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
                if($request['record_type']=="staff_subject"){
                    $response_data = Subjects::create($data);
                }               
            }
            if($request->actiontype=="edit"){
                $data ="";
                $table="";
                $parent_id="";
                if($request['record_type']=="sub_major_group"){
                    $data = StaffSubMajorGrop::find($request['id']);
                    $table="master_stf_sub_group";
                    $parent_id=$data->group_id;
                }
                if($request['record_type']=="position_title"){
                    $data = PositionTitle::find($request['id']);
                    $table="master_stf_position_title";
                    $parent_id=$data->group_id;
                }
                
                if($request['record_type']=="staff_subject"){
                    $data = Subjects::find($request['id']);
                    $table="master_stf_subject";
                    $parent_id=$data->sub_area_id;
                } 
                $messs_det='parent id:'.$parent_id.'; name:'.$data->name.'; Status:'.$data->status.'; updated_by:'.$data->updated_by.'; updated_date:'.$data->updated_at;
                $procid=DB::select("CALL system_db.emis_audit_proc('".$this->database."','".$table."','".$request['id']."','".$messs_det."','".$request->input('user_id')."','Edit')");
                $data->name = $request['name'];
                $data->status = $request['status'];
                if($request['record_type']=="sub_major_group"){
                    $data->group_id = $request['parent_field'];
                }
                if($request['record_type']=="position_title"){
                    $data->sub_group_id = $request['parent_field'];
                }
                if($request['record_type']=="staff_subject"){
                    $data->sub_area_id = $request['parent_field'];
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
                    $table="master_stf_qualification";
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
                    $table="master_stf_qualification";
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
        // dd($request);
        if($request['record_type']=="transfer_reason" || $request['record_type']=="mgmn_designation" || $request['record_type']=="major_group" 
        || $request['record_type']=="position_level" ||  $request['record_type']=="qualificaiton_type" || $request['record_type']=="qualificaiton_level" 
        || $request['record_type']=="relationship" || $request['record_type']=="marital_status" || $request['record_type']=="subject_area" 
        || $request['record_type']=="cureer_stage" || $request['record_type']=="qualification_description" || $request['record_type']=="course_mode" 
        || $request['record_type']=="transfer_uindertaking" || $request['record_type']=="mgmn_body_type" || $request['record_type']=="staff_award_category" 
        || $request['record_type']=="staff_award_type" || $request['record_type']=="staff_role_responsibility" || $request['record_type']=="staff_offence_type" 
        || $request['record_type']=="staff_offence_severity" || $request['record_type']=="staff_offence_action"){
            if($request->actiontype=="add"){
                $table="";
                if($request['record_type']=="transfer_reason"){
                    $table="master_transfer_reason";
                }
                if($request['record_type']=="transfer_uindertaking"){
                    $table="master_transfer_undertaking";
                }
                if($request['record_type']=="mgmn_designation"){
                    $table="master_mgmn_designation";
                }
                if($request['record_type']=="major_group"){
                    $table="master_stf_major_group";
                }
                if($request['record_type']=="position_level"){
                    $table="master_stf_position_level";
                }
                if($request['record_type']=="qualificaiton_type"){
                    $table="master_stf_qualification_type";
                }
                if($request['record_type']=="qualificaiton_level"){
                    $table="master_stf_qualification_level";
                }
                if($request['record_type']=="relationship"){
                    $table="master_stf_relationship";
                }
                if($request['record_type']=="marital_status"){
                    $table="master_stf_marital_status";
                }
                if($request['record_type']=="subject_area"){
                    $table="master_stf_subject_area";
                }
                if($request['record_type']=="cureer_stage"){
                    $table="master_stf_cureer_stage";
                }
                if($request['record_type']=="qualification_description"){
                    $table="master_qualification_description";
                }
                if($request['record_type']=="course_mode"){
                    $table="master_course_mode";
                }
                if($request['record_type']=="mgmn_body_type"){
                    $table="master_mgmn_body_type";
                }
                if($request['record_type']=="staff_award_category"){
                    $table="master_staff_serice_category";
                }
                if($request['record_type']=="staff_award_type"){
                    $table="master_staff_serice_type";
                }
                if($request['record_type']=="staff_role_responsibility"){
                    $table="master_staff_responsibility";
                }
                if($request['record_type']=="staff_offence_type"){
                    $table="master_staff_offence_type";
                }
                if($request['record_type']=="staff_offence_severity"){
                    $table="master_staff_offence_severity";
                }
                if($request['record_type']=="staff_offence_action"){
                    $table="master_staff_offence_action";
                }
                
                $rules = [
                    'name'  =>  'required|unique:'.$table,
                    'status'    =>  'required',
                ];
                if($request['record_type']!="master_transfer_undertaking"){
                    $rules=array_merge($rules,
                        array('code'    =>  'required|unique:'.$table,)
                    );
                }
                $this->validate($request, $rules);
                $data = [
                    'name'  =>  $request['name'],
                    'status'    =>  $request['status'],
                    'created_by'=>$request['user_id'],
                    'created_at'=>date('Y-m-d h:i:s'),
                ];
                if($request['record_type']!="master_transfer_undertaking"){
                    $data=array_merge($data,
                        array('code'    =>  $request['code'],)
                    );
                }
                if($request['record_type']=="transfer_reason"){
                    $response_data = TransferReason::create($data);
                }
                if($request['record_type']=="transfer_uindertaking"){
                    $response_data = TransferUndertaking::create($data);
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
                if($request['record_type']=="subject_area"){
                    $response_data = StaffSubjectArea::create($data);
                }
                if($request['record_type']=="cureer_stage"){
                    $response_data = CureerStage::create($data);
                }
                if($request['record_type']=="qualification_description"){
                    $response_data = QualificationDescription::create($data);
                }
                if($request['record_type']=="course_mode"){
                    $response_data = CourseMode::create($data);
                    // $table="master_course_mode";
                }
                if($request['record_type']=="mgmn_body_type"){
                    $response_data = MgmntBodyType::create($data);
                }
                if($request['record_type']=="staff_award_category"){
                    $response_data = StaffAwardCategory::create($data);
                }
                if($request['record_type']=="staff_award_type"){
                    $ddition_field= ['parent_id'    =>  $request['parent_field']];
                    $data=$data+$ddition_field;
                    $response_data = StaffAwardType::create($data);
                }
                if($request['record_type']=="staff_role_responsibility"){
                    $response_data = StaResponsiblity::create($data);
                }
                if($request['record_type']=="staff_offence_type"){
                    $response_data = StaffOffenceType::create($data);
                }
                if($request['record_type']=="staff_offence_severity"){
                    $response_data = StaffOffenceSeverity::create($data);
                }
                if($request['record_type']=="staff_offence_action"){
                    $response_data = StaffOffenceAction::create($data);
                }
            }
            if($request->actiontype=="edit"){
                $data ="";
                $table="";
                if($request['record_type']=="transfer_reason"){
                    $data = TransferReason::find($request['id']);
                    $table="master_transfer_reason";
                }
                if($request['record_type']=="transfer_uindertaking"){
                    $data = TransferUndertaking::find($request['id']);
                    $table="master_transfer_undertaking";
                }
                if($request['record_type']=="mgmn_designation"){
                    $data = MgmnDesignation::find($request['id']);
                    $table="master_mgmn_designation";
                }
                if($request['record_type']=="major_group"){
                    $data = StaffMajorGrop::find($request['id']);
                    $table="master_stf_major_group";
                }
                if($request['record_type']=="position_level"){
                    $data = PositionLevel::find($request['id']);
                    $table="master_stf_position_level";
                }
                if($request['record_type']=="qualificaiton_type"){
                    $data = QualificationType::find($request['id']);
                    $table="master_stf_qualification_type";
                }
                if($request['record_type']=="qualificaiton_level"){
                    $data = QualificationLevel::find($request['id']);
                    $table="master_stf_qualification_level";
                }
                if($request['record_type']=="relationship"){
                    $data = Relationship::find($request['id']);
                    $table="master_stf_relationship";
                }
                if($request['record_type']=="marital_status"){
                    $data = MaritalStatus::find($request['id']);
                    $table="master_stf_marital_status";
                }
                if($request['record_type']=="subject_area"){
                    $data = StaffSubjectArea::find($request['id']);
                    $table="master_stf_subject_area";
                }
                if($request['record_type']=="cureer_stage"){
                    $data = CureerStage::find($request['id']);
                    $table="master_stf_cureer_stage";
                }
                if($request['record_type']=="qualification_description"){
                    $data = QualificationDescription::find($request['id']);
                    $table="master_qualification_description";
                }
                if($request['record_type']=="course_mode"){
                    $data = CourseMode::find($request['id']);
                    $table="master_course_mode";
                }
                if($request['record_type']=="mgmn_body_type"){
                    $data = MgmntBodyType::find($request['id']);
                    $table="master_mgmn_body_type";
                }
                if($request['record_type']=="staff_award_category"){
                    $data = StaffAwardCategory::find($request['id']);
                    $table="master_staff_serice_category";
                }
                if($request['record_type']=="staff_award_type"){
                    $data = StaffAwardType::find($request['id']);
                    $table="master_staff_serice_type";
                }
                if($request['record_type']=="staff_role_responsibility"){
                    $data = StaResponsiblity::find($request['id']);
                    $table="master_staff_responsibility";
                }
                if($request['record_type']=="staff_offence_type"){
                    $data = StaffOffenceType::find($request['id']);
                    $table="master_staff_offence_type";
                }
                if($request['record_type']=="staff_offence_severity"){
                    $data = StaffOffenceSeverity::find($request['id']);
                    $table="master_staff_offence_severity";
                }
                if($request['record_type']=="staff_offence_action"){
                    $data = StaffOffenceAction::find($request['id']);
                    $table="master_staff_offence_action";
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
    
    public function loadStaffMasters($param=""){
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
        if($param=="all_mgmn_desig"){
            return $this->successResponse(MgmnDesignation::all());
        }
        if($param=="all_active_mgmn_desig"){
            return $this->successResponse(MgmnDesignation::where ('status', '1')->get());
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
        if($param=="all_active_position_title"){
            return $this->successResponse(PositionTitle::where ('status', 1)->get());
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
        if($param=="all_active_qualification_List"){
            return $this->successResponse(Qualification::where('status','1')->get());
        }

        if($param=="all_relationship_list"){
            return $this->successResponse(Relationship::all());
        }
        if($param=="all_active_relationship_list"){
            return $this->successResponse(Relationship::where('status','1')->get());
        }

        if($param=="all_marital_list"){
            return $this->successResponse(MaritalStatus::all());
        }
        if($param=="all_active_marital_list"){
            return $this->successResponse(MaritalStatus::where('status','1')->get());
        }

        if($param=="all_subject_area_List"){
            return $this->successResponse(StaffSubjectArea::all());
        }
        if($param=="all_active_subject_area_list"){
            return $this->successResponse(StaffSubjectArea::where('status','1')->get());
        }

        if($param=="all_subject_List"){
            return $this->successResponse(Subjects::with('subjectArea')->get());
        }
        if($param=="all_active_subject_List"){
            return $this->successResponse(Subjects::where('status','1')->get());
        }

        if($param=="all_cureer_stage_list"){
            return $this->successResponse(CureerStage::all());
        }
        if($param=="all_active_cureer_stage_list"){
            return $this->successResponse(CureerStage::where('status','1')->get());
        }

        if($param=="all_qualification_description_list"){
            return $this->successResponse(QualificationDescription::all());
        }
        if($param=="all_active_qualification_description_list"){
            return $this->successResponse(QualificationDescription::where('status','1')->get());
        }

        if($param=="all_coursemode_list"){
            return $this->successResponse(CourseMode::all());
        }
        
        if($param=="all_active_coursemode_list"){
            return $this->successResponse(CourseMode::where('status','1')->get());
        }
        if($param=="all_mgmn_body_type"){
            return $this->successResponse(MgmntBodyType::all());
        }
        if($param=="all_active_mgmn_body_type"){
            return $this->successResponse(MgmntBodyType::where('status','1')->get());
        }

        if($param=="all_staff_award_category_List"){
            return $this->successResponse(StaffAwardCategory::all());
        }
        if($param=="all_active_staff_award_category_List"){
            return $this->successResponse(StaffAwardCategory::where('status','1')->get());
        }

        if($param=="all_staff_award_type_List"){
            return $this->successResponse(StaffAwardType::with('category')->get());
        }
        if($param=="all_active_staff_award_type_List"){
            return $this->successResponse(StaffAwardType::where('status','1')->get());
        }

        if($param=="all_staff_responsibility_List"){
            return $this->successResponse(StaResponsiblity::all());
        }
        if($param=="all_active_staff_responsibility_List"){
            return $this->successResponse(StaResponsiblity::where('status','1')->get());
        }

        if($param=="all_staff_offence_type_List"){
            return $this->successResponse(StaffOffenceType::all());
        }
        if($param=="all_active_staff_offence_type_List"){
            return $this->successResponse(StaffOffenceType::where('status','1')->get());
        }

        if($param=="all_staff_offence_severity_List"){
            return $this->successResponse(StaffOffenceSeverity::all());
        }
        if($param=="all_active_staff_offence_severity_List"){
            return $this->successResponse(StaffOffenceSeverity::where('status','1')->get());
        }
        
        if($param=="all_staff_offence_action_List"){
            return $this->successResponse(StaffOffenceAction::all());
        }
        if($param=="all_active_staff_offence_action_List"){
            return $this->successResponse(StaffOffenceAction::where('status','1')->get());
        }
        
    }
    public function load_staff_masters_by_id($param="",$id=""){
        if($param=="qdescription"){
            return $this->successResponse(QualificationDescription::where('id',$id)->first());
        }
        if($param=="qualification"){
            return $this->successResponse(Qualification::where('id',$id)->first());
        }
        if($param=="coursemode"){
            return $this->successResponse(CourseMode::where('id',$id)->first());
        }
        if($param=="subject"){
            return $this->successResponse(Subjects::where('id',$id)->first());
        }
        if($param=="relation"){
            return $this->successResponse(Relationship::where('id',$id)->first());
        }
        if($param=="position_title"){
            return $this->successResponse(PositionTitle::where('id',$id)->first());
        }
        if($param=="staff_award_type"){
            return $this->successResponse(StaffAwardType::where('id',$id)->first());
        }
        if($param=="staff_award_category"){
            return $this->successResponse(StaffAwardCategory::where('id',$id)->first());
        }
        if($param=="staff_responsibility"){
            return $this->successResponse(StaResponsiblity::where('id',$id)->first());
        }
        if($param=="staff_offence_type"){
            return $this->successResponse(StaffOffenceType::where('id',$id)->first());
        }
        if($param=="staff_offence_severity"){
            return $this->successResponse(StaffOffenceSeverity::where('id',$id)->first());
        }
        
    }
    
    public function loadStaffDropdownMasters($model="",$parent_id=""){
        if($model=="StaffAwardType"){
            return $this->successResponse(StaffAwardType::where('parent_id',$parent_id)->get());
        }
    }
}
