<?php

namespace App\Http\Controllers\staff;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;
class StaffServicesController extends Controller{
    use ServiceHelper;
    use AuthUser;
    public $apiService;

    public $database_name="staff_db";
    public $leave_table_name="staff_leave_application";
    public $service_name="Leave";
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
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

        $request['user_id'] = $this->userId();
        // dd($staff_data);
        $response_data= $this->apiService->createData('emis/staff/staffServices/saveStaffAward', $request->all());
        return $response_data;
    }

    public function loadStaffAward(){
        $response_data= $this->apiService->listData('emis/staff/staffServices/loadStaffAward/'.$this->userId());
        return $response_data;
    }
    public function loadStaffAwardforView($id=""){
        $response_data= $this->apiService->listData('emis/staff/staffServices/loadStaffAwardforView/'.$id);
        return $response_data;
    }


    public function deleteStaffServices($type="",$id=""){
        $response_data= $this->apiService->listData('emis/staff/staffServices/deleteStaffServices/'.$type.'/'.$id);
        return $response_data;
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
        $request['user_id'] = $this->userId();
        // dd($staff_data);
        $response_data= $this->apiService->createData('emis/staff/staffServices/saveStaffResponsibility', $request->all());
        return $response_data;
    }

    public function loadStaffResponsibility(){
        $response_data= $this->apiService->listData('emis/staff/staffServices/loadStaffResponsibility/'.$this->userId());
        return $response_data;
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
        $request['user_id'] = $this->userId();
        // dd($staff_data);
        $response_data= $this->apiService->createData('emis/staff/staffServices/saveStaffDisaplinary', $request->all());
        return $response_data;
    }

    public function loadStaffdisaplinary(){
        $response_data= $this->apiService->listData('emis/staff/staffServices/loadStaffdisaplinary/'.$this->userId());
        return $response_data;
    }

    public function loadStaffdisaplinaryByIsd($id=""){
        $response_data= $this->apiService->listData('emis/staff/staffServices/loadStaffdisaplinaryByIsd/'.$id);
        return $response_data;
    }

    public function saveStaffAttendance(Request $request){
        $request['user_id'] = $this->userId();
        $request['org']     = $this->getWrkingAgencyId();
        $request['dzongkhag']     = $this->getUserDzoId();
        $response_data= $this->apiService->createData('emis/staff/staffServices/saveStaffAttendance', $request->all());
        return $response_data;
    }

    public function loadStaffattendance($dzo_id=""){
        // $param=$this->getAccessLevel().'SSS'.$this->getUserDzoId().'SSS'.$this->getWrkingAgencyId();
        $param=$dzo_id;
        $response_data= $this->apiService->listData('emis/staff/staffServices/loadStaffattendance/'.$param);
        return $response_data;
    }

    public function loadattendanceDetails($id=""){
        $response_data= $this->apiService->listData('emis/staff/staffServices/loadattendanceDetails/'.$id);
        return $response_data;
    }
    public function checkAttendanceDetailsByDate($year="",$month=""){
        $response_data= $this->apiService->listData('emis/staff/staffServices/checkAttendanceDetailsByDate/'.$year."/".$month.'/'.$this->getWrkingAgencyId());
        return $response_data;
    }

    public function checkEligibility($type_id=""){
        $response_data= $this->apiService->listData('emis/staff/staffServices/checkEligibility/'.$type_id.'/'.$this->getRoleIds('roleIds'));
        return $response_data;
    }

    public function checkrole($staff_id="",$type_id=""){
        $appRole_id=json_decode($this->apiService->listData('system/getRoleDetails/'.$staff_id));
        if($appRole_id!=[] && $appRole_id!=null){
            $response_data= $this->apiService->listData('emis/staff/staffServices/checkEligibility/'.$type_id.'/'.$appRole_id[0]->SysRoleId);
            return $response_data;
        }else{
            return json_encode('NA');
        }

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
        $appRole_id=json_decode($this->apiService->listData('system/getRoleDetails/'.$request->staff_id));

        if($appRole_id!=[]){
            $files = $request->attachments;
            $filenames = $request->attachmentname;
            $attachment_details=[];
            $file_store_path=config('services.constant.file_stored_base_path').'Leave_services';
            if($files!=null && $files!=""){
                if(sizeof($files)>0 && !is_dir($file_store_path)){
                    mkdir($file_store_path,0777,TRUE);
                }
                if(sizeof($files)>0){
                    foreach($files as $index => $file){
                        $file_name = time().'_' .$file->getClientOriginalName();
                        move_uploaded_file($file,$file_store_path.'/'.$file_name);
                        array_push($attachment_details,
                            array(
                                'path'                   =>  $file_store_path,
                                'original_name'          =>  $file_name,
                                'user_defined_name'      =>  $filenames[$index],
                                'saveapplication_number' =>  $request->applicationNo,
                            )
                        );
                    }
                }
            }
            // dd($appRole_id[0]->SysRoleId);
            $staff_data =[
                'id'                        =>  $request->id,
                'leave_type_id'             =>  $request->leave_type_id,
                'staff_id'                  =>  $request->staff_id,
                'year'                      =>  $request->year,
                'date_of_application'       =>  $request->date_of_application,
                'from_date'                 =>  $request->from_date,
                'to_date'                   =>  $request->to_date,
                'no_days'                   =>  $request->no_days,
                'reason'                    =>  $request->reason,
                'status'                    =>  'Pending For Approval',
                'action_type'               =>  $request->action_type,
                'attachment_details'        =>  $attachment_details,
                'org'                       =>  $this->getWrkingAgencyId(),
                'dzongkhag'                 =>  $this->getUserDzoId(),
                'user_id'                   =>  $this->userId()
            ];
            // dd($staff_data);
            $response_data= $this->apiService->createData('emis/staff/staffServices/submitLeaveApplication', $staff_data);
            // dd($response_data);
            if($request->action_type=="create"){
                $appNo=json_decode($response_data)->data->application_number;
                // dd($this->getRoleIds('roleIds'), $appRole_id[0]->SysRoleId,$request->staff_id);
                $workflow_data=[
                    'db_name'               =>  $this->database_name,
                    'table_name'            =>  $this->leave_table_name,
                    'service_name'          =>  $this->service_name,
                    'application_number'    =>  $appNo,
                    'screen_id'             =>  $appNo,
                    'status_id'             =>  1,
                    'app_role_id'           =>  $appRole_id[0]->SysRoleId,
                    'record_type_id'        =>  $request->leave_type_id,
                    'remarks'               =>  $request->remarks,
                    'user_dzo_id'           =>  $this->getUserDzoId(),
                    'access_level'          =>  $this->getAccessLevel(),
                    'working_agency_id'     =>  $this->getWrkingAgencyId(),
                    'action_by'             =>  $this->userId(),
                ];
                // dd($workflow_data);
                $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
                // $response_data= json_decode($this->apiService->listData('emis/staff/staffServices/getLeaveSubmittedRole/'.));
                $notification_data=[
                    'notification_for'              =>  'Leave Application',
                    'notification_appNo'            =>  $appNo,
                    'notification_message'          =>  '',
                    'notification_type'             =>  'role',
                    'notification_access_type'      =>  'all',
                    'call_back_link'                =>  'tasklist',
                    'user_role_id'                  =>  $request->submitted_to,
                    'dzo_id'                        =>  $this->getUserDzoId(),
                    'working_agency_id'             =>  $this->getWrkingAgencyId(),
                    'access_level'                  =>  $this->getAccessLevel(),
                    'action_by'                     =>  $this->userId(),
                ];
                // dd($notification_data);
                $this->apiService->createData('emis/common/insertNotification', $notification_data);
            }
            return $response_data;
        }
        else{
            return 'No role mapping found for this selected user. Please contact with system administrator';
        }
    }
    public function loadLeaveDetailsForEdit($id=""){
        $updated_data=$this->apiService->listData('emis/staff/staffServices/loadLeaveDetailsForEdit/'.$id);
        return $updated_data;
    }

    public function editLeaveApplication(Request $request){
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
        $request['user_id'] = $this->userId();
        $response_data= $this->apiService->createData('emis/staff/staffServices/submitLeaveApplication', $request->all());
        return $response_data;
    }
    public function loadLeaveDetails($appNo="",$type=""){
        $update_data=[
            'applicationNo'     =>  $appNo,
            'type'              =>  $type,
            'user_id'           =>  $this->userId(),
        ];
        $updated_data=json_decode($this->apiService->createData('emis/common/updateTaskDetails',$update_data));
        $leave_details=json_decode($this->apiService->getListData('emis/staff/staffServices/loadLeaveDetails/'.$appNo));
        $response_data= json_decode($this->apiService->listData('emis/staff/staffServices/getLeaveConfigDetails/'.$this->getRoleIds('roleIds')));
        if($response_data!=null){
            foreach($response_data as $work){
                if($leave_details->data->leave_type_id==$work->leave_type_id && $updated_data->data->status_id==$work->sequence){
                    if($work->authority_type_id==10){
                        $leave_details->data->app_seq_no=$work->authority_type_id;
                    }
                    else{
                        $leave_details->data->app_seq_no=$work->sequence;
                    }
                }
            }
        }
        if($leave_details->data!=""){
            $data=json_decode($this->apiService->listData('emis/common_services/viewStaffDetails/by_id/'.$leave_details->data->staff_id))->data;
            $leave_details->data->applicant_details=$data;
        }
        return json_encode($leave_details);
    }

    public function verifyApproveRejectLeaveApplication(Request $request){
        $work_status=$request->status_id+1;
        $app_status='Pending for approval';
        $notification_data=[
            'notification_for'              =>  'Leave Application',
            'notification_access_type'      =>  'all',
            'notification_appNo'            =>  $request->application_number,
            'dzo_id'                        =>  $this->getUserDzoId(),
            'working_agency_id'             =>  $this->getWrkingAgencyId(),
            'access_level'                  =>  $this->getAccessLevel(),
            'action_by'                     =>  $this->userId(),
        ];
        $appRole_id=json_decode($this->apiService->listData('system/getRoleDetails/'.$request->staff_id));
        // dd($request->staff_id,$appRole_id,$request->staff_id);
        $user_id=$appRole_id[0]->user_id;
        if($request->actiontype=="reject"){
            $work_status=0;
            $app_status="Rejected";
            $notification_data=$notification_data+[
                'notification_message'          =>  'Your Application for Leave has been rejected. Reason for the rejection: '.$request->remarks,
                'notification_type'             =>  'user',
                'call_back_link'                =>  'notificationMessage',
                'user_role_id'                  =>  $user_id,
            ];
        }
        else if($request->actiontype=="approve"){
            $app_status="Approved";
            $work_status=10;
            $notification_data=$notification_data+[
                'notification_message'          =>  'Your Application for Leave has been Approved ',
                'notification_type'             =>  'user',
                'call_back_link'                =>  'notificationMessage',
                'user_role_id'                  =>  $user_id,
            ];
        }
        else{
            //get next role id from leave config to send notification.
            $res=$this->apiService->listData('emis/staff/staffServices/getAppVeriLeaveConfigDetails/'.$request->leave_type_id.'/'.$appRole_id[0]->SysRoleId.'/'.$this->getRoleIds('roleIds'));
            $response_data= json_decode($res);
            $notification_data=$notification_data+[
                'notification_message'          =>  '',
                'notification_type'             =>  'role',
                'call_back_link'                =>  'tasklist',
                'user_role_id'                  =>  $response_data->role_id,
            ];
        }
        $workflow_data=[
            'db_name'           =>  $this->database_name,
            'table_name'        =>  $this->leave_table_name,
            'service_name'      =>  $this->service_name,
            'application_number'=>  $request->application_number,
            'screen_id'         =>  $request->application_number,
            'status_id'         =>  $work_status,
            'remarks'           =>  $request->remarks,
            'user_dzo_id'       =>  $this->getUserDzoId(),
            'access_level'      =>  $this->getAccessLevel(),
            'working_agency_id' =>  $this->getWrkingAgencyId(),
            'action_by'         =>  $this->userId(),
        ];
        $update_data =[
            'status'                       =>   $app_status,
            'application_number'           =>   $request->application_number,
            'remarks'                      =>   $request->remarks,
            'user_id'                      =>   $this->userId()
        ];

        $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        $data=$this->apiService->createData('emis/common/updateNextNotification', $notification_data);
        // dd($data);
        $response_data= $this->apiService->createData('emis/staff/staffServices/verifyApproveRejectLeaveApplication', $update_data);
        return $response_data;
    }

    public function getApprovedLeaveCount($staff_id="",$leave_type_id=""){
        $response_data= $this->apiService->listData('emis/staff/staffServices/getApprovedLeaveCount/'.$staff_id.'/'.$leave_type_id);
        return $response_data;
    }
    public function getOnGoingLeave($staff_id=""){
        $response_data= $this->apiService->listData('emis/staff/staffServices/getOnGoingLeave/'.$staff_id);
        return $response_data;
    }

    public function getallLeaves(){
        $response_data= $this->apiService->listData('emis/staff/staffServices/getallLeaves/'.$this->staffId().'__'.$this->userId());
        return $response_data;
    }
    public function getLeaveBalance($staff_id="",$year=""){
        $response_data= $this->apiService->listData('emis/staff/staffServices/getLeaveBalance/'.$staff_id.'/'.$year);
        return $response_data;
    }



}
