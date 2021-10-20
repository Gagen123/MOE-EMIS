<?php

namespace App\Http\Controllers\staff;
use GuzzleHttp\Client;
use App\Helper\EmisService;
use App\Traits\ServiceHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\AuthUser;

class TransferController extends Controller{
    public $apiService;
    use AuthUser;
    public $database_name="staff_db";
    public $table_name="transfer_application";
    // public $service_name="Transfer";
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function getcurrentTransferWindowDetails($id=""){
        $response_data= $this->apiService->listData('emis/staff/transfer/getcurrentTransferWindowDetails/'.$id);
        return $response_data;
    }

    public function submitIntialapplicantDetails(Request $request){
        $rules = [
            'name'                  =>  'required  ',
            'reason_id'             =>  'required',
        ];
        $customMessages = [
            'name.required'         => 'Please select applicant',
            'reason_id.required'    => 'Please select transfer reason',
        ];
        $this->validate($request, $rules,$customMessages);
        $request_data =[
            'id'                                =>  $request->id,
            'record_type_id'                    =>  $request->type_id,
            'name'                              =>  $request->name,
            'staff_id'                          =>  $request->staff_id,
            'transferType'                      =>  $request->transferType,
            'transferwindow_id'                 =>  $request->transferwindow_id,
            'reason_id'                         =>  $request->reason_id,
            'description'                       =>  $request->description,
            'status'                            =>  $request->status,
            'user_id'                           =>  $this->userId(),
            'user_dzo_id'                       =>  $this->getUserDzoId(),
        ];
        $response_data= $this->apiService->createData('emis/staff/transfer/submitIntialapplicantDetails', $request_data);
        return $response_data;
    }
    public function getDraftDetails(){
        $response_data= $this->apiService->listData('emis/staff/transfer/getDraftDetails/'.$this->userId());
        return $response_data;
    }

