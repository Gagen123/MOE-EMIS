<?php

namespace App\Http\Controllers\staff;

use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use App\Models\staff\PersonalDetails;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffSepSecController extends Controller{
    use ApiResponser;
    public $database="emis_staff_db";
    public $audit_database;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
        $this->audit_database = config('services.constant.auditdb');
    }
    public function saveSecondmentSeperation(Request $request){
        $modelName = "App\\Models\\staff\\"."$request->model";
        $model = new $modelName();
        $rules = [
            'staff_id'              =>  'required',
            'start_date'            =>  'required',
            // 'end_date'              =>  'required',
        ];
        $customMessages = [
            'staff_id.required'     => 'Please select applicant',
            'start_date.required'   => 'Please select applicant',
            // 'end_date.required'     => 'Please select applicant',
        ];
        $this->validate($request, $rules,$customMessages);
        $insert_data = [
            'staff_id'              =>  $request->staff_id,
            'from_date'             =>  $request->start_date,
            'to_date'               =>  $request->end_date,
            'remarks'               =>  $request->remarks,
        ];
        if(isset($request->secondment_typ)){
            $insert_data = $insert_data+[
                'secondment_id'   =>  $request->secondment_typ,
            ];
        }
        if(isset($request->seperation_type)){
            $insert_data = $insert_data+[
                'seperation_id'   =>  $request->seperation_type,
            ];
        }
        if(isset($request->agency)){
            $insert_data = $insert_data+[
                'agency'   =>  $request->agency,
            ];
        }
        if($request->action_type=="add"){
            $insert_data =$insert_data+[
                'created_by'        =>  $request->user_id,
                'created_at'        =>  date('Y-m-d h:i:s'),
            ];
            $response_data = $model::create($insert_data);
        }
        if($request->action_type=="edit"){
            $insert_data =$insert_data+[
                'updated_by'        =>  $request->user_id,
                'updated_at'        =>  date('Y-m-d h:i:s'),
            ];
            $response_data = $model::where('id',$request->id)->update($insert_data);
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadSecondment($type="",$model=""){
        $modelName = "App\\Models\\staff\\"."$model";
        $model = new $modelName();
        if($type == 'all'){
            $response_data=$model::get();
            if($response_data!=null && $response_data!="" && sizeof($response_data)){
                foreach($response_data as $data){
                    $data->staff_detials = PersonalDetails::select(
                        'emp_id',
                        'name',
                        'position_title_id',
                        'working_agency_id',
                    )
                    ->where('id', $data['staff_id'])->first();
                }
            }
            return $response_data;
        }
    }
    public function loadLeaveStaffList(){
        $modelName = "App\\Models\\staff\\"."$model";
        $model = new $modelName();
        if($type == 'all'){
            $response_data=$model::get();
            if($response_data!=null && $response_data!="" && sizeof($response_data)){
                foreach($response_data as $data){
                    $data->staff_detials = PersonalDetails::select(
                        'emp_id',
                        'name',
                        'position_title_id',
                        'working_agency_id',
                    )
                    ->where('id', $data['staff_id'])->first();
                }
            }
            return $response_data;
        }
    }
}
