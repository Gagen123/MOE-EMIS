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
    
    public function submitapplicantDetails(Request $request){
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
            't_id'                              =>  $request->t_id,
            'staff_id'                          =>  $request->staff_id,
            'reason_id'                         =>  $request->reason_id,
            'description'                       =>  $request->description,
            'status'                            =>  $request->status,
            'user_id'                           =>  $this->userId() 
        ];
        $response_data= $this->apiService->createData('emis/staff/transfer/submitapplicantDetails', $request_data);
        return $response_data;
    }
    
    public function getDraftDetails(){
        $response_data= $this->apiService->listData('emis/staff/transfer/getDraftDetails/'.$this->userId());
        return $response_data;
    }
    
    public function submitFinalapplicantDetails(Request $request){
        $rules = [
            'preference_dzongkhag1'              =>  'required  ',
        ];
        $customMessages = [
            'preference_dzongkhag1.required'     => 'Please select this',
        ];
        $this->validate($request, $rules,$customMessages);

        $workflowdet=$this->getsubmitterStatus('transfer');
        if($workflowdet['screen_id']=="0"){
            return "No Screen";
        }

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
                            'path'        =>  $file_store_path,
                            'original_name'           =>  $file_name,
                            'user_defined_name'       =>  $filenames[$index],
                        )
                    );
                }
            }
        }
        $request_data =[
            'id'                                =>  $request->id,
            'preference_dzongkhag1'             =>  $request->preference_dzongkhag1,
            'preference_dzongkhag2'             =>  $request->preference_dzongkhag2,
            'preference_dzongkhag3'             =>  $request->preference_dzongkhag3,
            'attachment_details'                =>  $attachment_details,
            'user_id'                           =>  $this->userId() 
        ];
        $response_data= $this->apiService->createData('emis/staff/transfer/submitFinalapplicantDetails', $request_data);
        // dd($response_data);
        $workflow_data=[
            'db_name'           =>$this->database_name,
            'table_name'        =>$this->table_name,
            'service_name'      =>$this->service_name,
            'application_number'=>json_decode($response_data)->data->aplication_number,
            'screen_id'         =>$workflowdet['screen_id'],
            'status_id'         =>$workflowdet['status'],
            'remarks'           =>null,
            'user_dzo_id'       =>$this->getUserDzoId(),
            'access_level'      =>$this->getAccessLevel(),
            'working_agency_id' =>$this->getWrkingAgencyId(),
            'action_by'         =>$this->userId(),
        ];
        // dd($workflow_data);
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        // dd($work_response_data);
        return $work_response_data;
    }

    public function loadtrainsferDetails($appNo="",$type=""){
        $update_data=[
            'applicationNo'     =>  $appNo,
            'type'              =>  $type,
            'user_id'           =>  $this->userId(),
        ];
        $updated_data=$this->apiService->createData('emis/common/updateTaskDetails',$update_data); 

        $workflowstatus=$this->getAllCurrentWorkflowStatus(json_decode($updated_data)->data->screen_id);
        $loadTransferDetails = json_decode($this->apiService->listData('emis/staff/transfer/loadtrainsferDetails/'.$appNo));
        $loadTransferDetails->app_stage=$workflowstatus;
        dd($loadTransferDetails->data);
        if(strpos(rtrim($workflowstatus,','),',')!==false){
            if($loadTransferDetails->data->status=="Under Process"){
                $loadTransferDetails->app_stage=explode(',',rtrim($workflowstatus,','))[0];
            } 
            else{
                $loadTransferDetails->app_stage=explode(',',rtrim($workflowstatus,','))[1];
            } 
        }
        dd($loadTransferDetails);
        return json_encode($loadTransferDetails);
    }
    
    public function updateTransferApplication(Request $request){
        $workflowdet=$this->getcurrentworkflowStatusForUpdate('transfer');
        $work_status=$workflowdet['status'];
        $transfer_status='Under Process';
        if($request->actiontype=="reject"){
            $work_status=0;
            $org_status="Rejected";
        }
        if($request->actiontype=="approve"){
            $org_status="Approved";
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
            'remarks'                      =>   $request->remarks,
            'user_id'                      =>   $this->userId() 
        ];
        // dd($update_data);
        $work_response_data= $this->apiService->createData('emis/common/insertWorkflow', $workflow_data);
        
        $response_data= $this->apiService->createData('emis/staff/transfer/updateTransferApplication', $update_data);
        return $response_data;
    }
}
