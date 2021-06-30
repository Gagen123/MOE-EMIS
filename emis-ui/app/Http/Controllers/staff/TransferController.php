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
    public $service_name="Transfer";
    public function __construct(EmisService $apiService){
        $this->apiService = $apiService;
    }

    public function getcurrentTransferWindowDetails($id=""){
        $response_data= $this->apiService->listData('emis/staff/transfer/getcurrentTransferWindowDetails/'.$id);
        return $response_data;
    }

    public function submitIntialapplicantDetails(Request $request){
        $rules = [
            'staff_id'              =>  'required  ',
            'reason_id'             =>  'required',
        ];
        $customMessages = [
            'staff_id.required'     => 'Please select applicant',
            'reason_id.required'    => 'Please select transfer reason',
        ];
        $this->validate($request, $rules,$customMessages);
        $request_data =[
            'id'                                =>  $request->id,
            'record_type_id'                    =>  $request->type_id,
            'staff_id'                          =>  $request->staff_id,
            'transferType'                      =>  $request->transferType,
            'transferwindow_id'                 =>  $request->transferwindow_id,
            'reason_id'                         =>  $request->reason_id,
            'description'                       =>  $request->description,
            'status'                            =>  $request->status,
            'user_id'                           =>  $this->userId()
        ];
        $response_data= $this->apiService->createData('emis/staff/transfer/submitIntialapplicantDetails', $request_data);
        return $response_data;
    }

    public function getDraftDetails(){
        $response_data= $this->apiService->listData('emis/staff/transfer/getDraftDetails/'.$this->userId());
        return $response_data;
    }

    public function submitFinalapplicantDetails(Request $request){
        $rules = [
            'transferType'              =>  'required  ',
        ];
        $customMessages = [
            'transferType.required'     => 'Please select this',
        ];
        $this->validate($request, $rules,$customMessages);
        

        // $workflowdet=$this->getsubmitterStatus('transfer');
        // if($workflowdet['screen_id']=="0"){
        //     return "No Screen";
        // }
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
            'transferType'                      =>  $request->transferType,
            'preference_dzongkhag1'             =>  $request->preference_dzongkhag1,
            'preference_dzongkhag2'             =>  $request->preference_dzongkhag2,
            'preference_dzongkhag3'             =>  $request->preference_dzongkhag3,
            'dzongkhag_id'                      =>  $this->getUserDzoId(),
            'preference_school1'                =>  $request->preference_school1,
            'preference_school2'                =>  $request->preference_school2,
            'preference_school3'                =>  $request->preference_school3,
            'attachment_details'                =>  $attachment_details,
            'user_id'                           =>  $this->userId(),
        ];
        $response_data= $this->apiService->createData('emis/staff/transfer/submitFinalapplicantDetails', $request_data);
        $workflow_data=[
            'db_name'           =>$this->database_name,
            'table_name'        =>$this->table_name,
            'service_name'      =>$this->service_name,
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
        return $work_response_data;
    }

    public function loadtrainsferDetails($appNo="",$type=""){
        $update_data=[
            'applicationNo'     =>  $appNo,
            'type'              =>  $type,
            'user_id'           =>  $this->userId(),
        ];
        $updated_data=$this->apiService->createData('emis/common/updateTaskDetails',$update_data);
        // $workflowdet=$this->getcurrentworkflowStatusForUpdate('transfer');
        // $work_status=$workflowdet['status'];
        $dat=$this->apiService->getListData('emis/common/getTaskDetials/'.$appNo);

        // $workflowstatus=$this->getAllCurrentWorkflowStatus(json_decode($updated_data)->data->screen_id);
        $loadTransferDetails = json_decode($this->apiService->listData('emis/staff/transfer/loadtrainsferDetails/'.$appNo));
        // $loadTransferDetails->app_stage=$workflowstatus;
        // if(strpos(rtrim($workflowstatus,','),',')!==false){
        //     if($loadTransferDetails->data->status=="Under Process" && json_decode($dat)->status_id!=4){
        //         if($loadTransferDetails->data->status=="Under Process" && json_decode($dat)->status_id==3){
        //             $loadTransferDetails->app_stage='Approver'; //cannot assign other then approver of transfer Application
        //         }
        //         else if($loadTransferDetails->data->status=="Under Process" && json_decode($dat)->status_id==2){
        //             $loadTransferDetails->app_stage='Verifier';
        //         }
        //         else{
        //             $loadTransferDetails->app_stage=explode(',',rtrim($workflowstatus,','))[0];
        //         }
        //     }
        //     else{
        //         if(json_decode($dat)->status_id==1){
        //             $loadTransferDetails->app_stage='Verifier';
        //         }
        //         else{
        //             $loadTransferDetails->app_stage=explode(',',rtrim($workflowstatus,','))[1];
        //         }
        //     }
        // }
        return json_encode($loadTransferDetails);
    }

    public function updateTransferApplication(Request $request){
        $workflowdet=$this->getcurrentworkflowStatusForUpdate('transfer');
        $work_status=$workflowdet['status'];
        $transfer_status='Under Process';
        if($request->actiontype=="reject"){
            $work_status=0;
            $transfer_status="Rejected";
        }
        if($request->actiontype=="approve"){
            $transfer_status="Approved";
        }
        $workflow_data=[
            'db_name'           =>$this->database_name,
            'table_name'        =>$this->table_name,
            'service_name'      =>$this->service_name,
            'application_number'=>$request->application_no,
            'screen_id'         =>$workflowdet['screen_id'],
            'status_id'         =>$work_status,
            'remarks'           =>$request->remarks,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        $update_data =[
            'status'                       =>   $transfer_status,
            'application_number'           =>   $request->application_no,
            'dzongkhagApproved'           =>   $request->dzongkhagApproved,
            'remarks'                      =>   $request->remarks,
            'user_id'                      =>   $this->userId()
        ];
        // dd($update_data);
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);

        $response_data= $this->apiService->createData('emis/staff/transfer/updateTransferApplication', $update_data);
        return $response_data;
    }

    public function LoadSchoolByDzoId($type="",$parent_id=""){
        $parent_id =$this->getUserDzoId();
        $type = "userdzongkhagwise";
        $response_data = $this->apiService->listData('emis/common_services/loadOrgList/'.$type.'/'.$parent_id);
        return $response_data;
    }
    public function loadtransferDetails($type=""){
        $userId=$this->userId();
        $response_data = $this->apiService->listData('emis/staff/transfer/loadtransferDetails/'.$type.'/'.$userId);
        return $response_data;
    }

    

}
