<?php

namespace App\Http\Controllers\staff;

use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\staff\PersonalDetails;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller{
    use ApiResponser;
    public $database="emis_staff_db";
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function savePersonalDetails(Request $request){
        $response_data=[];
        if($request->personal_id==""){
            $rules = [
                'emp_type'              =>  'required',
                'cid_work_permit'       =>  'required |unique:stf_staff',
                'name'                  =>  'required',
                'position_title'        =>  'required',
                'working_agency_id'     =>  'required',
                'contact_number'        =>  'required',
                'email'                 =>  'required |unique:stf_staff',
                'comp_sub'              =>  'required',
                'elective_sub1'         =>  'required',
                'currier_stage'         =>  'required',
                'emp_file_code'         =>  'required',
            ];
            $this->validate($request, $rules);
        }
        $data =[
            'emp_type_id'           =>  $request->emp_type,
            'cid_work_permit'       =>  $request->cid_work_permit,
            'name'                  =>  $request->name,
            'sex_id'                =>  $request->sex_id,
            'dob'                   =>  $request->dob,
            'country_id'            =>  $request->country_id,
            'position_title_id'     =>  $request->position_title,
            'village_id'            =>  $request->village_id,
            'address'               =>  $request->address,
            'working_agency_id'     =>  $request->working_agency_id,
            'contact_no'            =>  $request->contact_number,
            'email'                 =>  $request->email,
            'comp_sub_id'           =>  $request->comp_sub,
            'elective_sub_id1'      =>  $request->elective_sub1,
            'elective_sub_id2'      =>  $request->elective_sub2,
            'cureer_stagge_id'      =>  $request->currier_stage,
            'employee_code'         =>  $request->emp_file_code,
            'remarks'               =>  $request->remarks,
            'created_by'            =>  $request->user_id,
            'created_at'            =>  date('Y-m-d h:i:s')
        ];
        if($request->personal_id==""){
            $response_data = PersonalDetails::create($data);
        }
        else{
            $act_det = PersonalDetails::where ('id', $request->personal_id)->firstOrFail();
            $act_det->fill($data);
            $response_data=$act_det->save();
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    
    public function loaddraftpersonalDetails(Request $request,$user_id=""){
        return $this->successResponse(PersonalDetails::where('created_by',$user_id)->where('status','Pending')->first());
    }
}
