<?php

namespace App\Http\Controllers\staff;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\staff_services\StaffAward;
use App\Models\staff_services\StaffResponsiblity;
use App\Models\staff_services\StaffDisaplinary;
use App\Models\staff_services\StaffAttendance;
use App\Models\staff_services\StaffAttendanceDetails;
use App\Models\staff_masters\LeaveConfiguration;
use App\Models\staff_services\LeaveApplication;
use App\Models\staff\ApplicationSequence;
class StaffServicesController extends Controller{
    use ApiResponser;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }
    
    public function saveStaffAward(Request $request){
        $rules = [
            'staff'             =>  'required',
            'award_category'    =>  'required',
            'award_given_by'    =>  'required',
            'award_type_id'     =>  'required',
            'place'             =>  'required',
            'date'              =>  'required',
        ];
        $customMessages = [
            'staff.required'            => 'This field is required',
            'award_category.required'   => 'This field is required',
            'award_given_by.required'   => 'This field is required',
            'award_type_id.required'    => 'This field is required',
            'date.required'             => 'This field is required',
            'place.required'            => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        // 'action_type'                =>  $request->action_type,
        $data =[
            'staff_id'                   =>  $request->staff,
            'award_given_by'             =>  $request->award_given_by,
            'award_type_id'              =>  $request->award_type_id,
            'date'                       =>  $request->date,
            'place'                      =>  $request->place,
            'remarks'                    =>  $request->remarks,
            'coursetitle'                =>  $request->coursetitle,
        ];
        if($request->action_type=="edit"){
            $additional=[
                'updated_by'                 =>  $request->user_id, 
                'updated_at'                 =>  date('Y-m-d h:i:s'),
            ];
            $data=$data+$additional;
            StaffAward::where('id', $request->id)->update($data);
            $response_data = StaffAward::where('id', $request->id)->first();
        }
        else{
            $additional=[
                'created_by'                 =>  $request->user_id, 
                'created_at'                 =>  date('Y-m-d h:i:s'),
            ];
            $data=$data+$additional;
            $response_data = StaffAward::create($data); 
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    
    public function loadStaffAward($user_id=""){
        return $this->successResponse(StaffAward::where('created_by',$user_id)->get());
    }
    
    public function deleteStaffServices($type="",$id=""){
        if($type=="award"){
            return $this->successResponse(StaffAward::where('id',$id)->delete());
        }
        if($type=="responsibility"){
            return $this->successResponse(StaffResponsiblity::where('id',$id)->delete());
        }
    }
    
    public function saveStaffResponsibility(Request $request){
        $rules = [
            'staff'             =>  'required',
            'responsibility'    =>  'required',
        ];
        $customMessages = [
            'staff.required'            => 'This field is required',
            'responsibility.required'   => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $data =[
            'staff_id'                   =>  $request->staff,
            'responsibility'             =>  $request->responsibility,
            'remarks'                    =>  $request->remarks,
        ];
        if($request->action_type=="edit"){
            $additional=[
                'updated_by'                 =>  $request->user_id, 
                'updated_at'                 =>  date('Y-m-d h:i:s'),
            ];
            $data=$data+$additional;
            StaffResponsiblity::where('id', $request->id)->update($data);
            $response_data = StaffResponsiblity::where('id', $request->id)->first();
        }
        else{
            $additional=[
                'created_by'                 =>  $request->user_id, 
                'created_at'                 =>  date('Y-m-d h:i:s'),
            ];
            $data=$data+$additional;
            $response_data = StaffResponsiblity::create($data); 
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadStaffResponsibility($user_id=""){
        return $this->successResponse(StaffResponsiblity::where('created_by',$user_id)->get());
    }
    
    public function saveStaffDisaplinary(Request $request){
        $rules = [
            'staff'                 =>  'required',
            'offence_date'          =>  'required',
            'offence_type_id'       =>  'required',
            'offence_severity_id'   =>  'required',
            'offence_action_id'     =>  'required',
        ];
        $customMessages = [
            'staff.required'                => 'This field is required',
            'offence_date.required'         => 'This field is required',
            'offence_type_id.required'      => 'This field is required',
            'offence_severity_id.required'  => 'This field is required',
            'offence_action_id.required'    => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $data =[
            'staff_id'                   =>  $request->staff,
            'offence_date'               =>  $request->offence_date,
            'offence_type_id'            =>  $request->offence_type_id,
            'offence_severity_id'        =>  $request->offence_severity_id,
            'offence_action_id'          =>  $request->offence_action_id,
            'offence_description'        =>  $request->offence_description,
            'description_on_action'      =>  $request->description_on_action,
        ];
        if($request->action_type=="edit"){
            $additional=[
                'updated_by'                 =>  $request->user_id, 
                'updated_at'                 =>  date('Y-m-d h:i:s'),
            ];
            $data=$data+$additional;
            StaffDisaplinary::where('id', $request->id)->update($data);
            $response_data = StaffDisaplinary::where('id', $request->id)->first();
        }
        else{
            $additional=[
                'created_by'                 =>  $request->user_id, 
                'created_at'                 =>  date('Y-m-d h:i:s'),
            ];
            $data=$data+$additional;
            $response_data = StaffDisaplinary::create($data); 
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    public function loadStaffdisaplinary($user_id=""){
        $disaplinary=StaffDisaplinary::where('created_by',$user_id)->get();
        return $this->successResponse($disaplinary);
    }

    public function saveStaffAttendance(Request $request){
        $data =[
            'year'                      =>  $request->year,
            'month'                     =>  $request->month,
            'remarks'                   =>  $request->remarks,
            'org_id'                       =>  $request->org,
            'dzongkhag_id'                 =>  $request->dzongkhag,
        ];
        if($request->action_type=="edit"){
            $additional=[
                'updated_by'                 =>  $request->user_id, 
                'updated_at'                 =>  date('Y-m-d h:i:s'),
            ];
            $data=$data+$additional;
            StaffAttendance::where('id', $request->id)->update($data);
            $response_data = StaffAttendance::where('id', $request->id)->first();
            StaffAttendanceDetails::where('att_id',$request->id)->delete();
            foreach($request->staffList as $leave){
                $att_det=[
                    'att_id'                   =>  $request->id, 
                    'staff_id'                 =>  $leave['id'],
                    'cid_work_permit'          =>  $leave['cid_work_permit'],
                    'no_present_days'          =>  $leave['no_present_days'],
                    'no_absent_days'           =>  $leave['no_present_days'],
                ];
                StaffAttendanceDetails::create($att_det);
            }
        }
        else{
            $additional=[
                'created_by'                 =>  $request->user_id, 
                'created_at'                 =>  date('Y-m-d h:i:s'),
            ];
            $data=$data+$additional;
            $response_data = StaffAttendance::create($data); 

            foreach($request->staffList as $leave){
                $att_det=[
                    'att_id'                   =>  $response_data->id, 
                    'staff_id'                 =>  $leave['id'],
                    'cid_work_permit'          =>  $leave['cid_work_permit'],
                    'no_present_days'          =>  $leave['no_present_days'],
                    'no_absent_days'           =>  $leave['no_present_days'],
                ];
                StaffAttendanceDetails::create($att_det);
            }
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    
    public function loadStaffattendance($param=""){
        // $response_data="";
        // if(strpos($param,'SSS')){
        //     $access_level=explode('SSS',$param)[0];
        //     if($access_level=="Ministry"){
        //         $response_data=StaffAttendance::all();
        //     }
        //     if($access_level=="Dzongkhag"){
        //         $response_data=where('dzongkhag_id',explode('SSS',$param)[1])->get();
        //     }
        //     if($access_level=="Org"){
        //         $response_data=StaffAttendance::where('org_id',explode('SSS',$param)[2])->get();
        //     }
        // }
        $response_data=StaffAttendance::where('org_id',$param)->get();
        return $this->successResponse($response_data);
    }
    
    public function loadattendanceDetails($id=""){
        $att_detials=StaffAttendance::where('id',$id)->first();
        $att_detials->details=StaffAttendanceDetails::where('att_id',$att_detials->id)->get();
        return $this->successResponse($att_detials);
    }
    
    public function checkAttendanceDetailsByDate($year="",$month="",$org_id=""){
        $att_detials=StaffAttendance::where('year',$year)->where('month',$month)->where('org_id',$org_id)->first();
        return $this->successResponse($att_detials);
    }
    public function checkEligibility($type_id="",$role_ids=""){
        $response_data="";
        if(strpos( $role_ids,',')){
            $role_ids=explode(',',$role_ids);
            $response_data=LeaveConfiguration::with('leaveDetails')->where('leave_type_id',$type_id)->wherein('submitter_role_id',$role_ids)
            ->select('id','leave_type_id')->get();
        }
        else{
            $response_data=LeaveConfiguration::with('leaveDetails')->where('leave_type_id',$type_id)->where('submitter_role_id',$role_ids)
            ->select('id','leave_type_id')->get();
        }
        return $this->successResponse($response_data);
    }
    public function getLeaveConfigDetails($role_ids=""){
        $result_data="";
        if(strpos( $role_ids,',')){
            $role_ids=explode(',',$role_ids);
            $roles="";
            foreach($role_ids as $role){
                $roles.="'$role',";
            }
            $roles=rtrim($roles,',');
            $result_data="SELECT l.leave_type_id,d.role_id,d.sequence,d.authority_type_id FROM master_staff_leave_config l 
            LEFT JOIN master_staff_leave_config_details d ON l.id=d.leave_config_id  
            WHERE d.role_id IN(".$roles.")";
        }
        else{
            $result_data="SELECT l.leave_type_id,d.role_id,d.sequence,d.authority_type_id FROM master_staff_leave_config l 
            LEFT JOIN master_staff_leave_config_details d ON l.id=d.leave_config_id 
            WHERE d.role_id ='".$role_ids."'";
        }
        return DB::select($result_data);
    }

    public function submitLeaveApplication(Request $request){
        $rules = [
            'staff_id'                  =>  'required',
            'reason'                    =>  'required',
            'from_date'                  =>  'required',
            'to_date'                    =>  'required',
            'no_days'                    =>  'required',
        ];
        $customMessages = [
            'staff_id.required'         => 'This field is required',
            'reason.required'           => 'This field is required',
            'from_date.required'         => 'This field is required',
            'to_date.required'           => 'This field is required',
            'no_days.required'         => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);

        $last_seq=ApplicationSequence::where('service_name','Leave')->first();
        if($last_seq==null || $last_seq==""){
            $last_seq=1;
            $app_details = [
                'service_name'                  =>  'Leave',
                'last_sequence'                 =>  $last_seq,
            ];  
            ApplicationSequence::create($app_details);
        }
        else{
            $last_seq=$last_seq->last_sequence+1;
            $app_details = [
                'last_sequence'                 =>  $last_seq,
            ];  
            ApplicationSequence::where('service_name', 'Leave')->update($app_details);
        }
        $appNo='L';
        if(strlen($last_seq)==1){
            $appNo= $appNo.date('Y').'.'.date('m').'.0000'.$last_seq;
        }
        else if(strlen($last_seq)==2){
            $appNo= $appNo.date('Y').'.'.date('m').'.000'.$last_seq;
        }
        else if(strlen($last_seq)==3){
            $appNo= $appNo.date('Y').'.'.date('m').'.00'.$last_seq;
        }
        else if(strlen($last_seq)==4){
            $appNo= $appNo.date('Y').'.'.date('m').'.0'.$last_seq;
        }
        else if(strlen($last_seq)==5){
            $appNo= $appNo.date('Y').'.'.date('m').'.'.$last_seq;
        }
        
        $data_data =[
            'application_number'        =>  $appNo,
            'leave_type_id'             =>  $request->leave_type_id,
            'staff_id'                  =>  $request->staff_id,
            'year'                      =>  $request->year,
            'date_of_application'       =>  $request->date_of_application,
            'reason'                    =>  $request->reason,
            'from_date'                 =>  $request->from_date,
            'to_date'                   =>  $request->to_date,
            'no_days'                   =>  $request->no_days,
            'org_id'                    =>  $request->org,
            'status'                    =>  $request->status,
            'dzongkhag_id'              =>  $request->dzongkhag,
            'created_by'                =>  $request->user_id, 
            'created_at'                =>  date('Y-m-d h:i:s')
        ];
        $response_data = LeaveApplication::create($data_data); 
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    
    public function loadLeaveDetails($appNo=""){
        $leave_detials=LeaveApplication::where('application_number',$appNo)->first();
        return $this->successResponse($leave_detials);
    }
    
    public function verifyApproveRejectLeaveApplication(Request $request){
        $app_details =[
            'status'                        =>  $request->status,
            'remarks'                       =>  $request->remarks,
            'updated_by'                    =>  $request->user_id, 
            'updated_at'                    =>  date('Y-m-d h:i:s')
        ];
        
        LeaveApplication::where('application_number', $request->application_number)->update($app_details);
        $response_data = LeaveApplication::where('application_number', $request->application_number)->first(); 
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }
    
}
