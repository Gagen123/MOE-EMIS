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
        $rules = [
            'emp_type'              =>  'required',
            'cid_no'                =>  'required |unique:stf_staff',
            'full_name'             =>  'required',
            'position_title'        =>  'required',
            'working_agency'        =>  'required',
            'contact_number'        =>  'required',
            'email'                 =>  'required |unique:stf_staff',
            'comp_sub'              =>  'required',
            'elective_sub1'         =>  'required',
            'currier_stage'         =>  'required',
            'emp_file_code'         =>  'required',
        ];
        $this->validate($request, $rules);
        if($request->actiontype=="add"){
            $data =[
                'emp_type_id'           =>  $request->emp_type,
                'cid_work_permit'       =>  $request->cid_no,
                'name'                  =>  $request->full_name,
                'sex_id'                =>  $request->gender,
                'dob'                   =>  $request->dob,
                'merital_status'        =>  $request->gender,
                'country_id'            =>  $request->country_id,
                'position_title_id'     =>  $request->position_title,
                'village_id'            =>  $request->village_id,
                'working_agency_id'     =>  $request->working_agency,
                'contact_no'            =>  $request->contact_number,
                'email'                 =>  $request->email,
                'comp_sub_id'           =>  $request->comp_sub,
                'elective_sub_id1'      =>  $request->elective_sub1,
                'elective_sub_id2'      =>  $request->elective_sub2,
                'cureer_stagge_id'      =>  $request->currier_stage,
                'employee_code'         =>  $request->emp_file_code,
                'remarks'               =>  $request->remarks,
            ];
            $response_data = PersonalDetails::create($data);
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
}
