<?php

namespace App\Http\Controllers\staff;

use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\staff\PersonalDetails;
use App\Models\staff\QualificationDetails;
use App\Models\staff\Nomination;
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
                'marital_status'        =>  'required',
                'cid_work_permit'       =>  'required|unique:stf_staff',
                'name'                  =>  'required',
                'sex_id'                =>  'required',
                'dob'                   =>  'required',
                'contact_number'        =>  'required',
                'email'                 =>  'required |unique:stf_staff',
                'position_title'        =>  'required',
                'working_agency_id'     =>  'required',
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
            'merital_status'        =>  $request->marital_status,
            'country_id'            =>  $request->country_id,
            'village_id'            =>  $request->village_id,
            'address'               =>  $request->address,
            'contact_no'            =>  $request->contact_number,
            'email'                 =>  $request->email,
            'position_title_id'     =>  $request->position_title,
            'working_agency_id'     =>  $request->working_agency_id,
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
    
    public function loadpersonalDetails($id=""){
        return $this->successResponse(PersonalDetails::where('id',$id)->where('status','Created')->first());
    }

    public function savequalificationDetails(Request $request){
        $response_data=[];
        if($request->personal_id==""){
            $rules = [
                'description'      =>  'required',
                'qualification'    =>  'required',
                'coursemode'       =>  'required',
                'coursetitle'      =>  'required',
                'firstsub'         =>  'required',
                'country'          =>  'required',
                'startdate'        =>  'required',
                'enddate'          =>  'required'
            ];
            $this->validate($request, $rules);
        }
        $data =[
            'personal_id'           =>  $request->personal_id,
            'description'           =>  $request->description,
            'qualification'         =>  $request->qualification,
            'coursemode'            =>  $request->coursemode,
            'coursetitle'           =>  $request->coursetitle,
            'first_subject'         =>  $request->firstsub,
            'second_subject'        =>  $request->secondsub,
            'country'               =>  $request->country,
            'startdate'             =>  $request->startdate,
            'enddate'               =>  $request->enddate,
            'created_by'            =>  $request->user_id,
            'status'                =>  $request->status,
            'created_at'            =>  date('Y-m-d h:i:s')
        ];
        if($request->action_type=="add"){
            $response_data = QualificationDetails::create($data);
        }
        else if($request->action_type=="edit"){
            $act_det = QualificationDetails::where ('id', $request->qualification_id)->firstOrFail();
            $act_det->fill($data);
            $response_data=$act_det->save();
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    
    public function load_qualification($staff_id="",$user_id=""){
        return $this->successResponse(QualificationDetails::where('created_by',$user_id)->where('personal_id',$staff_id)->where('status','Pending')->get());
    }
    public function load_staff_qualification($staff_id=""){
        return $this->successResponse(QualificationDetails::where('personal_id',$staff_id)->where('status','Created')->get());
    }

    public function savenominationDetails(Request $request){
        $response_data=[];
        $rules = [
            'nomi_cid'          =>  'required',
            'nomi_name'         =>  'required',
            'nomi_desig'        =>  'required',
            'nomi_address'      =>  'required',
            'nomi_contact'      =>  'required',
            'nomi_email'        =>  'required',
            'nomi_relation'     =>  'required',
            'nomi_percentage'   =>  'required'
        ];
        $customMessages = [
            'nomi_name.required'            => 'This field is required',
            'nomi_cid.required'             => 'This field is required',
            'nomi_desig.required'           => 'This field is required',
            'nomi_address.required'         => 'This field is required',
            'nomi_email.required'           => 'This field is required',
            'nomi_relation.required'        => 'Country field is required',
            'nomi_percentage.required'      => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        
        $nomination_details =[
            'personal_id'                       =>  $request->personal_id,
            'nomination_id'                     =>  $request->nomination_id,
            'action_type'                       =>  $request->action_type,
            'nomi_cid'                          =>  $request->nomi_cid,
            'nomi_name'                         =>  $request->nomi_name,
            'nomi_desig'                        =>  $request->nomi_desig,
            'nomi_address'                      =>  $request->nomi_address,
            'nomi_contact'                      =>  $request->nomi_contact,
            'nomi_email'                        =>  $request->nomi_email,
            'nomi_relation'                     =>  $request->nomi_relation,
            'nomi_percentage'                   =>  $request->nomi_percentage,
            'created_by'                        =>  $request->user_id,
            'status'                            =>  $request->status,
            'created_at'                        =>  date('Y-m-d h:i:s')
        ];
        if($request->action_type=="add"){
            $response_data = Nomination::create($nomination_details);
        }
        else if($request->action_type=="edit"){
            $act_det = Nomination::where ('id', $request->nomination_id)->firstOrFail();
            $act_det->fill($nomination_details);
            $response_data=$act_det->save();
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function load_nominations($staff_id="",$user_id=""){
        return $this->successResponse(Nomination::where('created_by',$user_id)->where('personal_id',$staff_id)->where('status','Pending')->get());
    }
    public function load_staff_nomination($staff_id=""){
        return $this->successResponse(Nomination::where('personal_id',$staff_id)->where('status','Created')->get());
    }
    
    public function updatefinalstaffDetails(Request $request){
        $response_data=[];
        $final_details =[
            'status'           =>  'Created',
            'created_by'       =>  $request->user_id,
            'created_at'       =>  date('Y-m-d h:i:s')
        ];
        $act_det = PersonalDetails::where('id', $request->personal_id)->firstOrFail();
        $act_det->fill($final_details);
        $response_data=$act_det->save();

        QualificationDetails::where('personal_id', '=',$request->personal_id)->where('status', 'Pending')
        ->update($final_details);

        $act_det = Nomination::where ('personal_id', $request->personal_id)->where('status', 'Pending')
        ->update($final_details);

        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    
    public function loadAllStaff($type=""){
        if(strpos($type,',')){
            $emp_type=[];
            foreach(explode(',',$type) as $emp){
                array_push($emp_type,$emp);
            }
            return $this->successResponse(PersonalDetails::wherein('emp_type_id',$emp_type)->where('status','Created')->get());
        }
        else{
            return $this->successResponse(PersonalDetails::where('emp_type_id',$type)->where('status','Created')->get());
        }
        
    }
    
}
