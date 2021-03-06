<?php

namespace App\Http\Controllers\staff;
use App\Http\Controllers\Controller;
use App\Models\staff\ApplicationAttachments;
use App\Traits\ApiResponser;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\staff_services\StaffAward;
use App\Models\staff_services\StaffResponsiblity;
use App\Models\staff_services\StaffDisaplinary;
use App\Models\staff_services\StaffAttendance;
use App\Models\staff_services\StaffAttendanceDetails;
use App\Models\staff_master_config\LeaveConfiguration;
use App\Models\staff_master_config\LeaveConfigurationDetials;
use App\Models\staff_services\LeaveApplication;
use App\Models\staff\ApplicationSequence;
use App\Models\staff\PersonalDetails;
use App\Models\staff_masters\CaseCategory;
use App\Models\staff_masters\CaseType;
use App\Models\staff_masters\ChildGroupPosition;
use App\Models\staff_masters\LeaveType;
use App\Models\staff_masters\PositionLevel;
use App\Models\staff_masters\PositionTitle;
use App\Models\staff_masters\StaffAwardType;
use App\Models\staff_masters\StaffOffenceType;
use App\Models\staff_services\ZestAward;

class StaffServicesController extends Controller{
    use ApiResponser;
    public function __construct() {
        date_default_timezone_set('Asia/Dhaka');
    }