    //submitting the final application for transfer
    public function submitFinalapplicantDetails(Request $request){
        $service_name = $request->service_name;
        $rules = [
            'transferType'              =>  'required  ',
        ];
        $customMessages = [
            'transferType.required'     => 'Please select this',
        ];
        $this->validate($request, $rules,$customMessages);
        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'Transfer';
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
                            'path'              =>  $file_store_path,
                            'original_name'     =>  $file_name,
                            'user_defined_name' =>  $filenames[$index],
                        )
                    );
                }
            }
        }
        $request_data =[
            'id'                                =>  $request->id,
            'record_type_id'                    =>  $request->type_id,
            'submitterroleid'                   =>  $request->submitterroleid,
            'transferType'                      =>  $request->transferType,
            'preference_dzongkhag1'             =>  $request->preference_dzongkhag1,
            'preference_dzongkhag2'             =>  $request->preference_dzongkhag2,
            'preference_dzongkhag3'             =>  $request->preference_dzongkhag3,
            'spSubject'                         =>  $request->spSubject,
            'optional1sub'                      =>  $request->optional1sub,
            'optional2sub'                      =>  $request->optional2sub,
            'dzongkhag_id'                      =>  $this->getUserDzoId(),
            'preference_school1'                =>  $request->preference_school1,
            'preference_school2'                =>  $request->preference_school2,
            'preference_school3'                =>  $request->preference_school3,
            'attachment_details'                =>  $attachment_details,
            'user_id'                           =>  $this->userId(),
        ];
        $response_data= $this->apiService->createData('emis/staff/transfer/submitFinalapplicantDetails', $request_data);
        $appNo = json_decode($response_data)->data->aplication_number;
            $workflow_data=[
                'db_name'           =>$this->database_name,
                'table_name'        =>$this->table_name,
                'service_name'      =>$request->service_name,
                'name'              =>$request->name,
                'application_number'=>  json_decode($response_data)->data->aplication_number,
                'screen_id'         =>  json_decode($response_data)->data->aplication_number,
                'status_id'         =>  1,
                'app_role_id'       => $this->getRoleIds('roleIds'),
                'record_type_id'    => json_decode($response_data)->data->transfer_type_id,
                'remarks'           =>null,
                'user_dzo_id'       =>$this->getUserDzoId(),
                'access_level'      =>$this->getAccessLevel(),
                'working_agency_id' =>$this->getWrkingAgencyId(),
                'action_by'         =>$this->userId(),
            ];
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);

        //notification addded recently
        if( $work_response_data!="" || $work_response_data!=null){
            $notification_data=[
                'notification_for'              =>  $request->service_name,
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
        $response_data = $this->apiService->createData('emis/common/insertNotification', $notification_data);
    }
        return $work_response_data;
    }

    public function getIntialAppointmentDate($cid){
        $response_data= $this->apiService->listData('emis/staff/transfer/getIntialAppointmentDate/'.$cid);
        return $response_data;  
    }

    public function UpdatedApplicantDetails(Request $request){
        $rules = [
            'description'              =>  'required  ',
        ];
        $customMessages = [
            'description.required'     => 'please mention the description',
        ];
        $this->validate($request, $rules,$customMessages);
        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'Transfer';
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
                            'path'              =>  $file_store_path,
                            'original_name'     =>  $file_name,
                            'user_defined_name' =>  $filenames[$index],
                        )
                    );
                }
            }
        }
        $request_data =[
            'id'                                =>  $request->id,
            'reason_id'                         =>  $request->reason_id,
            'withdraw'                          =>  $request->withdraw,
            'remarks'                           =>  $request->remarks,
            'preference_dzongkhag1'             =>  $request->preference_dzongkhag1,
            'preference_dzongkhag2'             =>  $request->preference_dzongkhag2,
            'description'                       =>  $request->description,
            'application_number'                =>  $request->application_number,
            'preference_school1'                =>  $request->preference_school1,
            'preference_school2'                =>  $request->preference_school2,
            'preference_school3'                =>  $request->preference_school3,
            'spSubject'                         =>  $request->spSubject,
            'optional1sub'                      =>  $request->optional1sub,
            'optional2sub'                      =>  $request->optional2sub,
            'preference_dzongkhag1'             =>  $request->preference_dzongkhag1,
            'preference_dzongkhag2'             =>  $request->preference_dzongkhag2,
            'preference_dzongkhag3'             =>  $request->preference_dzongkhag3,
            'attachment_details'                =>  $attachment_details,
        ];
        $response_data= $this->apiService->createData('emis/staff/transfer/UpdatedApplicantDetails', $request_data);
        return $response_data;
    }

    public function loadattachementDetails($appNo=""){
        $loadTransferDetails = $this->apiService->listData('emis/staff/transfer/loadtrainsferDetails/'.$appNo);
        return $loadTransferDetails;

    }
    
    public function loadTransferAppealDetail($appNo=""){
        $loadTransferAppealDetail = $this->apiService->listData('emis/staff/transfer/loadTransferAppealDetail/'.$appNo);
        return $loadTransferAppealDetail;

    }
    public function loadAppealattachementDetails($appNo=""){
        $loadTransferDetails = $this->apiService->listData('emis/staff/transfer/loadAppealattachementDetails/'.$appNo);
        return $loadTransferDetails;

    }
    public function loadtrainsferDetails($appNo="",$type=""){

        $workflowstatus="";
        $screen_id="";
        $sequence="";
        $update_data=[
            'applicationNo'     =>  $appNo,
            'type'              =>  $type,
            'user_id'           =>  $this->userId(),
        ];
        $updated_data=json_decode($this->apiService->createData('emis/common/updateTaskDetails',$update_data));
        $loadTransferDetails = json_decode($this->apiService->listData('emis/staff/transfer/loadtrainsferDetails/'.$appNo));
        $response_data= json_decode($this->apiService->listData('emis/staff/transfer/getTransferConfigDetails/'.$this->getRoleIds('roleIds')));
        if($response_data!=null){
            foreach($response_data as $work){
                if($loadTransferDetails->data->transfer_type_id==$work->transfer_type_id && $updated_data->data->status_id==$work->sequence){
                    if($work->authority_type_id==10){
                        $loadTransferDetails->data->app_seq_no=$work->authority_type_id;
                    }
                    else{
                        $loadTransferDetails->data->app_seq_no=$work->sequence;
                    }
                }
            }
        }
        //removing notification onces visted
        $notification_data=[
            'notification_appNo'            =>  $appNo,
            'dzo_id'                        =>  $this->getUserDzoId(),
            'working_agency_id'             =>  $this->getWrkingAgencyId(),
            'access_level'                  =>  $this->getAccessLevel(),
            'action_by'                     =>  $this->userId(),
        ];
    $this->apiService->createData('emis/common/visitedNotification', $notification_data);

        return json_encode($loadTransferDetails);
    }
    public function updateTransferApplication(Request $request){
        $org_status='Verified';
        $work_status=$request->status_id+1;

        if($request->actiontype=="reject"){
            $work_status=0;
            $org_status="Rejected";
        }
        if($request->actiontype=="approve"){
            $org_status="Approved";
            $work_status=10;
        }
        if($request->actiontype=="forward"){
            $org_status="Assigned School";
            $work_status=9;
        }
        if($request->actiontype=="report"){
            $org_status="Joined";
            $work_status=8;
        }

        //notification for transfer which include the backward and forward notification
        $notification_data=[
            'notification_for'              =>  'Transfer Application',
            'notification_access_type'      =>  'all',
            'notification_appNo'            =>  $request->application_no,
            'dzo_id'                        =>  $this->getUserDzoId(),
            'working_agency_id'             =>  $this->getWrkingAgencyId(),
            'access_level'                  =>  $this->getAccessLevel(),
            'action_by'                     =>  $this->userId(),
        ];
        if($request->actiontype=="reject"){
            $notification_data=$notification_data+[
                'notification_message'          =>  'Your Application for Transfer has been rejected. Reason for the rejection: '.$request->remarks,
                'notification_type'             =>  'user',
                'call_back_link'                =>  'view_notification_message',
                'user_role_id'                  =>  $request->submitterroleid,
            ];
            $data=$this->apiService->createData('emis/common/updateNextNotification', $notification_data);
        }
        // if($request->actiontype=="verify"){
        //     $notification_data=$notification_data+[
        //         'notification_message'          =>  'Your Application for Transfer has been verified. Remarks: '.$request->remarks,
        //         'notification_type'             =>  'user',
        //         'call_back_link'                =>  'view_notification_message',
        //         'user_role_id'                  =>  $request->created_by,
                
        //     ];
        //     $data=$this->apiService->createData('emis/common/updateNextNotification', $notification_data);
        // }
        else if($request->actiontype=="approve"){
            $notification_data=$notification_data+[
                'notification_message'          =>  'Your Application for Transfer has been Approved ',
                'notification_type'             =>  'user',
                'call_back_link'                =>  'view_notification_message',
                'user_role_id'                  =>  $request->submitterroleid,
            ];
            $data=$this->apiService->createData('emis/common/updateNextNotification', $notification_data);
        }
        else if($request->actiontype=="forward"){
            $notification_data=$notification_data+[
                'notification_message'          =>  'Your Application for Transfer has been Approved and Deo had Assigned you School ',
                'notification_type'             =>  'user',
                'call_back_link'                =>  'view_notification_message',
                'user_role_id'                  =>  $request->submitterroleid,
            ];
            $data=$this->apiService->createData('emis/common/updateNextNotification', $notification_data);
        }
        else{
            //get next role id from transfer config to send notification.
            $res=$this->apiService->listData('emis/staff/transfer/getNextApprovalRoleIdForTransfer/'.$request->transfer_type_id.'/'.$request->submitterroleid.'/'.$this->getRoleIds('roleIds'));
            $response_data= json_decode($res);
            $notification_data=$notification_data+[
                'notification_message'          =>  'Transfer Notification',
                'notification_type'             =>  'role',
                'call_back_link'                =>  'tasklist',
                'user_role_id'                  =>  $response_data[0]->role_id,
            ];
        }
        $data=$this->apiService->createData('emis/common/updateNextNotification', $notification_data);
        
        if($request->transferType == "Intra Transfer"){
            $workflow_data=[
                'db_name'           =>$this->database_name,
                'table_name'        =>$this->table_name,
                'service_name'      =>"Intra Transfer",
                'preference_school' =>$request->schoolApproved,
                'application_number'=>$request->application_no,
                'screen_id'         =>$request->application_no,
                'status_id'         =>$work_status,
                'remarks'           =>$request->remarks,
                'user_dzo_id'       =>$this->getUserDzoId(),
                'access_level'      =>$this->getAccessLevel(),
                'working_agency_id' =>$this->getWrkingAgencyId(),
                'action_by'         =>$this->userId(),
                'dzongkhagApproved' =>$request->userDzongkhag,
            ];
        }
        if($request->transferType == "Inter Transfer"){
            $workflow_data=[
                'db_name'           =>$this->database_name,
                'status'            =>$org_status,
                'table_name'        =>$this->table_name,
                'service_name'      =>"Inter Transfer",
                'preference_school' =>$request->preference_school,
                'application_number'=>$request->application_no,
                'screen_id'         =>$request->application_no,
                'status_id'         =>$work_status,
                'remarks'           =>$request->remarks,
                'user_dzo_id'       =>$this->getUserDzoId(),
                'access_level'      =>$this->getAccessLevel(),
                'working_agency_id' =>$this->getWrkingAgencyId(),
                'action_by'         =>$this->userId(),
                'dzongkhagApproved' =>$request->userDzongkhag,
            ];
        }
        $response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        $notification_data=[
                'notification_appNo'            =>  $request->application_no,
                'dzo_id'                        =>  $this->getUserDzoId(),
                'working_agency_id'             =>  $this->getWrkingAgencyId(),
                'access_level'                  =>  $this->getAccessLevel(),
                'action_by'                     =>  $this->userId(),
        ];
        $this->apiService->createData('emis/common/visitedNotification', $notification_data);
        
        if($request->transferType=='Intra Transfer'){
            $data =[
                'id'                            =>  $request->id,
                'status'                        =>  $org_status,
                'staff_id'                      =>  $request->staff_id,
                'application_number'            =>  $request->application_no,
                'remarks'                       =>  $request->remarks,
                'transferType'                  =>  $request->transferType,
                'current_status'                =>  $request->actiontype,
                'status_id'                     =>  $work_status,
                'service_name'                  =>  "Intra Transfer",
                'preference_school'             =>$request->schoolApproved,
                'dzongkhagApproved'             =>$request->userDzongkhag,
                'schoolApproved'                =>$request->schoolApproved,
                // 'attachment_details'            =>   $attachment_details,
                'user_id'                       =>  $this->userId()
            ];

            $response_data= $this->apiService->createData('emis/staff/transfer/updateTransferApplication', $data);
        }
        else if($request->transferType=='Inter Transfer'){
            $data =[
                'id'                            =>  $request->id,
                'status'                        =>  $org_status,
                'staff_id'                      =>  $request->staff_id,
                'application_number'            =>  $request->application_no,
                'remarks'                       =>  $request->remarks,
                'preference_school'             => $request->preference_school,
                'transferType'                  =>  $request->transferType,
                'current_status'                =>  $request->actiontype,
                'status_id'                     =>  $work_status,
                'service_name'                  =>  "Inter Transfer",
                'dzongkhagApproved'             => $request->userDzongkhag,
                // 'attachment_details'            =>   $attachment_details,
                'user_id'                       =>   $this->userId()
            ];
            $response_data= $this->apiService->createData('emis/staff/transfer/updateTransferApplication', $data);
        }
        else if($request->transferType=='transferReporting'){
            $data =[
                'id'                            =>  $request->id,
                'status'                        =>  $request->status,
                'application_number'            =>  $request->aplication_number,
                'preference_school'             =>  $request->preference_school,
                'current_status'                =>  $request->actiontype,
                'dzongkhagApproved'             =>  $request->dzongkhagApproved,
                'user_id'                       =>   $this->userId()
            ];
            $response_data= $this->apiService->createData('emis/staff/transfer/updateTransferApplication', $data);
        }
        return $response_data;
    }
    public function LoadSchoolByDzoId($type="",$parent_id=""){
        $parent_id =$this->getUserDzoId();
        $type = "userdzongkhagwise";
        $response_data = $this->apiService->listData('emis/common_services/loadOrgList/'.$type.'/'.$parent_id);

        return $response_data;
    }
    public function getSubmitterId($type_id){
        
        $response_data = $this->apiService->listData('emis/staff/transfer/getSubmitterId/'.$type_id.'/'.$this->getRoleIds('roleIds'));
        return $response_data;
    }
    public function checkEligibilityForTransfer($type_id){
        $response_data = $this->apiService->listData('emis/staff/transfer/checkEligibilityForTransfer/'.$type_id.'/'.$this->getRoleIds('roleIds'));
        return $response_data;
    }
    public function getTransferTypeName($type_id){
        $response_data = $this->apiService->listData('emis/staff/transfer/getTransferTypeName/'.$type_id);
        return $response_data;
    }

    public function loadtransferDetails($type=""){
        $userId=$this->userId();
        $dzoId=$this->getUserDzoId();
        $response_data = $this->apiService->listData('emis/staff/transfer/loadtransferDetails/'.$type.'/'.$userId.'/'.$dzoId);
        return $response_data;
    }
    public function reportingTransfer($type=""){
        $dzoId=$this->getUserDzoId();
        $response_data = $this->apiService->listData('emis/staff/transfer/reportingTransfer/'.$type.'/'.$dzoId);
        return $response_data;
    }


    public function loadApplicationDetails($id=""){
        $response_data = $this->apiService->listData('emis/staff/transfer/loadApplicationDetails/'.$id);
        return $response_data;


    }
    public function getapplicatName($id=""){
        $response_data = $this->apiService->listData('emis/staff/transfer/getapplicatName/'.$id);
        return $response_data;
    }
    public function LoadApplicationDetailsByUserId($param="" ,$user_id=""){
        $response_data = $this->apiService->listData('emis/staff/transfer/LoadApplicationDetailsByUserId/'.$param.'/'.$user_id);
        return $response_data;
    }

    public function SaveTransferAppeal(Request $request){
        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'TransferAppeal';
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
                            'path'              =>  $file_store_path,
                            'original_name'     =>  $file_name,
                            'user_defined_name' =>  $filenames[$index],
                        )
                    );
                }
            }
        }
        $request_data =[
            'id'                                =>  $request->id,
            'record_type_id'                    =>  $request->type_id,
            'transferType'                      =>  $request->transfer_type_id,
            'name'                              =>  $request->name,
            'aplication_number'                 =>  $request->aplication_number,
            'description'                       =>  $request->description,
            'attachment_details'                =>  $attachment_details,
            'user_id'                           =>  $request->user_id,
            'status'                            =>  $request->status,
            'working_agency_id'                 =>  $this->getWrkingAgencyId(),
            'remarks'                           =>  $request->remarks,
            'withdraw'                          =>  $request->withdraw,
        ];
        // dd($request_data);
        $response_data= $this->apiService->createData('emis/staff/transfer/SaveTransferAppeal',$request_data);
        //inserting into work flow
        if($request->actionType=="add"){
            $appNo=json_decode($response_data)->data->application_no;
            if( $response_data!="Not Contain" && $response_data!="Not Approved"){
                if($request->transferType=="Intra Transfer"){
                    $workflow_data=[
                        'db_name'               =>$this->database_name,
                        'table_name'            =>$this->table_name,
                        'service_name'          =>'Intra Transfer Appeal',
                        'application_number'    =>json_decode($response_data)->data->application_no,
                        'screen_id'             =>json_decode($response_data)->data->application_no,
                        'status_id'             =>1,
                        'app_role_id'           =>$this->getRoleIds('roleIds'),
                        'record_type_id'        =>json_decode($response_data)->data->transferType,
                        'user_dzo_id'           =>$this->getUserDzoId(),
                        'access_level'          =>$this->getAccessLevel(),
                        'working_agency_id'     =>$this->getWrkingAgencyId(),
                        'action_by'             =>$this->userId(),
                    ];
                    $response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
                }
                if($request->transferType=="Inter Transfer"){
                    $workflow_data=[
                        'db_name'               =>$this->database_name,
                        'table_name'            =>$this->table_name,
                        'service_name'          =>'Inter Transfer Appeal',
                        'application_number'    =>json_decode($response_data)->data->application_no,
                        'screen_id'             =>json_decode($response_data)->data->application_no,
                        'status_id'             =>1,
                        'app_role_id'           =>$this->getRoleIds('roleIds'),
                        'record_type_id'        =>json_decode($response_data)->data->transferType,
                        'user_dzo_id'           =>$this->getUserDzoId(),
                        'access_level'          =>$this->getAccessLevel(),
                        'working_agency_id'     =>$this->getWrkingAgencyId(),
                        'action_by'             =>$this->userId(),
                    ];
                    $response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
                }
                //notification next action taker
            if($response_data!="" || $response_data!=null){
                if($request->transferType="Intra Transfer"){
                    $notification_data=[
                        'notification_for'              =>  'Intra Transfer Appeal',
                        'notification_appNo'            =>  $appNo,
                        'notification_message'          =>  '',
                        'notification_type'             =>  'role',
                        'notification_access_type'      =>  'all',
                        'call_back_link'                =>  'tasklist',
                        'user_role_id'                  =>  config('services.constant.deo_role_id'),
                        'dzo_id'                        =>  $this->getUserDzoId(),
                        'working_agency_id'             =>  $this->getWrkingAgencyId(),
                        'access_level'                  =>  $this->getAccessLevel(),
                        'action_by'                     =>  $this->userId(),
                    ];
                    $response_data = $this->apiService->createData('emis/common/insertNotification', $notification_data);
                }
                if($request->transferType="Inter Transfer"){
                    $notification_data=[
                        'notification_for'              =>  'Inter Transfer Appeal',
                        'notification_appNo'            =>  $appNo,
                        'notification_message'          =>  '',
                        'notification_type'             =>  'role',
                        'notification_access_type'      =>  'all',
                        'call_back_link'                =>  'tasklist',
                        'user_role_id'                  =>  config('services.constant.hrd_role_id'),
                        'dzo_id'                        =>  $this->getUserDzoId(),
                        'working_agency_id'             =>  $this->getWrkingAgencyId(),
                        'access_level'                  =>  $this->getAccessLevel(),
                        'action_by'                     =>  $this->userId(),
                    ];
            $response_data = $this->apiService->createData('emis/common/insertNotification', $notification_data);
            }
        }
      }
      return  $response_data;
    }
}

    public function UpdateTransferAppeal(Request $request){
        if($request->actiontype=="approved"){
            $status_id = 10;
        }
        $files = $request->attachments;
        $filenames = $request->attachmentname;
        $attachment_details=[];
        $file_store_path=config('services.constant.file_stored_base_path').'TransferAppeal';
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
                            'path'              =>  $file_store_path,
                            'original_name'     =>  $file_name,
                            'user_defined_name' =>  $filenames[$index],
                        )
                    );
                }
            }
        }
        $request_data =[
            'remarks'                                =>  $request->remarks,
            'aplication_number'                      =>  $request->aplication_number,
        ];
        $response_data= $this->apiService->createData('emis/staff/transfer/UpdateTransferAppeal', $request_data);
        //Inserting into the workflow
        if( $response_data!="" ||  $response_data!=null){
                 $workflow_data=[
                'db_name'           =>'staff_db',
                'table_name'        => 'staff_appeals',
                'service_name'      => 'transfer appeal',
                'application_number'=>$request->aplication_number,
                'screen_id'         =>$request->aplication_number,
                'status_id'         => $status_id,
                'remarks'           =>$request->remarks,
                'user_dzo_id'       =>$this->getUserDzoId(),
                'access_level'      =>$this->getAccessLevel(),
                'working_agency_id' =>$this->getWrkingAgencyId(),
                'action_by'         =>$this->userId(),
        ];
        $response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);

        }
   

           //removing notification onces visted
           $notification_data=[
            'notification_appNo'            =>  $request->aplication_number,
            'dzo_id'                        =>  $this->getUserDzoId(),
            'working_agency_id'             =>  $this->getWrkingAgencyId(),
            'access_level'                  =>  $this->getAccessLevel(),
            'action_by'                     =>  $this->userId(),
    ];
    $this->apiService->createData('emis/common/visitedNotification', $notification_data);
        return  $response_data;
}

    public function LoadTransferAppealDetails($user_id=""){
        $user_id=$this->userId();
        $response_data = $this->apiService->listData('emis/staff/transfer/LoadTransferAppealDetails/'.$user_id);
        return $response_data;


    }
    public function loadPreference($id=""){
        $response_data = $this->apiService->listData('emis/staff/transfer/loadPreference/'.$id);
        return $response_data;

    }

}
