<?php

namespace App\Http\Controllers\masters;


use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\masters\Subject;
use Illuminate\Support\Facades\DB;
// use TheSeer\Tokenizer\Exception;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\masters\RatingType;
use App\Models\masters\SubjectGroup;
use App\Models\masters\SubjectCategory;


class AcademicMastersController extends Controller
{
    use ApiResponser;

    public $audit_table="system_admin";

    public $database="academic_db";

    public function saveAcademicMasters(Request $request) {

        if($request['record_type']=="subject_group"){
            if($request['action_type'] =="add"){
                $rules = [
                    'name'    =>  'required|unique:aca_subject_group',
                    'status'    =>  'required',
                ];
                $customMessages = [
                    'name.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                $this->validate($request, $rules,  $customMessages);
                    $data = [
                        'name'  =>  $request['name'],
                        'status'    =>  $request['status'],
                        'created_by' =>  $request['user_id'],
                        'created_at'=>   date('Y-m-d h:i:s'),
                    ];
                    $responsedata= SubjectGroup::create($data);
            } 
            if($request['action_type']=="edit"){
                $rules = [
                    'name'    =>  'required',
                    'status'    =>  'required',
                ];
                $customMessages = [
                    'name.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                $this->validate($request, $rules,  $customMessages);
                $data = SubjectGroup::find($request['id']);

                $messs_det='name:'.$data->name.'; status:'.$data->status;
                $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','aca_subject_group','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
                $data->name = $request['name'];
                $data->status = $request['status'];
                $data->update();
                $responsedata = $data;
            }
        }
        
        if($request['record_type']=="subject"){
            if($request['action_type'] =="add"){
                $rules = [
                    'aca_sub_category_id' => 'required',
                    'aca_sub_group_id' => 'required',
                    'name'    =>  'required|unique:aca_subject',
                    'status'    =>  'required',
                ];
                $customMessages = [
                    'aca_sub_category_id.required' => 'This field is required',
                    'aca_sub_group_id.required' => 'This field is required',
                    'name.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                $this->validate($request, $rules,  $customMessages);
                $data = [
                    'aca_sub_category_id' => $request['aca_sub_category_id'],
                    'aca_sub_group_id' => $request['aca_sub_group_id'],
                    'name'  =>  $request['name'],
                    'status'    =>  $request['status'],
                    'created_by' =>  $request['user_id'],
                    'created_at'=>   date('Y-m-d h:i:s'),
                ];
                $responsedata= Subject::create($data);
            } 
            if($request['action_type']=="edit"){
                $rules = [
                    'aca_sub_category_id' => 'required',
                    'aca_sub_group_id' => 'required',
                    'name'    =>  'required',
                    'status'    =>  'required',
                ];
                $customMessages = [
                    'aca_sub_category_id.required' => 'This field is required',
                    'aca_sub_group_id.required' => 'This field is required',
                    'name.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                
                $this->validate($request, $rules,  $customMessages);

                $data = Subject::find($request['id']);
                $messs_det='aca_sub_category_id:'.$data->aca_sub_category_id.'; aca_sub_group_id:'.$data->aca_sub_group_id.'; name'.$data->name.'; status:'.$data->status;
                $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','aca_subject','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
                $data->aca_sub_category_id = $request['aca_sub_category_id'];
                $data->aca_sub_group_id = $request['aca_sub_group_id'];
                $data->name = $request['name'];
                $data->status = $request['status'];
                $data->update();
                $responsedata = $data;
            }
        }
        if($request['record_type']=="assessment_area"){
            if($request['action_type'] =="add"){
                $rules = [
                    'aca_sub_id' => 'required',
                    'aca_rating_type_id' => 'required',
                    'name'  =>  'required|unique:aca_assessment_area',
                    'display_order' => 'required',
                    'status'    =>  'required',
                ];
                $customMessages = [
                    'aca_sub_id.required' => 'This field is required',
                    'aca_rating_type_id.required' => 'This field is required',
                    'display_order.required' => 'This field is required',
                    'name.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                $this->validate($request, $rules,  $customMessages);
                $data = [
                    'aca_sub_id' => $request['aca_sub_id'],
                    'aca_rating_type_id' => $request['aca_rating_type_id'],
                    'display_order' => $request['display_order'],
                    'name'  =>  $request['name'],
                    'status'    =>  $request['status'],
                    'created_by' =>  $request['user_id'],
                    'created_at'=>   date('Y-m-d h:i:s'),
                ];
                $responsedata= Subject::create($data);
            } 
            if($request['action_type']=="edit"){
                $rules = [
                    'aca_sub_id' => 'required',
                    'aca_rating_type_id' => 'required',
                    'name'  =>  'required',
                    'display_order' => 'required',
                    'status'    =>  'required',
                ];
                $customMessages = [
                    'aca_sub_id.required' => 'This field is required',
                    'aca_rating_type_id.required' => 'This field is required',
                    'name.required' => 'This field is required',
                    'display_order.required' => 'This field is required',
                    'status.required' => 'This field is required',
                ];
                
                $this->validate($request, $rules,  $customMessages);

                $data = Subject::find($request['id']);
                $messs_det='aca_sub_id:'.$data->aca_sub_id.'; aca_rating_type_id:'.$data->aca_rating_type_id.'; display_order'.$data->display_order.'; name'.$data->name.'; status:'.$data->status;
                $procid= DB::select("CALL ".$this->audit_table.".emis_audit_proc('".$this->database."','aca_assessment_area','".$request['id']."','".$messs_det."','".$request['user_id']."','Edit')");
                $data->aca_rating_type_id = $request['aca_rating_type_id'];
                $data->aca_sub_group_id = $request['aca_sub_group_id'];
                $data->name = $request['name'];
                $data->display_order = $request['display_order'];
                $data->status = $request['status'];
                $data->update();
                $responsedata = $data;
            }
        }
        return $this->successResponse($responsedata, Response::HTTP_CREATED);

    }
    public function loadAcademicMasters($param=""){
        if($param == "all_subject_group"){
            return $this->successResponse(SubjectGroup::all());
        }
        if($param == "all_active_subject_group"){
            return $this->successResponse(SubjectGroup::where ('status', '1')->get());
        }
        if($param == "all_active_subject_category"){
            return $this->successResponse(SubjectCategory::where ('status', '1')->get());
        }
        if($param == "all_subject"){
            $subject = DB::table('aca_subject')
                ->join('aca_subject_category','aca_subject.aca_sub_category_id', '=', 'aca_subject_category.id')
                ->join('aca_subject_group','aca_subject.aca_sub_group_id', '=', 'aca_subject_group.id')
                ->select('aca_subject.id','aca_subject_category.name as sub_category_name','aca_subject.aca_sub_category_id','aca_subject.aca_sub_group_id', 'aca_subject_group.name as sub_group_name','aca_subject.name as sub_name', 'aca_subject.status',)
                ->get();
            return $this->successResponse($subject);
        }
        if($param == "all_active_subject"){
            return $this->successResponse(Subject::where ('status', '1')->get());
        }
        if($param == "all_active_rating_type"){
            return $this->successResponse(RatingType::where ('status', '1')->get());
        }
        if($param == "all_assessment_area"){
            $assessment_area = DB::table('aca_assessment_area')
                ->join('aca_subject','aca_assessment_area.aca_sub_id', '=', 'aca_subject.id')
                ->join('aca_rating_type','aca_assessment_area.aca_rating_type_id', '=', 'aca_rating_type.id')
                ->select('aca_assessment_area.id','aca_subject.name as sub_name','aca_assessment_area.aca_sub_id','aca_assessment_area.aca_rating_type_id', 'aca_rating_type.name as rating_type_name','aca_assessment_area.name as assessment_area_name', 'aca_assessment_area.status',)
                ->get();
            return $this->successResponse($assessment_area);
        }
    }
    
}