    public function saveStaffAward(Request $request){
        $rules = [
            'staff'             =>  'required',
            'award_given_by'    =>  'required',
            'award_type_id'     =>  'required',
            'place'             =>  'required',
            'date'              =>  'required',
        ];
        $customMessages = [
            'staff.required'            => 'This field is required',
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
        $awa=[];
        $stf_award=ZestAward::get();
        if($stf_award!=null && $stf_award!="" && sizeof($stf_award)>0){
            foreach($stf_award as $aw){
                $awa1=[];
                $awa1['id']=$aw['ID'];
                $awa1['year']=$aw['Year'];
                $awa1['awarddate']=$aw['AwardDate'];
                $awa1['type']='Zest';
                $awa1['name']=$aw['FirstName'].' '.$aw['MiddleName'].' '.$aw['LastName'];
                $aw->id=$aw['ID'];
                $aw->name=$aw['FirstName'].' '.$aw['MiddleName'].' '.$aw['LastName'];
                $type=StaffAwardType::where('id',$aw['AwardTypeID'])->first();
                if($type!=null && $type!=""){
                    $awa1['awardtype']=$type->name;
                    $aw->awardtype=$type->name;
                }
                array_push($awa,$awa1);
            }
        }
        $moeaward=StaffAward::get();
        if($moeaward!=null && $moeaward!="" && sizeof($moeaward)>0){
            foreach($moeaward as $aw){
                $awa1=[];
                $awa1['id']=$aw['id'];
                $awa1['year']=$aw['date'];
                $awa1['awarddate']=$aw['date'];
                $awa1['type']='MOE';
                $staf=PersonalDetails::where('id',$aw['staff_id'])->first();
                if($staf!=null && $staf!=""){
                    $awa1['name']=$staf['name'];
                    $aw->name=$staf->name;
                }
                $type=StaffAwardType::where('id',$aw['award_type_id'])->first();
                if($type!=null && $type!=""){
                    $awa1['awardtype']=$type->name;
                    $aw->awardtype=$type->name;
                }
                array_push($awa,$awa1);
            }
        }
        return $this->successResponse($awa);
    }

    public function loadStaffAwardforView($id=""){
        $type=explode('__',$id)[1];
        $id=explode('__',$id)[0];
        if($type=="Zest"){
            $stf_award=ZestAward::where('ID',$id)->first();
            if($stf_award!=null && $stf_award!=""){
                $type=StaffAwardType::where('id',$stf_award->AwardTypeID)->first();
                if($type!=null && $type!=""){
                    $stf_award->awardtype=$type->name;
                }
                $stf_award->awardtype=$type->name;
            }
        }else{
            $stf_award=StaffAward::where('id',$id)->first();
            if($stf_award!=null && $stf_award!=""){
                $type=StaffAwardType::where('id',$stf_award->award_type_id)->first();
                if($type!=null && $type!=""){
                    $stf_award->awardtype=$type->name;
                }
                $staf=PersonalDetails::where('id',$stf_award->staff_id)->first();
                if($staf!=null && $staf!=""){
                    $stf_award->name=$staf->name;
                }
            }
        }

        return $this->successResponse($stf_award);
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
            'year'                       =>  $request->year,
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
        $roles=StaffResponsiblity::with('type')->get();
        return $this->successResponse($roles);
    }

    public function saveStaffDisaplinary(Request $request){
        $rules = [
            'staff'                 =>  'required',
            'offence_date'          =>  'required',
            'offence_type_id'       =>  'required',
            'case_type'   =>  'required',
            'case_category'     =>  'required',
        ];
        $customMessages = [
            'staff.required'                => 'This field is required',
            'offence_date.required'         => 'This field is required',
            'offence_type_id.required'      => 'This field is required',
            'case_type.required'  => 'This field is required',
            'case_category.required'    => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        $data =[
            'staff_id'                   =>  $request->staff,
            'offence_date'               =>  $request->offence_date,
            'offence_type_id'            =>  $request->offence_type_id,
            'case_type'                  =>  $request->case_type,
            'case_category'              =>  $request->case_category,
            'record_type'                =>  'MOE',
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
        $disaplinary=StaffDisaplinary::get();
        if($disaplinary!=null && $disaplinary!="" && sizeof($disaplinary)>0){
            foreach($disaplinary as $off){
                $off->case_category_name="";
                $category=CaseCategory::where('id',$off->case_category)->first();
                if($category!=null && $category!=""){
                    $off->case_category_name=$category->name;
                }
                $off->case_type_name="";
                $casetype=CaseType::where('id',$off->case_type)->first();
                if($casetype!=null && $casetype!=""){
                    $off->case_type_name=$casetype->name;
                }
                $off->offence_type="";
                $offence=StaffOffenceType::where('id',$off->offence_type_id)->first();
                if($offence!=null && $offence!=""){
                    $off->offence_type=$offence->name;
                }
                $off->emp_id="";
                $off->name="";
                $off->working_agency_id="";

                $staff_det=PersonalDetails::where('id',$off->staff_id)->first();
                if($staff_det!=null && $staff_det!=""){
                    $off->emp_id=$staff_det->emp_id;
                    $off->name=$staff_det->name;
                    $off->working_agency_id=$staff_det->working_agency_id;

                    $positions=ChildGroupPosition::where('id', $staff_det->position_title_id)->first();
                    if($positions!=null && $positions!=""){
                        $posi=PositionTitle::where('id',$positions->position_title_id)->first();
                        if($posi!=null && $posi!=""){
                            $off->position_title_name=$posi->name;
                            //get position level from position title
                            $posiLev=PositionLevel::where('id',$posi->position_level_id)->first();
                            if($posiLev!=null && $posiLev!=""){
                                $off->positionlevel=$posiLev->name;
                            }
                        }
                    }
                }
            }
        }
        return $this->successResponse($disaplinary);
    }

    public function loadStaffdisaplinaryByIsd($id=""){
        $disaplinary=StaffDisaplinary::where('id',$id)->first();
        if($disaplinary!=null && $disaplinary!=""){
            $disaplinary->case_category_name="";
            $category=CaseCategory::where('id',$disaplinary->case_category)->first();
            if($category!=null && $category!=""){
                $disaplinary->case_category_name=$category->name;
            }
            $disaplinary->case_type_name="";
            $casetype=CaseType::where('id',$disaplinary->case_type)->first();
            if($casetype!=null && $casetype!=""){
                $disaplinary->case_type_name=$casetype->name;
            }
            $disaplinary->offence_type="";
            $offence=StaffOffenceType::where('id',$disaplinary->offence_type_id)->first();
            if($offence!=null && $offence!=""){
                $disaplinary->offence_type=$offence->name;
            }

            $disaplinary->emp_id="";
            $disaplinary->name="";
            $disaplinary->working_agency_id="";
            $staff_det=PersonalDetails::where('id',$disaplinary->staff_id)->first();
            if($staff_det!=null && $staff_det!=""){
                $disaplinary->emp_id=$staff_det->emp_id;
                $disaplinary->name=$staff_det->name;
                $disaplinary->working_agency_id=$staff_det->working_agency_id;
            }
            $positions=ChildGroupPosition::where('id', $disaplinary->staff_id)->first();
            if($positions!=null && $positions!=""){
                $posi=PositionTitle::where('id',$positions->position_title_id)->first();
                if($posi!=null && $posi!=""){
                    $disaplinary->position_title_name=$posi->name;
                    //get position level from position title
                    $posiLev=PositionLevel::where('id',$posi->position_level_id)->first();
                    if($posiLev!=null && $posiLev!=""){
                        $disaplinary->positionlevel=$posiLev->name;
                    }
                }
            }
        }
        return $this->successResponse($disaplinary);
    }

    public function saveStaffAttendance(Request $request){
        $data =[
            'year'                      =>  $request->year,
            'month'                     =>  $request->month,
            'remarks'                   =>  $request->remarks,
            'org_id'                    =>  $request->org,
            'total_work_day'            =>  $request->total_work_days,
            'dzongkhag_id'              =>  $request->dzongkhag,
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
                    'no_absent_days'           =>  $leave['no_absent_days'],
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
                    'no_absent_days'           =>  $leave['no_absent_days'],
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
        if($att_detials!=null && $att_detials!=""){
            $staff=StaffAttendanceDetails::where('att_id',$att_detials->id)->get();
            if($staff!=null && $staff!="" && sizeof($staff)>0){
                foreach($staff as $per){
                    $staff_det=PersonalDetails::where('id',$per->staff_id)->first();
                    if($staff_det!=null && $staff_det!=""){
                        $per->emp_id=$staff_det->emp_id;
                        $per->name=$staff_det->name;
                    }
                    $per->position_title_name="";
                    $per->positionlevel="";
                    $positions=ChildGroupPosition::where('id', $staff_det->position_title_id)->first();
                    if($positions!=null && $positions!=""){
                        $posi=PositionTitle::where('id',$positions->position_title_id)->first();
                        if($posi!=null && $posi!=""){
                            $per->position_title_name=$posi->name;
                            $posiLev=PositionLevel::where('id',$posi->position_level_id)->first();
                            if($posiLev!=null && $posiLev!=""){
                                $per->positionlevel=$posiLev->name;
                            }
                        }
                    }

                }
                $att_detials->details=$staff;
            }
        }
        return $this->successResponse($att_detials);
    }

    public function checkAttendanceDetailsByDate($year="",$month="",$org_id=""){
        $att_detials=StaffAttendance::where('year',$year)->where('month',$month)->where('org_id',$org_id)->first();
        return $this->successResponse($att_detials);
    }
    public function checkEligibility($type_id="",$role_ids=""){
        $response_data="";
        if(strpos($role_ids,',')){
            $role_ids=explode(',',$role_ids);
            $response_data=LeaveConfiguration::with('leaveDetails')->where('leave_type_id',$type_id)->wherein('submitter_role_id',$role_ids)
            ->select('id','leave_type_id')->first();
        }
        else{
            $response_data=LeaveConfiguration::with('leaveDetails')->where('leave_type_id',$type_id)->where('submitter_role_id',$role_ids)
            ->select('id','leave_type_id')->first();
        }
        if($response_data!=null && $response_data!=""){
            $det=LeaveConfigurationDetials::where('leave_config_id',$response_data->id)->get();
            $submitted_to='NA';
            if($det!=null && $det!="" && sizeof($det)>0){
                $count = 0;
                $cong_seq=0;
                foreach($det as $d){
                    $count++;
                    if($count==1){
                        $cong_seq=$d['sequence'];
                        $submitted_to=$d['role_id'];
                    }
                    if($d['sequence']<$cong_seq){
                        $submitted_to=$d['role_id'];
                    }
                }
            }
            $response_data->submitted_to=$submitted_to;
        }
        return $this->successResponse($response_data);
    }

    public function getAppVeriLeaveConfigDetails($leave_type_id="",$app_role_id="",$role_id=""){
        $response_data=LeaveConfiguration::with('leaveDetails')->where('leave_type_id',$leave_type_id)->where('submitter_role_id',$app_role_id)
        ->select('id','leave_type_id')->first();
        if($response_data!=null && $response_data!=""){
            //done for single role onle
            if(strpos( $role_id,',')){
                $role_ids=explode(',',$role_id);
                $currentLeaveConfigDetails=LeaveConfigurationDetials::where('leave_config_id',$response_data->id)->wherein('role_id',$role_ids)
                ->select('sequence')->first();
            }
            else{
                $currentLeaveConfigDetails=LeaveConfigurationDetials::where('leave_config_id',$response_data->id)->where('role_id',$role_id)
                ->select('sequence')->first();
            }

            $nxtLeaveConfigDetails= LeaveConfigurationDetials::where('leave_config_id',$response_data->id)->where('sequence',$currentLeaveConfigDetails->sequence+1)
            ->select('id','sequence','authority_type_id','role_id')->first();
            if($response_data!=null && $response_data!=""){
                return $nxtLeaveConfigDetails;
            }else{
                return null;
            }
        }
        else{
            return null;
        }
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
            $result_data="SELECT l.leave_type_id,l.submitter_role_id,d.role_id,d.sequence,d.authority_type_id FROM master_staff_leave_config l
            LEFT JOIN master_staff_leave_config_details d ON l.id=d.leave_config_id
            WHERE d.role_id IN(".$roles.")";
        }
        else{
            $result_data="SELECT l.leave_type_id,l.submitter_role_id,d.role_id,d.sequence,d.authority_type_id FROM master_staff_leave_config l
            LEFT JOIN master_staff_leave_config_details d ON l.id=d.leave_config_id
            WHERE d.role_id ='".$role_ids."'";
        }
        return DB::select($result_data);
    }



    public function submitLeaveApplication(Request $request){
        $rules = [
            'staff_id'                  =>  'required',
            'reason'                    =>  'required',
            'from_date'                 =>  'required',
            'to_date'                   =>  'required',
            'no_days'                   =>  'required',
        ];
        $customMessages = [
            'staff_id.required'         => 'This field is required',
            'reason.required'           => 'This field is required',
            'from_date.required'         => 'This field is required',
            'to_date.required'           => 'This field is required',
            'no_days.required'         => 'This field is required',
        ];
        $this->validate($request, $rules,$customMessages);
        if($request->action_type=="create"){
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
            if($response_data!=""){
                if($request->attachment_details!=null && $request->attachment_details!=""){
                    foreach($request->attachment_details as $att){
                        $attach =[
                            'ApplicationDetailsId'      =>  $response_data->id,
                            'path'                      =>  $att['path'],
                            'user_defined_file_name'    =>  $att['user_defined_name'],
                            'name'                      =>  $att['original_name'],
                            'updoad_type'               =>  'Applicant',
                        ];
                        ApplicationAttachments::create($attach);
                    }
                }
            }
        }
        else{
            $udpate_data =[
                'reason'                    =>  $request->reason,
                'from_date'                 =>  $request->from_date,
                'to_date'                   =>  $request->to_date,
                'no_days'                   =>  $request->no_days,
                'updated_by'                =>  $request->user_id,
                'updated_at'                =>  date('Y-m-d h:i:s')
            ];
            LeaveApplication::where('id',$request->id)->update($udpate_data);
            $response_data = LeaveApplication::where('id',$request->id)->first();
            if($response_data!=""){
                if($request->attachment_details!=null && $request->attachment_details!=""){
                    foreach($request->attachment_details as $att){
                        $attach =[
                            'ApplicationDetailsId'      =>  $request->id,
                            'path'                      =>  $att['path'],
                            'user_defined_file_name'    =>  $att['user_defined_name'],
                            'name'                      =>  $att['original_name'],
                            'updoad_type'               =>  'Applicant',
                        ];
                        ApplicationAttachments::create($attach);
                    }
                }
            }
        }
        return $this->successResponse($response_data, Response::HTTP_CREATED);
    }

    public function loadLeaveDetails($appNo=""){
        $leave_detials=LeaveApplication::with('leaveDetails')->where('application_number',$appNo)->first();
        if($leave_detials!=""){
            $leave_detials->attachment=ApplicationAttachments::where('ApplicationDetailsId',$leave_detials->id)->get();
        }
        return $this->successResponse($leave_detials);
    }

    public function loadLeaveDetailsForEdit($id=""){
        $leave_detials=LeaveApplication::where('id',$id)->first();
        if($leave_detials!=""){
            $leave_detials->attachment=ApplicationAttachments::where('ApplicationDetailsId',$leave_detials->id)->get();
        }
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

    public function getApprovedLeaveCount($staff_id="",$leave_type_id=""){
        $leave_detials=LeaveApplication::where('staff_id',$staff_id)->where('leave_type_id',$leave_type_id)->where('status','Approved')->where('year',date('Y'))->select('no_days')->get();
        return $this->successResponse($leave_detials);
    }

    public function getOnGoingLeave($staff_id=""){
        $leave_detials=LeaveApplication::where('staff_id',$staff_id)->whereNotIn('status', ['Rejected','Approved'])->select('application_number')->first();
        return $this->successResponse($leave_detials);
    }

    public function getallLeaves($staff_id=""){
        $leaves=LeaveApplication::with('leaveDetails')->where('staff_id',explode('__',$staff_id)[0])->orWhere('created_by',explode('__',$staff_id)[1])->get();
        if($leaves!=null && $leaves!="" && sizeof($leaves)>0){
            foreach($leaves as $per){
                $staff_det=PersonalDetails::where('id',$per->staff_id)->first();
                if($staff_det!=null && $staff_det!=""){
                    $per->emp_id=$staff_det->emp_id;
                    $per->name=$staff_det->name;
                    $per->working_agency_id=$staff_det->working_agency_id;

                }
                $per->position_title_name="";
                $per->positionlevel="";
                $positions=ChildGroupPosition::where('id', $staff_det->position_title_id)->first();
                if($positions!=null && $positions!=""){
                    $posi=PositionTitle::where('id',$positions->position_title_id)->first();
                    if($posi!=null && $posi!=""){
                        $per->position_title_name=$posi->name;
                        $posiLev=PositionLevel::where('id',$posi->position_level_id)->first();
                        if($posiLev!=null && $posiLev!=""){
                            $per->positionlevel=$posiLev->name;
                        }
                    }
                }

            }
        }
        return $this->successResponse($leaves);
    }

    public function getLeaveBalance($staff_id="",$year=""){
        $leaveType=LeaveType::where('category','MOE')->get();
        if($leaveType!=null && $leaveType!="" && sizeof($leaveType)>0){
            foreach($leaveType as $per){
                $per->totalleave="";
                $leaves=LeaveApplication::where('staff_id',$staff_id)->where('leave_type_id',$per->id)->Where('year',$year)->where('status','Approved')->get();
                $totalLeaveavailed=0;
                if($leaves!=null && $leaves!="" && sizeof($leaves)>0){
                    foreach($leaves as $lev){
                        $totalLeaveavailed+=$lev->no_days;
                    }
                }
                $per->totalleave= $totalLeaveavailed;

                //2015 will be the base year to calculate balance
                $accumulateLeave=0;
                if(strtolower($per->name)=="earned leave"){
                    $totalapplicableleave=($year-2015)*$per->no_days;
                    $leavesbal=LeaveApplication::where('staff_id',$staff_id)->where('leave_type_id',$per->id)->Where('year','>',2015)->Where('year','<=',$year)->where('status','Approved')->get();
                    if($leavesbal!=null && $leavesbal!="" && sizeof($leavesbal)>0){
                        foreach($leavesbal as $bal){
                            $totalapplicableleave=$totalapplicableleave-$bal->no_days;
                        }
                    }
                    $accumulateLeave=$totalapplicableleave;
                }
                $per->accumulateLeave= $accumulateLeave;
                if($accumulateLeave>90){
                    $per->accumulateLeave= 90;
                }
                $per->leavebalance= ($per->no_days-$totalLeaveavailed);
            }
        }
        return $this->successResponse($leaveType);
    }

}

